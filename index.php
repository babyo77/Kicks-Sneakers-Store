<?php
 session_start();
 $userEmail;
 $status=false;
 if(isset($_SESSION['status']) && isset($_SESSION['user-email']) && $_SESSION['status']==true){
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
    <div class="alert">
       <div>
        <button id="logout">Logout</button>
        <button id="Cancel">Cancel</button>
       </div>
    </div>
    <header>
      <div>
        <a href="index.php" class="logo">
        </a>
        <nav>
          <ul>
            <a href="#new-arrivals">New Arrivals</a>
            <a href="">Men</a>
            <a href="">Women</a>
          </ul>
        </nav>
        <nav>
            <div class="search"></div>
            <div class="bag"></div>
            <label for="user-menu" class="user"></label>
        </nav>
      </div>
      <input type="checkbox" hidden name="user-menu" id="user-menu">
        <div class="menu">
            <div id="sign-in">
                <?php
                if($status==false){
                echo '<p id="p4"><a id="p3" href="pages/login.php">Sign in</a> To Contine</p>';
                }
                else{
                    echo "<p id='p1'>Welcome $userEmail</p>";
                }
                ?>
                <h3>My Profile</h3>
                <div>
                    <p><svg enable-background="new 0 0 50 50" height="1rem" width="1.3rem"  id="Layer_1" version="1.1" viewBox="0 0 50 50" width="50px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><rect fill="none" height="50" width="50"/><path d="M49,27.954v-6l-7.141-1.167  c-0.423-1.691-1.087-3.281-1.962-4.737l4.162-5.932l-4.243-4.241l-5.856,4.21c-1.46-0.884-3.06-1.558-4.763-1.982l-1.245-7.106h-6  l-1.156,7.083c-1.704,0.418-3.313,1.083-4.777,1.963L10.18,5.873l-4.243,4.241l4.107,5.874c-0.888,1.47-1.563,3.077-1.992,4.792  L1,21.954v6l7.044,1.249c0.425,1.711,1.101,3.318,1.992,4.79l-4.163,5.823l4.241,4.245l5.881-4.119  c1.468,0.882,3.073,1.552,4.777,1.973l1.18,7.087h6l1.261-7.105c1.695-0.43,3.297-1.105,4.751-1.99l5.922,4.155l4.242-4.245  l-4.227-5.87c0.875-1.456,1.539-3.048,1.958-4.739L49,27.954z M25,33c-4.418,0-8-3.582-8-8s3.582-8,8-8s8,3.582,8,8S29.418,33,25,33  z" fill="none" stroke="#000000" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1"/></svg><a href="api/check.php">Account</a></p>
                    <p><svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"  height="1.3rem" width="1.3rem" ><g id="a"/><g id="b"><path d="M55.873,21.7808c-.5488-.4834-1.1465-.897-1.7744-1.228-1.3103-.6929-2.8191-.6383-4.0703,.015v-2.4266c0-.1636-.0801-.3164-.2139-.4102-.045-.0311-.0979-.0422-.1492-.0571l.0037-.0127-21-6.1411c-.0918-.0264-.1895-.0264-.2812,0L7.3877,17.6611l.0038,.0129c-.0514,.0149-.1044,.026-.1493,.0569-.1338,.0938-.2139,.2466-.2139,.4102v25.043c0,1.0322,.6484,1.9717,1.6143,2.3384l19.709,7.4673c.0566,.0215,.1172,.0322,.1768,.0322s.1201-.0107,.1768-.0322l4.7718-1.8079c.1243,.5645,.2361,.9236,.2516,.972,.0674,.2075,.2598,.3462,.4756,.3462l.0322-.001c.1895-.0122,4.665-.3325,7.7754-3.0176l-.01-.0116c.0338-.0291,.0732-.0506,.0989-.089l1.3146-1.9651,4.9998-1.8938c.9648-.3662,1.6133-1.3057,1.6133-2.3379v-5.6538l6.6016-9.8682c1.252-1.8716,.9268-4.3999-.7568-5.8813ZM28.5283,12.521l19.4025,5.674-8.9662,3.2903-17.9672-6.762,7.5309-2.2023Zm0,12.7939l-19.4025-7.1199,10.2748-3.0048,18.1273,6.8222-8.9996,3.3025ZM8.0283,43.1841V18.8574l20,7.3391v25.6014l-19.0312-7.2104c-.5801-.2197-.9688-.7837-.9688-1.4033Zm21,8.6138V26.1965l20-7.3391v2.4217c-.2537,.2375-.4925,.496-.6943,.7975l-14.5459,21.7441c-.0239,.0358-.0175,.079-.0311,.1183l-.0236-.0084c-.8105,2.2712-.6904,4.6404-.4419,6.252l-4.2632,1.6152Zm5.4162-6.7241c1.8631,1.9025,3.9426,3.3076,6.2037,4.1861-2.2558,1.5803-5.05,2.0708-6.0759,2.1992-.2536-.9896-.8016-3.7194-.1277-6.3853Zm7.0369,3.4341c-2.4697-.8613-4.6494-2.3242-6.6436-4.4575l12.3685-18.4886c2.8398,.3173,5.0165,1.7821,6.6361,4.4679l-12.361,18.4783Zm7.5469-5.3237c0,.6196-.3896,1.1836-.9678,1.4028l-3.6871,1.3965,4.6549-6.9583v4.159Zm6.7695-16.0776l-1.3502,2.0183c-1.6509-2.5337-3.8733-4.0389-6.625-4.4844l1.3433-2.008c.9844-1.4727,2.9473-2.0005,4.4658-1.1953,.5586,.2944,1.0908,.6631,1.5811,1.0947,1.3076,1.1514,1.5596,3.1182,.585,4.5747Z"/></g></svg><a href="">Orders</a></p>
                    <?php
                    if($status==true){
                    echo '<p><svg height="1rem" width="1.3rem" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M173 873.3c-11 0-20-9-20-20V173.9c0-11 9-20 20-20h320.7c11 0 20-9 20-20v-15c0-11-9-20-20-20H153h-35c-11 0-20 9-20 20v809.3h395.7c11 0 20-9 20-20v-15c0-11-9-20-20-20H173z" fill="grey" /><path d="M609.3 273.3c-7.8-7.8-7.8-20.5 0-28.3l10.6-10.6c7.8-7.8 20.5-7.8 28.3 0l264.9 264.9c7.8 7.8 7.8 20.5 0 28.3L648.4 792.8c-7.8 7.8-20.5 7.8-28.3 0l-10.6-10.6c-7.8-7.8-7.8-20.5 0-28.3l199-199c7.8-7.8 5.1-14.1-5.9-14.1H326.1c-11 0-20-9-20-20v-15c0-11 9-20 20-20h475.7c11 0 13.6-6.4 5.9-14.1L609.3 273.3z" fill="grey" /></svg><a id="Account">Log out</a></p>';
                    }
                     ?>
                    </div>
            </div>
        </div>
    </header>
  <div class="hero">
    <div class="left">
    <div class="title">
        <h1>UNLEASH</h1>
        <h2>THE THUNDER</h2>
    </div>
     <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet, necessitatibus dicta eveniet illo aliquid dolores in? Iure obcaecati nemo provident, magnam architecto error doloribus itaque delectus officiis nostrum quae assumenda?</p>
    <button>Shop Now</button>
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
                    <h1>$10</h1>
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
                <h1>$10,495</h1>
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
            <h1>$10,495</h1>
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
        <h1>$10,495</h1>
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
                    <h1>$10,495</h1>
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
                <h1>$10,495</h1>
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
            <h1>$10,495</h1>
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
        <h1>$10,495</h1>
    </div>
</div>
       </div>
    </div>
  </div>
<footer>
    <a href="index.php" class="logo">
    </a>
    <div class="footer-content">
        <div class="About">
            <ul><span>KICKS</span>
                <a href="">About Us</a>
                <a href="">Blog</a>
                <a href="">Career</a>
            </ul>
        </div>

        <div class="Need-help">
            <ul><span>NEED HELP?</span>
                <a href="api/check.php">My Account</a>
                <a href="">Size Chart</a>
                <a href="">Conatct Us</a>
            </ul>
        </div>

        <div class="Folow-us-on">
            <ul><span>FOLLOW US ON</span>
                <a href="">Instagram</a>
                <a href="">Facebook</a>
                <a href="">Twitter</a>
            </ul>
        </div>
        <div class="newsletter">
            <ul><span>JOIN US NOW!</span>
                <p>Lorem ipsum dolor,Inventore nihil facilis <br>assumenda recusandae commodi.</p>
               <form action="">
                <input type="text" placeholder="Enter your email address">
                <button type="submit">SUBSCRIBE</button>
               </form>
            </ul>
        </div>
    </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>