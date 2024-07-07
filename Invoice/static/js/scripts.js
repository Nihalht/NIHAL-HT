document.addEventListener('DOMContentLoaded', function() {
    const addProductButton = document.getElementById('addProduct');
    const generatePDFButton = document.getElementById('generatePDF');
    const productTableBody = document.getElementById('productTableBody');
    const grandTotalInput = document.getElementById('grandTotal');
    const grandTotalInWordsCell = document.getElementById('grandTotalInWords');
    let rowCount = 0;

    function addProductRow() {
        rowCount++;
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${rowCount}</td>
            <td><input type="text" class="description" placeholder="Description"></td>
            <td><input type="number" class="quantity" placeholder="Qty" min="0" step="0.01"></td>
            <td><input type="number" class="rate" placeholder="Rate" min="0" step="0.01"></td>
            <td><input type="number" class="amount" placeholder="Total Amount" min="0" step="0.01"></td>
            <td><button type="button" class="removeRow">Remove</button></td>
        `;
        productTableBody.appendChild(newRow);

        const removeButton = newRow.querySelector('.removeRow');
        removeButton.addEventListener('click', function() {
            productTableBody.removeChild(newRow);
            updateRowNumbers();
        });
    }

    function updateRowNumbers() {
        const rows = productTableBody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            row.firstElementChild.textContent = index + 1;
        });
        rowCount = rows.length;
    }

    function updateGrandTotalInWords() {
        const grandTotal = parseFloat(grandTotalInput.value) || 0;
        grandTotalInWordsCell.textContent = numberToWords(grandTotal);
    }

    addProductButton.addEventListener('click', addProductRow);
    generatePDFButton.addEventListener('click', function() {
        const doc = generatePDF();
        doc.save('quotation.pdf');
    });

    grandTotalInput.addEventListener('input', updateGrandTotalInWords);

    // Add initial row
    addProductRow();
});