<?php 
    session_start();
    include('./DB/connect.php');

    if(isset($_POST['reg'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $tel = $_POST['tel'];
        $role = $_POST['role'];

        if(empty($username)){
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: ./ ");
        }elseif(empty($email)){
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: ./ ");
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: ./ ");
        }elseif(empty($password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: ./ ");
        }elseif(strlen($_POST['password']) <5 || strlen($_POST['password']) >20){
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาว 5 ถึง 20 ตัวอักษร';
            header("location: ./ ");
        }elseif(empty($password2)){
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: ./ ");
        }elseif($password != $password2){
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: ./ ");
        }elseif(empty($tel)){
            $_SESSION['error'] = 'กรุณากรอกเบอร์โทร';
            header("location: ./ ");
        }else{
            try {
                //code...
                $sql = "SELECT * FROM members WHERE email = :email";
                $checkemail = $conn->prepare($sql);
                $checkemail->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
                $checkemail->execute();
                $result = $checkemail->fetch(PDO::FETCH_ASSOC);

                if($result['email'] == $email){
                    $_SESSION['warning'] = "มีอีเมลนี้ในระบบแล้ว";
                    header("location: ./");
                }elseif($result['tel'] == $tel){
                    $_SESSION['warning'] = "มีเบอร์โทรนี้ในระบบแล้ว";
                    header("location: ./");
                }elseif(!isset($_SESSION['error'])){

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO members (name,email,password,tel,role)   
                            VALUES (:name,:email,:pass,:tel,:role)";
                    $insert = $conn->prepare($sql);

                    $insert->bindParam(':name',$username,PDO::PARAM_STR);
                    $insert->bindParam(':email',$email,PDO::PARAM_STR);
                    $insert->bindParam(':pass',$passwordHash,PDO::PARAM_STR);
                    $insert->bindParam(':tel',$tel,PDO::PARAM_STR);
                    $insert->bindParam(':role',$role,PDO::PARAM_STR);

                    $insert->execute();

                    $_SESSION['success'] = "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'สมัครสมาชิกเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1000
                              });                      
                       </script>";
                    header("location: ./");
                }else{
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: ./ ");
                }


            } catch (PDOException $err) {
                //throw $th;
                echo $err->getMessage();
            }
        }
    }

?>

