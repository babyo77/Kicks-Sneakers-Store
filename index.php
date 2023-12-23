<?php
session_start();
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
    <title>Kicks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="Assets/Images/favicon.webp" type="image/x-icon">
</head>

<body>
    <?php
    include 'includes/header.html'
    ?>
    <div class="hero">
        <div class="left">
            <div class="title">
                <h1>UNLEASH</h1>
                <h2>THE THUNDER</h2>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet, necessitatibus dicta eveniet illo aliquid dolores in? Iure obcaecati nemo provident, magnam architecto error doloribus itaque delectus officiis nostrum quae assumenda?</p>
            <button onclick="window.location.href='./pages/products.php'">Shop Now</button>
        </div>
        <div class="right">
            <img src="Assets/Images/hero banner.jpg" alt="shop-banner">
        </div>
    </div>
    <div class="banner1">
        <nav>
            <h1>POPULAR COLLECTION</h1>
            <div>
                <a href="">View All <img src="Assets/Images/right-arrow.png" alt=""></a>
            </div>
        </nav>
        <div class="popular-collection">
            <div class="shoe">
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/1.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10</h1>
                    </div>
                </div>
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/2.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10,495</h1>
                    </div>
                </div>
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/3.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10,495</h1>
                    </div>
                </div>
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/4.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10,495</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner2">
        <nav>
            <h1>FEATURED COLLECTION</h1>
        </nav>
        <div class="featured-collection">
            <div class="casuals">
                <button>Men's</button>
                <img src="Assets/Images/men.webp" alt="">
            </div>
            <div class="sports">
                <button>Shop</button>
                <img src="Assets/Images/shoex.webp" alt="">
            </div>
            <div class="sliders">
                <button>Women's</button>
                <img src="Assets/Images/women.webp" alt="">
            </div>
            <div class="sale">
                <button>Shop</button>
                <img src="Assets/Images/shoes.webp" alt="">
            </div>
        </div>
    </div>
    <div class="banner3">
        <nav>
            <h1 id="new-arrivals">NEW ARRIVALS</h1>
            <div>
                <a href="">View All <img src="Assets/Images/right-arrow.png" alt=""></a>
            </div>
        </nav>
        <div class="new-arrivals">
            <div class="shoe">
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/5.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10,495</h1>
                    </div>
                </div>
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/6.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10,495</h1>
                    </div>
                </div>
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/7.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10,495</h1>
                    </div>
                </div>
                <div class="shoe-details">
                    <div class="shoe-image">
                        <img src="Assets/Shoes Images/8.webp" alt="">
                    </div>
                    <div class="shoe-name">
                        <h3>Nike</h3>
                    </div>
                    <div class="shoe-desc">
                        <p>Air Zoom Pegasus 39</p>
                    </div>
                    <div class="shoe-price">
                        <h1>₹ 10,495</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'includes/footer.html'
    ?>
    <script src="script.js"></script>
   
</body>

</html>