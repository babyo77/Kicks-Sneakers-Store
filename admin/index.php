<?php
session_start();
if (isset($_SESSION['user-email']) && $_SESSION['status'] === true) {
    header('Location: ../index.php');
    exit();
}
include_once "../includes/db.php";

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
        <form action="" method="post" id="form">
            <h1 style="text-align:center;">Admin Login</h1>
            <input type="email" id="email" name="email" placeholder="Email address" required>
            
            <button type="submit" name="login" value="login" id="login">
                <div class="loader"></div>
                <label id="text" for="login">Continue</label>
            </button>

            <?php
            if (isset($_POST['login'])) {

                $result = $con->query("SELECT `email` FROM `admin` WHERE email = '{$_POST['email']}'");

                if ($result && $result->num_rows > 0) {
                    $otp = generateOTP(4);
                    $_SESSION['otp'] = $otp;
                    $to = $_POST['email'];
                    $subject = "Your OTP for verification";
                    $message = "Your One-Time Password (OTP) is: $otp";
                    $headers = "From: Kicks-Store";
                    $subject = 'Test Email';
                    echo $otp;


                    
                        echo "<script>document.getElementById('email').remove();</script>";
                        echo "<script>document.getElementById('login').remove();</script>";
                        echo "<input type='text' name='verify' id='verify' placeholder='OTP'>";
                        echo "<button type='submit' name='otp' value='otp' id='otp'>
                        <div class='loader'></div>
                        <label id='text' for='otp'>Confirm OTP</label>
                    </button> ";
                   
                }
            }
            function generateOTP($length)
            {
                $characters = '0123456789';
                $otp = '';
                for ($i = 0; $i < $length; $i++) {
                    $otp .= $characters[rand(0, strlen($characters) - 1)];
                }
                return $otp;
            }

            if(isset($_POST['otp'])){

                $otp = $_POST['verify'];
            
                if($otp == $_SESSION['otp']){
                    $_SESSION['admin'] = true;
                    $_SESSION['otp'] = "";
                    header('Location: ../controller/manage.php');
                }else{
                   echo "<p style='text-align: center;' id='error'>Invalid OTP.</p>";
                   echo "<script>document.getElementById('email').remove();</script>";
                   echo "<script>document.getElementById('login').remove();</script>";
                   echo "<input type='text' name='verify' id='verify' placeholder='OTP'>";
                   echo "<button type='submit' name='otp' value='otp' id='otp'>
                   <div class='loader'></div>
                   <label id='text' for='otp'>Confirm OTP</label>
               </button> ";
                }
            }

            ?>


        </form>
    </div>

    <script>
        const form = document.getElementById('form');
        let email = document.getElementById('email')
        form.onsubmit = () => {
            document.querySelector('#text').style.display = "none";
            document.querySelector('.loader').style.display = "block";
        }
    </script>
</body>

</html>