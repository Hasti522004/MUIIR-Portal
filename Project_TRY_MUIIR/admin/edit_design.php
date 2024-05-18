<?php
require_once "config.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "UPDATE design SET classno=:classno, grno=:grno, name=:name, address=:address, catapp=:catapp, eduins=:eduins, twork=:twork, description=:description WHERE id=:id";

        $res = $conn->prepare($sql);
        $res->bindParam(':classno', $_REQUEST['classno']);
        $res->bindParam(':grno', $_REQUEST['grno']);
        $res->bindParam(':name', $_REQUEST['name']);
        $res->bindParam(':address', $_REQUEST['address']);
        $res->bindParam(':catapp', $_REQUEST['catapp']);
        $res->bindParam(':eduins', $_REQUEST['eduins']);
        $res->bindParam(':twork', $_REQUEST['twork']);
        $res->bindParam(':description', $_REQUEST['description']);
        $res->bindParam(':id', $_REQUEST['id']);

        $res->execute();

        header("location: dashboard.php?msg=Data Updated!");
    } else {
        $sql = "SELECT * FROM design WHERE id=:id";

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
	<title>Registration Page</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<style>
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

		#p1 {
			text-align: right;
		}
	</style>

</head>

<body>

	<div class="container my-12">
		<div class="row justify-content-center">
			<div class="col-md-9">
				<div class="card">
					<div class="card-header text-white">
						<h4>Design Form</h4>
					</div>
					<div class="card-body">
						<small class="form-text text-muted"><i class="fa fa-hand-o-right"></i> You are requested to register the accompanying in:</small>
						<form method="POST" enctype="multipart/form-data">
							<div class="justify-content-center">
								Class No <input type="text" id="classno" name="classno" value="<?php if (isset($row['classno'])) {
                                                                                                                        echo $row['classno'];
                                                                                                                    } ?>"> in the name<br>
								<h4><b><i class="fa fa-hand-o-right"></i> Data of Inventor</b></h4>
								<table id="myTable">
									<thead>
										<tr>
											<th>ID(grno) </th>
											<th>Name </th>
											<th>Address <small>(Affiliation, Department, University, Address, City (State) - Pin)</small></th>
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
                                
                                </tbody>
									<br>

                                                                                                                </table>

								<small class="form-text text-muted"><i class="fa fa-hand-o-right"></i> Who claim(s) to be proprietor(s) thereof :</small>
								<input type="text" id="catapp" name="catapp"  value="<?php if (isset($row['catapp'])) {
                                                                                                                        echo $row['catapp'];
                                                                                                                    } ?>" placeholder="Category of Applicant">

								<input type="text" id="eduins" name="eduins" placeholder="Educational Institution"  value="<?php if (isset($row['eduins'])) {
                                                                                                                        echo $row['eduins'];
                                                                                                                    } ?>"><br>

								<!--  -->
								<small class="form-text text-muted"><i class="fa fa-hand-o-right"></i>For exactly similar DRAWINGS of the design accompany this request,</small>
								<input type="text" id="twork" name="twork" placeholder="Title of Work"  value="<?php if (isset($row['twork'])) {
                                                                                                                        echo $row['twork'];
                                                                                                                    } ?>"><br>
								<small class="form-text text-muted"><i class="fa fa-hand-o-right"></i>Address For Service in India is</small>
								<input style="width: 100%;" type="text" id="addind" name="addind" value="Marwadi University, Rajkot - Morbi Highway Road, Gauridad, Rajkot, Gujarat 360003
registrar@marwadiuniversity.ac.in 
Cell: +91 9727724694" disabled><br>

								<small class="form-text text-muted"><i class="fa fa-hand-o-right"></i> Declaration (The applicant claims to be the proprietors of the design and that to the best of their knowledge and belief design is new or original)</small>
								<input type="text" name="description" id="description"  value="<?php if (isset($row['description'])) {
                                                                                                                        echo $row['description'];
                                                                                                                    } ?>"><br>
								<p id="p1"><b>For, (Applicant)<br><br>
										Marwadi University<br>(Naresh Dilawarsinh Jadeja, Registrar)<br><br>inventors
									</b></p>

								<p id="p2"><b>To<br>
										The Controller of Designs, <br>
										The Patent Office, <br>
										Kolkata</b>
								</p>
							</div>
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