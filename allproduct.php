<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include("./DB/connect.php");

if (isset($_GET['namegame'])) {

    $namegame =  $_GET['namegame'];
    $sql = "SELECT * FROM category WHERE name LIKE '%$namegame%'";
    $qureypro = $conn->prepare($sql);
    $qureypro->execute();

    $product = $qureypro->fetchAll(PDO::FETCH_ASSOC);
} else {

    $sql = "SELECT * FROM category";
    $qureypro = $conn->prepare($sql);
    $qureypro->execute();
    $product = $qureypro->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>allproduct</title>
</head>

<body>
    <?php include("nav.php"); ?>
    <?php
    echo $_SESSION['success'];
    unset($_SESSION['success']);
    echo $_SESSION['A'];
    unset($_SESSION['A']);
    ?>
    <div class="container">
        <div class="btn-group mt-3" role="group" aria-label="Basic example">
            <form class="d-flex">
                <input type="text" class="form-control" name="namegame">
                <button type="submit" class="btn btn-light">ค้นหา</button>
            </form>
        </div>
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


                                <img style=" height:13rem; padding-top: 5px;" src="./assets/imgs/<?= $row['img'] ?>" class="card-img-top" alt="...">
                                <div class="card-body d-inline-block py-1 px-2 mt-1 w-100">
                                    <?php
                                    $product_name = $row['name'];
                                    if (strlen($product_name) > 15) {
                                        $product_name = mb_substr($product_name, 0, 13) . '...';
                                    }
                                    
                                    ?>
                                    <h5><?= $product_name ?></h5>
                                    <p>ราคา <?= $row['cost'] ?> บาท</p>
                                </div>
                                <div>
                                    <form action="./cart.php?Cid=<?= $row['Cid'] ?>&quantity=1" method="post" class="card-body border-top pt-1 d-flex justify-content-between align-items-center">
                                        <input type="hidden" value="<?= $row['cost'] ?>" name="cost">
                                        <input type="hidden" value="<?= $row['Cid'] ?>" name="idinfo">
                                        <button type="submit" class="btn btn-link" name="addcart2" class=" pt-1"><ion-icon name="cart-outline" style="font-size: 1.6rem;"></ion-icon></button>
                                        <button type="submit" name="buy" class="btn btn-success">ซื้อ</button>
                                    </form>
                                </div>
                                
                            </a>
                        </div>

            <?php
                    }
                }
            } ?>
        </div>

    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#twitter"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#instagram"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook"></use>
                        </svg></a></li>
            </ul>
        </footer>
    </div>
</body>

</html>