<?php
    require_once "config.php";

    try {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sql = "UPDATE users SET firstname=:fname, lastname=:lname, username=:uname, password=:pword, contactnumber=:cnumber, emailid=:email, program=:prog, department=:dept, title=:title WHERE grno=:grno";
            
            $res = $conn->prepare($sql);

            $res->bindParam(':fname', $_REQUEST['firstname']);
            $res->bindParam(':lname', $_REQUEST['lastname']);
            $res->bindParam(':uname', $_REQUEST['username']);
            $res->bindParam(':pword', $_REQUEST['password']);
            $res->bindParam(':cnumber', $_REQUEST['contactnumber']);
            $res->bindParam(':email', $_REQUEST['emailid']);
            $res->bindParam(':prog', $_REQUEST['program']);
            $res->bindParam(':dept', $_REQUEST['department']);
            $res->bindParam(':title', $_REQUEST['title']);
            $res->bindParam(':grno', $_REQUEST['grno']);

            $res->execute();

            header("location: dashboard.php?msg=Data Updated!");
        }
        else {
            $sql = "SELECT * FROM users WHERE grno=:grno";

            $res = $conn->prepare($sql);
    
            $res->bindValue(':grno', $_REQUEST['grno']);
    
            $res->execute();
    
            if ($res->rowCount() == 1) {
                $row = $res->fetch();
            }
        }
    }
    catch(PDOException $e){
        echo "Error: Unable to execute the query".$e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit User</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<!-- Custom CSS -->
	<style>

.card-header,.btn{
  background-color:#337ab7; /* Change this to your desired color */
}
.card {
  max-width: 700px;
  margin: auto;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
}

@media (max-width: 576px) {
  .card {
	margin-top: 20px;
  }
}
.form-control {
	display: block;
	width: 100%;
	height: 34px;
	padding: 6px 12px;
	font-size: 14px;
	line-height: 1.42857143;
	color: #555;
	background-image: none;
	border: 1px solid #ccc;
	border-radius: 4px;
}
	
</style>
</head>
<body>
<div class="container my-5">
		<div class="row justify-content-center">
			<div class="col-md-9">
				<div class="card">
					<div class="card-header text-white">
						<h4>Edit user Data</h4>
					</div>
					<div class="card-body">
						<form method="POST" enctype="multipart/form-data">
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>GR No.</label>
								<input type="text" class="form-control" name="grno" value="<?php if(isset($row['grno'])){ echo $row['grno'];} ?>" required>
							</div>
							<div class="form-group col-md-6">
								<label>Username</label>
								 <input type="text" class="form-control" name="username" value="<?php if(isset($row['username'])){ echo $row['username'];} ?>" required>
							</div>
							<div class="form-group col-md-3">
								<label>Title</label>
								<select class="form-control" name="title" value="<?php if(isset($row['title'])){ echo $row['title'];} ?>">
									<option value="Mr">Mr.</option>
									<option value="Mrs">Mrs.</option>
									<option value="Ms">Ms.</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>First Name</label>
								<input type="text" class="form-control" name="firstname" value="<?php if(isset($row['firstname'])){ echo $row['firstname'];} ?>" required>
							</div>
							<div class="form-group col-md-6">
								<label>Last Name</label>
								<input type="text" class="form-control" name="lastname" value="<?php if(isset($row['lastname'])){ echo $row['lastname'];} ?>" required>
							</div>
						</div>
						
						
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Program</label>
								<input type="text" class="form-control" name="program" value="<?php if(isset($row['program'])){ echo $row['program'];} ?>" required>
							</div>
							<div class="form-group col-md-6">
								<label>Department</label>
								<input type="text" class="form-control" name="department" value="<?php if(isset($row['department'])){ echo $row['department'];} ?>" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Contact Number</label>
								<input type="text" class="form-control" name="contactnumber" value="<?php if(isset($row['contactnumber'])){ echo $row['contactnumber'];} ?>" required>
							</div>
							<div class="form-group col-md-6">
								<label>Email</label>
								<input type="email" class="form-control" name="emailid" value="<?php if(isset($row['emailid'])){ echo $row['emailid'];} ?>" required>
							</div>
						</div>
						<div class="form-row">	
							<div class="form-group col-md-6">
								<label>Password</label>
								<input type="password" class="form-control" name="password" value="<?php if(isset($row['password'])){ echo $row['password'];} ?>" required>
							</div>
						</div>

						
						
						<div class="form-row">
							<div class="col-9">
								<a class="form-group d-flex justify-content-center" href="dashboard.php"><button type="submit" class="btn">Update</button></a> 
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"
	integrity="sha384-rnRcOTLZIrcwZvbiMh7W8Bue5U5o6U5vqew3ndpf8LY49GWZS7Ke1wvQAYaw7W8P"
	crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
   