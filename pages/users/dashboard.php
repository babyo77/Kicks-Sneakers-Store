<?php
session_start();
if (isset($_SESSION['user-email']) && $_SESSION['status'] === true) {
    exit();
}else{
    header('location: ../login.php');
    die();
}

?>