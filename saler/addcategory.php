<?php
session_start();
require '../DB/connect.php';

$id = $_SESSION['id'];

$sql = "SELECT * FROM category WHERE Mid = :id";
$qurey = $conn->prepare($sql);
$qurey->bindParam(':id', $id);
$qurey->execute();

$result = $qurey->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM category WHERE Cid = :id";
    $delete = $conn->prepare($sql);
    $delete->bindParam(':id', $id);
    $delete->execute();

    if ($delete) {
        $_SESSION['success'] = "<script>
                Swal.fire({
                icon: 'success',
                title: 'ลบเกมเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                    });                      
            </script>";
        header("refresh:0.5; url=addcategory.php");
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/x-icon" href="./assets/imgs/logo-bg.png">
    <title>Personal info</title>
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
    <!-- session -->
    <?php if (isset($_SESSION['success'])) { ?>
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
    <?php } ?>
    <?php if (isset($_SESSION['confirm'])) { ?>
        <?php
        echo $_SESSION['confirm'];
        unset($_SESSION['confirm']);
        ?>
    <?php } ?>
    <?php
    include('../modalall.php');
    ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light"><img class="ms-5" src="./assets/imgs/logo-bg.png" width="100px"></div>
            <div class="list-group list-group-flush" id="myTab">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php">ข้อมูลส่วนตัว</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="addcategory.php">เพิ่มหมวดหมู่เกม</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="managecode.php">จัดการสินค้า</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="soldcode.php">สินค้าที่ขายแล้ว</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="in-outcome.php">รายได้ทั้งหมด</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-light" id="sidebarToggle"><ion-icon name="arrow-back-outline"></ion-icon></button>
                    <!-- <button class="btn btn-primary" id="sidebarToggle"></button> -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active"><a class="nav-link" href="../">หน้าแรก</a></li>
                            <li class="nav-item"><a class="nav-link" href="../logout.php">ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid mt-2">
                <h1 class="mb-3">เพิ่มหมวดหมู่เกม</h1>
                <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#addcategory">เพิ่มเกม</button>

                <div class="row">
                    <?php if ($qurey->rowCount() > 0) {
                        foreach ($result as $row) {
                            $cid = $row['Cid'];
                            $qur = $conn->prepare("SELECT COUNT(cid) count FROM products WHERE cid=$cid");
                            $qur->execute();

                            $res = $qur->fetch(PDO::FETCH_ASSOC);
                    ?>

                            <div class="card m-2 p-2" style="width: 14rem; ">
                                <img style=" height:13rem; padding-top: 5px;" src="../assets/imgs/<?= $row['img'] ?>" class="card-img-top" alt="...">
                                <div class="card-body d-inline-block py-1 px-2 mt-1 mb-2">
                                    <h5><?= $row['Cid']; ?></h5>
                                    <h5><?= $row['name'] ?></h5>
                                    <h6>ราคา <?= $row['cost'] ?> บาท</h6>
                                    <p>คงเหลือ : <?= $res['count'] ?></p>
                                    <td><a href="?delete=<?= $row['Cid']; ?>" class="btn btn-danger" onclick="confirm('ต้องการที่จะลบเกมนี้? เกมที่ยังคงเหลือจะถูกลบไปด้วย');">ลบ</a></td>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>

            </div>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="./assets/js/scripts.js"></script>
</body>

</html>