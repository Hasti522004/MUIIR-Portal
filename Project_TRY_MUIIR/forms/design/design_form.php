<?php
session_start();
require_once "../../assets/include/config.php";
if (isset($_POST["submit"])) {
    $error = false;
    $records = [];
    $p_id = "";

    if (isset($_POST["grno"])) {
        $classno = $_POST["classno"];
        $grnos = $_POST["grno"];
        $names = $_POST["name"];
        $authors = $_POST["srno"];

        // Retrieve the address parts
        $affiliation = $_POST["affiliation"];
        $department = $_POST["department"];
        $university = $_POST["university"];
        $universityAddress = $_POST["universityAddress"];
        $cityState = $_POST["cityState"];
        $pin = $_POST["pin"];

        // Combine the address parts into a single address string
        $address = implode(', ', array_filter([$affiliation, $department, $university, $universityAddress, $cityState . ' ' . $pin]));

        $titleOfWork = $_POST["titleOfWork"];
        $StateOfDesign = $_POST["stateOfDesign"];

        if ($_FILES['front_view']['error'] === UPLOAD_ERR_OK && $_FILES['rear_view']['error'] === UPLOAD_ERR_OK && $_FILES['top_view']['error'] === UPLOAD_ERR_OK && $_FILES['bottom_view']['error'] === UPLOAD_ERR_OK && $_FILES['left_view']['error'] === UPLOAD_ERR_OK && $_FILES['right_view']['error'] === UPLOAD_ERR_OK && $_FILES['prospective_view']['error'] === UPLOAD_ERR_OK) {
            $image_urls = [];

            // Directory to store the images
            $target_dir = "design_images/";

            // Allowed image file extensions
            $allowed_extensions = array("jpg", "jpeg", "png");

            // Loop through each image input
            $views = ["front_view", "rear_view", "top_view", "bottom_view", "left_view", "right_view", "prospective_view"];
            foreach ($views as $view) {
                $target_file = $target_dir . basename($_FILES[$view]["name"]);
                $image_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if the file extension is allowed
                if (!in_array($image_extension, $allowed_extensions)) {
                    $error = true;
                    break;
                }

                // Move the uploaded file to the designated directory
                if (move_uploaded_file($_FILES[$view]["tmp_name"], $target_file)) {
                    $image_urls[$view] = "http://localhost/dashboard/Portal/Project_TRY_MUIIR/forms/design/" . $target_file;
                } else {
                    $error = true;
                    break;
                }
            }

            if (!$error) {
                try {
                    $conn->beginTransaction();

                    // Get the maximum ID from the table
                    $maxID = getMaxID();
                    $id = $maxID + 1;
                    // $p_id = $id;

                    foreach ($grnos as $index => $grno) {
                        $name = $names[$index];
                        $author = $authors[$index];
                        $address  = $_POST["address"][$index];
                        $front_view_url = isset($image_urls['front_view']) ? $image_urls['front_view'] : '';
                        $rear_view_url = isset($image_urls['rear_view']) ? $image_urls['rear_view'] : '';
                        $top_view_url = isset($image_urls['top_view']) ? $image_urls['top_view'] : '';
                        $bottom_view_url = isset($image_urls['bottom_view']) ? $image_urls['bottom_view'] : '';
                        $left_view_url = isset($image_urls['left_view']) ? $image_urls['left_view'] : '';
                        $right_view_url = isset($image_urls['right_view']) ? $image_urls['right_view'] : '';
                        $prospective_view_url = isset($image_urls['prospective_view']) ? $image_urls['prospective_view'] : '';

                        $sql = "INSERT INTO design (grno,classno,d_id,author, name, address,designstate,titleOfWork, 
                        front_view_url, rear_view_url, top_view_url, bottom_view_url, 
                        left_view_url, right_view_url, prospective_view_url) 
                        VALUES (:grno,:classno,:id,:author, :name, :address,:designstate,:titleOfWork, 
                        :front_view_url, :rear_view_url, :top_view_url, :bottom_view_url, 
                        :left_view_url, :right_view_url, :prospective_view_url)";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute(array(
                            ':classno' => $classno,
                            ':grno' => $grno,
                            ':id' => $id,
                            ':author' => $author,
                            ':name' => $name,
                            ':address' => $address,
                            ':designstate' => $StateOfDesign,
                            ':titleOfWork' => $titleOfWork,
                            ':front_view_url' => $front_view_url,
                            ':rear_view_url' => $rear_view_url,
                            ':top_view_url' => $top_view_url,
                            ':bottom_view_url' => $bottom_view_url,
                            ':left_view_url' => $left_view_url,
                            ':right_view_url' => $right_view_url,
                            ':prospective_view_url' => $prospective_view_url
                        ));
                    }

                    if (!$error) {
                        $conn->commit();
                        echo "<script>alert('Records added successfully.');</script>";
                        echo "<script>window.location.href = '../../pages/design.php';</script>";

                        exit();
                    } else {
                        echo "<script>alert('Please fill all required fields.')</script>";
                    }
                } catch (PDOException $e) {
                    $conn->rollBack();
                    echo "<script>alert('There was an error while adding the record.')</script>";
                }
            } else {
                echo "<script>alert('Please fill all required fields.')</script>";
            }
        } else {
            echo "<script>alert('Please fill all required fields.')</script>";
        }
    }
}
// Function to get the maximum ID from the table
function getMaxID()
{
    global $conn;
    $sql = "SELECT MAX(d_id) FROM design";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $maxID = $stmt->fetchColumn();

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
    <title>Design_form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            /* font-weight: ; */
            font-size: medium;
        }

        .card {
            width: auto;
        }

        .card-header {
            background-color: #337ab7;
            text-align: center;
        }

        .input-container {
            display: grid;
            grid-template-columns: 1.1fr 2.5fr 1.5fr 2.5fr;
            /* Equal width for label and input */
            gap: 10px;
            /* Gap between label and input */
            align-items: center;
            /* Vertically center align content */
            /* margin-bottom: 10px; */
        }

        .input-container input {
            width: 90%;
            /* Input field takes up the entire width */
        }

        input {
            margin: 5px;
            height: 25px;
            border-radius: 5px;
            border: 2px solid gray;
        }

        label {
            margin-bottom: auto;
            font-weight: bold;
        }

        table,
        th,
        td {
            border: 1.5px solid gray;
            border-collapse: collapse;
        }

        table {
            width: 100%;
            table-layout: fixed;
            text-align: center;
        }

        .text-center {
            text-align: center;
            margin-top: 10px;
        }

        button,
        #submit {
            background-color: #337ab7;
            color: white;
            padding: 0px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: auto;
            height: auto;
        }

        #popupOverlay {
            display: none;
            z-index: 9999;
        }

        .preview-container {
            max-width: 100%;
            /* Set the maximum width to 100% */
            width: 800px;
            /* Adjust this value to your desired width */
            max-height: 80vh;
            overflow: auto;
            padding: 20px;
        }

        .preview-table {
            width: 100%;
            border-collapse: collapse;
        }

        .preview-table td {
            padding: 10px;
            text-align: left;
            /* Align content to the left */
            vertical-align: top;
            border: 1px solid gray;
        }

        #pdfContainer {
            display: none;
            position: relative;
            /* Add relative positioning for close button */
        }

        #pdfViewer {
            width: 100%;
            height: 600px;
        }

        .input-group {
            display: flex;
            align-items: left;
            margin-bottom: 10px;
        }

        .input-group label {
            flex: 1;
            margin-right: 10px;

        }

        .input-group input {
            flex: 7;
            border: none;
        }


        /* Adjust the appearance of the "Choose File" button */
        .input-group input[type="file"]::file-selector-button {
            border: 1px solid #ccc;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5>“FORM 1<br>
                            [THE DESIGNS ACT, 2000]<br>
                            APPLICATION FOR REGISTRATION OF DESIGNS (See sections 5 and 44)
                        </h5>
                    </div>
                    <div class="card-body">

                        <form method="POST" enctype="multipart/form-data" id="myForm" onsubmit="return validateClassNo();">
                            <input type="hidden" name="addRecord">

                            <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i> 1. You are requested
                                to register the accompanying in Class No.</small>

                            <label for="classno"><b>Class No.<span style="color:red;" class="required">
                                        *</span></b></label>
                            <input type="text" id="classno" placeholder="00-00" name="classno" maxlength="5" required>

                            <!-- <span class="help-icon" onclick="togglePdfViewer()"><i class="fas fa-question-circle"></i></span> -->
                            <span class="help-icon" onclick="togglePdfViewer()">
                                <img style="height: 20px;width:20px;" src="../../assets/images/icons/help_icon.png" alt="Help Image">
                            </span>
                            <div id="pdfContainer">
                                <div id="pdfViewer">
                                    <embed src="../../assets/pdf/Class-Subclass for Design_2022.pdf" width="100%" height="600px" type="application/pdf">
                                </div>
                            </div>

                            <br><br>
                            <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i> 2. Name and
                                Communication Address of Innovator</small>
                            <br>
                            <div class="input-container">
                                <label for="grno">ID (GR No.):</label>
                                <input type="number" id="grno" name="grno">

                                <label for="name">Innovator Name:</label>
                                <input type="text" id="name" name="name">
                            </div>

                            <div class="input-container">
                                <label for="affiliation">Affiliation:</label>
                                <input type="text" id="affiliation" name="affiliation">

                                <label for="department">Department:</label>
                                <input type="text" id="department" name="department">
                            </div>

                            <div class="input-container">
                                <label for="university">University Name:</label>
                                <input type="text" id="university" name="university">

                                <label for="universityAddress">University Address:</label>
                                <input type="text" id="universityAddress" name="universityAddress">
                            </div>

                            <div class="input-container">
                                <label for="cityState">City(State):</label>
                                <input type="text" id="cityState" name="cityState">

                                <label for="pin">Pincode:</label>
                                <input type="number" id="pin" name="pin">
                            </div>
                            <br>
                            <table id="itemTable">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Sr. No.</th>
                                        <th style="width: 15%;">ID (GR No.)</th>
                                        <th style="width: 20%;">Name</th>
                                        <th style="width: 35%;">Address</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="itemTableBody"></tbody>
                            </table>
                            <div class="text-center">
                                <button type="button" onclick="addItem();" id="addButton">Add Applicant</button>
                            </div>
                            <br>
                            <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i> 3. State of Design
                                and Title of work</small>

                            <div>
                                <label for="stateOfDesign">State of Design:</label>
                                <select id="stateOfDesign" name="stateOfDesign" style="width: 15%;margin-right: 20px;">
                                    <option value="drawings">Drawings</option>
                                    <option value="photographs">Photographs</option>
                                    <option value="tracings">Tracings</option>
                                    <option value="specimens">Specimens</option>
                                </select>
                                <label for="titleOfWork">Title of Work:<span style="color:red;" class="required">
                                        *</span></label>
                                <input type="text" id="titleOfWork" name="titleOfWork" style="width:50%">
                            </div>

                            <div>
                                <br><small class="form-text text-muted"><i class="fa fa-hand-o-right"></i>4. 7 Images of different view of Design(Please select an image file (jpg, jpeg, png).):</small><br>

                                <div class="input-group">
                                    <label for="front_view">Front View:</label>
                                    <input type="file" name="front_view" id="front_view" class="image-input" accept=".jpg, .jpeg, .png" onchange="getImagePreview(event)">
                                </div>
                                <div class="input-group">
                                    <label for="rear_view">Rear View:</label>
                                    <input type="file" name="rear_view" id="rear_view" class="image-input" accept=".jpg, .jpeg, .png">
                                </div>
                                <div class="input-group">
                                    <label for="top_view">Top View:</label>
                                    <input type="file" name="top_view" id="top_view" class="image-input" accept=".jpg, .jpeg, .png">
                                </div>
                                <div class="input-group">
                                    <label for="bottom_view">Bottom View:</label>
                                    <input type="file" name="bottom_view" id="bottom_view" class="image-input" accept=".jpg, .jpeg, .png">
                                </div>
                                <div class="input-group">
                                    <label for="left_view">Left View:</label>
                                    <input type="file" name="left_view" id="left_view" class="image-input" accept=".jpg, .jpeg, .png">
                                </div>
                                <div class="input-group">
                                    <label for="right_view">Right View:</label>
                                    <input type="file" name="right_view" id="right_view" class="image-input" accept=".jpg, .jpeg, .png">
                                </div>
                                <div class="input-group">
                                    <label for="prospective_view">Prospective View:</label>
                                    <input type="file" name="prospective_view" id="prospective_view" class="image-input" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>


                            <div id="popupOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8);">
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px;">
                                    <span style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 24px;" onclick="closePopup();">&times;</span>
                                    <div id="previewTableDiv"></div>
                                    <div class="text-center">
                                        <button type="button" onclick="print();" id="printButton">Print</button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <button type="button" onclick="openPopupviews();" id="openPopupButton">Previewviews</button>

                                </div>
                                <br>
                                <div>
                                    <button type="button" onclick="openPopupview();" id="openPopupButton">Previewview</button>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" onclick="openPopup();" id="openPopupButton">Preview</button>
                                <input type="submit" name="submit" value="submit" id="submit">
                            </div>
                            <div id="previewimage">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js" integrity="sha384-rnRcOTLZIrcwZvbiMh7W8Bue5U5o6U5vqew3ndpf8LY49GWZS7Ke1wvQAYaw7W8P" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        let currentPopupFunction;

        var items = 0;
        var currentDate = new Date();
        var monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        var formattedDate = currentDate.getDate() + ' ' + monthNames[currentDate.getMonth()] + ' ' + currentDate.getFullYear();

        function print() {
            if (currentPopupFunction) {
                currentPopupFunction();
            }
        }

        function togglePdfViewer() {
            var pdfContainer = document.getElementById("pdfContainer");
            pdfContainer.style.display = pdfContainer.style.display === "block" ? "none" : "block";
        }

        function validateClassNo() {
            var classnoInput = document.getElementById("classno");
            var classnoPattern = /^\d{2}-\d{2}$/; // Regular expression pattern for x-y format
            if (!classnoPattern.test(classnoInput.value)) {
                alert("Class No must be in the format x-y, where x and y are two-digit numbers between 00 and 99.");
                classnoInput.focus();
                return false;
            }
            var titleOfWork = document.getElementById("titleOfWork").value;
            var titleRegex = /^[\s\S]{1,255}$/; // This regex allows any character, including line breaks
            if (!titleOfWork.match(titleRegex)) {
                alert(
                    "Title of Work must have a maximum length of 255 characters and can contain any combination of alphabets, numbers, and special characters.");
                return false;
            }
            return true;
        }

        function addItem() {
            var grno = document.getElementById("grno").value;
            var name = document.getElementById("name").value;
            var affiliation = document.getElementById("affiliation").value;
            var department = document.getElementById("department").value;
            var university = document.getElementById("university").value;
            var universityAddress = document.getElementById("universityAddress").value;
            var cityState = document.getElementById("cityState").value;
            var pin = document.getElementById("pin").value;

            if (
                grno.trim() === "" ||
                name.trim() === "" ||
                affiliation.trim() === "" ||
                department.trim() === "" ||
                university.trim() === "" ||
                universityAddress.trim() === "" ||
                cityState.trim() === "" ||
                pin.trim() === ""
            ) {
                alert("Please fill in all required fields.");
                return;
            }

            var grnoRegex = /^\d{1,20}$/;
            if (!grno.match(grnoRegex)) {
                alert("GR No. must contain numbers only and have a maximum length of 20 digits.");
                return;
            }

            var nameRegex = /^[A-Za-z\s]{1,255}$/;
            if (!name.match(nameRegex)) {
                alert("Name must contain alphabets only and have a maximum length of 255 characters.");
                return;
            }

            var pinRegex = /^\d{4,10}$/;
            if (!pin.match(pinRegex)) {
                alert("Invalid PIN code. Please enter a valid PIN code with 4 to 10 digits.");
                return;
            }

            var textRegex = /^[A-Za-z\s]{1,255}$/;

            if (!affiliation.match(textRegex)) {
                alert("Affiliation must contain alphabets only and have a maximum length of 255 characters.");
                return;
            }

            if (!department.match(textRegex)) {
                alert("Department must contain alphabets only and have a maximum length of 255 characters.");
                return;
            }

            if (!university.match(textRegex)) {
                alert("University must contain alphabets only and have a maximum length of 255 characters.");
                return;
            }

            if (!universityAddress.match(textRegex)) {
                alert("University Address must contain alphabets only and have a maximum length of 255 characters.");
                return;
            }

            if (!cityState.match(textRegex)) {
                alert("City/State must contain alphabets only and have a maximum length of 255 characters.");
                return;
            }

            var table = document.getElementById("itemTable");
            var rows = table.getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var rowGrno = rows[i].cells[1].innerText;
                if (rowGrno === grno) {
                    alert("GR No. " + grno + " already exists in the table.");
                    return;
                }
            }

            var address = [affiliation, department, university, universityAddress, cityState + ' ' + pin].filter(Boolean)
                .join(', ');

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
            cell5.innerHTML = '<button type="button" onclick="deleteRow(this);">Delete</button>';

            // Clear the input fields
            document.getElementById("grno").value = "";
            document.getElementById("name").value = "";
            document.getElementById("affiliation").value = "";
            document.getElementById("department").value = "";
            document.getElementById("university").value = "";
            document.getElementById("universityAddress").value = "";
            document.getElementById("cityState").value = "";
            document.getElementById("pin").value = "";
            items++;
        }

        function deleteRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("itemTable").deleteRow(i);
            items--;
        }

        // function getImagePreview(event) {
        //     var image = URL.createObjectURL(event.target.files[0]);
        //     var imagediv = document.getElementById("previewimage");
        //     var newimg = document.createElement('img');
        //     newimg.src = image;
        //     imagediv.appendChild(newimg);
        // }

        function openPopup() {
            // Format the date as "dd Month yyyy"

            var titleOfWork = document.getElementById("titleOfWork").value;
            var stateOfDesign = document.getElementById("stateOfDesign").value;
            var classno = document.getElementById("classno").value;

            var previewHTML = '<div class="preview-container">';
            previewHTML += '<table style="text-align: left;">';
            previewHTML += '<tr>';
            previewHTML += '<th colspan="2"><h3 style="text-align: center;">FORM - 1<br>Application for Registration of Designs<br>Sections 5 & 44</b></h3></th>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td colspan="2" >You are requested to register the accompanying in;</td>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td colspan="2">Class No <strong><u>' + classno + '</u></strong> in the same; </td>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td><strong>Marwadi University </strong></td>';
            previewHTML += '<td>Rajkot - Morbi Highway Road, Gauridad, Rajkot, Gujarat 360003</td>';
            previewHTML += '</tr>';

            var table = document.getElementById("itemTable");
            var rows = table.getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                var address = cells[3].innerText;

                previewHTML += '<tr>';
                previewHTML += '<td><strong>' + name + '</strong></td>';
                previewHTML += '<td>' + address + '</td>';
                previewHTML += '</tr>';
            }

            previewHTML += '<tr>';
            previewHTML += '<td colspan="2">Who claim(s) to be proprietor(s) thereof</td>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td>Category of Applicant</td>';
            previewHTML += '<td>Marwadi University</td>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td colspan="2">Four exactly similar <strong>' + stateOfDesign.toUpperCase() + '</strong> of the design accompany this request</td>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td colspan="2">The design is to be applied for a new design of the <strong>' + titleOfWork + '</strong> </td>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td>Address For Service in India is</td>';
            previewHTML += '<td><strong>Marwadi University, Rajkot - Morbi<br>Highway Road, Gauridad, Rajkot,<br>Gujarat 360003<br>registrar@marwadiuniversity.ac.in<br>Cell: +91 9727724694</strong></td>';
            previewHTML += '</tr>';
            previewHTML += '<tr>';
            previewHTML += '<td colspan="2"><strong>Declaration:</strong><br>The applicant claims to be the proprietors of the design and that to the best of their knowledge and belief design is new or original</td>';
            previewHTML += '</tr>';

            previewHTML += '<tr>';
            previewHTML += '<td colspan="2" style="text-align: left;">Dated this: ' + formattedDate + '<strong><div style="text-align: right;">For, (Applicant)<br><br>Marwadi University<br>(Naresh Dilawarsinh Jadeja, Registrar)<br><br>';
            // Loop through the innovator names and add them to the same cell
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                previewHTML += name + '<br><br>';
            }
            previewHTML += '</div><div style="text-align: left;">To<br>The Controller of Designs,<br>The Patent Office,<br>Kolkata</div></strong></td>';
            previewHTML += '</tr>';


            previewHTML += '</table>';
            previewHTML += '</div>'; // Closing tag for preview container

            document.getElementById("previewTableDiv").innerHTML = previewHTML;
            document.getElementById("popupOverlay").style.display = "block";
            currentPopupFunction = printPreview;
        }

        function openPopupview() {
            var previewHTML = '<div class="preview-container">';
            var titleOfWork = document.getElementById("titleOfWork").value;

            previewHTML += '<strong>Marwadi University</strong><br>'
            var table = document.getElementById("itemTable");
            var rows = table.getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;

                previewHTML += '<strong>' + name + '</strong><br>';

            }
            previewHTML += '<br><p>We have invented a new design of a <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> as outlined in the following specifications. The claimed design of the <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> consists of an arrangement to measure the vertical penetration caused by standard needle in industrial wax. This measurement further helps in getting an idea about hardness of industrial wax used in investment casting process. This device is specifically designed to acquire real time data related to measurement of penetration through sensors & data acquisition system, and streams the acquired data to server using internet. This device is designed as per guidelines of Investment Casting Institute - USA.</p>'
            previewHTML += '<p>Figure 1 is a Front View of an <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> of our new design&semi; <br>Figure 2 is a Rear View thereof&semi; <br>Figure 3 is a Top View thereof&semi; <br>Figure 4 is a Bottom View thereof&semi; <br>Figure 5 is a Left Side View thereof&semi; <br>Figure 6 is the Right Side View thereof&semi; <br>Figure 7 is the Perspective View thereof&semi; </p>';
            previewHTML += '<b><br>We Claim that: <br><br></b>';
            previewHTML += '<p>The novelty resides in the shape and configuration of the <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> as illustrated.</p>';
            previewHTML += '<p>No claim is made by virtue of this registration in respect of any mechanical or other action of any mechanism whatever or in respect of any mode or principle of construction of the Article.</p>';
            previewHTML += '<p>No claim is made by virtue of this registration to any right to the exclusive use of the words, letters, numbers, Color, or trademarks appearing in the representation. </p>'
            previewHTML += '<p>Dated :' + formattedDate + '</p>';
            previewHTML += '<strong><div style="text-align: right;">For, (Applicant)<br><br>Marwadi University<br>(Naresh Dilawarsinh Jadeja, Registrar)<br><br>';
            // Loop through the innovator names and add them to the same cell
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                previewHTML += name + '<br><br>';
            }
            previewHTML += '</strong>';
            previewHTML += '</div>';

            document.getElementById("previewTableDiv").innerHTML = previewHTML;
            document.getElementById("popupOverlay").style.display = "block";

            currentPopupFunction = printViewPreview;


        }

        function openPopupviews() {
            var previewHTML = '<div class="preview-container">';
            var titleOfWork = document.getElementById("titleOfWork").value;




            var imageIds = ['front_view', 'rear_view', 'top_view', 'bottom_view', 'left_view', 'right_view', 'prospective_view'];
            for (var i = 0; i < imageIds.length; i++) {
                previewHTML += '<strong>Marwadi University</strong><br>';
                // var table = document.getElementById("itemTable");
                // var rows = table.getElementsByTagName("tr");
                // for (var i = 1; i < rows.length; i++) {
                //     var cells = rows[i].getElementsByTagName("td");
                //     var name = cells[2].innerText;

                //     previewHTML += '<strong>' + name + '</strong><br>';

                // }
                var imageId = imageIds[i];
                var fileInput = document.getElementById(imageId);
                if (fileInput.files && fileInput.files[0]) {
                    previewHTML += '<img style="height:100px;width:100px;" src="' + URL.createObjectURL(fileInput.files[0]) + '" alt="' + imageId + '"><br><br>';
                }
            }

            previewHTML += '<b><br>We Claim that: <br><br></b>';
            previewHTML += '<p>The novelty resides in the shape and configuration of the <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> as illustrated.</p>';
            previewHTML += '<p>No claim is made by virtue of this registration in respect of any mechanical or other action of any mechanism whatever or in respect of any mode or principle of construction of the Article.</p>';
            previewHTML += '<p>No claim is made by virtue of this registration to any right to the exclusive use of the words, letters, numbers, Color, or trademarks appearing in the representation. </p>'
            previewHTML += '<p>Dated :' + formattedDate + '</p>';
            previewHTML += '<strong><div style="text-align: right;">For, (Applicant)<br><br>Marwadi University<br>(Naresh Dilawarsinh Jadeja, Registrar)<br><br>';
            // Loop through the innovator names and add them to the same cell
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                previewHTML += name + '<br><br>';
            }
            previewHTML += '</strong>';
            previewHTML += '</div>';

            document.getElementById("previewTableDiv").innerHTML = previewHTML;
            document.getElementById("popupOverlay").style.display = "block";

            currentPopupFunction = printViewPreviews;


        }

        function printViewPreviews() {
            var titleOfWork = document.getElementById("titleOfWork").value;
            var previewContent = document.getElementById("previewTableDiv").innerHTML;
            var imageUrl = 'forms/design/design_images/1 (1).jpg';

            var frontViewImage = '<img src="' + imageUrl + '" alt="Front View">';
            var printStyle = '<style>';
            printStyle += 'table { border-collapse: collapse; width: 100%; }';
            printStyle += 'th, td { border: 1px solid black; padding: 8px; text-align: left; }';
            printStyle += 'td { width: 50%; }';
            printStyle += '</style>';
            var printWindow = window.open('', '_blank', 'height=auto,width=auto');
            printWindow.document.write('<html><head><title>Print Preview</title>' + printStyle + '</head><body style="font-family: "Times New Roman", Times, serif;">');

            printWindow.document.write('<strong>Marwadi University</strong><br>');
            var table = document.getElementById("itemTable");
            var rows = table.getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;

                printWindow.document.write('<strong>' + name + '</strong><br>');

            }
            printWindow.document.write(frontViewImage);
            printWindow.document.write('<b><strong>FRONT VIEW</strong></b>');
            printWindow.document.write('<b><br>We Claim that: <br><br></b>');
            printWindow.document.write('<p>The novelty resides in the shape and configuration of the <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> as illustrated.</p>');
            printWindow.document.write('<p>No claim is made by virtue of this registration in respect of any mechanical or other action of any mechanism whatever or in respect of any mode or principle of construction of the Article.</p>');
            printWindow.document.write('<p>No claim is made by virtue of this registration to any right to the exclusive use of the words, letters, numbers, Color, or trademarks appearing in the representation. </p>');
            printWindow.document.write('<p>Dated :' + formattedDate + '</p>');
            printWindow.document.write('<strong><div style="text-align: right;">For, (Applicant)<br><br>Marwadi University<br>(Naresh Dilawarsinh Jadeja, Registrar)<br><br>');
            // Loop through the innovator names and add them to the same cell
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                printWindow.document.write(name + '<br><br>');
            }
            printWindow.document.write('</strong>');
            printWindow.document.write('</div>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();

        }

        function printViewPreview() {
            var titleOfWork = document.getElementById("titleOfWork").value;
            var previewContent = document.getElementById("previewTableDiv").innerHTML;
            var printStyle = '<style>';
            printStyle += 'table { border-collapse: collapse; width: 100%; }';
            printStyle += 'th, td { border: 1px solid black; padding: 8px; text-align: left; }';
            printStyle += 'td { width: 50%; }';
            printStyle += '</style>';
            var printWindow = window.open('', '_blank', 'height=auto,width=auto');
            printWindow.document.write('<html><head><title>Print Preview</title>' + printStyle + '</head><body style="font-family: "Times New Roman", Times, serif;">');

            printWindow.document.write('<strong>Marwadi University</strong><br>');
            var table = document.getElementById("itemTable");
            var rows = table.getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;

                printWindow.document.write('<strong>' + name + '</strong><br>');

            }
            printWindow.document.write('<br><p>We have invented a new design of a <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> as outlined in the following specifications. The claimed design of the <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> consists of an arrangement to measure the vertical penetration caused by standard needle in industrial wax. This measurement further helps in getting an idea about hardness of industrial wax used in investment casting process. This device is specifically designed to acquire real time data related to measurement of penetration through sensors & data acquisition system, and streams the acquired data to server using internet. This device is designed as per guidelines of Investment Casting Institute - USA.</p>');
            printWindow.document.write('<p>Figure 1 is a Front View of an <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> of our new design&semi; <br>Figure 2 is a Rear View thereof&semi; <br>Figure 3 is a Top View thereof&semi; <br>Figure 4 is a Bottom View thereof&semi; <br>Figure 5 is a Left Side View thereof&semi; <br>Figure 6 is the Right Side View thereof&semi; <br>Figure 7 is the Perspective View thereof&semi; </p>');
            printWindow.document.write('<b><br>We Claim that: <br><br></b>');
            printWindow.document.write('<p>The novelty resides in the shape and configuration of the <span style="text-transform:uppercase"><strong>' + titleOfWork + '</strong></span> as illustrated.</p>');
            printWindow.document.write('<p>No claim is made by virtue of this registration in respect of any mechanical or other action of any mechanism whatever or in respect of any mode or principle of construction of the Article.</p>');
            printWindow.document.write('<p>No claim is made by virtue of this registration to any right to the exclusive use of the words, letters, numbers, Color, or trademarks appearing in the representation. </p>');
            printWindow.document.write('<p>Dated :' + formattedDate + '</p>');
            printWindow.document.write('<strong><div style="text-align: right;">For, (Applicant)<br><br>Marwadi University<br>(Naresh Dilawarsinh Jadeja, Registrar)<br><br>');
            // Loop through the innovator names and add them to the same cell
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                printWindow.document.write(name + '<br><br>');
            }
            printWindow.document.write('</strong>');
            printWindow.document.write('</div>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function printPreview() {
            var titleOfWork = document.getElementById("titleOfWork").value;
            var stateOfDesign = document.getElementById("stateOfDesign").value;
            var classno = document.getElementById("classno").value;

            var previewContent = document.getElementById("previewTableDiv").innerHTML;
            var printStyle = '<style>';
            printStyle += 'table { border-collapse: collapse; width: 100%; }';
            printStyle += 'th, td { border: 1px solid black; padding: 8px; text-align: left; }';
            printStyle += 'td { width: 50%; }';
            printStyle += '</style>';
            var printWindow = window.open('', '_blank', 'height=auto,width=auto');
            printWindow.document.write('<html><head><title>Print Preview</title>' + printStyle + '</head><body style="font-family: "Times New Roman", Times, serif;">');

            printWindow.document.write('<div>');
            printWindow.document.write('<table style="text-align: left;">');
            printWindow.document.write('<tr>');
            printWindow.document.write('<th colspan="2"><h3 style="text-align: center;">FORM - 1<br>Application for Registration of Designs<br>Sections 5 & 44</b></h3></th>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td colspan="2" >You are requested to register the accompanying in;</td>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td colspan="2">Class No <strong><u>' + classno + '</u></strong> in the same; </td>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td><strong>Marwadi University </strong></td>');
            printWindow.document.write('<td>Rajkot - Morbi Highway Road, Gauridad, Rajkot, Gujarat 360003</td>');
            printWindow.document.write('</tr>');

            var table = document.getElementById("itemTable");
            var rows = table.getElementsByTagName("tr");
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                var address = cells[3].innerText;

                printWindow.document.write('<tr>');
                printWindow.document.write('<td><strong>' + name + '</strong></td>');
                printWindow.document.write('<td>' + address + '</td>');
                printWindow.document.write('</tr>');
            }

            printWindow.document.write('<tr>');
            printWindow.document.write('<td colspan="2">Who claim(s) to be proprietor(s) thereof</td>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td>Category of Applicant</td>');
            printWindow.document.write('<td>Marwadi University</td>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td colspan="2">Four exactly similar <strong>' + stateOfDesign.toUpperCase() + '</strong> of the design accompany this request</td>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td colspan="2">The design is to be applied for a new design of the <strong>' + titleOfWork + '</strong> </td>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td>Address For Service in India is</td>');
            printWindow.document.write('<td><strong>Marwadi University, Rajkot - Morbi<br>Highway Road, Gauridad, Rajkot,<br>Gujarat 360003<br>registrar@marwadiuniversity.ac.in<br>Cell: +91 9727724694</strong></td>');
            printWindow.document.write('</tr>');
            printWindow.document.write('<tr>');
            printWindow.document.write('<td colspan="2"><strong>Declaration:</strong><br>The applicant claims to be the proprietors of the design and that to the best of their knowledge and belief design is new or original</td>');
            printWindow.document.write('</tr>');

            // Add the formatted date to the previewHTML
            // Add the formatted date and applicant information to the previewHTML
            printWindow.document.write('<tr>');
            printWindow.document.write('<td colspan="2" style="text-align: left;">Dated this: ' + formattedDate + '<strong><div style="text-align: right;">For, (Applicant)<br><br>Marwadi University<br>(Naresh Dilawarsinh Jadeja, Registrar)<br><br>');
            // Loop through the innovator names and add them to the same cell
            for (var i = 1; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var name = cells[2].innerText;
                printWindow.document.write(name + '<br><br>');
            }
            printWindow.document.write('</div><div style="text-align: left;">To<br>The Controller of Designs,<br>The Patent Office,<br>Kolkata</div></strong></td>');
            printWindow.document.write('</tr>');


            printWindow.document.write('</table>');
            printWindow.document.write('</div>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function closePopup() {
            document.getElementById("popupOverlay").style.display = "none";
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