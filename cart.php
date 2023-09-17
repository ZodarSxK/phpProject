<?php
session_start();
include("./DB/connect.php");

$id = $_SESSION['id'];

$sql = "SELECT * FROM liscart WHERE Mid = $id";
$qureypro = $conn->prepare($sql);
$qureypro->execute();

$product = $qureypro->fetchAll(PDO::FETCH_ASSOC);


// หาผลรวมของสินค้า
$sum = $conn->prepare("SELECT SUM(lcost) FROM liscart WHERE Mid = $id");
$sum->execute();

$sumres = $sum->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>
    <?php include("nav.php"); ?>

    <div class="container padding-bottom-3x mb-1">
        <!-- Shopping Cart-->
        <div class="table-responsive shopping-cart">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Cost</th>
                        <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th>
                    </tr>
                </thead>
                <?php
                if ($qureypro->rowCount() > 0) {
                    foreach ($product as $row) {

                        $Cid = $row['idinfo'];
                        $qurey = $conn->prepare("SELECT * FROM category WHERE Cid =  $Cid ");
                        $qurey->execute();

                        $info = $qurey->fetch(PDO::FETCH_ASSOC);
                ?>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="product-item d-flex">
                                        <div class="product-info ps-2">
                                            <h4 class="product-title"><a href="#"><?= $info['name'] ?></a>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center text-lg text-medium"><?= $info['cost'] ?></td>
                                <td class="text-center">—</td>
                                <td class="text-center"><a class="remove-from-cart" href="#" data-toggle="tooltip" title="" data-original-title="Remove item"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </tbody>
                <?php
                    }
                }
                ?>
            </table>
        </div>
        <div class="shopping-cart-footer">
            <div class="column text-lg">Total: <span class="text-medium"><?= $sumres['SUM(lcost)'] ?></span></div>
        </div>
        <div class="shopping-cart-footer mt-2">
            <a class="btn btn-outline-secondary" href="#"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a>
            <a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a>
            <a class="btn btn-success" href="#">Checkout</a>
        </div>
    </div>
    </div>







</body>

</html>