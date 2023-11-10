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
        <form action="../api/login.php" method="post" id="form">
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
    </div>
    <?php
    if (isset($_GET['error'])) {
        echo '<script>document.getElementById("error-message").textContent = "' .$_GET['error']. '"; document.getElementById("error-message").style.display = "block"; setTimeout(function() { document.getElementById("error-message").style.display = "none"; }, 4000);</script>';
        if($_GET['error']=="Register to continue." || $_GET['error']=='All fields are required.'){
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
    }
    ?>
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