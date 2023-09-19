<?php
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
  
}

?>