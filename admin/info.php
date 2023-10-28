<?php
session_start();
require '../DB/connect.php';

if (!isset($_SESSION['id'])) {
    header("location: ../");
}


$id = $_SESSION['id'];

$sql = "SELECT * FROM `members` INNER JOIN licence ON members.Mid = licence.Mid WHERE members.Mid=:id";
$qurey = $conn->prepare($sql);
$qurey->bindParam(':id', $id);
$qurey->execute();

$result = $qurey->fetch(PDO::FETCH_ASSOC);

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
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light"><img class="ms-5" src="./assets/imgs/logo-bg.png" width="100px"></div>
            <div class="list-group list-group-flush" id="myTab">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="./">จัดการสมาชิก</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="verifysaler.php">ยืนยันตัวตนผู้ขาย</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="in-outcome.php">รายการขอถอนเงิน</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="info.php">ข้อมูลส่วนตัว</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="comment.php">คอมเม้น</a>
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
                <div class="container-fluid d-flex justify-content-between">
                    <h1 class="mb-3">ข้อมูลส่วนตัว</h1>
                    <a href="editpass.php" class="btn btn-primary h-50 mt-3">เปลี่ยนรหัสผ่าน</a>
                </div>
                <form action="./editinfo.php" method="post" enctype="multipart/form-data" class="border-top">
                    <div class="container-fluid d-flex justify-content-center mt-2">
                        <?php if (isset($result['profile'])) { ?>
                            <img src="../assets/imgs/<?= $result['profile'] ?>" alt="" class="rounded-circle" width="300" height="300">
                        <?php } else { ?>
                            <img src="./assets/imgs/nouser.png" alt="" class="rounded-circle" width="300" height="300">
                        <?php } ?>
                    </div>
                    <div class="container-fluid">
                        <div class="mb-3 px-5">
                            <label for="profile" class="form-label">Profile</label>
                            <input type="file" class="form-control" id="Imginput" name="profile">
                            <input type="hidden" class="form-control" name="profileold" value="<?= $result['profile'] ?>"></input>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ID</label>
                            <input readonly value="<?= $_SESSION['id'] ?>" type="text" class="form-control" id="exampleFormControlInput1" disabled>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input value="<?= $result['name'] ?>" type="text" class="form-control" id="exampleFormControlInput1" name="name">
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input value="<?= $result['email'] ?>" type="email" class="form-control" id="exampleFormControlInput1" name="email">
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tel</label>
                            <input value="<?= $result['tel'] ?>" type="text" class="form-control" id="exampleFormControlInput1" name="tel">
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Description</label>
                            <input value="<?= $result['descs'] ?>" type="text" class="form-control" id="exampleFormControlInput1" name="descs">
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Address</label>
                            <textarea type="text" class="form-control" id="exampleFormControlInput1" name="address"><?= $result['address'] ?></textarea>
                        </div>
                    </div>
                    <div class="container-fluid d-flex justify-content-center mb-3">
                        <button class="btn btn-primary" type="submit" name="edit">Save</button>
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