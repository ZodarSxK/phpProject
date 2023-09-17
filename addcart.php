<?php
session_start();
require './DB/connect.php';


$id = $_SESSION['id'];
$pid = $_POST['pid'];
$cost = $_POST['cost'];
$idinfo = $_POST['idinfo'];
if(!isset($id)){
    $_SESSION['error'] = "<script>
        Swal.fire({
        icon: 'error',
        title: 'กรุณาเข้าสู่ระบบ',
        showConfirmButton: false,
        timer: 2000
              });                      
       </script>";

        header("location: ./");
}



if (isset($_POST['addcart'])) {
    $sql = "SELECT * FROM liscart WHERE pid = $pid AND Mid = $id";
    $qureypro = $conn->prepare($sql);
    $qureypro->execute();

    // $product = $qureypro->fetchAll(PDO::FETCH_ASSOC);

    if ($qureypro->rowCount() == 0) {

        $sql = "INSERT INTO liscart (Mid,pid,lcost,idinfo) VALUES ($id,$pid,$cost,$idinfo)";

        $addcart = $conn->prepare($sql);
        $addcart->execute();

        if ($addcart) {
            $_SESSION['success'] = "<script>
                Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                      });                      
               </script>";

            header("location: ./");
        }
    } else {
        $_SESSION['error'] = "<script>
        Swal.fire({
        icon: 'error',
        title: 'มีสินค้าในตะกร้าแล้ว',
        showConfirmButton: false,
        timer: 2000
              });                      
       </script>";

        header("location: ./");
    }
}
if (isset($_POST['buy'])) {

    $sql = "INSERT INTO liscart (Mid,pid,lcost) VALUES ($id,$pid,$cost)";

    $addcart = $conn->prepare($sql);
    $addcart->execute();

    if ($addcart) {
        header("location: ./cart.php");
    }
}
