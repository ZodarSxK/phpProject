<?php
session_start();
require '../DB/connect.php';

$cid = $_GET['id'];
$showcate = $conn->prepare("SELECT * FROM category WHERE Cid = $cid");
$showcate->execute();

$query = $showcate->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['editcate'])){
    $name = $_POST['name'];
    $cost = $_POST['cost'];

    $editcate = $conn->prepare("UPDATE category SET name = '$name' , cost = $cost WHERE Cid = $cid");
    $editcate->execute();

    if($editcate){
        $_SESSION['success'] = "<script>
                  Swal.fire({
                      icon: 'success',
                      title: 'แก้ไขข้อมูลเรียบร้อย',
                      showConfirmButton: false,
                      timer: 2000
                            });                      
                     </script>";
              header("location: ./addcategory.php");
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
    <title>add game</title>
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
            <div class="container-fluid mt-3">
                <h1 class="mb-2">เพิ่มหมวดหมู่เกม</h1>
                <div class="row border-top">
                    <div class="col-md-6">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <img src="../assets/imgs/<?= $query['img'] ?>" width="300">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อเกม</label>
                                <input type="text" class="form-control" name="name" value="<?= $query['name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cost" class="form-label">ราคา</label>
                                <input type="text" class="form-control" name="cost" value="<?= $query['cost'] ?>" required>
                            </div>
                            <div class="modal-footer">
                                <a href="./addcategory.php" class="btn btn-secondary me-1">ยกเลิก</a>
                                <button type="submit" class="btn btn-primary" name="editcate">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- Bootstrap core JS-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Core theme JS-->
            <script src="./assets/js/scripts.js"></script>
</body>

</html>