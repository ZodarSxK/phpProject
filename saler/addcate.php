<?php
session_start();
require '../DB/connect.php';

// add category

if(isset($_POST['addcate'])){

    $id = $_SESSION['id'];
    $namecate = $_POST['namecate'];
    $desc = $_POST['descgame'];
    $cost = $_POST['cost'];
    $img = $_FILES['img'];

    $upload = $_FILES['img']['name'];

       if($upload != ''){

              $allow = array('jpg','jpeg','png');
              $extention = explode(".",$img['name']);
              $fileActExt = strtolower(end($extention));
              $fileNew = rand() . "." . $fileActExt;
              $filePath = "../assets/imgs/".$fileNew;

              if(in_array($fileActExt, $allow)){
                     if($img['size'] > 0 && $img['error'] == 0){
                            move_uploaded_file($img['tmp_name'], $filePath);    
                     }
              }
            }
            
            $sql = "SELECT * FROM category WHERE Mid = :id";
            $check_data = $conn->prepare($sql);
            $check_data->bindParam(':id',$id);
            $check_data->execute();
        
            $result = $check_data->fetch(PDO::FETCH_ASSOC);
            
            if($namecate != $result['name']){

                $sql ="INSERT INTO category (Mid,name,descs,cost,img) VALUES (:id,:name,:desc,:cost,:img)";
        
                    $additem = $conn->prepare($sql);
                    $additem->bindParam(':id',$id);
                    $additem->bindParam(':name',$namecate);
                    $additem->bindParam(':desc',$desc);
                    $additem->bindParam(':cost',$cost);
                    $additem->bindParam(':img',$fileNew);
        
                    $additem->execute();
        
                    if($additem){
                        $_SESSION['success'] = "<script>
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'เพิ่มสินค้าสำเร็จ',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                        });                      
                                                </script>";
                        header("location: addcategory.php");
                    }else{
                        $_SESSION['error'] ="<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เพิ่มสินค้าล้มเหลว',
                            text: 'ไม่สามารถเพิ่มข้อมูลเข้าฐานข้อมูลได้'
                                });
                          </script>";
                          header("location: addcategory.php");
                    }
            }else{
                $_SESSION['error'] ="<script>
                Swal.fire({
                    icon: 'error',
                    title: 'เพิ่มสินค้าล้มเหลว',
                    text: 'มีโค้ดนี้ในร้านแล้ว!!!'
                        });
                  </script>";
                  header("location: addcategory.php");
            }
        
}


?>