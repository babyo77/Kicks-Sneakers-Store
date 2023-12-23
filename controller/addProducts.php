<?php
session_start();
if(!isset($_SESSION['admin']) && $_SESSION['admin']!==true){
header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link rel="stylesheet" href="../stylesheets/addProduct.css">
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <img src="../Assets/Shoes Images/1.webp" alt="shoe" id="image">
        <div class="label">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
            <label for="desc">Description</label>
            <input type="text" id="desc" name="desc" required>
            <label for="price">Price</label>
            <input type="number" id="price" name="price" required>
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" required>
            <input type="file" name="file" id="shoe-image" accept=".jpg, .png, .jpeg, .webp" hidden>
            <button type="submit" name="add">Add Shoe</button>
            <button onclick="window.location.href='manage.php'" style="margin-top: -.5rem;">Go Back</button>
            <?php
            include_once '../includes/db.php';

            if (isset($_POST["add"])) {
                $title = $con->real_escape_string($_POST['title']);
                $desc = $con->real_escape_string($_POST['desc']);
                $price = $con->real_escape_string($_POST['price']);
                $stock = $con->real_escape_string($_POST['stock']);
                $targetDir = '../Assets/Shoes Images/';

                $filepath = $targetDir . basename($_FILES['file']['name']);

                $checkQuery = $con->query("SELECT * FROM `products` WHERE `product_name`='$title' AND `product_desc`='$desc' AND `product_price`='$price'");
                if (
                    !empty($title) && !empty($desc) && !empty($price) &&
                    $_FILES['file']['error'] == UPLOAD_ERR_OK &&
                    $checkQuery->num_rows == 0
                ) {
                    $result = $con->query("INSERT INTO `products`(`product_name`, `product_desc`, `product_price`, `path`,`stock`) VALUES ('$title','$desc','$price','" . basename($_FILES['file']['name']) . "','$stock')");
                    if ($result == true && move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
                        echo "<p id='success'>Shoe Successfully Added</p>";

                       
                    } else {
                        echo "<p id='error'>Error Adding Shoe</p>";
                       
                    }
                } else {
                    echo "<p id='error'>All field Required</p>";
                   
                }
            }

            ?>
        </div>
    </form>
    <script>
        let image = document.getElementById('image')
        let shoeImage = document.getElementById('shoe-image')
        image.addEventListener('click', () => {
            shoeImage.click()
            console.log('ok');
        })
        shoeImage.addEventListener('change', () => {
            if (shoeImage.files.length > 0) {
                const file = shoeImage.files[0]
                const reader = new FileReader()

                reader.onload = (e) => {
                    image.src = e.target.result
                }
                reader.readAsDataURL(file)
            }
        })
    </script>
</body>

</html>