
<?php 
    session_start();
    include('../DB/connect.php');

    if(isset($_POST['login'])){
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: ../login.php");
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: ../login.php ");
        }elseif(empty($password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: ../login.php ");
        }elseif(strlen($_POST['password']) <5 || strlen($_POST['password']) >20){
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาว 5 ถึง 20 ตัวอักษร';
            header("location: ../login.php ");
     }else{
            try {
                //code...
                $sql = "SELECT * FROM members WHERE email = :email";
                $checkemail = $conn->prepare($sql);
                $checkemail->bindParam(':email',$email,PDO::PARAM_STR);
                $checkemail->execute();
                $result = $checkemail->fetch(PDO::FETCH_ASSOC);

            if($checkemail->rowCount() > 0){  
                if($email == $result['email']){
                    if(password_verify($password,$result['password'])){
                        if(isset($result['role'])){
                                $_SESSION['id'] = $result['Mid'];
                                $_SESSION['role'] = $result['role'];
                                $_SESSION['Name_login'] = $result['name'];
                                $_SESSION['success'] = "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เข้าสู่ระบบสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 1000
                                          });                      
                                   </script>";
                                header("location: ../");
                            }
                    }else{
                        $_SESSION['error'] = 'รหัสผ่านไม่ถูกต้อง';
                        header("location: ../login.php");
                    }
                }else{
                        $_SESSION['error'] = 'อีเมลไม่ถูกต้อง';
                        header("location: ../login.php");
                }
            }else{
                    $_SESSION['error'] = "ไม่มี User นี้ในระบบ";
                    header("location: ../login.php ");
            }    

            } catch (PDOException $err) {
                //throw $th;
                echo $err->getMessage();
            }
        }
    }

?>
