<?php
session_start();
include("./DB/connect.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("installpackage.php");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("navbar.php");?>
    <title>Login</title>
</head>
<body>
<!-- ======================html form================================================================================ -->
            <div class="contrainer">
                <form class="form" method="post" action="./sql/checklogin.php">
                    
                    <div class="title">สมาชิก</div>
                            <?php if(isset($_SESSION['error'])){ ?>
                                    <div class="alert alert-danger">
                                        <?php 
                                            echo $_SESSION['error'];
                                            unset($_SESSION['error']);
                                        ?>
                                    </div>
                            <?php } ?>
                            <?php if(isset($_SESSION['success'])){ ?>
                                    <div class="alert alert-success">
                                        <?php 
                                            echo $_SESSION['success'];
                                            unset($_SESSION['success']);
                                        ?>
                                 </div>
                            <?php } ?>
                   
                    <div class="email mb-3">
                        <input type="email" placeholder="email" name="email"></input>
                    </div>
                   
                    <div class="email mb-3">
                        <input type="password" placeholder="password" name="password"></input>
                    </div>
                    <div class="forgot mb-3">
                        
                        <a  href="#">ลืมรหัสผ่าน?</a>
                        
                    </div>
                   
                    <div class="btn mb-3">
                        <a href="register.php"><input type="button" value="สมัครสมาชิก" class="btn1" ></input></a>
                        <button type="submit" name="login">เข้าสู่ระบบ</button>
                    </div>
                    
                
                </form>
            </div>
</body>
</html>