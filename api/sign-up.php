<?php
session_start();

if($_SERVER['REQUEST_METHOD']== 'POST'){
require '../includes/db.php';

$email = $con->real_escape_string($_POST['email']);
$password =  $_POST['password'];

$sql = 'SELECT `password`,`username` FROM `user-info` WHERE email = ?';
if (!$con) {
    die('Connection failed: ' . $con->connect_error);
}
$stmt = $con->prepare($sql);
if (!$stmt) {
    die('Prepare failed: ' . $con->error);
}
$stmt->bind_param('s', $email);

if($stmt->execute()){
    $stmt->bind_result($hashedPassword,$username);
    if($stmt->fetch() && password_verify($password,$hashedPassword)){
        session_start();
        $_SESSION['user-email'] = $username;
        $_SESSION['status'] = true;
        header('location: ../index.php');
        exit();
    }else{
         header('location: ../pages/login.html');
    }
}else{
    echo 'login failed';
}
$stmt->close();
$con->close();
}
?>