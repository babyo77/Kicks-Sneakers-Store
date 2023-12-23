<?php
session_start();
include '../includes/db.php';
if(isset($_SESSION['user_info_id'])){
    $user_info_id = intval($_SESSION['user_info_id']);
  }
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
    <title>Checkout</title>
    <link rel="stylesheet" href="../style.css">
    
</head>
<style>

body{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100dvh;
}

    button{
        background-color: #f50;
        color: white;
        padding: .3rem 1rem;
        border: none;
        cursor: pointer;
    }
</style>
<body>
<main>

    <?php if($status){
        
        
        $result = $con->query("
        SELECT c.user_id, SUM(c.quantity * p.product_price) AS total_price
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = {$user_info_id}
        GROUP BY c.user_id
        ");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $totalPrice = number_format($row['total_price'], 2); // Format with two decimal places and commas
        
        echo "<button class='pay'><h1>Place Order ₹ ".number_format($row['total_price'], 2)."</h1></button>";
    }
} else {
    echo "Error executing query: " . $con->error;
}

}
?>

<?php
    if($status){
        
        $result = $con->query("SELECT cart.*, products.product_name, products.path, products.product_desc ,products.product_price FROM cart 
JOIN products ON cart.product_id = products.product_id 
WHERE cart.user_id = {$user_info_id}");

if($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      
        echo "  <div class='cart-item' data-cart-id='{$row['cart_id']}'>
        
        <div class='shoe-image'>
        <img src='../Assets/Shoes Images/{$row['path']}'>
        </div>
        <div class='cart-item-details'>
        
        <div class='shoe-name'>
        <h3>{$row['product_name']}</h3>
        </div>
        <div class='shoe-desc'>
        <p>{$row['product_desc']}</p>
        </div>
        <div class='shoe-price'>
        <h1>₹ ".number_format($row['product_price'], 2)."</h1>
        <input type='number' id='quantity' value='{$row['quantity']}' min='1' readonly>
       
        </div>
        </div>
        
        </div>";
    }
}else{
    echo "<h2>Cart is Empty</h2>";
    
} }

?>

</main>
<script>

   let pay =  document.querySelector('.pay')
pay.onclick=()=>{
    window.location.href = "payment.php"
}
</script>
</body>
</html>