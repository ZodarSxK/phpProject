<?php

session_start();
require '../DB/connect.php';

 if(isset($_POST['update'])){

       $id = $_POST['id'];
       $username = $_POST['username'];
       $email = $_POST['email'];
       $tel = $_POST['tel'];
       $descs = $_POST['descs'];
       $address = $_POST['address'];
       $idcard = $_POST['idcard'];
       $imgidcard = $_FILES['img'];

       $imgold = $_POST['imgold'];
       
       $upload = $_FILES['img']['name'];

       if($upload != ''){
              $allow = array('jpg','jpeg','png');
              $extention = explode(".",$img['name']);
              $fileActExt = strtolower(end($extention));
              $fileNew = rand() . "." . $fileActExt;
              $filePath = "../imgs/".$fileNew;

              if(in_array($fileActExt, $allow)){
                     if($img['size'] > 0 && $img['error'] == 0){
                            move_uploaded_file($img['tmp_name'], $filePath);    
                     }
              }
       }else{
              $fileNew = $imgold;
       }
        

       $sql = "UPDATE members SET name = :name, email = :email, tel = :tel, descs = :nameshop, address = :address, idcard = :idcard, imgidcard = :img WHERE Mid = :id";
       $update = $conn->prepare($sql);

       $update->bindParam(':name',$username);
       $update->bindParam(':email',$email);
       $update->bindParam(':tel',$tel);
       $update->bindParam(':nameshop',$descs);
       $update->bindParam(':address',$address);
       $update->bindParam(':idcard',$idcard);
       $update->bindParam(':img',$fileNew);
       $update->bindParam(':id',$id);

       $update->execute();

       if($update){
              $_SESSION['success'] = "<script>
                  Swal.fire({
                      icon: 'success',
                      title: 'แก้ไขข้อมูลสมาชิกเรียบร้อย',
                      showConfirmButton: false,
                      timer: 2000
                            });                      
                     </script>";
              header("location: ../editUser_admin.php");
       }else{
              $_SESSION['error'] = "แก้ไขข้อมูลสมาชิกล้มเหลว";
              header("location: ../editUser_admin.php");
       }
        
    
 }




?>