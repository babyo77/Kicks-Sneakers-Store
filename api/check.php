<?php
session_start();
if (isset($_SESSION['user-email']) && $_SESSION['status'] === true) {
    header('location: ../pages/dashboard.php');
    exit();
}else{
    header('location: ../pages/login.php');
    die();
}

?>