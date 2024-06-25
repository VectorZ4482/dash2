<?php 

$host = "localhost";
$name = "root";
$password = "";
$db_name = "patient";



$conn = mysqli_connect($host,$name,$password,$db_name);


if(!$conn){
    header("Location: ../errors/db.php");
    die();
}



?>
