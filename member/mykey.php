<?php
session_start();
require '../DB/connect.php';

$id = $_SESSION['id'];

$sql ="SELECT products.pid, category.name, products.Code FROM category INNER JOIN products ON category.Cid=products.Cid WHERE products.owner=$id ";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="icon" type="image/x-icon" href="../assets/imgs/logo-bg.png">
        <title>Dashboard</title>
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
                <div class="sidebar-heading border-bottom bg-light"><img class="ms-5" src="./assets/imgs/logo-bg.png" width="100px" ></div>
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
        <div class="container-fluid ">
            <h1 class="mt-2">คีย์ของฉัน</h1>
            <!-- body -->
            <div class="contrainer-fluid mt-3  border-top">
                <table class="table table-sm mt-4">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ชื่อเกม</th>
                            <th scope="col">รหัสโค้ดเกม</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if ($query->rowCount() > 0) {
                            foreach ($result as $row) {
                        ?>
                                <tr>
                                    <td><?= $row['pid']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['Code'] ?></td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
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
