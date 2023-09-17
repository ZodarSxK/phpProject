<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include("./DB/connect.php");


$sql = "SELECT * FROM products ORDER BY pid ";
$qureypro = $conn->prepare($sql);
$qureypro->execute();

$product = $qureypro->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/style_index.css">
  <title>HOMEPAGE</title>
  <style>
    .carousel-item img {
      height: 500px;

    }
  </style>
</head>

<body>

  <?php include("nav.php"); ?>

  <?php if (isset($_SESSION['success'])) { ?>
    <?php
    echo $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
  <?php } ?>
  <?php if (isset($_SESSION['warning'])) { ?>
    <div class="alert alert-danger" role="alert">

      <?php
      echo $_SESSION['warning'];
      unset($_SESSION['warning']);
      ?>

    </div>
  <?php } ?>
  <div class="carousel">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./assets/imgs/top10.jpg" class="d-block w-100 " alt="...">
        </div>
        <div class="carousel-item">
          <img src="./assets/imgs/Gaming.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./assets/imgs/janD.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <div class="container" style="padding-left: 5rem;">
    <div class="row">
      <?php if ($qureypro->rowCount() > 0) {
        foreach ($product as $row) {

          $Cid = $row['Cid'];
          $sql = "SELECT * FROM category WHERE Cid = :Cid ";
          $qureypro = $conn->prepare($sql);
          $qureypro->bindParam(':Cid', $Cid);
          $qureypro->execute();

          $product = $qureypro->fetch(PDO::FETCH_ASSOC);
      ?>
          <div class="card m-2 p-2" style="width: 14rem; ">
            <?= $row['pid'] ?>
            <?= $row['Cid'] ?>
            <img style=" height:13rem; padding-top: 5px;" src="./assets/imgs/<?= $product['img'] ?>" class="card-img-top" alt="...">
            <div class="card-body d-inline-block py-1 px-2 mt-1 mb-2">
              <h5><?= $product['name'] ?></h5>
              <p>ราคา <?= $product['cost'] ?> บาท</p>
            </div>
            <div>
              <form action="./addcart.php" method="post" class="card-body border-top pt-1 d-flex justify-content-between align-items-center">
                <input type="hidden" value="<?= $row['pid'] ?>" name="pid">
                <input type="hidden" value="<?= $product['cost'] ?>" name="cost">
                <input type="hidden" value="<?= $row['Cid'] ?>" name="idinfo">
                <button type="submit" class="btn btn-link" name="addcart" class=" pt-1"><ion-icon name="cart-outline" style="font-size: 1.6rem;"></ion-icon></button>
                <button type="submit" name="buy" class="btn btn-success">ซื้อ</button>
              </form>
            </div>
          </div>
      <?php }
      } ?>
    </div>
  </div>

</body>

</html>