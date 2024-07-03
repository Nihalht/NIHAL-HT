from flask import Flask, render_template, request, redirect, url_for, flash, session, jsonify
import xml.etree.ElementTree as ET
import bcrypt
import os
import json
import re
from difflib import SequenceMatcher
import requests
from bs4 import BeautifulSoup
import logging
import concurrent.futures
import time
import threading

app = Flask(__name__)
app.secret_key = os.urandom(24)

XML_FILE = 'users.xml'
CONVERSATIONS_FILE = 'conversations.json'
HEALTH_QUERIES_FILE = 'health_queries.json'
USER_RECORD_FILE = 'user_record.xml'

logging.basicConfig(level=logging.INFO)

def load_json_file(file_path, default_value):
    try:
        with open(file_path, 'r') as f:
            return json.load(f)
    except FileNotFoundError:
        logging.warning(f"{file_path} not found. Using default value.")
        return default_value

conversations = load_json_file(CONVERSATIONS_FILE, [])
health_queries = load_json_file(HEALTH_QUERIES_FILE, [])

def ensure_xml_file_exists(file_path, root_element):
    if not os.path.exists(file_path):
        root = ET.Element(root_element)
        tree = ET.ElementTree(root)
        tree.write(file_path)

ensure_xml_file_exists(XML_FILE, "users")
ensure_xml_file_exists(USER_RECORD_FILE, "user_record")

def username_exists(username):
    tree = ET.parse(XML_FILE)
    root = tree.getroot()
    return any(user.find('username').text == username for user in root.findall('user'))

def add_user(username, hashed_password):
    tree = ET.parse(XML_FILE)
    root = tree.getroot()
    new_user = ET.SubElement(root, 'user')
    ET.SubElement(new_user, 'username').text = username
    ET.SubElement(new_user, 'password').text = hashed_password
    tree.write(XML_FILE)

def get_hashed_password(username):
    tree = ET.parse(XML_FILE)
    root = tree.getroot()
    for user in root.findall('user'):
        if user.find('username').text == username:
            return user.find('password').text
    return None

def clean_text(text):
    return re.sub(r'[^\w\s]', '', text.lower())

def string_similarity(a, b):
    return SequenceMatcher(None, clean_text(a), clean_text(b)).ratio()

def format_health_response(response):
    formatted = "Health Information:\n\n"
    for key, value in response.items():
        if isinstance(value, list):
            formatted += f"{key.replace('_', ' ').capitalize()}:\n"
            for item in value[:2]:  # Limit to 2 items
                formatted += f"• {item}\n"
        elif value:
            formatted += f"{key.replace('_', ' ').capitalize()}: {value}\n"
        formatted += "\n"
    return formatted.strip()

def search_google(query):
    url = f"https://www.google.com/search?q={query}"
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'}
    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.text, 'html.parser')
    
    search_results = []
    for g in soup.find_all('div', class_='g'):
        anchors = g.find_all('a')
        if anchors:
            link = anchors[0]['href']
            if link.startswith('/url?q='):
                link = link.split('/url?q=')[1].split('&')[0]
            if link.startswith('http') and 'google' not in link:
                search_results.append(link)
    
    return search_results[:3]  # Return top 3 results

def extract_info(url):
    try:
        headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'}
        response = requests.get(url, headers=headers, timeout=10)
        soup = BeautifulSoup(response.text, 'html.parser')
        
        text = soup.get_text()
        
        info = {
            "possible_conditions": [],
            "urgency": "",
            "common_age_groups": "",
            "immediate_actions": [],
            "precautions": [],
            "potential_treatments": [],
            "medications": [],
            "lifestyle_changes": []
        }
        
        keywords = {
            "possible_conditions": ["condition", "disease", "disorder"],
            "urgency": ["urgent", "emergency", "immediate"],
            "common_age_groups": ["age", "common in"],
            "immediate_actions": ["do immediately", "first step", "right away"],
            "precautions": ["precaution", "avoid", "don't"],
            "potential_treatments": ["treatment", "therapy", "procedure"],
            "medications": ["medication", "drug", "medicine"],
            "lifestyle_changes": ["lifestyle", "habit", "change"]
        }
        
        for key, words in keywords.items():
            for word in words:
                pattern = re.compile(r"(?i)(?:{}[:\s]*)([^.!?\n]+)[.!?\n]".format(word))
                matches = pattern.findall(text)
                if isinstance(info[key], list):
                    info[key].extend(matches[:2])  # Limit to 2 matches
                elif not info[key] and matches:
                    info[key] = matches[0]
        
        return info
    except Exception as e:
        logging.error(f"Error extracting info from {url}: {e}")
        return {}

def web_scrape(query):
    search_results = search_google(query)
    
    with concurrent.futures.ThreadPoolExecutor(max_workers=3) as executor:
        results = list(executor.map(extract_info, search_results))
    
    combined_info = {
        "possible_conditions": [],
        "urgency": "",
        "common_age_groups": "",
        "immediate_actions": [],
        "precautions": [],
        "potential_treatments": [],
        "medications": [],
        "lifestyle_changes": []
    }
    
    for result in results:
        for key, value in result.items():
            if isinstance(combined_info[key], list):
                combined_info[key].extend(value)
            elif not combined_info[key] and value:
                combined_info[key] = value
    
    for key in combined_info:
        if isinstance(combined_info[key], list):
            combined_info[key] = list(dict.fromkeys(combined_info[key]))[:2]  # Limit to 2 unique items
    
    return combined_info

def update_json_dataset(query, attributes):
    global health_queries
    health_queries.append({
        "input": query,
        "response": attributes
    })
    
    with open(HEALTH_QUERIES_FILE, 'w') as f:
        json.dump(health_queries, f, indent=2)

def get_response(user_input):
    conversation_threshold = 0.95
    health_query_threshold = 0.85
    responses = []

    cleaned_input = clean_text(user_input)
    found_response = False

    for pair in conversations:
        similarity = string_similarity(cleaned_input, clean_text(pair['input']))
        if similarity >= conversation_threshold:
            responses.append({"type": "General", "similarity": similarity, "response": pair['response']})
            found_response = True

    for query in health_queries:
        similarity = string_similarity(cleaned_input, clean_text(query['input']))
        if similarity >= health_query_threshold:
            formatted_response = format_health_response(query['response'])
            responses.append({"type": "Health", "similarity": similarity, "response": formatted_response})
            found_response = True

    responses.sort(reverse=True, key=lambda x: x['similarity'])

    if not found_response:
        scraped_attributes = web_scrape(user_input)
        if any(scraped_attributes.values()):
            formatted_response = format_health_response(scraped_attributes)
            responses.append({"type": "Health", "similarity": 1.0, "response": formatted_response})
            update_json_dataset(user_input, scraped_attributes)
            found_response = True
        else:
            record_user_query(user_input)
            responses = [{"response": "I'm sorry, but I couldn't find a suitable answer to your query. Could you please rephrase or provide more details?"}]

    return responses

def record_user_query(user_input, response=None):
    tree = ET.parse(USER_RECORD_FILE)
    root = tree.getroot()
    new_record = ET.SubElement(root, 'record')
    ET.SubElement(new_record, 'query').text = user_input
    if response:
        ET.SubElement(new_record, 'response').text = response
    tree.write(USER_RECORD_FILE)

def process_user_records():
    try:
        tree = ET.parse(USER_RECORD_FILE)
        root = tree.getroot()
        records = root.findall('record')
        
        for record in records:
            query = record.find('query').text
            existing_response = record.find('response')
            
            if existing_response is None:
                responses = get_response(query)
                
                if responses:
                    response_text = responses[0]['response']
                    ET.SubElement(record, 'response').text = response_text
                else:
                    ET.SubElement(record, 'response').text = "No suitable answer found."
        
        tree.write(USER_RECORD_FILE)
    except Exception as e:
        logging.error(f"Error processing user records: {e}")

@app.route('/')
def login():
    return render_template('login.html')

@app.route('/login', methods=['POST'])
def login_post():
    username = request.form.get('username')
    password = request.form.get('password').encode('utf-8')

    hashed_password = get_hashed_password(username)

    if hashed_password:
        if bcrypt.checkpw(password, hashed_password.encode('utf-8')):
            session['username'] = username
            flash('Logged in successfully!', 'success')
            return redirect(url_for('index'))
        else:
            flash('Invalid username or password. Please try again.', 'error')
            return redirect(url_for('login'))
    else:
        flash('Invalid username or password. Please try again.', 'error')
        return redirect(url_for('login'))

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form.get('username')
        password = request.form.get('password').encode('utf-8')

        if username_exists(username):
            flash('Username already exists. Please choose a different one.', 'error')
            return redirect(url_for('register'))

        hashed_password = bcrypt.hashpw(password, bcrypt.gensalt()).decode('utf-8')

        add_user(username, hashed_password)

        flash('Registration successful! You can now log in.', 'success')
        return redirect(url_for('login'))

    return render_template('register.html')

@app.route('/index')
def index():
    if 'username' in session:
        username = session['username']
        return render_template('index.html', username=username)
    else:
        flash('You need to log in first.', 'error')
        return redirect(url_for('login'))

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/logout')
def logout():
    session.pop('username', None)
    flash('Logged out successfully.', 'success')
    return redirect(url_for('login'))

@app.route('/converse', methods=['POST'])
def converse():
    user_input = request.json.get('user_input')
    responses = get_response(user_input)
    
    if responses:
        formatted_responses = []
        for response in responses:
            if response.get('type') == 'Health':
                formatted_responses.append(response['response'])
            else:
                formatted_responses.append(f"{response['response']}")
        return jsonify({"responses": formatted_responses})
    else:
        return jsonify({"responses": ["I'm sorry, not found in dataset"]})

if __name__ == '__main__':
    process_user_records()  # Process any existing queries in user_record.xml
    
    def run_periodic_processing():
        while True:
            time.sleep(3600)  # Wait for 1 hour
            process_user_records()
    
    processing_thread = threading.Thread(target=run_periodic_processing)
    processing_thread.daemon = True
    processing_thread.start()
    
    app.run(debug=True)