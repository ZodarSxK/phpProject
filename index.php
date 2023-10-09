<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include("./DB/connect.php");


$sql = "SELECT * FROM category";
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
  <?php
  echo $_SESSION['error'];
  unset($_SESSION['error']);
  ?>
  <?php if (isset($_SESSION['success'])) { ?>
    <?php
    echo $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
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
  <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
  <?php
  echo $_SESSION['A'];
  unset($_SESSION['A']);
  ?>
  <div class="container-fluid border-top" style="padding-left: 5rem;">
    <div class="row">
      <?php if ($qureypro->rowCount() > 0) {
        $i = 0;
        foreach ($product as $row) {

          $cid = $row['Cid'];
          $qur = $conn->prepare("SELECT COUNT(cid) count FROM products WHERE cid=$cid and status =''");
          $qur->execute();

          $res = $qur->fetch(PDO::FETCH_ASSOC);
          if ($res['count'] > 0) {
      ?>
            <div class="card m-2 p-2" style="width: 14rem; "><a href="showproduct.php?Cid=<?= $row['Cid'] ?>" style="text-decoration: none;color:black;">

                <?= $row['Cid'] ?>
                <img style=" height:13rem; padding-top: 5px;" src="./assets/imgs/<?= $row['img'] ?>" class="card-img-top" alt="...">
                <div class="card-body d-inline-block py-1 px-2 mt-1 mb-2">
                  <h5><?= $row['name'] ?></h5>
                  <p>ราคา <?= $row['cost'] ?> บาท</p>
                </div>
                <div>
                  <form action="./cart.php?Cid=<?= $row['Cid'] ?>&quantity=1" method="post" class="card-body border-top pt-1 d-flex justify-content-between align-items-center">
                    <input type="hidden" value="<?= $row['cost'] ?>" name="cost">
                    <input type="hidden" value="<?= $row['Cid'] ?>" name="idinfo">
                    <button type="submit" class="btn btn-link" name="addcart" class=" pt-1"><ion-icon name="cart-outline" style="font-size: 1.6rem;"></ion-icon></button>
                    <button type="submit" name="buy" class="btn btn-success">ซื้อ</button>
                  </form>
                </div>
              </a>
            </div>
      <?php
          }
          if ($i == 5) {
            exit();
          }
          $i++;
        }
      } ?>
    </div>
  </div>
</body>

</body>

</html>