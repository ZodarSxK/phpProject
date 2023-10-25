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
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./assets/css/styles.css" rel="stylesheet" />
    <!-- IONICONS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=https://code.jquery.com/jquery-3.7.0.js></script>
</head>

<body>
    <!-- <div class="container d-flex px-4 px-lg-5 my-5">

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


    </div> -->

    <div class="container-fluid d-flex justify-content-center mt-5">
        <div class="card mb-3" style="max-width: 700px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="./assets/imgs/<?= $rs['img'] ?>" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title"><?= $rs['name'] ?></h3>
                        <p class="card-text"><?= $rs['descs'] ?></p>
                        <h5>ราคา <?= $rs['cost'] ?> บาท</้>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <form action="./cart.php?Cid=<?= $rs['Cid'] ?>&quantity=1" method="post" class="d-flex justify-content-between align-items-center">
                        <input type="hidden" value="<?= $rs['cost'] ?>" name="cost">
                        <input type="hidden" value="<?= $rs['Cid'] ?>" name="idinfo">
                        <button type="submit" class="btn btn-link" name="addcart2" class=" pt-1"><ion-icon name="cart-outline" style="font-size: 1.6rem;"></ion-icon></button>
                        <button type="submit" name="buy" class="btn btn-success">ซื้อ</button>
                    </form>
                </div>
                <div class="card-footer text-muted d-flex">
                    <?php
                    $Mid = $rs['Mid'];
                    $info = $conn->prepare("SELECT * FROM `members` INNER JOIN licence ON members.Mid = licence.Mid WHERE members.Mid=$Mid;");
                    $info->execute();

                    $resinfo = $info->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="col-md-2">
                        <img src="./assets/imgs/<?= $resinfo['profile'] ?>" class="img-fluid rounded" style="width: 100px; max-height: 100px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">ร้าน <?= $resinfo['name'] ?></h5>
                            <?php
                            if($resinfo['status'] == 'สำเร็จ'){
                            ?>
                            <span class="text-success">ได้รับการยืนยันผู้ขายแล้ว <ion-icon name="medal-sharp"></ion-icon></span>
                            <?php
                            }else{
                            ?>
                            <span class="text-warning">ยังไม่ได้รับการยืนยันผู้ขาย</span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./assets/js/scripts.js"></script>
</body>

</html>