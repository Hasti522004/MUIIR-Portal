<?php
    require_once "config.php";

    $grno = $_GET['grno'];

    $sql = "delete from users where grno=:grno";

    $res = $conn->prepare($sql);

    $res->bindParam(':grno', $grno);

    $res->execute();

    header("location:dashboard.php?msg=Data Deleted!");
?>