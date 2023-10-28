<?php
   $hostname ="202.28.34.205";
   $username = "63011212180";
   $password = "63011212180";
   $database = "db63011212180";
  // $hostname ="127.0.0.1";
  // $username = "root";
  // $password = "";
  // $database = "Project";
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


