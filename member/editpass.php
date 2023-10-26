<?php
session_start();
require '../DB/connect.php';

$id = $_SESSION['id'];

if (isset($_SESSION['id'])) {
    if (isset($_POST['submit'])) {
        $passwordold = $_POST['password'];
        $passwordnew = $_POST['password2'];
        $checkpass = $conn->prepare("SELECT * FROM members WHERE Mid = $id");
        $checkpass->execute();
        $resultpass = $checkpass->fetch(PDO::FETCH_ASSOC);


        if (password_verify($passwordold, $resultpass['password'])) {

            $passwordHash = password_hash($passwordnew, PASSWORD_DEFAULT);
            $editpass = $conn->prepare("UPDATE members SET password = '$passwordHash' WHERE Mid = $id");
            $editpass->execute();
            $_SESSION['password'] = "<script>
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ',
                                    text: 'แก้ไขรหัสผ่านแล้วกรุณาเข้าสู่ระบบใหม่'
                                        });                      
                                </script>";
            header("location: ../logout.php ");
        } else {
            $_SESSION['error'] = "<script>
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'รหัสไม่ถูกต้อง',
                                    text: 'รหัสผ่านเก่าไม่ตรง'
                                        });                      
                                </script>";
        }
    }
} else {
    $_SESSION['error'] = "<script>
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'กรุณาเข้าสู่ระบบ',
                                        });                      
                                </script>";
    header('location: ../');
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
    <title>info</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./assets/css/styles.css" rel="stylesheet" />
    <!-- IONICONS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=https://code.jquery.com/jquery-3.7.0.js></script>

    <link rel="stylesheet" href="../assets/css/stylemail.css">
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
                <div class="container-fluid">
                    <form class="card" method="post">
                        <img src="./assets/imgs/logo-bg.png" width="100px">
                        <h2>เปลี่ยนรหัสผ่าน</h2>

                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="ใส่รหัสผ่านเก่า" required>
                        <input type="password" class="form-control" id="floatingPassword2" name="password2" placeholder="ใส่รหัสผ่านใหม่" required>

                        <button type="submit" class="btn-submit" name="submit">ยืนยัน</button>

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