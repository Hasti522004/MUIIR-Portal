<?php
    require_once "config.php";

    $id = $_GET['id'];

    $sql = "delete from design where id=:id";

    $res = $conn->prepare($sql);

    $res->bindParam(':id', $id);

    $res->execute();

    header("location:dashboard.php?msg=Data Deleted!");
?>