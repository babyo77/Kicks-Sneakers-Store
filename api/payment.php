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
    <title>payment</title>
   
    <link rel="stylesheet" href="../stylesheets/addProduct.css">
    
</head>


<body>



<?php
$order = $con->query("SELECT * FROM `cart` WHERE user_id = $user_info_id");
if($order->num_rows>0){
$check_sql = "SELECT * FROM `user_addresses` WHERE `user_id` = '$user_info_id'";
$result = $con->query($check_sql);

$result2 = $con->query("
SELECT c.user_id, SUM(c.quantity * p.product_price) AS total_price
FROM cart c
JOIN products p ON c.product_id = p.product_id
WHERE c.user_id = {$user_info_id}
GROUP BY c.user_id
");

if ($result2) {
while ($row = $result2->fetch_assoc()) {
  $totalPrice = $row['total_price'];
}
} else {
    header('location: ../pages/order.php');
}

if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $shipping_address = $row['street_address'].$row['city'].$row['postal_code'].$row['country'];
        }

$user_id = $user_info_id ;
$total_amount = $totalPrice;
$payment_method = 'COD';
$shipping_status = 'Pending'; 

$existing_order_query = "SELECT * FROM `orders` WHERE `user_id` = '$user_id'";
$existing_order_result = $con->query($existing_order_query);

if ($existing_order_result->num_rows == 0 || $existing_order_result->num_rows >0) {
 
    $insert_sql = "INSERT INTO `orders` (`user_id`, `total_amount`, `payment_method`, `shipping_address`, `shipping_status`)
                   VALUES ('$user_id', '$total_amount', '$payment_method', '$shipping_address', '$shipping_status')";

if ($con->query($insert_sql) === TRUE) {
    $order_id = $con->insert_id;

    $move_to_order_items_sql = "INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`) 
                                SELECT '$order_id', `product_id`, `quantity` FROM `cart` WHERE `user_id` = $user_id";

    if ($con->query($move_to_order_items_sql) === TRUE) {

 
        $update_stock_sql = "UPDATE `products` p
                             INNER JOIN `cart` c ON p.`product_id` = c.`product_id`
                             SET p.`stock` = p.`stock` - c.`quantity`
                             WHERE c.`user_id` = $user_id AND p.`stock` >= c.`quantity`";

        $stock_update_result = $con->query($update_stock_sql);

        if ($stock_update_result !== FALSE) {

           
            if ($con->affected_rows > 0) {

        
                if ($con->query("DELETE FROM `cart` WHERE user_id = $user_id")) {
                    echo "<h2>Order Placed Successfully</h2>";
                } else {
                    echo $con->error;
                }

            } else {
                echo "<h2>Out of stock for some products in your cart</h2>";
               
            }

        } else {
            echo $con->error;
        }

    } else {
        echo $con->error;
    }

} else {
    echo $con->error;
}

$con->close();
  
}
} else {


    echo "<form method='post'>
        <div class='label'>
            <label for='title'>Full Name</label>
            <input type='text' id='name' name='name' required>
            <label for='desc'>Street Address</label>
            <input type='text' id='street' name='street' required>
            <label for='price'>City</label>
            <input type='text' id='city' name='city' required>
            <label for='stock'>Postal Code</label>
            <input type='text' id='code' name='code' required>
            <label for='stock'>Country</label>
            <input list='countries' id='country' name='country' required>
            <datalist id='countries'>
                <option value='India'>
                <option value='USA'>
                <!-- Add more countries as needed -->
            </datalist>
            <button type='submit' name='add'>Continue</button>
            <button onclick='window.history.back()' style='margin-top: -.5rem;'>Go Back</button>
        </div>
    </form>";

    
   
   
}
}else{
    header('location: ../pages/order.php'); 
}

?>


<?php

if(isset($_POST['add'])){

    

$user_id = $user_info_id;
$full_name = $_POST['name'];
$street_address = $_POST['street'];  
$city = $_POST['city'];
$postal_code = $_POST['code'];
$country = $_POST['country'];

$check_sql = "SELECT * FROM `user_addresses` WHERE `user_id` = '$user_id'";
$result = $con->query($check_sql);

if ($result->num_rows > 0) {
    
    $update_sql = "UPDATE `user_addresses`
                   SET `full_name`='$full_name', `street_address`='$street_address',
                       `city`='$city', `postal_code`='$postal_code', `country`='$country'
                   WHERE `user_id`='$user_id'";

    if ($con->query($update_sql) === TRUE) {
        
    } else {
        echo "Error updating record: " . $con->error;
    }
} else {
   
    $insert_sql = "INSERT INTO `user_addresses` (`user_id`, `full_name`, `street_address`, `city`, `postal_code`, `country`)
                   VALUES ('$user_id', '$full_name', '$street_address', '$city', '$postal_code', '$country')";

    if ($con->query($insert_sql) === TRUE) {
        header('location: ../api/payment.php');
    } else {
        echo "No user Found";
    }
}
$con->close();
}
?>
</body>
</html>