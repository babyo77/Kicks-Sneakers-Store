<?php
include '../includes/db.php';

if(isset($_POST['id'])){
    $order_id = $_POST['id'];
   if($con->query("UPDATE `orders` SET `shipping_status`='Completed' WHERE order_id = $order_id")){
    echo $order_id;
   }else{
    echo $order_id;
   }
}else{
    echo "sex";
}

?>