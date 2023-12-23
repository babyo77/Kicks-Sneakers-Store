<?php
session_start();
$_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
$userEmail;
 $status=false;
 if(isset($_SESSION['status']) && isset($_SESSION['user-email']) && $_SESSION['status']==true){
    $userEmail = $_SESSION['user-email'];
    $status = $_SESSION['status'];
 }else{
    header('Location: login.php');
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
<div class="edit-profile-details">
  <header id="close-profile-details"><svg style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="grid_system"/><g id="_icons"><path d="M5.3,18.7C5.5,18.9,5.7,19,6,19s0.5-0.1,0.7-0.3l5.3-5.3l5.3,5.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3   c0.4-0.4,0.4-1,0-1.4L13.4,12l5.3-5.3c0.4-0.4,0.4-1,0-1.4s-1-0.4-1.4,0L12,10.6L6.7,5.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4   l5.3,5.3l-5.3,5.3C4.9,17.7,4.9,18.3,5.3,18.7z"/></g></svg></header>
   
<?php 
include '../includes/db.php';

$result = $con->query("SELECT * FROM `user` WHERE id={$_SESSION['user_info_id']}");
if($result->num_rows>0){
  while($row = $result->fetch_assoc()){
    echo "<div class='user-details'>
     <h1 style='text-transform:capitalize;'>Name: {$row['username']}</h1>
     <h1>Email: {$row['email']}</h1>
    </div>";
  }
}
?>
</div>
<div class="edit-address-details">
  <header id="close-address-details"><svg style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="grid_system"/><g id="_icons"><path d="M5.3,18.7C5.5,18.9,5.7,19,6,19s0.5-0.1,0.7-0.3l5.3-5.3l5.3,5.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3   c0.4-0.4,0.4-1,0-1.4L13.4,12l5.3-5.3c0.4-0.4,0.4-1,0-1.4s-1-0.4-1.4,0L12,10.6L6.7,5.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4   l5.3,5.3l-5.3,5.3C4.9,17.7,4.9,18.3,5.3,18.7z"/></g></svg></header>
</div>
    <?php
      include '../includes/dashboard-header.html';
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
      <a href="../pages/order.php" class="your-orders">
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
      include '../includes/dashboard-footer.html';
    ?>
    <script src="../scripts/dashboard.js"></script>
</body>
</html>

