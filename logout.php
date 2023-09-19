<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['role']);
unset($_SESSION['Name_login']);
unset($_SESSION['success']);
unset($_SESSION['error']);
unset($_SESSION['wanning']);
unset($_SESSION['A']);
unset($_SESSION['cart']);

header('location: index.php');

?>