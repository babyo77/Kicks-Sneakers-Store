<?php
session_start();
$_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
$userEmail;
$status = false;
if (isset($_SESSION['status']) && isset($_SESSION['user-email']) && $_SESSION['status'] == true) {
    $userEmail = $_SESSION['user-email'];
    $status = $_SESSION['status'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../stylesheets/products.css">
    
</head>

<body>
    <?php
    include '../includes/dashboard-header.html';
    ?>
    <div class="products">
        <nav>
            <h1>All Products</h1>
        </nav>
        <div class="popular-collection">
            <div class="shoe">
                <?php
                 include '../includes/db.php';
                 $result = $con->query("SELECT * FROM `products`");
                 if($result->num_rows>0){
                      while($row = $result->fetch_assoc()){
                        if($row['stock']==0){
                            echo "<div class='shoe-details' data-product-id={$row['product_id']}>
                        <div class='shoe-image'>
                            <img src='../Assets/Shoes Images/{$row['path']}' alt=''>
                        </div>
                        <div class='shoe-name'>
                            <h3>{$row['product_name']}</h3>
                        </div>
                        <div class='shoe-desc'>
                            <p>{$row['product_desc']}</p>
                        </div>
                        <div class='shoe-price'>
                            <h1>₹ ".number_format($row['product_price'], 2)."</h1>
                            <button style='background-color:#f50;' >Out of Stock</button>
                        </div>
    
                    </div>";
                        }else{
                        echo "<div class='shoe-details' data-product-id={$row['product_id']}>
                        <div class='shoe-image'>
                            <img src='../Assets/Shoes Images/{$row['path']}' alt=''>
                        </div>
                        <div class='shoe-name'>
                            <h3>{$row['product_name']}</h3>
                        </div>
                        <div class='shoe-desc'>
                            <p>{$row['product_desc']}</p>
                        </div>
                        <div class='shoe-price'>
                            <h1>₹ ".number_format($row['product_price'], 2)."</h1>
                            <button class='add-to-cart-btn'>Add to cart</button>
                        </div>
    
                    </div>";
                      }
                    }
                 }

                ?>
                

            </div>
        </div>
    </div>
    <div class="popup">
       <h1>Added to Cart</h1>
    </div>
    <?php
    include '../includes/dashboard-footer.html';
    ?>
    <script src="../scripts/product.js"></script>
    
</body>

</html>