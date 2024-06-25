<?php 
session_start();

if(!isset($_SESSION['auth'])){

    header("Location: login.php");
    $_SESSION['status'] = "LOGIN OR REGISTER TO ACCES DASHBOARD";
    $_SESSION['status_code'] = "warning";
    exit();
}

?>