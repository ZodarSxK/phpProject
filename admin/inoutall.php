<?php
session_start();
require '../DB/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST['myDate'];
    $date2 = $_POST['myDate2'];

    // echo $date, $date2;

    $qurrole = $conn->prepare("SELECT *,SUM(outcome*(5/100)) income FROM credit 
    WHERE DATE_FORMAT(date, '%Y-%m-%d') 
    BETWEEN '$date' AND '$date2';");
    $qurrole->execute();
    $resrole = $qurrole->fetchAll(PDO::FETCH_ASSOC);

    // $date = $_POST["date"];

    // if ($date == 'D') {
    //     $sql = "SELECT id,Mid,outcome,SUM(outcome*(5/100)) income,DATE_FORMAT(date, '%d-%m-%Y') date FROM credit WHERE status='สำเร็จ' GROUP BY DATE_FORMAT(date, '%d%') ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
    // } else if ($date == 'M') {
    //     $sql = "SELECT id,Mid,outcome,SUM(outcome*(5/100)) income,DATE_FORMAT(date, '%m-%Y') date FROM credit WHERE status='สำเร็จ' GROUP BY DATE_FORMAT(date, '%m%') ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
    // } else if ($date == 'Y') {
    //     $sql = "SELECT id,Mid,outcome,SUM(outcome*(5/100)) income,DATE_FORMAT(date, '%Y') date FROM credit WHERE status='สำเร็จ' GROUP BY DATE_FORMAT(date, '%Y%') ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
    // } else {
    //     $sql = "SELECT id,Mid,outcome,(outcome*(5/100)) income,DATE_FORMAT(date, '%d-%m-%Y') date FROM credit WHERE status='สำเร็จ' ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
    // }

    // $qurrole = $conn->prepare($sql);
    // $qurrole->execute();
    // $resrole = $qurrole->fetchAll(PDO::FETCH_ASSOC);

    $count = $conn->prepare("SELECT SUM(outcome*(5/100)) income FROM credit WHERE status = 'สำเร็จ'");
    $count->execute();

    $rescount = $count->fetch(PDO::FETCH_ASSOC);
} else {
    $qurrole = $conn->prepare("SELECT id,Mid,outcome,(outcome*(5/100)) income,DATE_FORMAT(date, '%d-%m-%Y') date FROM credit WHERE status='สำเร็จ' ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC");
    $qurrole->execute();

    $resrole = $qurrole->fetchAll(PDO::FETCH_ASSOC);

    $count = $conn->prepare("SELECT SUM(outcome*(5/100)) income FROM credit WHERE status = 'สำเร็จ'");
    $count->execute();

    $rescount = $count->fetch(PDO::FETCH_ASSOC);
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
    <title>inoutall</title>
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
                    <h1>สรุปรายรับ-รายจ่าย</h1>
                    <form method="post" class="mt-3">
                        <label for="myDate">เริ่ม:</label>
                        <input type="date" id="myDate" name="myDate">
                        <label for="myDate2">ถึง:</label>
                        <input type="date" id="myDate2" name="myDate2">

                        <!-- <select id="date" name="date">
                            <option value="All">ทั้งหมด</option>
                            <option value="D">วัน</option>
                            <option value="M">เดือน</option>
                            <option value="Y">ปี</option>
                        </select> -->
                        <button type="submit" class="btn btn-primary" name="submit">ดู</button>
                    </form>
                </div>

                <div class="container-fluid border-top pt-2 mt-3">
                    <div class="card me-2 mb-2" style="width: 18rem;">
                        <h5 class="card-header">รายได้ทั้งหมด <ion-icon name="cash-outline"></ion-icon></h5>
                        <div class="card-Top ms-2 mt-2 mb-2">
                            <h5 class="card-title ps-2"><?= $rescount['income'] ?> บาท</h5>
                        </div>
                    </div>
                    <table class="table table-striped table-hover border-top" style="width:100%" id="myTable">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>รหัสผู้ถอน</th>
                                <th>จำนวนที่ถอน</th>
                                <th>จำนวนที่ได้รับ</th>
                                <th>วันที่</th>
                            </tr>
                        </thead>
                        <?php

                        if ($qurrole->rowCount() > 0) {
                            foreach ($resrole as $row) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['Mid'] ?></td>
                                        <td><?= $row['outcome'] ?></td>
                                        <td class="text-success"><?= $row['income'] ?></td>
                                        <td><?= $row['date'] ?></td>
                                    </tr>
                                </tbody>
                        <?php }
                        } ?>
                    </table>
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