<?php
session_start();
include('DB/connect.php');

$sql ="SELECT products.pid, category.name, products.Code FROM category INNER JOIN products ON category.Cid=products.Cid WHERE products.Mid=16 AND status=''";

$qurey = $conn->prepare($sql);
$qurey->execute();

$result = $qurey->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
   echo '//'; 
   echo $row['name'];

}


?>