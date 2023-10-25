<?php
session_start();
require '../DB/connect.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM products WHERE pid = :id";
    $delete = $conn->prepare($sql);
    $delete->bindParam(':id', $id);
    $delete->execute();

    if ($delete) {
        $_SESSION['success'] = "<script>
                Swal.fire({
                icon: 'success',
                title: 'ลบเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                    });                      
            </script>";
        header("refresh:0.5; url=managecode.php");
    }
}
$id = $_SESSION['id'];

$sql = "SELECT products.pid, category.name, products.Code, category.cost FROM category INNER JOIN products ON category.Cid=products.Cid WHERE products.status='' AND category.Mid = $id ";
$check_data = $conn->prepare($sql);
$check_data->execute();
$result = $check_data->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/x-icon" href="./assets/imgs/logo-bg.png">
    <title>Code Management</title>

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
    <?php
    include_once('../modalall.php');
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
            <div class="container-fluid ">
                <h1 class="mt-2">จัดการสินค้า</h1>
                <!-- body -->
                <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#addcodemodel">เพิ่มสินค้า</button>
                <div class="container-fluid border-top mt-2 pt-2">
                    <table id="myTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อเกม</th>
                                <th>รหัสโค้ดเกม</th>
                                <th>ราคา</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($check_data->rowCount() > 0) {
                                foreach ($result as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['pid']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['Code'] ?></td>
                                        <td><?= $row['cost'] ?></td>
                                        <td><a href="?delete=<?= $row['pid']; ?>" class="btn btn-danger" onclick="return confirm('ต้องการที่จะลบโค้ดนี้?');">ลบ</a></td>
                                    </tr>
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

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#myTable');
    </script>
</body>

</html>