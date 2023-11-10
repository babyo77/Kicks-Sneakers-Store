<?php
session_start();
$userEmail;
 $status=false;
 if(isset($_SESSION['status']) && isset($_SESSION['user-email']) && $_SESSION['status']==true){
    $userEmail = $_SESSION['user-email'];
    $status = $_SESSION['status'];
 }else{
    header('location: login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../Assets/Images/favicon.webp" type="image/x-icon">
    <?php
    echo '<link rel="stylesheet" href="../style.css">';
    echo ' <link rel="stylesheet" href="../stylesheets/dashboard.css">';
    ?>
</head>
<body>
    <?php
      include '../includes/header.html';
    ?>
   <div class="main">
    <?php
    echo "<h1>Hi $userEmail </h1>";
    ?>
    <div class="main2">
      <a href="" class="edit-profile">
        <img src="../Assets/Images/dashboardprofile.png" alt="profile">
        <div>
          <h1>Profile</h1>
          <p>Edit Profile</p>
        </div>
      </a>
      <a href="" class="your-orders">
        <img src="../Assets/Images/return.png" alt="profile">
        <div>
          <h1>Orders</h1>
          <p>Your Orders</p>
        </div>
      </a>
      <a href="" class="address">
        <img src="../Assets/Images/address.png" alt="profile">
        <div>
          <h1>Address</h1>
          <p>Edit Address</p>
        </div>
      </a>
      <a href="" class="log-out">
        <img src="../Assets/Images/logout.png" alt="profile">
        <div>
          <h1>Logout</h1>
          <p>Logout</p>
        </div>
      </a>
    </div>
    </div>
    <?php
      include '../includes/footer.html';
    ?>
    <script>
const logout = document.querySelector("#logout");
const cancel = document.querySelector("#Cancel");
const alerts = document.querySelector(".alert");
const Account = document.querySelector("#Account");
const menu = document.querySelector("#user-menu");
const main = document.querySelector(".main");

cancel.onclick=()=>{
    alerts.style.display="none"
}

logout.onclick=()=>{
        fetch('../api/logout.php')
          .then(response => {
            if (response.status === 200) {
              alerts.style.display = 'none';
              location.reload()
            } else {
              alert('Logout failed');
            }
          })
          .catch(error => {
            console.error('Error during logout:', error);
          });
      }

Account.onclick=()=>{
alerts.style.display='flex'
menu.checked=false
}

alerts.onclick=()=>{
  alerts.style.display="none"
}

main.addEventListener('mouseover',()=>{
    menu.checked = false;
})
    </script>
</body>
</html>