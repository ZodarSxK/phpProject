<?php
session_start();
require '../DB/connect.php';

if (isset($_GET['Mid'])) {
    $id = $_SESSION['id'];
    $Mid = $_GET['Mid'];

    echo "ยืนยัน";

    $sql = "UPDATE licence SET Mid_ver = $id, status ='สำเร็จ' WHERE Mid = $Mid";
    $query = $conn->prepare($sql);
    $query->execute();
    $_SESSION['success'] = "<script>
                  Swal.fire({
                      icon: 'success',
                      title: 'ยืนยันตัวตนผู้ขายเรียบร้อย',
                      showConfirmButton: false,
                      timer: 2000
                            });                      
                     </script>";

    header("location: verifysaler.php");
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
    <title>verifysaler</title>
    <!-- table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
                <h1>verifysaler</h1>
                <div class="container-fluid border-top pt-2 mt-3">
                    <?php
                    $Mid = $_GET['id'];

                    $qurrole = $conn->prepare("SELECT * FROM licence INNER JOIN members ON licence.Mid = members.Mid WHERE licence.Mid = $Mid");
                    $qurrole->execute();

                    $resrole = $qurrole->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <h5>รหัสร้าน : <?= $resrole['Mid'] ?></h5>
                    <h5>ชื่อร้าน : <?= $resrole['name'] ?></h5>
                    <h5>รายละเอียดร้าน : <?= $resrole['descs'] ?></h5>
                    <h5>โทร : <?= $resrole['tel'] ?></h5>
                    <h5>รหัสบัตรประชาชน : <?= $resrole['idcard'] ?></h5>
                    <img src="../assets/imgs/<?= $resrole['imgidcard'] ?>" alt="">
                    <div class="button mt-2">
                        <a href="verifysaler2.php?Mid=<?= $resrole['Mid']; ?>" class="btn btn-success">ยืนยันตัวตนผู้ขาย</a>
                        <a href="verifysaler.php?" class="btn btn-warning">กลับ</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./assets/js/scripts.js"></script>
    <!-- table -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#myTable');
    </script>

</body>

</html>