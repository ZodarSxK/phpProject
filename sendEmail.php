<?php
session_start();
include("./DB/connect.php");

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['email'])) {

    $email = $_POST['email'];

    $checkemail = $conn->prepare("SELECT * FROM members WHERE email ='$email'");
    $checkemail->execute();

    if ($checkemail->rowCount() > 0) {

        echo "เข้า";
        $randomPassword = generateRandomPassword(12);
        $password = $randomPassword;

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $resetpass = $conn->prepare("UPDATE members SET password = '$passwordHash' WHERE email ='$email'");
        $resetpass->execute();

        // $checkemail2 = $conn->prepare("SELECT * FROM members WHERE email ='$email'");
        // $checkemail2->execute();

        // $result = $checkemail2->fetch(PDO::FETCH_ASSOC);

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "63011212180@msu.ac.th"; // enter your email address
        $mail->Password = "0892772471a"; // enter your password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email);
        $mail->addAddress($email); // Send to mail
        $mail->Subject = 'Reset Password';
        $mail->Body = 'รหัสผ่านใหม่ของคุณ = ' . $password;

        if ($mail->send()) {
            $_SESSION['success'] = "<script>
                                        Swal.fire({
                                        icon: 'success',
                                        title: 'สำเร็จ',
                                        text: 'เช็ครหัสผ่านใหม่ที่อีเมลของคุณ'
                                            });                      
                                    </script>";
            header("location: reset.php ");
        } else {
            $_SESSION['error'] = "<script>
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'มีบางอย่างผิดพลาด',
                                    text: 'ลองใหม่อีกครั้ง'
                                        });                      
                                </script>";
            header("location: reset.php ");
        }
    } else {
        $_SESSION['error'] = "<script>
        Swal.fire({
        icon: 'error',
        title: 'ไม่มีอีเมลนี้',
        text: 'ลองใหม่อีกครั้ง'
              });                      
       </script>";
        header("location: reset.php ");
    }
}
function generateRandomPassword($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_';
    $password = '';
    $charCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomChar = $characters[rand(0, $charCount - 1)];
        $password .= $randomChar;
    }

    return $password;
}
