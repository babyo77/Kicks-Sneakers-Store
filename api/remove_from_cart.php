<?php
session_start();
require_once '../includes/db.php';


$product_id = $_POST['product_id'];

if (isset($_SESSION['user_info_id'])) {

    $user_info_id = $_SESSION['user_info_id'];

    $con->query("DELETE  FROM cart WHERE user_id = $user_info_id AND product_id = $product_id");

    $countQuery = $con->query("SELECT COUNT(*) AS item_count FROM cart WHERE user_id = $user_info_id");

    if ($countQuery->num_rows>0) {
        $row = $countQuery->fetch_assoc();
        $itemCount = $row['item_count'];
    }else{
        $itemCount = "";
    }
    $result = $con->query("
        SELECT c.user_id, SUM(c.quantity * p.product_price) AS total_price
        FROM cart c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = {$user_info_id}
        GROUP BY c.user_id");

    if ($result) {

        if($result->num_rows>0){

            while ($row = $result->fetch_assoc()) {
                $totalPrice = number_format($row['total_price'], 2);
            }
        }else{
                $totalPrice = 0.00;
        }

        header('Content-Type: application/json');
        echo json_encode(['id' => $product_id, "total" => $totalPrice, "cart" => $itemCount]);
        die;
    }
}
?>