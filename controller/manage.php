<?php

session_start();
if(!isset($_SESSION['admin']) && $_SESSION['admin']!==true){
header('location: ../index.php');
}

include '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../stylesheets/products.css">
</head>
<style>

.shoe-price a:hover {
  background-color: #f50;
}

.shoe-details{
    position: relative;
}
.shoe-price a {
  text-transform: capitalize;
  background-color: rgba(0, 0, 0, 0.566);
  backdrop-filter: blur(10px);
  color: white;
  cursor: pointer;
  border: none;
  border-radius: 3rem;
  text-decoration: none;
  margin-left: -.7rem;
  position: absolute;
  margin-bottom: 5rem;
  right: 4%;
  padding: .4rem 1.07rem;
  transition: all .3s ease-in-out;
}
</style>
<body>
    <header style="display: flex;">
        <div style="margin: 1rem;">
            <a href="../api/adminLogout.php">Logout</a>
        </div>
        <div style="margin: 1rem;">
            <a href="../controller/addProducts.php">Add Products</a>
        </div>
        <div style="margin: 1rem;">
            <a href="../controller/orders.php">View Orders</a>
        </div>
            </header>
<div class="products">
        <nav>
            <h1>All Products</h1>
        </nav>
        <div class="popular-collection">
            <div class="shoe">
                <?php
              
                 $result = $con->query("SELECT * FROM `products`");
                 if($result->num_rows>0){
                      while($row = $result->fetch_assoc()){
        
                    
                        echo "<div class='shoe-details' id='{$row['product_id']}' data-product-id={$row['product_id']}>
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
    
                            <button onclick='deleteItem({$row['product_id']})'>Delete</button>
                        
                            <a href='update.php?product_id={$row['product_id']}'>update</a>
                        </div>
    
                    </div>";
                      
                    }
                 }

                ?>

               
            </div>
        </div>
    </div>
</body>
<script>

function deleteItem(id){

    fetch("../api/delete.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/x-www-form-urlencoded",
              },
              body: "delete_id=" + encodeURIComponent(id),
            })
              .then((response) => {
                if (!response.ok) {
                  throw new Error("Network response was not ok");
                }
                return response.text()
              })
              .then((data) => {
                console.log(data);
               if(data == "ok"){
                document.getElementById(id).remove()
               }
              })
              .catch(err=>{
                console.log(err);
              })
            

            }
</script>
</html>