<?php
session_start();
if (isset($_SESSION['user-email']) && $_SESSION['status'] === true) {
    header('location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../stylesheets/login.css">
    <link rel="shortcut icon" href="../Assets/Images/favicon.webp" type="image/x-icon">
</head>

<body>
    <div class="main">
        <form action="login.php" method="post" id="form">
            <img src="../Assets/Images/Nike Airmax.gif" alt="">
            <h1>Enter your email to join us or sign in</h1>
            <input type="email" id="email" name="email" placeholder="Email address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="username" id="username" placeholder="Full Name" hidden>
            <div id="error-message" style="color: red; display: none; margin-left:.5rem;">Incorrect password. Please try again.</div>
            <p style="font-size: .7rem; padding-left: .5rem;">By continuing, I agree to Nike’s Privacy Policy and Terms of Use.</p>
            <button type="submit" name="login" value="login" id="login">
                <div class="loader"></div>
                <label id="text" for="login">Continue</label>
            </button>
            <a href="">Forgot password?</a>
        </form>

        <?php
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
                        echo '<script>window.location.href="../index.php"</script>';
                        exit();
                    }else{
                        $error_message = 'Incorrect Password.';
                    }
                } else {
                    // Email not found in the database
                    echo "<script>
    // Create the registration button
    const registrationButton = document.createElement('button');
    registrationButton.type = 'submit';
    registrationButton.name = 'username-reg';
    registrationButton.value = 'username-reg';
    registrationButton.id = 'reg';

    // Create the loader div within the button
    const loaderDiv = document.createElement('div');
    loaderDiv.className = 'loader';

    // Create the label for the button
    const label = document.createElement('label');
    label.id = 'text';
    label.htmlFor = 'login';
    label.textContent = 'Continue';

    // Append the loader and label to the button
    registrationButton.appendChild(loaderDiv);
    registrationButton.appendChild(label);

    // Hide the registration button initially
    registrationButton.hidden = true;

    const forgotPasswordLink = document.querySelector('a');

    forgotPasswordLink.parentNode.insertBefore(registrationButton, forgotPasswordLink);


                    document.getElementById('username').removeAttribute('hidden');
                    document.getElementById('username').setAttribute('required', 'required'); 
                    document.getElementById('reg').style.display='flex';
                    document.getElementById('reg').removeAttribute('hidden');
                    document.getElementById('login').remove();
                    </script>";
                }
            } else {
                $error_message = "Login failed. Please try again later.";
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
                        echo '<script>window.location.href="../index.php"</script>';
                        exit();
                    }else{
                        $error_message = 'Incorrect Password.';
                    }
                }else{
            
            $email = $con->real_escape_string($_POST['email']);
            $username = $con->real_escape_string($_POST['username']);
            $password = $_POST['password'];
            if (empty(trim($email)) || empty(trim($username)) || empty(trim($password))) {
                $error_message = "All fields are required.";
                echo "<script>
                // Create the registration button
                const registrationButton = document.createElement('button');
                registrationButton.type = 'submit';
                registrationButton.name = 'username-reg';
                registrationButton.value = 'username-reg';
                registrationButton.id = 'reg';
            
                // Create the loader div within the button
                const loaderDiv = document.createElement('div');
                loaderDiv.className = 'loader';
            
                // Create the label for the button
                const label = document.createElement('label');
                label.id = 'text';
                label.htmlFor = 'login';
                label.textContent = 'Continue';
            
                // Append the loader and label to the button
                registrationButton.appendChild(loaderDiv);
                registrationButton.appendChild(label);
            
                // Hide the registration button initially
                registrationButton.hidden = true;
            
                const forgotPasswordLink = document.querySelector('a');
            
                forgotPasswordLink.parentNode.insertBefore(registrationButton, forgotPasswordLink);
            
                                document.getElementById('username').removeAttribute('hidden');
                                document.getElementById('username').setAttribute('required', 'required'); 
                                document.getElementById('reg').style.display='flex';
                                document.getElementById('reg').removeAttribute('hidden');
                                document.getElementById('login').remove();
                                </script>";            
            }
                else{
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $insert_sql = 'INSERT INTO `user-info` (`email`, `password`, `username`) VALUES (?, ?, ?)';
            $insert_stmt = $con->prepare($insert_sql);
            $insert_stmt->bind_param('sss', $email, $hashedPassword, $username);
            if ($insert_stmt->execute()) {
                // Registration successful, you can now redirect to the login page
                echo '<script>window.location.href="../pages/login.php";localStorage.clear();</script>';
                exit();
            } else {
                $error_message = "Registration failed due to a technical issue. Please try again later.";
            }
            $insert_stmt->close();
        }
    }}}
        if (isset($error_message)) {
            echo '<script>document.getElementById("error-message").textContent = "' . $error_message . '"; document.getElementById("error-message").style.display = "block"; setTimeout(function() { document.getElementById("error-message").style.display = "none"; }, 4000);</script>';
        }
        ?>
    </div>
    <script>
        const form = document.getElementById('form');
        let email = document.getElementById('email')
        form.onsubmit = () => {
            document.querySelector('#text').style.display = "none";
            document.querySelector('.loader').style.display = "block";
            localStorage.setItem('email',email.value);
        }
        if(localStorage.getItem('email')){
            email.value = localStorage.getItem('email');
        }
    </script>
</body>

</html>