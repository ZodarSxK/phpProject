<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include('DB/connect.php');

$sql = "SELECT * FROM category";
$qureypro = $conn->prepare($sql);
$qureypro->execute();

$product = $qureypro->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['addcart'])) {
    echo "ตะกร้า";
    $cid = $_GET['Cid'];
    $quantity = $_GET['quantity'];

    $qurey = $conn->prepare("SELECT * FROM category WHERE Cid=$cid");
    $qurey->execute();

    $res = $qurey->fetch(PDO::FETCH_ASSOC);

    $product_arr = array(
        'Cid' => $cid,
        'name' => $res['name'],
        'cost' => $res['cost'],
        'quantity' => $quantity,
    );
    if (!empty($_SESSION['cart'])) {
        $product_id = array_column($_SESSION['cart'], 'Cid');
        if (in_array($cid, $product_id)) {
            foreach ($_SESSION['cart'] as $key => $val) {
                if ($_SESSION['cart'][$key]['Cid'] == $cid) {
                    $_SESSION['cart'][$key]['quantity'] = $_SESSION['cart'][$key]['quantity'] + $quantity;
                }
            }
        } else {
            $_SESSION['cart'][] = $product_arr;
        }
    } else {
        $_SESSION['cart'][] = $product_arr;
    }
    header("location:carttest.php");
}
if (isset($_POST['buy'])) {
    echo "ซื้อ";
}
if (isset($_GET['remove_item'])) {
    $index = $_GET['remove_item'];
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart'][$index]);
        header("location:carttest.php");
    }
}
if (isset($_GET['remove_itemall'])) {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
        header("location:carttest.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("nav.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="container padding-bottom-3x mb-1">
        <!-- Shopping Cart-->
        <div class="table-responsive shopping-cart">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>สินค้า</th>
                        <th class="text-center">ราคา</th>
                        <th class="text-center">จำนวน</th>
                        <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="?remove_itemall">ลบทั้งตะกร้า</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $Total = 0;
                    if (isset($_SESSION['cart'])) {
                        $index = 0;
                        $i = 1;
                        foreach ($_SESSION['cart'] as $key => $val) {
                            $totalPrice = $val['quantity'] * $val['cost'];
                            $Total = $Total + $totalPrice;

                    ?>
                            <tr>

                                <td class="text-center"><?= $i++ ?></td>
                                <td>
                                    <div class="product-item d-flex">
                                        <div class="product-info ps-2">
                                            <h4 class="product-title"><a href="#"><?= $val['name'] ?></a>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center text-lg text-medium"><?= $val['cost'] ?></td>
                                <td class="text-center"><?= $val['quantity'] ?></td>
                                <td class="text-center"><a class="remove-from-cart" href="?remove_item=<?= $key ?>" data-toggle="tooltip" title="" data-original-title="Remove item"><ion-icon name="trash-outline" style="color: red;margin-top:5px;"></ion-icon></a></td>

                            </tr>
                    <?php
                            $index++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="shopping-cart-footer">
            <div class="column text-lg">Total: <span class="text-medium"><?= $Total ?></span></div>
        </div>
        <div class="shopping-cart-footer mt-2">
            <a class="btn btn-outline-secondary" href="#"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a>
            <!-- omise -->
            <form id="checkoutForm" method="POST" action="checkout.php">
                <input type="hidden" value="<?= $Total ?>" name="total">
                <input type="hidden" name="omiseToken">
                <input type="hidden" name="omiseSource">
                <button type="submit" class="btn btn-primary" id="checkoutButton">Checkout</button>
            </form>
            <!-- omise -->
        </div>
    </div>
    </div>
    <!-- ///////////////////////////////////////////////////////////////////////////// -->
    <div class="container-fluid border-top" style="padding-left: 5rem;">
        <div class="row">
            <?php if ($qureypro->rowCount() > 0) {
                foreach ($product as $row) {

                    //   $Cid = $row['Cid'];
                    //   $sql = "SELECT * FROM category WHERE Cid = :Cid ";
                    //   $qureypro = $conn->prepare($sql);
                    //   $qureypro->bindParam(':Cid', $Cid);
                    //   $qureypro->execute();

                    //   $product = $qureypro->fetch(PDO::FETCH_ASSOC);
            ?>
                    <div class="card m-2 p-2" style="width: 14rem; ">
                        <?= $row['Cid'] ?>
                        <img style=" height:13rem; padding-top: 5px;" src="./assets/imgs/<?= $row['img'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-inline-block py-1 px-2 mt-1 mb-2">
                            <h5><?= $row['name'] ?></h5>
                            <p>ราคา <?= $row['cost'] ?> บาท</p>
                        </div>
                        <div>
                            <form action="./carttest.php?Cid=<?= $row['Cid'] ?>&quantity=1" method="post" class="card-body border-top pt-1 d-flex justify-content-between align-items-center">
                                <input type="hidden" value="<?= $row['cost'] ?>" name="cost">
                                <input type="hidden" value="<?= $row['Cid'] ?>" name="idinfo">
                                <button type="submit" class="btn btn-link" name="addcart" class=" pt-1"><ion-icon name="cart-outline" style="font-size: 1.6rem;"></ion-icon></button>
                                <button type="submit" name="buy" class="btn btn-success">ซื้อ</button>
                            </form>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</body>

</html>
<script type="text/javascript" src="https://cdn.omise.co/omise.js">
</script>

<script>
  OmiseCard.configure({
    publicKey: "pkey_test_5wvofluqcjrbxs8ch2g"
  });

  var button = document.querySelector("#checkoutButton");
  var form = document.querySelector("#checkoutForm");

  button.addEventListener("click", (event) => {
    event.preventDefault();
    OmiseCard.open({
      amount: <?= $Total ?>00,
      currency: "THB",
      defaultPaymentMethod: "credit_card",
      onCreateTokenSuccess: (nonce) => {
          if (nonce.startsWith("tokn_")) {
              form.omiseToken.value = nonce;
          } else {
              form.omiseSource.value = nonce;
          };
        form.submit();
      }
    });
  });
</script>