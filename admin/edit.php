<?php
session_start();
require './DB/connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./assets/css/styles.css" rel="stylesheet" />
    <!-- IONICONS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=https://code.jquery.com/jquery-3.7.0.js></script>

    <style>
        .container {
            max-width: 500px;
        }
    </style>
</head>

<body>

    <?php if (isset($_GET['id'])) {

        $sql = "SELECT * FROM members WHERE Mid = :id";
        $qurey = $conn->prepare($sql);
        $qurey->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
        $qurey->execute();
        $result = $qurey->fetch(PDO::FETCH_ASSOC);

        if ($result['role'] == 'admin' || $result['role'] == 'saler') {
            // echo $result['role']; 
    ?>

            <div class="container mt-3">
                <h1 class="mb-3">แก้ไขข้อมูล</h1>
                <form class="form" method="post" action="../admin/edit_User.php" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="id" class="form-label">รหัสผู้ใช้</label>
                        <input readonly value="<?= $result['Mid'] ?>" type="text" class="form-control" name="id"></input>
                        <input type="hidden" class="form-control" name="imgold" value="<?= $result['imgidcard'] ?>"></input>
                    </div>
                    <div class="mb-3">

                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                        <input value="<?= $result['name'] ?>" type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username"></input>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">อีเมล</label>
                        <input value="<?= $result['email'] ?>" type="text" class="form-control" placeholder="อีเมล" name="email"></input>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">เบอร์โทร</label>
                        <input value="<?= $result['tel'] ?>" type="tel" class="form-control" placeholder="เบอร์โทร" name="tel"></input>
                    </div>
                    <div class="mb-3">
                        <label for="descs" class="form-label">ชื่อร้าน และ รายละเอียด</label>
                        <input value="<?= $result['descs'] ?>" type="text" class="form-control" placeholder="ชื่อร้าน" name="descs"></input>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่</label>
                        <textarea type="textarea" class="form-control" rows="5" placeholder="ที่อยู่" name="address"><?= $result['address'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="idcard" class="form-label">รหัสบัตรประชาชน</label>
                        <input value="<?= $result['idcard'] ?>" type="text" class="form-control" placeholder="รหัสบัตรประชาชน" name="idcard"></input>
                    </div>
                    <div class="mb-3">
                        <img src="../assets/imgs/<?= $result['imgidcard'] ?>" alt="" width="400px"">
                    <label for=" img" class="form-label">รูปบัตรประชาชน</label>
                        <input type="file" class="form-control" name="img"></input>
                        <img src="imgs/<?= $result['imgidcard'] ?>" id="preimg" alt="">
                    </div>
                    <input type="hidden" name="role" value="saler"></input>
                    <div class="mb-3">
                        <a href="./" class="btn btn-danger" type="button" name="reg">ยกเลิก</a>
                        <button type="submit" name="update" class="btn btn-primary">แก้ไข</button>
                    </div>

                </form>

            </div>

            <!-- ///////////////////////////////////////////////USER////////////////////////////////////////////////////////////// -->

        <?php } else {
            // echo $result['role']; 
        ?>
            <div class="container">
                <h1 class="mb-3">แก้ไขข้อมูล</h1>
                <form class="form" method="post" action="./sql/regis.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                        <input value="<?= $result['name'] ?>" class="form-control" type="text" placeholder="ชื่อผู้ใช้" name="username"></input>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">อีเมล</label>
                        <input value="<?= $result['email'] ?>" class="form-control" type="email" placeholder="อีเมล" name="email"></input>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">เบอร์โทร</label>
                        <input value="<?= $result['tel'] ?>" class="form-control" type="tel" placeholder="เบอร์โทร" name="tel"></input>
                    </div>
                    <input type="hidden" name="role" value="member"></input>
                    <div class="mb-3">
                        <a href="./" class="btn btn-danger" type="button" name="reg">ยกเลิก</a>
                        <button class="btn btn-primary" type="submit" name="reg">แก้ไข</button>
                    </div>

                </form>
            </div>
    <?php
        }
    }
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./assets/js/scripts.js"></script>
</body>

</html>