<?php
session_start();
include '../includes/db.php';

if (isset($_SESSION['user_info_id'])) {
    $user_info_id = intval($_SESSION['user_info_id']);
} else {
    header('Location: login.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2, h3 {
            color: #333;
        }

        p {
            margin: 5px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 5px 0;
        }

        .confirm-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirm-btn:hover {
            background-color: #45a049;
        }
       

        .container {
            text-align: center;
        }

        .goback-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-decoration: none;
            text-transform: capitalize;
            background-color: rgba(0, 0, 0, 0.566);
            backdrop-filter: blur(10px);
            color: white;
            cursor: pointer;
            border: none;
            border-radius: 3rem;
            font-size: 1rem;
            padding: .4rem 1.3rem;
            transition: all .3s ease-in-out;
        }

        .goback-btn:hover {
          
            background-color: #f50;
        }
      
    </style>
</head>
<body>
   
</body>
</html>


<?php
$order_items_result = $con->query("SELECT o.*, oi.product_id, oi.quantity, p.product_name
                                    FROM `orders` o
                                    JOIN `order_items` oi ON o.order_id = oi.order_id
                                    JOIN `products` p ON oi.product_id = p.product_id
                                    WHERE o.user_id = $user_info_id");

if ($order_items_result->num_rows > 0) {
    $current_user_id = null;

    while ($order_item_row = $order_items_result->fetch_assoc()) {
        $order_id = $order_item_row['order_id'];
        $user_id = $order_item_row['user_id'];
        $total_amount = $order_item_row['total_amount'];
        $payment_method = $order_item_row['payment_method'];
        $shipping_address = $order_item_row['shipping_address'];
        $shipping_status = $order_item_row['shipping_status'];
        $product_id = $order_item_row['product_id'];
        $quantity = $order_item_row['quantity'];
        $product_name = $order_item_row['product_name'];

       

       
        echo "<h3>Order ID: $order_id</h3>";
        echo "<p>Total Amount: $total_amount</p>";
        echo "<p>Payment Method: $payment_method</p>";
        echo "<p>Shipping Address: $shipping_address</p>";
        echo "<p>Shipping Status: $shipping_status</p>";

        
        echo "<ul>";
        echo "<li>Product: $product_name, Quantity: $quantity</li>";
        echo "</ul>";
    }
} else {
   echo "<div class='container'>
    <p>No orders found.</p>
    <a href='dashboard.php' class='goback-btn'>Go Back</a>
</div>";
    echo $con->error;
}
?>
