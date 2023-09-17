<?php
session_start();
require '../DB/connect.php';



if (isset($_POST['submit'])) {

    $id = $_SESSION['id'];
    $Cid = $_POST['Cid'];
    $code = $_POST['code'];

    $sql = "SELECT * FROM products WHERE Code = :code";
    $check_data = $conn->prepare($sql);
    $check_data->bindParam(':code', $code);
    $check_data->execute();

    $result = $check_data->fetch(PDO::FETCH_ASSOC);

    if ($check_data->rowCount() == 0) {

        $sql = "INSERT INTO products (Mid,Cid,Code) VALUES (:id,:Cid,:code)";

        $additem = $conn->prepare($sql);
        $additem->bindParam(':id', $id);
        $additem->bindParam(':Cid', $Cid);
        $additem->bindParam(':code', $code);


        $additem->execute();

        if ($additem) {
            $_SESSION['success'] = "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'เพิ่มสินค้าสำเร็จ',
                                            showConfirmButton: false,
                                            timer: 2000
                                                });                      
                                        </script>";
            header("location: managecode.php");
        } else {
            $_SESSION['error'] = "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'เพิ่มสินค้าล้มเหลว',
                    text: 'ไม่สามารถเพิ่มข้อมูลเข้าฐานข้อมูลได้'
                        });
                  </script>";
            header("location: managecode.php");
        }
    } else {
        $_SESSION['error'] = "<script>
        Swal.fire({
            icon: 'error',
            title: 'เพิ่มสินค้าล้มเหลว',
            text: 'มีโค้ดนี้ในร้านแล้ว!!!'
                });
          </script>";
        header("location: managecode.php");
    }
}
