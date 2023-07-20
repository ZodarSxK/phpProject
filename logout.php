<?php
session_start();
unset($_SESSION['Admin_login']);
unset($_SESSION['Saler_login']);
unset($_SESSION['User_login']);
unset($_SESSION['Name_login']);


header('location: index.php');

?>