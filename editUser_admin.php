<?php

    session_start();
    require './DB/connect.php';
    
    // if(!isset($_SESSION['Admin_login'])){
    //     header("location: index.php");
    // }

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

            header("refresh:1; url=editUser_admin.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("installpackage.php");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("navbar.php");?>
    <title>showUser</title>
</head>
<body>
        <?php if(isset($_SESSION['success'])){ ?>
        <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        ?>                              
        <?php } ?>
<div class="container">
    <div class="container mt-5">
        <form  method="post">
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
    <div class="contrainer-table w-100 mt-5">
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
                        <td width="200px"><img width="100%" src="imgs/<?= $row['profile'];?>" class="rounded" alt=""></td>
                    <?php }else{?>
                        <td width="200px"><img width="100%" src="imgs/logo-bg.png" class="rounded" alt=""></td>
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
</body>
</html>