<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="muiir";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Error : Could not connet with DB".$e->getMessage();
}
?>