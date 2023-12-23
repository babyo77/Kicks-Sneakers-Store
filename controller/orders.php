<?php

session_start();
if (!isset($_SESSION['admin']) && $_SESSION['admin'] !== true) {
    header('location: ../index.php');
}

include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2,
        h3 {
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

        a {
            text-decoration: none;
            background-color: black;
            color: white;
            padding: .3rem 1rem;
            border-radius: 1rem;

        }

        .go-back {
            margin-top: 1.3rem;
            margin-bottom: 1.3rem;
        }

        .orders {
            margin-bottom: 1.3rem;
            padding: .7rem;
            border-radius: .7rem;
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        }

        .pending {
            color: yellow;
        }
        .Completed {
            color: green;
        }

        button:hover {
            background-color: #f50;
        }

      

        button {
            margin-top: .3rem;
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
    </style>
</head>

<body>
    <div class="go-back">

        <a href="../controller/manage.php">Go Back</a>
    </div>
  
<main>

    <?php


$order_items_result = $con->query("SELECT o.*, u.username, u.email, oi.product_id, oi.quantity, p.product_name
                                    FROM `orders` o
                                    JOIN `order_items` oi ON o.order_id = oi.order_id
                                    JOIN `products` p ON oi.product_id = p.product_id
                                    JOIN `user` u ON o.user_id = u.id");

if ($order_items_result->num_rows > 0) {
    $current_user_id = null;
    
    while ($order_item_row = $order_items_result->fetch_assoc()) {
        $order_id = $order_item_row['order_id'];
        $user_id = $order_item_row['user_id'];
        $user_email = $order_item_row['email'];
        $user_username = $order_item_row['username'];
        $total_amount = "₹ ".$order_item_row['total_amount'];
        $payment_method = $order_item_row['payment_method'];
                $shipping_address = $order_item_row['shipping_address'];
                $shipping_status = $order_item_row['shipping_status'];
                $product_id = $order_item_row['product_id'];
                $quantity = $order_item_row['quantity'];
                $product_name = $order_item_row['product_name'];
                
                
                echo "<div class='orders'>";
                echo "<h2>User ID: $user_id</h2>";
                echo "<p>Email: $user_email</p>";
                echo "<p>Username: $user_username</p>";
                
                
                
                echo "<h3>Order ID: $order_id</h3>";
                echo "<p>Total Amount: $total_amount</p>";
                echo "<p>Payment Method: $payment_method</p>";
                echo "<p>Shipping Address: $shipping_address</p>";
                echo "<p>Shipping Status:<span class='$shipping_status' id='$order_id'> $shipping_status</span></p>";
                
                // Display product details
                echo "<ul>";
                echo "<li>Product: $product_name, Quantity: $quantity</li>";
                echo "</ul>";
                if($shipping_status == 'Completed'){
                    echo "<button style='Background-color:green;' >Completed</button>";
                }else{
                    echo "<button onclick='Update($order_id)' >Update Status</button>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No orders found.</p>";
            echo $con->error;
        }
        
        ?>
    
</main>
<script>



function Update(id){
    fetch('status.php',{
        method: 'post',
        headers:{
            'content-type': 'application/x-www-form-urlencoded',
        },
        body: "id=" + encodeURIComponent(id),
    }).then(response=>{
       if(!response.ok){
        console.log('Network Error');
       }
        return response.text()       
    }).then(data=>{
        document.getElementById(id).style.color = "green"
        document.getElementById(id).textContent = " Completed";
    }).catch(error=>{
        console.log(error);
    })
}


</script>
    
</body>

</html>