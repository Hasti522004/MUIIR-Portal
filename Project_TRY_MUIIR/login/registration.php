<?php

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	require_once "../assets/include/config.php";

	// Handle file upload
	$target_dir = "upload/";
	$target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["profilepic"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check file size
	if ($_FILES["profilepic"]["size"] > 2000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if (
		$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif"
	) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file)) {
			echo "The file " . htmlspecialchars(basename($_FILES["profilepic"]["name"])) . " has been uploaded.";
			$profilepic = basename($_FILES["profilepic"]["name"]);
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}

	// Insert data into database
	$sql = "INSERT INTO users (grno,title,firstname, lastname, username, password, contactnumber, emailid, program, department, profilepic) VALUES (:id,:title,:firstname, :lastname, :username, :password, :contactnumber, :emailid, :program, :department, :profilepic)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':id', $_POST['grno']);
	$stmt->bindParam(':title', $_POST['title']);
	$stmt->bindParam(':firstname', $_POST['firstname']);
	$stmt->bindParam(':lastname', $_POST['lastname']);
	$stmt->bindParam(':username', $_POST['username']);
	$stmt->bindParam(':password', $_POST['password']);
	$stmt->bindParam(':contactnumber', $_POST['contactnumber']);
	$stmt->bindParam(':emailid', $_POST['emailid']);
	$stmt->bindParam(':program', $_POST['program']);
	$stmt->bindParam(':department', $_POST['department']);
	$stmt->bindParam(':profilepic', $profilepic);
	$stmt->execute();

	// Redirect to homepage with success message
	header("Location:login.php?msg=Data inserted successfully.");
	exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
    .card-header,
    .btn {
        background-color: #337ab7;
        /* Change this to your desired color */
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

    <!-- Registration Form -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-white">
                        <h4>Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="myForm" enctype="multipart/form-data"
                            onsubmit="return formValidation()">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>GR No.<span style="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="grno" required minlength="6"
                                        maxlength="10" pattern="[0-9]{6,10}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Username<span style="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="username" required minlength="3"
                                        maxlength="20">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Title<span style="color:red;" class="required"> *</span></label>
                                    <select class="form-control" name="title" required>
                                        <option value="">Select a title</option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Ms">Ms.</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>First Name<span style="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="firstname" required
                                        pattern="[A-Za-z]+">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name<span style="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="lastname" required
                                        pattern="[A-Za-z]+">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Program<span style="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="program" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Department<span style="color:red;" class="required"> *</span></label>
                                    <input type="text" class="form-control" name="department" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Contact Number<span style="color:red;" class="required"> *</span></label>
                                    <input type="tel" class="form-control" name="contactnumber" required
                                        pattern="[0-9]{10}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email<span style="color:red;" class="required"> *</span></label>
                                    <input type="email" class="form-control" name="emailid" required>
                                    <small class="form-text text-muted">Please enter a valid email address.</small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Password<span style="color:red;" class="required"> *</span></label>
                                    <input type="password" class="form-control" name="password" required
                                        pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':\\|,.<>\/?])(?!.*\s).{8,}$">
                                    <small class="form-text text-muted">Please enter a password that is at least 8
                                        characters long and contains at least one uppercase letter, one lowercase
                                        letter, one number, and one special character.</small>
                                </div>
                                <!-- <div class="form-group col-md-6">
								<label>Confirm Password</label>
								<input type="password" class="form-control" name="confirmpassword" required>
							</div> -->
                                <div class="form-group col-md-6">
                                    <label>Profile Picture<span style="color:red;" class="required"> *</span></label>
                                    <input type="file" class="form-control-file" name="profilepic" accept="image/*">
                                    <small class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, GIF. Maximum
                                        size: 2MB</small>
                                </div>
                            </div>



                    </div>
                    <div class="form-row">
                        <div class="col-9">
                            <a class="form-group d-flex justify-content-center" href="login.php"><button type="submit"
                                    id="submitButton" class="btn">Register</button></a>
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
    <script>
    // Select all input elements for validation
    const grNo = document.getElementsByName("grno")[0];
    const username = document.getElementsByName("username")[0];
    const title = document.getElementsByName("title")[0];
    const firstName = document.getElementsByName("firstname")[0];
    const lastName = document.getElementsByName("lastname")[0];
    const program = document.getElementsByName("program")[0];
    const department = document.getElementsByName("department")[0];
    const contactNumber = document.getElementsByName("contactnumber")[0];
    const email = document.getElementsByName("emailid")[0];
    const password = document.getElementsByName("password")[0];
    const profilePic = document.getElementsByName("profilepicture")[0];

    // get a reference to the form and submit button
    const form = document.getElementById("myForm");
    const submitButton = document.getElementById("submitButton");

    // add an event listener to the submit button
    submitButton.addEventListener("click", function() {
        // call the validateForm() function when the submit button is clicked
        if (formValidation()) {
            form.submit();
        }
    });


    // Function for form validation
    function formValidation() {

        // Validate GR No.
        if (!grNo.value.match(/^[0-9]{6,10}$/)) {
            alert("GR No. must be a number between 6-10 digits!");
            grNo.focus();
            return false;
        }

        // Validate Username
        if (username.value.length < 3 || username.value.length > 20) {
            alert("Username must be between 3-20 characters!");
            username.focus();
            return false;
        }

        // Validate Title
        if (title.value === "") {
            alert("Please select a title!");
            return false;
        }

        // Validate First Name
        if (!firstName.value.match(/^[A-Za-z]+$/)) {
            alert("First Name must contain only alphabets!");
            firstName.focus();
            return false;
        }

        // Validate Last Name
        if (!lastName.value.match(/^[A-Za-z]+$/)) {
            alert("Last Name must contain only alphabets!");
            lastName.focus();
            return false;
        }

        // Validate Program
        if (program.value === "") {
            alert("Program field is required!");
            return false;
        }

        // Validate Department
        if (department.value === "") {
            alert("Department field is required!");
            return false;
        }

        // Validate Contact Number
        if (!contactNumber.value.match(/^[0-9]{10}$/)) {
            alert("Contact Number must be a 10 digit number!");
            contactNumber.focus();
            return false;
        }

        // Validate Email
        if (!email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
            alert("Please enter a valid email!");
            email.focus();
            return false;
        }

        // Validate Password
        if (!password.value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/)) {
            alert(
                "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character!");
            password.focus();
            return false;
        }

        // Validate Profile Picture
        if (profilePic.value === "") {
            alert("Please upload a profile picture!");
            return false;
        }

        return true;
    }
    </script>
    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"
        integrity="sha384-rnRcOTLZIrcwZvbiMh7W8Bue5U5o6U5vqew3ndpf8LY49GWZS7Ke1wvQAYaw7W8P" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>