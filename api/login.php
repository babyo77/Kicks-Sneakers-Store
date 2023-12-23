<?php
session_start();
require '../includes/db.php';

if (isset($_POST['login'])) {
    $email = $con->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT  `id` ,`password`, `username` FROM `user` WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            $hashedPassword = $row['password'];
            $username = $row['username'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user-email'] = $username;
                $_SESSION['status'] = true;
                $_SESSION['user_info_id'] = $row['id'];
                if (isset($_SESSION['previous_page']) && !empty($_SESSION['previous_page'])) {
                    $previousPage = $_SESSION['previous_page'];
                    header("location: $previousPage");
                    exit();
                } else {
                    header("location: ../index.php");
                    exit();
                }
            } else {
                $error_message = 'Incorrect Password.';
                header("location: ../pages/login.php?error=$error_message");
                die();
            }
        } else {
            $error_message = 'Register to continue.';
            header("location: ../pages/login.php?error=$error_message");
            die();
        }
    } else {
        $error_message = "Login failed. Please try again later.";
        header("location: ../pages/login.php?error=$error_message");
        die();
    }
}

if (isset($_POST['username-reg'])) {
    if (isset($_SESSION['user-email']) && $_SESSION['status'] === true) {
        header('location: ../index.php');
        exit();
    }

    $email = $con->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT `id`,`password`, `username` FROM `user` WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row) {
            $hashedPassword = $row['password'];
            $username = $row['username'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user-email'] = $username;
                $_SESSION['status'] = true;
$_SESSION['user_info_id'] = $row['id'];

                header("location: ../index.php");
                exit();
            } else {
                $error_message = 'Incorrect Password.';
                header("location: ../pages/login.php?error=$error_message");
                die();
            }
        } else {
            $email = $con->real_escape_string($_POST['email']);
            $username = $con->real_escape_string($_POST['username']);
            $password = $_POST['password'];

            if (empty(trim($email)) || empty(trim($username)) || empty(trim($password))) {
                $error_message = 'All fields are required.';
                header("location: ../pages/login.php?error=$error_message");
                die();
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $insert_sql = "INSERT INTO `user` (`email`, `password`, `username`) VALUES ('$email', '$hashedPassword', '$username')";
                $result = $con->query($insert_sql);

                if ($result) {
                    header('location: ../pages/login.php');
                    exit();
                } else {
                    $error_message = "Registration failed due to a technical issue. Please try again later.";
                    header("location: ../pages/login.php?error=$error_message");
                    die();
                }
            }
        }
    }
}

$con->close();
?>
