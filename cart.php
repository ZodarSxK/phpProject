<?php
session_start();
include("./DB/connect.php");

if (!isset($_SESSION['id'])) {
    $_SESSION['A'] = "<script>
    Swal.fire({
    icon: 'error',
    title: 'กรุณเข้าสู่ระบบก่อนทำการซื้อ'
          });                      
   </script>";
    header("location: index.php");
} else {
    $id = $_SESSION['id'];
    $qurrole = $conn->prepare("SELECT * FROM members WHERE Mid = $id");
    $qurrole->execute();
    $resrole = $qurrole->fetch(PDO::FETCH_ASSOC);
    
    if ($resrole['role'] == "member") {
        if (isset($_POST['buy'])) {
            echo "ซื้อ";
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
                            header("location: cart.php");
                        }
                    }
                } else {
                    $_SESSION['cart'][] = $product_arr;
                    header("location: cart.php");
                }
            } else {
                $_SESSION['cart'][] = $product_arr;
                header("location: cart.php");
            }
            header("location:cart.php");
        }
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

                $qur = $conn->prepare("SELECT COUNT(cid) count FROM products WHERE cid=$cid and status =''");
                $qur->execute();

                $re = $qur->fetch(PDO::FETCH_ASSOC);

                if (in_array($cid, $product_id)) {
                    foreach ($_SESSION['cart'] as $key => $val) {
                        if ($_SESSION['cart'][$key]['Cid'] == $cid) {
                            if ($re['count'] == $_SESSION['cart'][$key]['quantity']) {
                                $_SESSION['A'] = "<script>
                                                Swal.fire({
                                                icon: 'error',
                                                title: 'สินค้าชิ้นนี้หมดแล้ว'
                                                    });                      
                                            </script>";
                                header("location: ./");
                            } else {
                                $_SESSION['cart'][$key]['quantity'] = $_SESSION['cart'][$key]['quantity'] + $quantity;
                                $_SESSION['success'] = "<script>
                Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                      });                      
               </script>";

                                header("location: ./");
                            }
                        }
                    }
                } else {
                    $_SESSION['cart'][] = $product_arr;
                    $_SESSION['success'] = "<script>
                Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                      });                      
               </script>";

                    header("location: ./");
                }
            } else {
                $_SESSION['cart'][] = $product_arr;
                $_SESSION['success'] = "<script>
                                        Swal.fire({
                                        icon: 'success',
                                        title: 'เพิ่มสินค้าเรียบร้อย',
                                        showConfirmButton: false,
                                        timer: 2000
                                            });                      
                                    </script>";

                header("location: ./");
            }
            header("location:./");
        } else if (isset($_POST['addcart2'])) {
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

                $qur = $conn->prepare("SELECT COUNT(cid) count FROM products WHERE cid=$cid and status =''");
                $qur->execute();

                $re = $qur->fetch(PDO::FETCH_ASSOC);

                if (in_array($cid, $product_id)) {
                    foreach ($_SESSION['cart'] as $key => $val) {
                        if ($_SESSION['cart'][$key]['Cid'] == $cid) {
                            if ($re['count'] == $_SESSION['cart'][$key]['quantity']) {
                                $_SESSION['A'] = "<script>
                                                Swal.fire({
                                                icon: 'error',
                                                title: 'สินค้าชิ้นนี้หมดแล้ว'
                                                    });                      
                                            </script>";
                                header("location: allproduct.php");
                            } else {
                                $_SESSION['cart'][$key]['quantity'] = $_SESSION['cart'][$key]['quantity'] + $quantity;
                                $_SESSION['success'] = "<script>
                Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                      });                      
               </script>";

                                header("location: allproduct.php");
                            }
                        }
                    }
                } else {
                    $_SESSION['cart'][] = $product_arr;
                    $_SESSION['success'] = "<script>
                Swal.fire({
                icon: 'success',
                title: 'เพิ่มสินค้าเรียบร้อย',
                showConfirmButton: false,
                timer: 2000
                      });                      
               </script>";

                    header("location: allproduct.php");
                }
            } else {
                $_SESSION['cart'][] = $product_arr;
                $_SESSION['success'] = "<script>
                                        Swal.fire({
                                        icon: 'success',
                                        title: 'เพิ่มสินค้าเรียบร้อย',
                                        showConfirmButton: false,
                                        timer: 2000
                                            });                      
                                    </script>";

                header("location: allproduct.php");
            }
            header("location: allproduct.php");
        }


        if (isset($_GET['remove_item'])) {
            $index = $_GET['remove_item'];
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart'][$index]);
                header("location:cart.php");
            }
        }
        if (isset($_GET['remove_itemall'])) {
            if (isset($_SESSION['cart'])) {
                unset($_SESSION['cart']);
                header("location:cart.php");
            }
        }
        if (isset($_GET['del_item'])) {
            $index = $_GET['del_item'];
            if (isset($_SESSION['cart'])) {
                if ($_SESSION['cart'][$index]['quantity'] != 1) {
                    $_SESSION['cart'][$index]['quantity'] = $_SESSION['cart'][$index]['quantity'] - 1;
                    header("location:cart.php");
                } else {
                    unset($_SESSION['cart'][$index]);
                    header("location:cart.php");
                }
            }
        }
        if (isset($_GET['add_item'])) {
            $index = $_GET['add_item'];

            $cid = $_SESSION['cart'][$index]['Cid'];
            $qur = $conn->prepare("SELECT COUNT(cid) count FROM products WHERE cid=$cid and status =''");
            $qur->execute();

            $re = $qur->fetch(PDO::FETCH_ASSOC);

            if (isset($_SESSION['cart'])) {
                if ($re['count'] == $_SESSION['cart'][$index]['quantity']) {
                    header("location:cart.php");
                } else {
                    $_SESSION['cart'][$index]['quantity'] = $_SESSION['cart'][$index]['quantity'] + 1;
                    header("location:cart.php");
                }
            }
        }
    } else {
        $_SESSION['A'] = "<script>
                                Swal.fire({
                                icon: 'error',
                                title: 'กรุณาใช้รหัสสำหรับลูกค้าเพื่อซื้อ'
                                    });                      
                            </script>";
        header("location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("nav.php"); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>

<body>
    <div class="container padding-bottom-3x mb-1 mt-5 border">
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
                            $val['quantity'] + 5;
                            $cid = $val['Cid'];
                            $rescart = $conn->prepare("SELECT * FROM category WHERE Cid = $cid");
                            $rescart->execute();

                            $cart = $rescart->fetch(PDO::FETCH_ASSOC);
                    ?>
                            <tr>

                                <td class="text-start"><?= $i++ ?></td>
                                <td>
                                    <div class="product-item d-flex">
                                        <div class="product-info">
                                            <img src="./assets/imgs/<?= $cart['img'] ?>" width="100">
                                            <h6 class="product-title text-center"><?= $val['name'] ?>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center text-lg text-medium"><?= $val['cost'] ?></td>
                                <td class="text-center"><a class="remove-from-cart me-2 " href="?del_item=<?= $key ?>"><ion-icon name="remove-circle-outline"></ion-icon></a><?= $val['quantity'] ?><a class="remove-from-cart ms-2 " href="?add_item=<?= $key ?>"><ion-icon name="add-circle-outline"></ion-icon></a></td>
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
            <div class="column text-lg">ราคารวม: <span class="text-medium"><?= $Total ?> บาท</span></div>
        </div>
        <div class="shopping-cart-footer mt-2  d-flex">
            <a class="btn btn-outline-secondary me-2" href="allproduct.php">เลือกสินค้าเพิ่ม</a>
            <!-- omise -->
            <form id="checkoutForm" method="POST" action="checkout.php">
                <input type="hidden" value="<?= $Total ?>" name="total">
                <input type="hidden" name="omiseToken">
                <input type="hidden" name="omiseSource">
                <button type="submit" class="btn btn-primary" id="checkoutButton">ชำระเงิน</button>
            </form>
            <!-- omise -->
        </div>
    </div>
    </div>

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