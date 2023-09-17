<?php
session_start();
require '../DB/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT * FROM members WHERE role = :role";
    $check_data = $conn->prepare($sql);
    $check_data->bindParam(':role',$_POST["role"],PDO::PARAM_STR);
    $check_data->execute();
    $result = $check_data->fetchAll(PDO::FETCH_ASSOC);


}else{
    $sql = "SELECT * FROM members ";
    $check_data = $conn->prepare($sql);
    $check_data->execute();
    $result = $check_data->fetchAll(PDO::FETCH_ASSOC);
}

if(isset($_GET['delete'])){
$id = $_GET['delete'];

$sql ="DELETE FROM members WHERE Mid = :id";
$delete = $conn->prepare($sql);
$delete->bindParam(':id',$id);
$delete->execute();

if($delete){
    $_SESSION['success'] = "<script>
        Swal.fire({
        icon: 'success',
        title: 'ลบสมาชิกเรียบร้อย',
        showConfirmButton: false,
        timer: 2000
              });                      
       </script>";

    header("refresh:1; url=manageUser.php");
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
        <!-- session -->
        <?php if(isset($_SESSION['success'])){ ?>
        <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        ?>                              
        <?php } ?>
        <?php if(isset($_SESSION['error'])){ ?>
        <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        ?>                              
        <?php } ?>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light"><img class="ms-5" src="./assets/imgs/logo-bg.png" width="100px" ></div>
                <div class="list-group list-group-flush" id="myTab">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="./">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="manageUser.php">ManageMember</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="verifysaler.php">Verifysaler</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="verifysaler.php">สินค้าที่ขายแล้ว</a>
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
                    <div class="container-fluid d-flex justify-content-between">
                        <h1>ManageMember</h1>
                        <form  method="post" class="mt-3">
                            <label for="role">Select Role:</label>
                            <select id="role" name="role">
                                <option value="All">All</option>
                                <option value="admin">Admin</option>
                                <option value="saler">Saler</option>
                                <option value="member">Member</option>
                            </select>
                            <button type="submit" class="btn btn-primary">ดู</button>
                        </form>
                    </div>
                        
                </div>
    <div class="contrainer-table w-100 px-2 border-top mt-2">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Profile</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php if($check_data->rowCount() > 0){
                    foreach ($result as $row) {
                ?>
                <tr>
                <td><?= $row['Mid'];?></td>

                    <?php if($row['profile'] != ''){?>
                        <td><img style="width:5rem; " src="../assets/imgs/<?= $row['profile']?>" class="rounded" alt=""></td>
                    <?php }else{?>
                        <td><img style="width:5rem; " src="../assets/imgs/logo-bg.png" class="rounded" alt=""></td>
                    <?php }?>

                <td><?= $row['name'];?></td>
                <td><?= $row['role'];?></td>
                <td>
                    <a href="edit.php?id=<?= $row['Mid'];?>" class="btn btn-warning">แก้ไข</a>
                    <a href="?delete=<?= $row['Mid'];?>" class="btn btn-danger" onclick="return confirm('ต้องการที่จะลบผู้ใช้นี้?');">ลบ</a>
                </td>
                </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
                  
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="./assets/js/scripts.js"></script>

    </body>
</html>
