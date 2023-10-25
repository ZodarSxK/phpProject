<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include("./DB/connect.php");

$id = $_SESSION['id'];
$cid = $_GET['Cid'];

$sql = "SELECT * FROM category WHERE Cid = $cid";
$query = $conn->prepare($sql);
$query->execute();

$rs = $query->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("nav.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showproduct</title>
</head>

<body>
    <div class="container d-flex px-4 px-lg-5 my-5">
        
            <div class="col-md-6 d-flex justify-content-end  pe-3">
                <img src="./assets/imgs/<?= $rs['img'] ?>" alt="" style="width: 13rem;">
            </div>
            <div class="col-md-6 pe-5">
                <h1 class="display-6 fw-bolder"><?= $rs['name'] ?></h1>
                <div class="fs-5 mb-5">
                    <span>ราคา <?= $rs['cost'] ?> บาท</span>
                </div>
                <p><?= $rs['descs'] ?></p>
                <form action="./cart.php?Cid=<?= $rs['Cid'] ?>&quantity=1" method="post" class="card-body border-top pt-1 d-flex justify-content-between align-items-center">
                    <input type="hidden" value="<?= $rs['cost'] ?>" name="cost">
                    <input type="hidden" value="<?= $rs['Cid'] ?>" name="idinfo">
                    <button type="submit" class="btn btn-link" name="addcart" class=" pt-1"><ion-icon name="cart-outline" style="font-size: 1.6rem;"></ion-icon></button>
                    <button type="submit" name="buy" class="btn btn-success">ซื้อ</button>
                </form>

            </div>
        
    </div>

</body>

</html>