<?php
  $hostname ="127.0.0.1";
  $username = "root";
  $password = "";
  $database = "Project";
  try {
    //code...
      mysqli_report(MYSQLI_REPORT_OFF); 
      $conn = new PDO("mysql:host=$hostname;dbname=$database",$username,$password);
      $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      
      // echo "DB connect success";
  } catch (PDOException $err){ 
    //throw $th;
    echo "DB connect ERROR" . $err->getMessage();
  }

?>
<!-- if(!$conn){
    echo "fale";
  }
  else{ 
    echo "true";
  }

$sql = "คำสั่ง sql";
mysqli_query($conn,$sql);

echo "<pre>"; print_r($_POST['email']) ;  echo "</pre>";

var_dump($_POST);


$_SERVER["REQUEST_METHOD"] == "POST" 



-->

