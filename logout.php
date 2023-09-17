<?php
session_start();
unset($_SESSION['role']);
unset($_SESSION['Name_login']);


header('location: index.php');

?>