<?php
session_start();
require '../DB/connect.php';

if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $namereport = $_POST['namereport'];
    $report = $_POST['report'];
    $img = $_FILES['imgreport'];

                $allow = array('jpg', 'jpeg', 'png');
                $extention = explode(".", $img['name']);
                $fileActExt = strtolower(end($extention));
                $fileNew = rand() . "." . $fileActExt;
                $filePath = "../assets/imgs/" . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath)) {
        
                $insertreport = $conn->prepare("INSERT INTO report (Mid,namereport,reportdesc,img) VALUES ($id,'$namereport','$report','$fileNew')");
                $insertreport->execute();

                $_SESSION['success'] = "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'ส่งคำร้องเรียบร้อย',
                    showConfirmButton: false,
                    timer: 1000
                          });                      
                   </script>";
                // header("location: ./report.php");
            }
        }
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
    <link rel="icon" type="image/x-icon" href="../assets/imgs/logo-bg.png">
    <title>report</title>
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
    <?php if (isset($_SESSION['success'])) { ?>
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
    <?php } ?>
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light"><img class="ms-5" src="./assets/imgs/logo-bg.png" width="100px"></div>
            <div class="list-group list-group-flush" id="myTab">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php">ข้อมูลส่วนตัว</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="mykey.php">คีย์ของฉัน</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="history.php">รายการบัญชี</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="report.php">แจ้งปัญหา</a>
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
            <div class="container-fluid">
                <h1>report</h1>
                <div class="container-fluid border-top mt-4">
                    <form enctype="multipart/form-data" method="post">
                        <div class="container mb-3 mt-2">
                            <label for="namereport" class="form-label">
                                <h5>เรื่อง</h5>
                            </label>
                            <input type="text" class="form-control" id="namereport" name="namereport" required>
                        </div>
                        <div class="container mb-3 mt-2">
                            <label for="report" class="form-label">รายละเอียด</label>
                            <textarea class="form-control" id="report" rows="10" name="report" required></textarea>
                        </div>
                        <div class="container mb-3 mt-2">
                            <label for="imgreport" class="form-label">แนบรูป</label>
                            <input type="file" class="form-control" id="imgreport" name="imgreport">
                        </div>
                        <div class="container-fluid d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-50" name="submit">ส่ง</button>
                        </div>

                    </form>
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