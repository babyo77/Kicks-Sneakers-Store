<?php

require_once '../includes/db.php';


if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    
    $result = $con->query("SELECT * FROM products WHERE product_id = $product_id");

    if ($result) {
       
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

           
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            
            http_response_code(404);
            echo json_encode(['error' => 'Product not found']);
        }
    } else {
        
        http_response_code(500);
        echo json_encode(['error' => $con->error]);
    }
} else {
    
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}

$con->close();
?>

