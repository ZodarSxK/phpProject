<?php
session_start();
include("./DB/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("installpackage.php");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_index.css">
    <title>HOMEPAGE</title>
</head>
<body>
<div><?php include("navbar.php");?></div>

<section class="banner">
    <div class="banner-info">
        <img src="imgs/logo.png" alt="">
        <h1>Gamer Shop</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis fugit dicta commodi totam enim velit voluptatem sint corrupti! Quaerat tenetur illo ratione doloribus ex a culpa fuga cumque, magnam illum?</p>
    </div>
</section>
<div class="container-item">
        <form action="">
            <input type="text"></input>
            <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
        </form>
        <div class="container-card">
            <div class="card">
            <img src="imgs/logo.png" alt="Avatar" style="width:100%">
            <div class="container">
                <h4><b>John Doe</b></h4> 
                <p>Architect & Engineer</p> 
            </div>
            </div>

        </div>
</div>
</body>
</html>