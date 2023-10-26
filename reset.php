<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include("./DB/connect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send PHPMailer</title>

    <link rel="stylesheet" href="./assets/css/stylemail.css">
</head>

<body>
    <?php include("nav.php"); ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <?php
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        ?>
    <?php } ?>
    <?php if (isset($_SESSION['success'])) { ?>
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
    <?php } ?>
    <?php if (isset($_SESSION['A'])) { ?>
        <?php
        echo $_SESSION['A'];
        unset($_SESSION['A']);
        ?>
    <?php } ?>

    <form id="myForm" class="card" action="sendEmail.php" method="post">
        <img src="./assets/imgs/logo-bg.png" width="100px">
        <h2>รีเซ็ตรหัสผ่าน</h2>

        <div class="form-control">
            <p>อีเมล</p>
            <input type="text" id="email" name="email" class="txt" placeholder="ใส่อีเมล">
        </div>
        <button type="submit" value="Send an email" class="btn-submit">ยืนยัน</button>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</body>

</html>