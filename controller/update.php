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
    <title>Update Product</title>
    <link rel="stylesheet" href="../stylesheets/addProduct.css">
    <style>
         a:hover {
            background-color: #f50;
        }

        a:hover {
            background-color: #f50;
        }

        a {
             text-align: center;
             text-decoration: none;
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
    <?php
    if(isset($_GET['product_id'])){

   $product_id = $_GET['product_id'];
   $checkQuery = $con->query("SELECT * FROM `products` WHERE `product_id`='$product_id'");

   if ($checkQuery->num_rows > 0) {
       $row = $checkQuery->fetch_assoc();

       $title = $row['product_name'];
       $desc = $row['product_desc'];
       $price = $row['product_price'];
       $stock = $row['stock'];
    echo "<form method='post' enctype='multipart/form-data'>
        <img src='../Assets/Shoes Images/{$row['path']}' alt='shoe' id='image'>
        <div class='label'>
            <label for='title'>Title</label>
            <input type='text' id='title' name='title' value='".htmlspecialchars($title, ENT_QUOTES)."' required>
            <label for='desc'>Description</label>
            <input type='text' id='desc' name='desc' value='".htmlspecialchars($desc, ENT_QUOTES)."' required>
            <label for='price'>Price</label>
            <input type='number' id='price' value='$price' name='price' required>
            <label for='stock'>Stock</label>
            <input type='number' id='stock' value='$stock' name='stock' required>
            <input type='file' name='file' id='shoe-image' accept='.jpg, .png, .jpeg, .webp' hidden>
            <button type='submit' name='update'>Update Shoe</button>
            <a href='manage.php' style='margin-top: -.5rem;'>Go Back</a>
            </div>
            ";
    }
}
            ?>
<?php
include_once '../includes/db.php';

if(isset($_POST['update'])){
$checkQuery = $con->query("SELECT * FROM `products` WHERE `product_id`='$product_id'");

if ($checkQuery->num_rows > 0) {
    $row = $checkQuery->fetch_assoc();

    $title = $con->real_escape_string($_POST['title']);
    $desc = $con->real_escape_string($_POST['desc']);
    $price = $con->real_escape_string($_POST['price']);
    $stock = $con->real_escape_string($_POST['stock']);

    if ($_FILES['file']['size'] > 0) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];

    
        $upload_dir = '../Assets/Shoes Images/';
        $file_path = $upload_dir . $file_name;

        move_uploaded_file($file_tmp, $file_path);

     
        $image_path = $file_path;
        $image_base_name = basename($file_path);

    } else {
      
        $image_base_name = $row['path'];
    }

    $result = $con->query("UPDATE `products` SET `product_name`='$title',`product_desc`='$desc',`product_price`='$price',`path`='$image_base_name',`stock`='$stock' WHERE `product_id`='$product_id'");

    if ($result) {
        echo "<script>alert('Shoe Successfully Updated');</script>";
        header('location: manage.php');
      
    } else {
        echo "<p id='error'>Error Updating Shoe</p>";
    }
} else {
    echo "<p id='error'>Product does not exist or all fields required</p>";
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