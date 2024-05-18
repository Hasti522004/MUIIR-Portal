<?php
require_once "config.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "UPDATE copyright SET grno=:grno, name=:name, address=:address, pincode=:pincode, nationality=:nationality, description=:description, title=:title, language_work=:language_work, publish=:publish, remark=:remark WHERE id=:id";

        $res = $conn->prepare($sql);
        $res->bindParam(':grno', $_REQUEST['grno']);
        $res->bindParam(':name', $_REQUEST['name']);
        $res->bindParam(':address', $_REQUEST['address']);
        $res->bindParam(':pincode', $_REQUEST['pincode']);
        $res->bindParam(':nationality', $_REQUEST['nationality']);
        $res->bindParam(':description', $_REQUEST['description']);
        $res->bindParam(':title', $_REQUEST['title']);
        $res->bindParam(':language_work', $_REQUEST['language_work']);
        $res->bindParam(':publish', $_REQUEST['publish']);
        $res->bindParam(':remark', $_REQUEST['remark']);
        $res->bindParam(':id', $_REQUEST['id']);

        $res->execute();

        header("location: dashboard.php?msg=Data Updated!");
    } else {
        $sql = "SELECT * FROM copyright WHERE id=:id";

        $res = $conn->prepare($sql);

        $res->bindValue(':id', $_REQUEST['id']);

        $res->execute();

        if ($res->rowCount() == 1) {
            $row = $res->fetch();
        }
    }
} catch (PDOException $e) {
    echo "Error: Unable to execute the query" . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copyright Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .card {
            width: fit-content;
        }

        .card-header,
        .btn {
            background-color: #337ab7;
            /* Change this to your desired color */
        }

        /* Style for the input fields */
        input {
            padding: 5px;
            height: 30px;
            border-radius: 5px;
            border: 1px solid #999999;
            margin: 5px;
        }



        /* Style for the Add button */
        #addButton {
            background-color: #337ab7;
            color: white;
            padding: 5px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Style for the Add button when hovering over it */
        #addButton:hover {
            background-color: #337ab7;
        }

        #submit {
            background-color: #337ab7;
            color: white;
            padding: 5px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Style for the Add button when hovering over it */
        #sbtn:hover {
            background-color: #337ab7;
        }
    </style>

</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white">
                        <h4>Copyright Form</h4>
                    </div>
                    <div class="card-body">
                        <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i> I also send herewith duly completed the Statement of further particulars relating to
                            the work (Not applicable for filing copyright)</small>
                        <form method="POST" enctype="multipart/form-data">

                            <small class="form-text text-muted"><i class="fa fa-hand-o-right"></i>In accordance with rule 70 of the Copyright Rules, 2012, I have sent by prepaid
                                registered post copies of this letter and of the Statement of Particulars and Statement
                                of Further Particulars to other parties13 concerned, as shown below:
                            </small>
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID(grno)</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Pincode</th>
                                        <th>Nationality</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                <td><input type='number' name='grno' value="<?php if (isset($row['grno'])) {
                                                                                                                        echo $row['grno'];
                                                                                                                    } ?>" require></td>
                                 <td><input type='text' name='name' value="<?php if (isset($row['name'])) {
                                                                                                                        echo $row['name'];
                                                                                                                    } ?>" require></td>
                                
                                <td><input type='text' name='address' value="<?php if (isset($row['address'])) {
                                                                                                                        echo $row['address'];
                                                                                                                    } ?>" require></td>
                                
                                <td><input type='text' name='pincode' value="<?php if (isset($row['pincode'])) {
                                                                                                                        echo $row['pincode'];
                                                                                                                    } ?>" require></td>
                                
                                <td><input type='text' name='nationality' value="<?php if (isset($row['nationality'])) {
                                                                                                                        echo $row['nationality'];
                                                                                                                    } ?>" require></td>
                                
                                </tbody>
                            </table>
                            <button type="button" onclick="addItem();">Add Item</button>

                            <label>Description of the Work (in 200 characters only)<span style="color:red;" class="required"> *</span></label>
                            <br>
                            <input style="width:100%;" type="text" class="form-control" name="description" value="<?php if (isset($row['description'])) {
                                                                                                                        echo $row['description'];
                                                                                                                    } ?>" required>
                            <br>

                            <label>Title of Work<span style="color:red;" class="required"> *</span></label>
                            <br>
                            <input style="width:100%;" type="text" class="form-control" name="title" value="<?php if (isset($row['title'])) {
                                                                                                                echo $row['title'];
                                                                                                            } ?>" required>
                            <br>

                            <label>Language of Work (if more than one language is used then separate it by comma, eg. dotnet, php, android, )<span style="color:red;" class="required"> *</span></label>
                            <br>
                            <input style="width:100%;" type="text" class="form-control" name="language_work" value="<?php if (isset($row['language_work'])) {
                                                                                                                        echo $row['language_work'];
                                                                                                                    } ?>" required>
                            <br>

                            <label>Whether Work is Published or Unpublished ?<span style="color:red;" class="required"> *</span></label>
                            <br>
                            <input style="width:100%;" type="text" class="form-control" name="publish" value="<?php if (isset($row['publish'])) {
                                                                                                                    echo $row['publish'];
                                                                                                                } ?>" required>
                            <br>

                            <label>Remarks (in 200 characters only) (optional)</label>
                            <br>
                            <input style="width:100%;" type="text" class="form-control" name="remark" value="<?php if (isset($row['remark'])) {
                                                                                                                    echo $row['remark'];
                                                                                                                } ?>">
                            <br>

                            <div class="form-row">
							<div class="col-9">
								<a class="form-group d-flex justify-content-left" href="dashboard.php"><button type="submit" class="btn">Update</button></a> 
							</div>
							<div class="col-3">
								<a href="../index.php">Home</a>   
							</div>
						</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js" integrity="sha384-rnRcOTLZIrcwZvbiMh7W8Bue5U5o6U5vqew3ndpf8LY49GWZS7Ke1wvQAYaw7W8P" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


</body>

</html>