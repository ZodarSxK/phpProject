<?php
// require 'sql/regis.php';
session_start();
require_once './DB/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include("installpackage.php");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("navbar.php");?>
    <title>Register</title>
<body>
    
</body>
</html>
<title>REG</title>
<body>

                <div class="container">
                    <h1 class="mb-3">สมัครสมาชิก</h1>
                    <form class="form" method="post" action="./sql/regis.php">
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
                    <div class="mb-3"><input type="text" placeholder="ชื่อผู้ใช้" name="username"></input></div>  
                    <div class="mb-3"><input type="email" placeholder="อีเมล" name="email"></input></div>                    
                    <div class="mb-3"><input type="password" placeholder="รหัสผ่าน" name="password"></input></div>
                    <div class="mb-3"><input type="password" placeholder="ยืนยันรหัสผ่าน" name="password2"></input></div>
                    <div class="mb-3"><input type="tel" placeholder="เบอร์โทร" name="tel"></input></div>
                    <input type="hidden"name="role" value="member"></input>
                        <div class="mb-3">
                            <a href="register-saler.php"><input type="button" value="สมัครสมาชิกผู้ขาย"></input></a>
                            <button type="submit" name="reg" >สมัครสมาชิก</button>
                        </div>
                    
                    </form>
                </div>  
  
</body>
</html>

