<?php
session_start();
require '../DB/connect.php';

if(isset($_POST['edit'])){

    $id = $_SESSION['id'];
    $profile = $_FILES['profile'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];

    $profileold = $_POST['profileold'];
    $upload = $_FILES['profile']['name'];

    if($upload != ''){
        $allow = array('jpg','jpeg','png');
        $extention = explode(".",$profile['name']);
        $fileActExt = strtolower(end($extention));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "../assets/imgs/".$fileNew; 

        if(in_array($fileActExt, $allow)){
               if($profile['size'] > 0 && $profile['error'] == 0){
                      move_uploaded_file($profile['tmp_name'], $filePath); 
               }
        }
    }else{
            $fileNew = $profileold;
    }

    $sql = "UPDATE members SET profile = :profile, name = :name, email = :email, tel = :tel, address = :address WHERE Mid = :id";
    $update = $conn->prepare($sql);

    $update->bindParam(':id',$id);
    $update->bindParam(':profile',$fileNew);
    $update->bindParam(':name',$name);
    $update->bindParam(':email',$email);
    $update->bindParam(':tel',$tel);
    $update->bindParam(':address',$address);

    $update->execute();

    if($update){
        $_SESSION['success'] = "<script>
            Swal.fire({
                icon: 'success',
                title: 'แก้ไขข้อมูลเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                      });                      
               </script>";
        header("location: ./");
    }else{
        $_SESSION['error'] = "<script>
        Swal.fire({
            icon: 'error',
            title: 'แก้ไขข้อมูลผิดพลาด',
            showConfirmButton: false,
            timer: 2000
                  });                      
           </script>";
        header("location: ./");
    }
    



}







?>