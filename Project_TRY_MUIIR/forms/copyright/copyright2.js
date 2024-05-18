function openPopup() {
    var tableContainer = document.getElementById('tableContainer');
    var dynamicTableData = tableContainer.innerHTML;
    var checkbox = document.querySelector('input[name="samedata"]');
    var previewHTML = '<div class="preview-container">';
    previewHTML +=
        '<h3 style="text-align: center;"><b>FORM - XIV <br> Application for Registration of Copyright<br> See Rule 70</b></h3>';
    previewHTML += '<hr>';
    previewHTML +=
        '<p>1. <sup>12</sup>I also send herewith duly completed the Statement of further particulars relating to the work (Not applicable for filing copyright)</p><br>';
    previewHTML +=
        '<p>2. In accordance with rule 70 of the Copyright Rules, 2012, I have sent by prepaid registered post copies of this letter and of the Statement of Particulars and Statement of Further Particulars to other parties13 concerned, as shown below:</p><br>';

    previewHTML += '<table>';
    previewHTML += '<tr>';
    previewHTML += '<th>Name</th>';
    previewHTML += '<th>Pin Code</th>';
    previewHTML += '<th>Address</th>';
    previewHTML += '<th>Nationality</th>';
    previewHTML += '</tr>';
    previewHTML += '<tr>';
    previewHTML += '<td>Marwadi University</td>';
    previewHTML += '<td>36003</td>';
    previewHTML += '<td>Registrar, Rajkot Morbi Road, Rajkot </td>';
    previewHTML += '<td>India</td>';
    previewHTML += '</tr>';
    var dynamicTable = $('<table>' + dynamicTableData + '</table>');
    dynamicTable.find('tr').slice(1).each(function () {
        var columns = $(this).find('td');
        previewHTML += '<tr>';

        // Add the columns in the order of Name, Address, Pin Code, Nationality
        previewHTML += '<td>' + columns.eq(1).html() + '</td>'; // Name
        previewHTML += '<td>' + columns.eq(2).html() + '</td>'; // Address
        previewHTML += '<td>' + columns.eq(3).html() + '</td>'; // Pin Code
        previewHTML += '<td>' + columns.eq(4).html() + '</td>'; // Nationality

        previewHTML += '</tr>';
    });
    previewHTML += '</table><br>';

    previewHTML += '<p><b>3. Communications on this subject may be addressed to:</b></p>';

    previewHTML += '<table>';
    previewHTML += '<tr>';
    previewHTML += '<th>Name</th>';
    previewHTML += '<th>Communication Address</th>';
    previewHTML += '<th>Pin Code</th>';
    previewHTML += '<th>Phone</th>';
    previewHTML += '</tr>';
    previewHTML += '<tr>';
    previewHTML += '<td>Mr Naresh Dilawarsinh Jadeja</td>';
    previewHTML += '<td>Registrar, Marwadi University, Rajkot Morbi Road, Rajkot</td>';
    previewHTML += '<td>360003</td>';
    previewHTML += '<td>9727724694</td>';
    previewHTML += '</tr>';
    previewHTML += '</table><br>';

    previewHTML += '<hr>';
    previewHTML += '<h3 style="text-align: center;"><b>STATEMENT OF PARTICULARS</b></h3><br>'
    if (checkbox.checked) {
        previewHTML += '<table>';
        previewHTML += '<tr>';
        previewHTML += '<th>Name</th>';
        previewHTML += '<th>Pin Code</th>';
        previewHTML += '<th>Address</th>';
        previewHTML += '<th>Nationality</th>';
        previewHTML += '</tr>';
        previewHTML += '<tr>';
        previewHTML += '<td>Marwadi University</td>';
        previewHTML += '<td>36003</td>';
        previewHTML += '<td>Registrar, Rajkot Morbi Road, Rajkot </td>';
        previewHTML += '<td>India</td>';
        previewHTML += '</tr>';
        var dynamicTable = $('<table>' + dynamicTableData + '</table>');
        dynamicTable.find('tr').slice(1).each(function () {
            var columns = $(this).find('td');
            previewHTML += '<tr>';

            // Add the columns in the order of Name, Address, Pin Code, Nationality
            previewHTML += '<td>' + columns.eq(1).html() + '</td>'; // Name
            previewHTML += '<td>' + columns.eq(2).html() + '</td>'; // Address
            previewHTML += '<td>' + columns.eq(3).html() + '</td>'; // Pin Code
            previewHTML += '<td>' + columns.eq(4).html() + '</td>'; // Nationality

            previewHTML += '</tr>';
        });
        previewHTML += '</table><br>';
    } else {

        previewHTML += "<table>";
        previewHTML += "<thead><tr><th>Name</th><th>Pincode</th><th>Address</th><th>Nationality</th></tr></thead>";
        previewHTML += '<tr>';
        previewHTML += '<td>Marwadi University</td>';
        previewHTML += '<td>36003</td>';
        previewHTML += '<td>Registrar, Rajkot Morbi Road, Rajkot </td>';
        previewHTML += '<td>India</td>';
        previewHTML += '</tr>';
        previewHTML += "<tbody>";

        var table = document.getElementById("itemTable");
        var rows = table.getElementsByTagName("tr");
        for (var i = 1; i < rows.length; i++) {
            // var grno = rows[i].cells[1].innerText;
            var name = rows[i].cells[2].innerText;
            var pincode = rows[i].cells[4].innerText;
            var address = rows[i].cells[3].innerText;
            var nationality = rows[i].cells[5].innerText;
            // var author = rows[i].cells[6].innerText;

            previewHTML += "<tr>";
            // previewHTML += "<td>" + grno + "</td>";
            previewHTML += "<td>" + name + "</td>";
            previewHTML += "<td>" + pincode + "</td>";
            previewHTML += "<td>" + address + "</td>";
            previewHTML += "<td>" + nationality + "</td>";
            // previewHTML += "<td>" + author + "</td>";
            previewHTML += "</tr>";
        }

        previewHTML += "</tbody>";
        previewHTML += "</table><br>";

    }

    previewHTML += '<h5><b>Additional Details:</b></h5>';

    var description = document.getElementById('description').value;
    var title = document.getElementById('title').value;
    var languageWork = document.getElementById('language_work').value;
    var remark = document.getElementById('remark').value;
    var published = document.querySelector('input[name="published"]:checked').value;

    previewHTML += '<ul>';
    previewHTML += "<li><b>Description:</b> " + description + "</li>";
    previewHTML += "<li><b>Title:</b> " + title + "</li>";
    previewHTML += "<li><b>Language of Work:</b> " + languageWork + "</li>";
    previewHTML += "<li><b>Remarks:</b> " + remark + "</li>";
    previewHTML += "<li><b>Published Status:</b> " + published + "</li>";
    previewHTML += '</ul>';

    previewHTML += '</div>'; // Closing tag for preview container


    document.getElementById("previewTableDiv").innerHTML = previewHTML;
    document.getElementById("popupOverlay").style.display = "block";
}

function printPreview() {
    var checkbox = document.querySelector('input[name="samedata"]');

    var description = document.getElementById('description').value;
    var title = document.getElementById('title').value;
    var languageWork = document.getElementById('language_work').value;
    var published = document.querySelector('input[name="published"]:checked').value;
    var remark = document.getElementById('remark').value;


    var previewContent = document.getElementById("previewTableDiv").innerHTML;
    var tableContainer = document.getElementById('tableContainer');
    var dynamicTableData = tableContainer.innerHTML;

    // Define the CSS style to add borders to the table cells
    var printStyle = '<style>';
    printStyle += 'table { border-collapse: collapse; width: 100%; }';
    printStyle += 'th, td { border: 1px solid black; padding: 8px; text-align: left; }';
    printStyle += '</style>';

    var printWindow = window.open('', '_blank', 'height=auto,width=auto');
    printWindow.document.write('<html><head><title>Print Preview</title>' + printStyle +
        '</head><body style="font-family: "Times New Roman", Times, serif;">');

    // Add the additional text with proper style and font
    printWindow.document.write('<div>');
    printWindow.document.write(
        '<h1 style="text-align: center;">FORM – XIV <br> Application for Registration of Copyright<br> See Rule 70</h1>'
    );
    printWindow.document.write('<hr>');
    printWindow.document.write(
        '<p>1. <sup>12</sup>I also send herewith duly completed the Statement of further particulars relating to the work (Not applicable for filing copyright)</p><br>'
    );
    printWindow.document.write(
        '<p>2. In accordance with rule 70 of the Copyright Rules, 2012, I have sent by prepaid registered post copies of this letter and of the Statement of Particulars and Statement of Further Particulars to other parties13 concerned, as shown below:</p><br>'
    );
    printWindow.document.write('</div>');

    // Add the static table data
    printWindow.document.write('<table>');
    printWindow.document.write('<tr>');
    printWindow.document.write('<th>Name</th>');
    printWindow.document.write('<th>Address</th>');
    printWindow.document.write('<th>Pin Code</th>');
    printWindow.document.write('<th>Nationality</th>');
    printWindow.document.write('</tr>');
    printWindow.document.write('<tr>');
    printWindow.document.write('<td>Marwadi University</td>');
    printWindow.document.write('<td>Registrar, Rajkot Morbi Road, Rajkot </td>');
    printWindow.document.write('<td>360003</td>');
    printWindow.document.write('<td>India</td>');
    printWindow.document.write('</tr>');
    var dynamicTable = $('<table>' + dynamicTableData + '</table>');
    dynamicTable.find('tr').slice(1).each(function () {
        var columns = $(this).find('td');
        printWindow.document.write('<tr>');

        // Add the columns in the order of Name, Address, Pin Code, Nationality
        printWindow.document.write('<td>' + columns.eq(1).html() + '</td>'); // Name
        printWindow.document.write('<td>' + columns.eq(3).html() + '</td>'); // Address
        printWindow.document.write('<td>' + columns.eq(2).html() + '</td>'); // Pin Code
        printWindow.document.write('<td>' + columns.eq(4).html() + '</td>'); // Nationality

        printWindow.document.write('</tr>');
    });
    printWindow.document.write('</table><br>');

    printWindow.document.write('<div>');
    printWindow.document.write('<p><b>3. Communications on this subject may be addressed to:</b></p>');
    printWindow.document.write('<table>');
    printWindow.document.write('<tr>');
    printWindow.document.write('<th>Name</th>');
    printWindow.document.write('<th>Communication Address</th>');
    printWindow.document.write('<th>Pin Code</th>');
    printWindow.document.write('<th>Phone</th>');
    printWindow.document.write('</tr>');
    printWindow.document.write('<tr>');
    printWindow.document.write('<td>Mr Naresh Dilawarsinh Jadeja</td>');
    printWindow.document.write('<td>Registrar, Marwadi University, Rajkot Morbi Road, Rajkot</td>');
    printWindow.document.write('<td>360003</td>');
    printWindow.document.write('<td>9727724694</td>');
    printWindow.document.write('</tr>');
    printWindow.document.write('</table>');
    printWindow.document.write('</div><br>');
    printWindow.document.write('<div style="page-break-before: always;"></div>');

    // Add the "STATEMENT OF PARTICULARS" header
    printWindow.document.write('<h1 style="text-align: center;">STATEMENT OF PARTICULARS</h1><br>');
    printWindow.document.write('<hr><br>');

    printWindow.document.write('<p>Name, address and nationality of the applicant (mandatory)</p><br>');


    if (checkbox.checked) {
        // Display the table content if the checkbox is checked
        printWindow.document.write('<table>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<th>Name</th>');
        printWindow.document.write('<th>Address</th>');
        printWindow.document.write('<th>Pin Code</th>');
        printWindow.document.write('<th>Nationality</th>');
        printWindow.document.write('</tr>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>Marwadi University</td>');
        printWindow.document.write('<td>Registrar, Rajkot Morbi Road, Rajkot </td>');
        printWindow.document.write('<td>360003</td>');
        printWindow.document.write('<td>India</td>');
        printWindow.document.write('</tr>');
        var dynamicTable = $('<table>' + dynamicTableData + '</table>');
        dynamicTable.find('tr').slice(1).each(function () {
            var columns = $(this).find('td');
            printWindow.document.write('<tr>');

            // Add the columns in the order of Name, Address, Pin Code, Nationality
            printWindow.document.write('<td>' + columns.eq(1).html() + '</td>'); // Name
            printWindow.document.write('<td>' + columns.eq(3).html() + '</td>'); // Address
            printWindow.document.write('<td>' + columns.eq(2).html() + '</td>'); // Pin Code
            printWindow.document.write('<td>' + columns.eq(4).html() + '</td>'); // Nationality

            printWindow.document.write('</tr>');
        });
        printWindow.document.write('</table><br>');

    } else {
        // Display the data from input fields if the checkbox is not checked
        printWindow.document.write('<div>');
        printWindow.document.write('<table>');
        printWindow.document.write(
            '<thead><tr><th>Name</th><th>Address</th><th>Pin Code</th><th>Nationality</th></tr></thead>');
        printWindow.document.write('<tbody>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>Marwadi University</td>');
        printWindow.document.write('<td>Registrar, Rajkot Morbi Road, Rajkot </td>');
        printWindow.document.write('<td>360003</td>');
        printWindow.document.write('<td>India</td>');
        printWindow.document.write('</tr>');
        var table = document.getElementById("itemTable");
        var rows = table.getElementsByTagName("tr");
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("td");
            // var grno = cells[1].innerText;
            var name = cells[2].innerText;
            var pincode = cells[4].innerText;
            var address = cells[3].innerText;
            var nationality = cells[5].innerText;
            // var author = cells[6].innerText;

            printWindow.document.write('<tr>');
            // printWindow.document.write('<td>' + grno + '</td>');
            printWindow.document.write('<td>' + name + '</td>');
            printWindow.document.write('<td>' + address + '</td>');
            printWindow.document.write('<td>' + pincode + '</td>');
            printWindow.document.write('<td>' + nationality + '</td>');
            // printWindow.document.write('<td>' + author + '</td>');
            printWindow.document.write('</tr>');
        }

        printWindow.document.write('</tbody>');
        printWindow.document.write('</table>');
        printWindow.document.write('</div>');
    }

    // Add the additional information
    printWindow.document.write('<br><div>');
    printWindow.document.write('<p><strong>Description of the Work (in 200 characters only):</strong> ' +
        description + '</p>');
    printWindow.document.write('<p><strong>Title of Work:</strong> ' + title + '</p>');
    printWindow.document.write('<p><strong>Language of Work:</strong> ' + languageWork + '</p>');
    printWindow.document.write('<p><strong>Whether Work is Published or Unpublished ?</strong> ' + published +
        '</p>');
    printWindow.document.write('<p><strong>Remarks (in 200 characters only) (optional):</strong> ' + remark +
        '</p>');
    printWindow.document.write('</div>');

    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

function closePopup() {
    document.getElementById("popupOverlay").style.display = "none";
}

function samedata() {
    var checkbox = document.querySelector('input[name="samedata"]');
    var tableContainer = document.getElementById('tableContainer');
    var inputFieldsContainer = document.getElementById('inputFieldsContainer');
    var hiddenCheckboxValue = document.getElementById('hiddenCheckboxValue');

    if (checkbox.checked) {
        tableContainer.style.display = 'block';
        inputFieldsContainer.style.display = 'none';
        hiddenCheckboxValue.value = 'YES'; // Set the value to 'YES' if checkbox is checked
    } else {
        tableContainer.style.display = 'none';
        inputFieldsContainer.style.display = 'block';
        hiddenCheckboxValue.value = 'NO'; // Set the value to 'NO' if checkbox is not checked
    }
}

var items = 0;

function addItem() {

    // Get the input field value
    var grno = document.getElementById("grno").value;
    var name = document.getElementById("name").value;
    var pincode = document.getElementById("pincode").value;
    var nationality = document.getElementById("nationality").value;
    var address = document.getElementById("address").value;

    // Check if any field is empty
    if (grno.trim() === "" || name.trim() === "" || pincode.trim() === "" || address.trim() === "" || nationality
        .trim() === "") {
        alert("Please fill all required fields.");
        return; // Stop execution if any field is empty
    }

    // Validate GR No. (numeric and maximum length)
    var grnoRegex = /^\d{1,20}$/;
    if (grno.trim() !== "" && !grno.match(grnoRegex)) {
        alert("GR No. must contain numbers only and have a maximum length of 20 digits.");
        return;
    }

    // Validate Name (alphabets and maximum length)
    var nameRegex = /^[A-Za-z\s]{1,255}$/;
    if (name.trim() !== "" && !name.match(nameRegex)) {
        alert("Name must contain alphabets only and have a maximum length of 255 characters.");
        return;
    }

    // Validate Pincode/Zip Code based on country selection
    var pincodeRegex;
    var country = document.getElementById("nationality").value;

    // Add pincode validation for each country (modify as per your requirements)
    switch (country) {
        case "Country1":
            pincodeRegex = /^[0-9]{4,10}$/; // Example regex for Country1
            break;
        case "Country2":
            pincodeRegex = /^[0-9]{5,10}$/; // Example regex for Country2
            break;
        // Add more cases for other countries
        default:
            pincodeRegex = /^[0-9]{1,}$/; // Default regex
            break;
    }

    if (pincode.trim() !== "" && !pincode.match(pincodeRegex)) {
        alert("Invalid Pincode/Zip Code for the selected country.");
        return;
    }

    // Validate Address (maximum length)
    if (address.trim() !== "" && address.length > 255) {
        alert("Address cannot exceed 255 characters.");
        return;
    }

    // Validate Nationality (alphabets and maximum length)
    if (nationality.trim() !== "" && !nationality.match(nameRegex)) {
        alert("Nationality must contain alphabets only and have a maximum length of 255 characters.");
        return;
    }

    var table = document.getElementById("itemTable");
    var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
        var rowGrno = rows[i].cells[1].innerText;
        if (rowGrno === grno) {
            alert("GR No. " + grno + " already exists in the table.");
            return; // Stop execution if grno already exists
        }
    }

    var table = document.getElementById("itemTable");
    var newRow = table.insertRow();

    var new_item = items + 1;
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = '<input type="hidden" name="srno[]" value="' + new_item + '">' + new_item;

    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = '<input type="hidden" name="grno[]" value="' + grno + '">' + grno;

    var cell3 = newRow.insertCell(2);
    cell3.innerHTML = '<input type="hidden" name="name[]" value="' + name + '">' + name;

    var cell4 = newRow.insertCell(3);
    cell4.innerHTML = '<input type="hidden" name="address[]" value="' + address + '">' + address;

    var cell5 = newRow.insertCell(4);
    cell5.innerHTML = '<input type="hidden" name="pincode[]" value="' + pincode + '">' + pincode;

    var cell6 = newRow.insertCell(5);
    cell6.innerHTML = '<input type="hidden" name="nationality[]" value="' + nationality + '">' + nationality;

    var cell7 = newRow.insertCell(6);
    cell7.innerHTML = '<button type="button" onclick="deleteRow(this);">Delete</button>';

    // Clear the input fields
    document.getElementById("grno").value = "";
    document.getElementById("name").value = "";
    document.getElementById("pincode").value = "";
    document.getElementById("nationality").value = "";
    document.getElementById("address").value = "";
    items++;
}

function deleteRow(row) {
    var i = row.parentNode.parentNode.rowIndex;
    document.getElementById("itemTable").deleteRow(i);
    items--;
}

function submitForm() {
    // Check if there are any items in the table
    var checkbox = document.querySelector('input[name="samedata"]');
    var tableContainer = document.getElementById('tableContainer');
    var inputFieldsContainer = document.getElementById('inputFieldsContainer');

    if (checkbox.checked) {
        var confirmation = confirm("Are you sure you want to submit the form?");
        if (confirmation === false) {
            event.preventDefault(); // Prevent form submission if cancel button is clicked
        }
    } else {
        if (items === 0) {
            alert("Please add at least one record.");
            event.preventDefault(); // Prevent form submission
        } else {
            // Show a confirmation message before submitting the form
            var confirmation = confirm("Are you sure you want to submit the form?");
            if (confirmation === false) {
                event.preventDefault(); // Prevent form submission if cancel button is clicked
            }
        }
    }
}