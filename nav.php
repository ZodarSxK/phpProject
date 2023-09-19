<?php

if (isset($_SESSION['id'])) {

    $id = $_SESSION['id'];

    $sql = "SELECT * FROM members WHERE Mid = :id";
    $qurey = $conn->prepare($sql);
    $qurey->bindParam(':id', $id);
    $qurey->execute();

    $resultnav = $qurey->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- IONICONS -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=https://code.jquery.com/jquery-3.7.0.js></script>


</head>

<body>
    <!-- Modal -->
    <?php
    include('./modalall.php');
    ?>
    <!-- Nav -->
    <div class="container-fluid border-bottom">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2">
            <a href="/project" class="d-flex align-items-center col-md-3 mb-2 ms-2 mb-md-0 text-dark text-decoration-none">
                <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg> -->
                <img src="./assets/imgs/logo-bg.png" alt="logo" height="50">
            </a>

            <ul id="navli" class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 ">
                <li><a href="#" class="nav-link px-2 link-dark">Home</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Contract</a></li>
            </ul>

            <?php if (isset($_SESSION['role'])) { ?>

                <div class="dropdown col-md-3 d-flex justify-content-end ">

                    <a href="cart.php" class="me-2"><ion-icon style="font-size: 1.7rem; color: black; margin-top:1rem;" name="cart-outline"></ion-icon></a>

                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if ($resultnav['profile'] != '') { ?>
                            <img class="rounded-circle border-dark" src="./assets/imgs/<?= $resultnav['profile']; ?>" alt="profile" width="50" height="50">
                        <?php } else { ?>
                            <img class="rounded-circle border-dark" src="./saler/assets/imgs/nouser.png" alt="profile" width="50" height="50">
                        <?php } ?>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li class="border-bottom"><a class="dropdown-item" href="#">สวัสดี <?= $resultnav['name']; ?> </a></li>
                        <?php if ($_SESSION['role'] == 'saler') { ?>
                            <li><a class="dropdown-item" href="./saler/">Dashboard</a></li>
                        <?php } elseif ($_SESSION['role'] == 'admin') { ?>
                            <li><a class="dropdown-item" href="./admin/">Dashboard</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="./member/">Dashboard</a></li>
                        <?php } ?>

                        <li><a class="dropdown-item" href="./cart.php">My Cart</a></li>
                        <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <div class="col-md-3 d-flex justify-content-end ">

                    <button id="btnlogin" type="button" class="btn btn-outline-dark me-3 ms-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>

                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#regModal">Sign-up</button> -->
                </div>
            <?php } ?>
        </header>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>