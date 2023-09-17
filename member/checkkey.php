<?php
session_start();
require './DB/connect.php';


$id = $_SESSION['id'];

$sql ="SELECT * FROM products WHERE owner = $id";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
    echo $row['Code'];
    echo '||';
}

?>