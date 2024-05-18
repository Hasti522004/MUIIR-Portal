<?php
require_once "../../assets/include/config.php";
require('PHPMailer/PHPMailerAutoload.php');

if(isset($_POST) && !empty($_POST)){
  $email = $_POST['email'];
  $stmt = $connection->prepare("SELECT * FROM login WHERE email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $count = $stmt->rowCount();
  
  if($count == 1){
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    $password = $r['password'];
    $to = $r['email'];
    $subject = "Your Recovered Password";
    $message = "Please use this password to login " . $password;
    $headers = "From : admin@phpflow.com";

    if(mail($to, $subject, $message, $headers)){
      echo "Your Password has been sent to your email id";
    }else{
      echo "Failed to Recover your password, try again";
    }

  }else{
    echo "Email does not exist in database";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password in PHP & MySQL</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
  <?php if(isset($smsg)){ ?>
    <div class="alert alert-success" role="alert">
      <?php echo $smsg; ?>
    </div>
  <?php } ?>
  <?php if(isset($fmsg)){ ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $fmsg; ?>
    </div>
  <?php } ?>
  <form id="register-form" role="form" autocomplete="off" class="form" method="post">    
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
        <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
      </div>
    </div>
    <div class="form-group">
      <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
    </div>
    <input type="hidden" class="hide" name="token" id="token" value=""> 
  </form>
</div>
</body>
</html>
