<?php
// Include the config.php file
require_once "../../assets/include/config.php";
try {
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (isset($_POST['submit'])) {
        // Process form submission

        // Escape the input to prevent SQL injection
        $id = $_SESSION['p_id'];
        $description = $_POST['description'];
        $title = $_POST['title'];
        $language_work = $_POST['language_work'];
        $remarks = $_POST['remark'];
        $published = $_POST['published'];
        $use_previous_data = $_POST['samedata'];
        // Insert data into the 'copyright2' table
        $stmt = $conn->prepare("INSERT INTO copyright2 (id, description, title, language_work, remarks, published, use_previous_data) 
                               VALUES (:id, :description, :title, :language_work, :remarks, :published, :use_previous_data)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':language_work', $language_work);
        $stmt->bindParam(':remarks', $remarks);
        $stmt->bindParam(':published', $published);
        $stmt->bindParam(':use_previous_data', $use_previous_data);

        if ($stmt->execute()) {
            // Check if the checkbox is unchecked and insert new data from the form into 'copyright3'
            if ($use_previous_data === 'No') {
                $grno = $_POST['grno'];
                $name = $_POST['name'];
                $pincode = $_POST['pincode'];
                $address = $_POST['address'];
                $nationality = $_POST['nationality'];
                $authors = $_POST["srno"];

                $stmt2 = $conn->prepare("INSERT INTO copyright3 (id, grno, name, pincode, address, nationality,author) 
                                       VALUES (:id, :grno, :name, :pincode, :address, :nationality,:author)");

                for ($i = 0; $i < count($grno); $i++) {
                    $stmt2->bindParam(':id', $id);
                    $stmt2->bindParam(':grno', $grno[$i]);
                    $stmt2->bindParam(':name', $name[$i]);
                    $stmt2->bindParam(':pincode', $pincode[$i]);
                    $stmt2->bindParam(':address', $address[$i]);
                    $stmt2->bindParam(':nationality', $nationality[$i]);
                    $stmt2->bindParam(':author', $authors[$i]);

                    $stmt2->execute();
                }
            }

            echo "<script>alert('Data successfully added!');</script>";
            echo "<script>window.location.href = '../../pages/copyright.php';</script>";
            exit;
        } else {
            // Error occurred while inserting data
            echo "Error: Unable to insert data into the database.";
        }
    }
} catch (PDOException $e) {
    // Handle PDO exceptions
    if ($e->getCode() === '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
        echo "<script>alert('You have already submitted project details for copyright.');</script>";
        echo "<script>window.location.href = '../../pages/copyright.php';</script>";
    } else {
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$pdo = null;

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
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h5>STATEMENT OF PARTICULARS</h5>
                    </div>

                    <div class="card-body">

                        <input type="checkbox" name="samedata" id="" onclick="samedata()">
                        <label> Same as Above data</label>
                        <br>
                        <form method="POST" id="myForm" onsubmit="return submitForm();">
                            <div>
                                <input type="hidden" name="samedata" id="hiddenCheckboxValue" value='No'>

                                <div id="tableContainer" style="display: none;">
                                    <?php
                                    // Retrieve the records array from the session variable
                                    $records = $_SESSION['records'];
                                    // Display the data
                                    if (!empty($records)) {
                                        echo "<table>";
                                        echo "<thead><tr><th>Employee Id/Gr no.</th><th>Name</th><th>Pincode</th><th>Address</th><th>Nationality</th><th>Author</th></tr></thead>";
                                        echo "<tbody>";
                                        foreach ($records as $record) {
                                            echo "<tr>";
                                            echo "<td>" . $record['grno'] . "</td>";
                                            echo "<td>" . $record['name'] . "</td>";
                                            echo "<td>" . $record['pincode'] . "</td>";
                                            echo "<td>" . $record['address'] . "</td>";
                                            echo "<td>" . $record['nationality'] . "</td>";
                                            echo "<td>" . $record['author'] . "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                    } else {
                                        echo "No data found.";
                                    }
                                    ?>
                                </div>

                                <div id="inputFieldsContainer">
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
                                </div>
                            </div>
                            <br>
                            <label for="description">Description of the Work (in 200 characters only)<span
                                    style="color:red;" class="required"> *</span></label>
                            <br>
                            <input style="width:100%;" type="text" id="description" name="description" maxlength="200"
                                required>
                            <br>
                            <label for="title">Title of Work<span style="color:red;" class="required"> *</span></label>
                            <br>
                            <input style="width:100%;" type="text" id="title" name="title" maxlength="200" required>
                            <br>
                            <label for="language_work">Language of Work (if more than one language is used then separate
                                it by comma, e.g. dotnet, php, android)<span style="color:red;" class="required">
                                    *</span></label>
                            <br>
                            <input style="width:100%;" type="text" id="language_work" name="language_work"
                                maxlength="200" required>
                            <br>
                            <label for="remark">Remarks (in 200 characters only) (optional)</label>
                            <br>
                            <input style="width:100%;" type="text" id="remark" name="remark" maxlength="200">
                            <br>
                            <label>Whether Work is Published or Unpublished ?<span style="color:red;" class="required">
                                    *</span></label>
                            <br>
                            <input type="radio" id="published" name="published" value="published" required>
                            <label for="published"> published</label>
                            <input type="radio" id="unpublished" name="published" value="unpublished" required>
                            <label for="unpublished"> unpublished</label>
                            <br>

                            <div id="popupOverlay"
                                style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8);">
                                <div
                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border-radius: 10px;">
                                    <span
                                        style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 24px;"
                                        onclick="closePopup();">&times;</span>
                                    <div id="previewTableDiv"></div>
                                    <div class="text-center">
                                        <button type="button" onclick="printPreview();" id="printButton">Print</button>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" onclick="openPopup();" id="openPopupButton">Preview</button>
                                <input type="submit" name="submit" value="submit" id="submit">
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="copyright2.js"></script>
</body>

</html>