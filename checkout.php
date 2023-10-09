<?php
session_start();
include("./DB/connect.php");
// print('<pre>');
// print_r($_POST);
// print('</pre>');

$total = $_POST['total'].'00';
// echo $total;

// exit();

require_once dirname(__FILE__).'/omise-php/lib/Omise.php';
define('OMISE_API_VERSION', '2015-11-17');
// define('OMISE_PUBLIC_KEY', 'PUBLIC_KEY');
// define('OMISE_SECRET_KEY', 'SECRET_KEY');
define('OMISE_PUBLIC_KEY', 'pkey_test_5wvofluqcjrbxs8ch2g');
define('OMISE_SECRET_KEY', 'skey_test_5wvof2quk73fmrl6ili');

$charge = OmiseCharge::create(array(
  'amount' => $total,
  'currency' => 'thb',
  'card' => $_POST["omiseToken"]
));

echo($charge['status']);

// print('<pre>');
// print_r($charge);
// print('</pre>');
if($charge['status'] == 'successful'){
  echo "ชำระเงินสำเร็จ";

  foreach ($_SESSION['cart'] as $key => $val) {
    echo $_SESSION['cart'][$key]['Cid'];
    echo $_SESSION['cart'][$key]['cost'];

    $cid = $_SESSION['cart'][$key]['Cid'];
    $id = $_SESSION['id'];
    $cost = $_SESSION['cart'][$key]['cost'];
    $quantity = $_SESSION['cart'][$key]['quantity'];

    $query = $conn->prepare("UPDATE products SET status='sold',owner=$id,income=$cost WHERE Cid = $cid AND status='' LIMIT $quantity");
    $query->execute();

    if($query){
      header("location: ./member/mykey.php");
    }


}
 
  
}

?>