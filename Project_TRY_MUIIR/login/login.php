<?php

require_once "../assets/include/config.php";

if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query="SELECT * FROM users WHERE username=:username AND password=:password";
    $stmt=$conn->prepare($query);
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":password", $password);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        $status = $result['status'];
        if($status == 2){
            header("Location:../admin/dashboard.php?msg=Data inserted successfully.");
        } elseif($status == 1){
            header("Location:../mentor/dashboard.php?msg=Data inserted successfully.");
        } else {
            header("Location:../users/dashboard.php?msg=Data inserted successfully.");
        }
    } else {
        echo '<script>alert("Username or password is incorrect.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
    .card-header,
    .btn {
        background-color: #337ab7;
        /* Change this to your desired color */
        text-align: center;
    }

    .card {
        max-width: 500px;
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
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    </style>
</head>

<body>

    <!-- Login Form -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white">
                        <h4>Login Form</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Username<span style="color:red;" class="required"> *</span></label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="form-group">
                                <label>Password<span style="color:red;" class="required"> *</span></label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="mt-3 text-center">
                                <a href="registration.php">Register Here</a> |
                                <a href="forgot_psw.php">Forgot Password</a>
                                <!-- <a href="logout.php">Logout</a> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>