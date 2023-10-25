<?php
session_start();
require '../DB/connect.php';

$id = $_SESSION['id'];

if (isset($_SESSION['id'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = $_SESSION['id'];
        $date = $_POST["date"];

        if ($date == 'D') {
            $sql = "SELECT pid,SUM(cost) cost,name,DATE_FORMAT(date, '%d-%m-%Y') date FROM ordersold WHERE Mid_buy = $id GROUP BY DATE_FORMAT(date, '%d%') ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
        } else if ($date == 'M') {
            $sql = "SELECT pid,SUM(cost) cost,name,DATE_FORMAT(date, '%m-%Y') date FROM ordersold WHERE Mid_buy = $id GROUP BY DATE_FORMAT(date, '%m%') ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
        } else if ($date == 'Y') {
            $sql = "SELECT pid,SUM(cost) cost,name,DATE_FORMAT(date, '%Y') date FROM ordersold WHERE Mid_buy = $id GROUP BY DATE_FORMAT(date, '%Y%') ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
        } else {
            $sql = "SELECT pid,cost,name,DATE_FORMAT(date, '%d-%m-%Y') date FROM ordersold WHERE Mid_buy = $id ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC";
        }

        // $sqldata = "SELECT * FROM ordersold WHERE Mid_buy = $id";
        // $qurdata = $conn->prepare($sqldata);
        // $qurdata->execute();

        // $resdata = $qurdata->fetchAll(PDO::FETCH_ASSOC);

        $qurdata = $conn->prepare($sql);
        $qurdata->execute();
        $resdata = $qurdata->fetchAll(PDO::FETCH_ASSOC);

        $sqlcount = "SELECT SUM(cost) cost FROM ordersold WHERE Mid_buy = $id";
        $qurcount = $conn->prepare($sqlcount);
        $qurcount->execute();

        $rescount = $qurcount->fetch(PDO::FETCH_ASSOC);
    } else {

        $qurdata = $conn->prepare("SELECT pid,cost,name,DATE_FORMAT(date, '%d-%m-%Y') date FROM ordersold WHERE Mid_buy = $id ORDER BY DATE_FORMAT(date, '%Y-%m-%d') ASC");
        $qurdata->execute();
        $resdata = $qurdata->fetchAll(PDO::FETCH_ASSOC);


        $sqlcount = "SELECT SUM(cost) cost FROM ordersold WHERE Mid_buy = $id";
        $qurcount = $conn->prepare($sqlcount);
        $qurcount->execute();

        $rescount = $qurcount->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("location: ./");
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
    <title>history</title>
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
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php">ข้อมูลส่วนตัว</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="mykey.php">คีย์ของฉัน</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="history.php">รายการบัญชี</a>
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
                <div class="container-fluid d-flex justify-content-between">
                    <h1>รายการบัญชี</h1>
                    <form method="post" class="mt-3">
                        <label for="date">ดูรายงานประจำ ว/ด/ป :</label>
                        <select id="date" name="date">
                            <option value="All">ทั้งหมด</option>
                            <option value="D">วัน</option>
                            <option value="M">เดือน</option>
                            <option value="Y">ปี</option>
                        </select>
                        <button type="submit" class="btn btn-primary">ดู</button>
                    </form>
                </div>
                <div class="contrainer-fluid mt-4  border-top">
                    <div class="container-fluid d-flex mt-2">
                        <div class="card me-2" style="width: 18rem;">
                            <h5 class="card-header">ยอดเงินที่ซื้อทั้งหมด</h5>
                            <div class="card-Top ms-2 mt-2 mb-2">
                                <h5 class="card-title ps-2"><?= $rescount['cost'] ?> บาท</h5>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid border-top pt-2 mt-2">
                        <table class="table table-striped table-hover" style="width:100%" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">รหัสสินค้า</th>
                                    <th scope="col">ราคา</th>
                                    <th scope="col">วันที่ซื้อ</th>
                                    <!-- <th scope="col">วันที่ซื้อ</th> -->
                                </tr>
                            </thead>
                            <?php
                
                            if ($qurdata->rowCount() > 0) {
                                foreach ($resdata as $row) {
                            ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $row['pid'] ?></td>
                                            <td><?= $row['cost'] ?></td>
                                            <td><?= $row['date'] ?></td>
                                            <!-- <td><a type="button" class="btn btn-primary" href=in-outcome.php?a=1>ลบ</a></td> -->
                                        </tr>
                                    </tbody>
                            <?php }
                            } ?>
                        </table>
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