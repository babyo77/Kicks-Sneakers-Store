<?php

include '../includes/db.php';

$id = (int)$_POST['delete_id'];


$cartReferences = $con->query("SELECT * FROM cart WHERE product_id = $id");

if ($cartReferences->num_rows > 0) {
  
    $con->query("DELETE FROM cart WHERE product_id = $id");
}


$result = $con->query("DELETE FROM products WHERE product_id = $id");

if ($result) {
    echo 'ok';
} else {
    echo 'Error: ' . $con->error;
}
?>
