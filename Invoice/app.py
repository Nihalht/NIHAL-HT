from flask import Flask, render_template, request

app = Flask(__name__)

# Define route for the loading page
@app.route('/')
def loading():
    return render_template('loading.html')

# Define route for the main page
@app.route('/main')
def main():
    return render_template('index.html')

# Define route for the About Us page
@app.route('/about')
def about():
    return render_template('aboutus.html')

# Define route for the Our Services page
@app.route('/services')
def services():
    return render_template('services.html')

@app.route('/contact')
def contact():
    return render_template('contact.html')

if __name__ == '__main__':
    app.run(debug=True)