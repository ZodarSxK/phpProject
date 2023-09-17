<?php
// require 'sql/regis.php';
session_start();
include('DB/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include("installpackage.php");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("nav.php");?>
    <title>Register-saler</title>
<body>
    
</body>
</html>
<title>REG</title>
<body>

            <div class="container mt-3">
                
                    <h1 class="mb-3">สมัครสมาชิกผู้ขาย</h1>
                    <form class="form" method="post" action="./sql/regis-saler.php" enctype="multipart/form-data">
                        <?php if(isset($_SESSION['error'])){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php 
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                    ?>
                                </div>
                        <?php } ?>
                        <?php if(isset($_SESSION['warning'])){ ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php 
                                        echo $_SESSION['warning'];
                                        unset($_SESSION['warning']);
                                    ?>
                                </div>
                        <?php } ?>
                        <?php if(isset($_SESSION['success'])){ ?>
                                <div class="alert alert-success" role="alert">
                                    <?php 
                                        echo $_SESSION['success'];
                                        unset($_SESSION['success']);
                                    ?>
                                </div>
                        <?php } ?>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" name="username"></input>
                    </div>  
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="อีเมล" name="email"></input>
                    </div>                    
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password"></input>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="password2"></input>
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" placeholder="เบอร์โทร" name="tel"></input>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="ชื่อร้าน" name="descs"></input>
                    </div>
                    <div class="mb-3">
                        <textarea type="textarea" class="form-control" rows="5" placeholder="ที่อยู่" name="address"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="รหัสบัตรประชาชน" name="idcard"></input>
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" name="imgid"></input>
                    </div>
                    <input type="hidden" name="role" value="saler"></input>
                      


                        <div class="mb-3">
                            <button type="submit" name="reg-saler" class="btn btn-primary">สมัครสมาชิก</button>
                        </div>
                    
                    </form>
                
            </div>  
  
</body>
</html>

