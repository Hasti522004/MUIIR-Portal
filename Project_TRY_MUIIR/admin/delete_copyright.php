<?php
    require_once "config.php";

    $id = $_GET['id'];

    $sql = "delete from copyright1 where id=:id";

    $res = $conn->prepare($sql);

    $res->bindParam(':id', $id);

    $res->execute();

    header("location:dashboard.php?msg=Data Deleted!");
?>