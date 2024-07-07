function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    doc.setFont("helvetica", "normal");
    
    const gstin = document.getElementById('gstin').value;
    const mobile = document.getElementById('mobile').value;
    
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 255);
    doc.text(`GSTIN : ${gstin}`, 10, 10);
    doc.text(`Mob: ${mobile}`, doc.internal.pageSize.width - 10, 10, { align: 'right' });
    
    doc.setFontSize(24);
    doc.setTextColor(255, 0, 0);
    doc.text('M.S. ENTERPRISES', doc.internal.pageSize.width / 2, 20, { align: 'center' });
    
    doc.setFontSize(10);
    doc.setTextColor(0, 0, 255);
    doc.text('(Authorised Dealer for Rotary Oil Extraction Machines and Chaff Cutter Machines)', 
             doc.internal.pageSize.width / 2, 25, { align: 'center' });
    
    doc.text('Behind M.D.C.C. Bank, Near K.S.R.T.C. Busstand, K.R.Pete Taluk, Mandya Dsit.', 
             doc.internal.pageSize.width / 2, 30, { align: 'center' });
    
    doc.setDrawColor(0);
    doc.line(10, 32, doc.internal.pageSize.width - 10, 32);
    doc.line(10, 42, doc.internal.pageSize.width - 10, 42);
    
    doc.setTextColor(0);
    doc.setFontSize(16);
    doc.text('QUOTATION', doc.internal.pageSize.width / 2, 39, { align: 'center' });
    
    const currentDate = new Date().toLocaleDateString();
    doc.setFontSize(10);
    doc.text(`Date: ${currentDate}`, doc.internal.pageSize.width - 14, 46, { align: 'right' });
    
    doc.setFontSize(10);
    let yPos = 50;
    
    const toDetails = document.getElementById('to_details').value;
    const rightDetails = document.getElementById('sub_details').value;
    const subDetails = document.querySelector('textarea[name="sub_details"][placeholder="Sub:"]').value;
    
    doc.text('To :', 14, yPos);
    const toLines = doc.splitTextToSize(toDetails, 80);
    doc.text(toLines, 14, yPos + 5);
    
    doc.text(rightDetails, doc.internal.pageSize.width - 14, yPos, { align: 'right' });
    yPos += (toLines.length * 5) + 15;
    
    doc.text('Sub:', 14, yPos);
    const subLines = doc.splitTextToSize(subDetails, doc.internal.pageSize.width - 28);
    doc.text(subLines, 14, yPos + 5);
    yPos += (subLines.length * 5) + 10;
    
    doc.text("Dear sir,", 14, yPos);
    yPos += 5;
    const additionalText = "         We thank you very much for your enquiry towards supply of Rotary type oil extraction machine. Please find enclosed our most competitive prices. We hope our offer is in line with your requirement. Please call us for any further clarification regarding our proposal. We are looking towards to receive your valued purchase order to take up the manufacturing process.";
    const additionalLines = doc.splitTextToSize(additionalText, doc.internal.pageSize.width - 28);
    doc.text(additionalLines, 14, yPos);
    yPos += (additionalLines.length * 5) + 10;

    const gst = document.getElementById('gst').value;
    const cgst = document.getElementById('cgst').value;
    const grandTotal = document.getElementById('grandTotal').value;

    const productRows = Array.from(document.querySelectorAll('#productTableBody tr'));
    const itemCount = productRows.length;

    let tableOptions = {
        head: [['Sl.\nNo', 'Description', 'Qnty', 'Rate', 'Amount']],
        body: productRows.map((row, index) => {
            const cells = row.querySelectorAll('td');
            return [
                index + 1,
                cells[1].querySelector('input').value,
                cells[2].querySelector('input').value,
                cells[3].querySelector('input').value,
                cells[4].querySelector('input').value,
            ];
        }).concat([
            ['', '', '', 'GST (@9%) ', gst],
            ['', '', '', 'CGST (@9%)', cgst],
            ['', '', '', 'Grand Total', grandTotal]
        ]),
        startY: yPos,
        theme: 'grid',
        styles: { font: 'helvetica', fontSize: 9 },
        headStyles: { fillColor: [200, 200, 200], textColor: 0, fontStyle: 'bold' },
        columnStyles: { 
            0: { cellWidth: 10 },
            1: { cellWidth: 'auto' },
            2: { cellWidth: 20 },
            3: { cellWidth: 30 },
            4: { cellWidth: 40 }
        },
    };

    if (itemCount <= 2) {
        tableOptions.margin = { bottom: 60 };
    }

    doc.autoTable(tableOptions);
    
    const amountInWords = numberToWords(parseFloat(grandTotal) || 0);
    
    yPos = doc.lastAutoTable.finalY + 5;
    
    doc.setFontSize(10);
    doc.text(`Rupees ${amountInWords} only`, 14, yPos);
    yPos += 10;
    
    doc.setFontSize(10);
    doc.setFont("helvetica", "bold");
    doc.text("Terms and conditions :", 14, yPos);
    yPos += 5;
    doc.setFont("helvetica", "normal");
    const terms = [
        "a)   Validity     :   Quoted price valid for 40 days from the date of submission.",
        "b)   Payment      :   Advance 100% immediate payment at the time of delivery.",
        "c)   Completion   :   The total scope of work is completed within 3-4 weeks from the date of your Period P.O and advance.",
        "d)   Taxes        :   GST @ 18% extra",
        "e)   Others       :   Transportation and installation extra."
    ];
    terms.forEach(term => {
        doc.text(term, 14, yPos);
        yPos += 5;
    });
    yPos += 5;
    
    doc.text("Thanking you and assuring you of our services always.", 14, yPos);
    yPos += 10;
    
    const name = document.getElementById('name').value;
    const bankName = document.getElementById('bank_name').value;
    const bankAcNo = document.getElementById('bank_ac_no').value;
    const ifscCode = document.getElementById('ifsc_code').value;
    const branch = document.getElementById('branch').value;

    const pageWidth = doc.internal.pageSize.width;
    const tableWidth = pageWidth * 0.5;

    doc.autoTable({
        head: [['Bank Details', '']],
        body: [
            ['Name', name],
            ['Bank Name', bankName],
            ['Bank A/C No', bankAcNo],
            ['IFSC Code', ifscCode],
            ['Branch', branch]
        ],
        startY: yPos,
        theme: 'grid',
        styles: { font: 'times', fontSize: 10 },
        headStyles: { fillColor: [200, 200, 200], textColor: 0, fontStyle: 'bold' },
        columnStyles: { 
            0: { cellWidth: tableWidth * 0.3},
            1: { cellWidth: tableWidth * 0.5 }
        },
        margin: { left: 14 },
        tableWidth: tableWidth
    });

    yPos = doc.lastAutoTable.finalY + 10;
    doc.setFontSize(10);
    doc.text('For M.S.ENTERPRISES', doc.internal.pageSize.width - 14, yPos, { align: 'right' });
    
    return doc;
}
function numberToWords(number) {
    const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
    const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
    const teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];

    function convertLessThanOneThousand(n) {
        if (n >= 100) {
            return ones[Math.floor(n / 100)] + ' Hundred ' + convertLessThanOneThousand(n % 100);
        }
        if (n >= 20) {
            return tens[Math.floor(n / 10)] + ' ' + ones[n % 10];
        }
        if (n >= 10) {
            return teens[n - 10];
        }
        return ones[n];
    }

    if (number === 0) return 'Zero';

    let result = '';
    if (number >= 10000000) {
        result += convertLessThanOneThousand(Math.floor(number / 10000000)) + ' Crore ';
        number %= 10000000;
    }
    if (number >= 100000) {
        result += convertLessThanOneThousand(Math.floor(number / 100000)) + ' Lakh ';
        number %= 100000;
    }
    if (number >= 1000) {
        result += convertLessThanOneThousand(Math.floor(number / 1000)) + ' Thousand ';
        number %= 1000;
    }
    if (number > 0) {
        result += convertLessThanOneThousand(number);
    }

    return result.trim();
}