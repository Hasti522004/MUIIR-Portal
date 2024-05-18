<?php
session_start();
require_once "../../assets/include/config.php";

if(isset($_POST["submit"])) {
    $error = false;
    $records = [];
    $p_id = "";

    // Check if the table has existing rows
    if (isset($_POST["grno"])) {
        // Retrieve the data from the table
        $grnos = $_POST["grno"];
        $names = $_POST["name"];
        $pincodes = $_POST["pincode"];
        $addresses = $_POST["address"];
        $nationalities = $_POST["nationality"];
        $authors = $_POST["srno"];

        // Check if any field is empty
        if (empty($grnos) || empty($names) || empty($pincodes) || empty($addresses) || empty($nationalities)) {
            $error = true;
        }

        if (!$error) {
            try {
                $conn->beginTransaction();

                // Get the maximum ID from the table
                $maxID = getMaxID();
                $id = $maxID + 1;
                $p_id = $id;

                // Process each record
                foreach ($grnos as $index => $grno) {
                    // Retrieve the individual values
                    $name = $names[$index];
                    $pincode = $pincodes[$index];
                    $address = $addresses[$index];
                    $nationality = $nationalities[$index];
                    $author = $authors[$index];

                    // Check if any field is empty for the current record
                    if (empty($grno) || empty($name) || empty($pincode) || empty($address) || empty($nationality)) {
                        $error = true;
                        break;
                    }

                    // Insert the record into the database
                    $sql = "INSERT INTO copyright1 (id, grno, name, address, pincode, nationality,author) VALUES (:id, :grno, :name, :address, :pincode, :nationality,:author)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array(
                        ':id' => $id,
                        ':grno' => $grno,
                        ':name' => $name,
                        ':address' => $address,
                        ':pincode' => $pincode,
                        ':nationality' => $nationality,
                        ':author' => $author
                    ));

                    $record = [
                        'grno' => $grno,
                        'name' => $name,
                        'pincode' => $pincode,
                        'address' => $address,
                        'nationality' => $nationality,
                        'author' => $author
                    ];
                    $records[] = $record;
                }
                $_SESSION['records'] = $records;
                $_SESSION['p_id'] = $p_id;

                if (!$error) {
                    $conn->commit();
                    echo "<script>alert('Records added successfully.');</script>";
                    echo "<script>window.location.href = 'copyright2.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Please fill all required fields.')</script>";
                }
            } catch (PDOException $e) {
                $conn->rollBack();
                // echo "<script>alert('There was an error while adding the record.')</script>";
                print($e);
            }
        } else {
            echo "<script>alert('Please fill all required fields.')</script>";
        }
    } else {
        echo "<script>alert('Please fill all required fields.')</script>";
    }
}

// Function to get the maximum ID from the table
function getMaxID()
{
    global $conn;
    $sql = "SELECT MAX(id) FROM copyright1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $maxID = $stmt->fetchColumn();

    // If there are no existing records, set the initial ID as 0
    if ($maxID === false) {
        $maxID = 0;
    }

    return $maxID;
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copyright_form1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class=" container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5>FORM XIV<br>
                            APPLICATION FOR REGISTRATION OF COPYRIGHT<br>
                            [SEE RULE 70]</h5>
                    </div>
                    <div class="card-body">
                        <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i>1.
                            <sup>12</sup>I also send herewith duly completed the Statement of further particulars
                            relating to the work. (Not applicable for filing copyright)
                        </small>
                        <br>
                        <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i>2. In accordance with rule
                            70 of the Copyright Rules, 2012, I have sent by prepaid
                            registered post copies of this letter and of the Statement of Particulars and Statement
                            of Further Particulars to other parties<sup>13</sup> concerned, as shown below:
                        </small>
                        <br>
                        <form method="POST" enctype="multipart/form-data" id="myForm">
                            <input type="hidden" name="addRecord">
                            <div class="input-container">
                                <label for="grno">Employee Id/Gr no.:</label>
                                <input type="number" id="grno" name="grno">

                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name">

                            </div>
                            <div class="input-container">
                                <label for="nationality">Nationality:</label>
                                <input type="text" id="nationality" name="nationality">

                                <label for="pincode">Pincode:</label>
                                <input type="number" id="pincode" name="pincode">
                            </div>
                            <div class="input-container">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address">
                            </div>
                            <br><br>
                            <table id="itemTable">
                                <thead>
                                    <tr>
                                        <th>Sr_no.</th>
                                        <th>Employee Id/Gr no.</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Pincode</th>
                                        <th>Nationality</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="itemTableBody"></tbody>
                            </table>
                            <div class="text-center">
                                <button type="button" onclick="addItem();" id="addButton">Add Applicant</button>
                            </div>
                            <br>
                            <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i>3. Communications on
                                this subject may be addressed to: (No need to edit this section)
                            </small>
                            <br>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Communication Address</th>
                                        <th>Pincode</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mr Naresh Dilawarsinh Jadeja</td>
                                        <td>Registrar, Marwadi University,Rajkot Morbi Road, Rajkot</td>
                                        <td>360003</td>
                                        <td>9727724694</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <input type="submit" name="submit" value="submit" id="submit" onclick="submitForm()">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"
        integrity="sha384-rnRcOTLZIrcwZvbiMh7W8Bue5U5o6U5vqew3ndpf8LY49GWZS7Ke1wvQAYaw7W8P" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
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
    </script>
</body>

</html>