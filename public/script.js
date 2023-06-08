function printTable() {
    const sourceTable = document.getElementById("dtHorizontalVerticalExample");
    let newTable = document.createElement("table");

    // Create a header row for the new table
    const newHeader = document.createElement("thead");
    const headerRow = document.createElement("tr");
    headerRow.innerHTML = `
                        <th>#</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Unit of Measure</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Q1</th>
                        <th>Q1 Amount</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>June</th>
                        <th>Q2</th>
                        <th>Q2 Amount</th>
                        <th>July</th>
                        <th>Aug</th>
                        <th>Sept</th>
                        <th>Q3</th>
                        <th>Q3 Amount</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                        <th>Q4</th>
                        <th>Q4 Amount</th>
                        <th>Total Quantity</th>
                        <th>Price Catalogue</th>
                        <th>Total Amount</th>
`;
    newHeader.appendChild(headerRow);

    newTable.appendChild(newHeader);

    // Clone the data rows of the source table (excluding the header row) and append them to the new table
    const tbody = document.createElement("tbody");
    const dataRows = sourceTable.querySelectorAll("tbody tr");
    for (let i = 0; i < dataRows.length; i++) {
        const row = dataRows[i].cloneNode(true);
        tbody.appendChild(row);
    }

    newTable.appendChild(tbody);

    // Clone the footer row of the source table and append it to the new table
    const newFooter = document.createElement("tfoot");
    const footerRows = sourceTable.querySelectorAll("tfoot tr");
    for (let i = 0; i < footerRows.length; i++) {
        /*const footerRow = footerRows[i].cloneNode(true);
        const lastCell = footerRow.lastElementChild;
        const text = lastCell.textContent;
        lastCell.textContent = "";
        lastCell.appendChild(document.createTextNode(text));
        newFooter.appendChild(footerRow); */
        const footerRow = footerRows[i].cloneNode(true);
        const text = footerRow.textContent;
        newFooter.appendChild(document.createTextNode(text));
        newFooter.style.display = 'flex'
        newFooter.style.justifyContent = "flex-end"
        newFooter.style.position = "relative"
        newFooter.style.right ="-139vw"




    }
    newTable.appendChild(newFooter);
    // Add border to the new table
    newTable.style.marginTop = "5rem";
    newTable.style.border = "1px solid black";
    newTable.style.borderCollapse = "collapse";
    // Remove any previously appended tables
    const oldTable = document.getElementById("printTable");
    if (oldTable) {
        document.body.removeChild(oldTable);
    }

    // Append the new table to the body and give it an ID for future removal
    newTable.id = "printTable";
    document.body.appendChild(newTable);
    window.print();

    newTable.style.display = "none";
}
