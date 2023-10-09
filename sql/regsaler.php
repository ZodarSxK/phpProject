<?php
session_start();
include('../DB/connect.php');

if(isset($_POST['regsaler'])){
    $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $tel = $_POST['tel'];
        $descs = $_POST['descs'];
        $address = $_POST['address'];
        $idcard = $_POST['idcard'];
        $img = $_FILES['imgid'];
        $role = $_POST['role'];

        $allow = array('jpg','jpeg','png');
        $extention = explode(".",$img['name']);
        $fileActExt = strtolower(end($extention));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "../assets/imgs/".$fileNew;


        if(empty($username)){
            $_SESSION['error'] = 'กรุณากรอกชื่อ';
            header("location: ../ ");
        }elseif(empty($email)){
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: ../ ");
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: ../ ");
        }elseif(empty($password)){
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: ../ ");
        }elseif(strlen($_POST['password']) <5 || strlen($_POST['password']) >20){
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาว 5 ถึง 20 ตัวอักษร';
            header("location: ../ ");
        }elseif(empty($password2)){
            $_SESSION['error'] = 'กรุณายืนยันรหัสผ่าน';
            header("location: ../ ");
        }elseif($password != $password2){
            $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
            header("location: ../ ");
        }elseif(empty($tel)){
            $_SESSION['error'] = 'กรุณากรอกเบอร์โทร';
            header("location: ../ ");
        }elseif(empty($descs)){
            $_SESSION['error'] = 'กรุณากรอกชื่อร้าน';
            header("location: ../ ");
        }elseif(empty($address)){
            $_SESSION['error'] = 'กรุณากรอกที่อยู่';
            header("location: ../ ");
        }elseif(empty($idcard)){
            $_SESSION['error'] = 'กรุณากรอกรหัสบัตรประชาชน';
            header("location: ../ ");
        }
        elseif(empty($img)){
            $_SESSION['error'] = 'กรุณาแนบรูปบัตรประชาชน';
            header("location: ../ ");
        }
        else{
            try {
                //code...
                $sql = "SELECT * FROM members WHERE email = :email";
                $checkemail = $conn->prepare($sql);
                $checkemail->bindParam(':email',$email,PDO::PARAM_STR);
                $checkemail->execute();
                $result = $checkemail->fetch(PDO::FETCH_ASSOC);

                if($result['email'] == $email){
                    $_SESSION['warning'] = "<script>
                    Swal.fire({
                        icon: 'wanning',
                        title: 'มีอีเมลนี้ในระบบแล้ว'
                              });                      
                       </script>";
                    header("location: ../");
                }elseif($result['tel'] == $tel){
                    $_SESSION['warning'] = "<script>
                    Swal.fire({
                        icon: 'wanning',
                        title: 'มีเบอร์นี้ในระบบแล้ว'
                              });                      
                       </script>";
                    header("location: ../");

                }elseif(!isset($_SESSION['error'])){

                    if(in_array($fileActExt, $allow)){
                        if($img['size'] > 0 && $img['error'] == 0){
                            if(move_uploaded_file($img['tmp_name'], $filePath)){
                                
                                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                                $sql = "INSERT INTO members (name,email,password,tel,descs,address,idcard,imgidcard,role)   
                                        VALUES (:name,:email,:pass,:tel,:descs,:address,:idcard,:imgidcard,:role)";
                                $insert = $conn->prepare($sql);

                                $insert->bindParam(':name',$username,PDO::PARAM_STR);
                                $insert->bindParam(':email',$email,PDO::PARAM_STR);
                                $insert->bindParam(':pass',$passwordHash,PDO::PARAM_STR);
                                $insert->bindParam(':tel',$tel,PDO::PARAM_STR);
                                $insert->bindParam(':descs',$descs,PDO::PARAM_STR);
                                $insert->bindParam(':address',$address,PDO::PARAM_STR);
                                $insert->bindParam(':idcard',$idcard,PDO::PARAM_STR);
                                $insert->bindParam(':imgidcard',$fileNew,PDO::PARAM_STR);
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
                                header("location: ../");
                            }
                        }
                    }
    

                    
                }else{
                    $_SESSION['error'] = "มีบางอย่างผิดพลาด";
                    header("location: ../");
                }


            } catch (PDOException $err) {
                //throw $th;
                echo $err->getMessage();
            }
        }
}



?>