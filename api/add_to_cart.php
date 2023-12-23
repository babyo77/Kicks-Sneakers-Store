<?php
session_start();
require_once '../includes/db.php';


$product_id = $_POST['product_id'];
$quantity = 1;

if (isset($_SESSION['user_info_id'])) {

    $user_info_id = $_SESSION['user_info_id'];
    $resulT = $con->query("SELECT * FROM cart WHERE user_id = $user_info_id AND product_id = $product_id");

    if ($resulT->num_rows > 0) {

        $con->query("UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $user_info_id AND product_id = $product_id");
    } else {

        $con->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_info_id, $product_id, $quantity)");
    }

    $result = $con->query("
        SELECT c.user_id, SUM(c.quantity * p.product_price) AS total_price
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = {$user_info_id}
        GROUP BY c.user_id");
      
    $countQuery = $con->query("SELECT COUNT(*) AS item_count FROM cart WHERE user_id = $user_info_id");

    if ($countQuery->num_rows>0) {
        $row = $countQuery->fetch_assoc();
        $itemCount = $row['item_count'];
    }else{
        $itemCount = "";
    }

    if ($result) {
       

        while ($row = $result->fetch_assoc()) {
            $totalPrice = number_format($row['total_price'], 2);
        }
        header('Content-Type: application/json');
        echo json_encode(['id' => $product_id, "total" => $totalPrice, "cart" => $itemCount]);
        die;
    }
} 

?>