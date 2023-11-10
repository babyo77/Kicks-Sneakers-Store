<?php
session_start();
        require '../includes/db.php';
        if (isset($_POST['login'])) {

            $email = $con->real_escape_string($_POST['email']);
            $password = $_POST['password'];

            $sql = 'SELECT `password`, `username` FROM `user-info` WHERE email = ?';
            if (!$con) {
                die('Connection failed: ' . $con->connect_error);
            }
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                die('Prepare failed: ' . $con->error);
            }
            $stmt->bind_param('s', $email);

            if ($stmt->execute()) {
                $stmt->bind_result($hashedPassword, $username);
                if ($stmt->fetch()) {
                    // Email found in the database
                    if (password_verify($password, $hashedPassword)) {
                        // Password is correct, so proceed with login
                        $_SESSION['user-email'] = $username;
                        $_SESSION['status'] = true;
                         header("location: ../index.php");
                        exit();
                    }else{
                        $error_message = 'Incorrect Password.';
                         header("location: ../pages/login.php?error=$error_message");
                         die();
                    }
                } else {
                    // Email not found in the database
                    $error_message = 'Register to continue.';
                    header("location: ../pages/login.php?error=$error_message");
                    die();
                }
            } else {
                $error_message = "Login failed. Please try again later.";
                header("location: ../pages/login.php?error=$error_message");
                die();
            }
            $stmt->close();
            $con->close();
        }

        if (isset($_POST['username-reg'])) {
            if (isset($_SESSION['user-email']) && $_SESSION['status'] === true) {
                header('location: ../index.php');
                exit();
            }
            
            $email = $con->real_escape_string($_POST['email']);
            $password = $_POST['password'];

            $sql = 'SELECT `password`, `username` FROM `user-info` WHERE email = ?';
            if (!$con) {
                die('Connection failed: ' . $con->connect_error);
            }
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                die('Prepare failed: ' . $con->error);
            }
            $stmt->bind_param('s', $email);

            if ($stmt->execute()) {
                $stmt->bind_result($hashedPassword, $username);
                if ($stmt->fetch()) {
                    // Email found in the database
                    if (password_verify($password, $hashedPassword)) {
                        // Password is correct, so proceed with login
                        
                        $_SESSION['user-email'] = $username;
                        $_SESSION['status'] = true;
                         header("location: ../index.php");
                        exit();
                    }else{
                        $error_message = 'Incorrect Password.';
                        header("location: ../pages/login.php?error=$error_message");
                        die();
                    }
                }else{
            
            $email = $con->real_escape_string($_POST['email']);
            $username = $con->real_escape_string($_POST['username']);
            $password = $_POST['password'];
            if (empty(trim($email)) || empty(trim($username)) || empty(trim($password))) {
                $error_message = 'All fields are required.';
                header("location: ../pages/login.php?error=$error_message");
                die();
            }
                else{
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $insert_sql = 'INSERT INTO `user-info` (`email`, `password`, `username`) VALUES (?, ?, ?)';
            $insert_stmt = $con->prepare($insert_sql);
            $insert_stmt->bind_param('sss', $email, $hashedPassword, $username);
            if ($insert_stmt->execute()) {
                // Registration successful, you can now redirect to the login page
                header('location: ../pages/login.php');
                exit();
            } else {
                $error_message = "Registration failed due to a technical issue. Please try again later.";
                header("location: ../pages/login.php?error=$error_message");
                die();
            }
            $insert_stmt->close();
        }
    }}}
        ?>