<!-- Modal Login-->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form method="post" action="./checklogin.php">
                    <div class="d-flex justify-content-center">
                        <img class="mb-4" src="./assets/imgs/logo-bg.png" alt="" width="100" height="100">
                    </div>

                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">

                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>

                        </div>
                    <?php } ?>
                    <!-- <h1 class="h3 mb-3 fw-normal text-center">Login</h1> -->

                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
                    <div class="mt-3 text-center">
                        <span>don't have account?</span>
                        <a type="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#regModal" data-bs-dismiss="modal">Register</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end-Modal Login -->

<!-- Modal Register -->
<div class="modal fade" id="regModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img class="mb-4" src="./assets/imgs/logo-bg.png" alt="" width="100" height="100">
                </div>
                <!-- form -->
                <form method="post" action="./regis.php">
                    <h1 class="h3 mb-3 fw-normal text-center">Register</h1>

                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">

                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>

                        </div>
                    <?php } ?>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingusername" name="username" required>
                        <label for="floatingusername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingemail" name="email" required>
                        <label for="floatingemail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword2" name="password2" required>
                        <label for="floatingPassword2">ConfirmPassword</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingtel" name="tel" required>
                        <label for="floatingtel">tel</label>
                    </div>
                    <input type="hidden" name="role" value="member"></input>
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="reg">Register</button>
                    <div class="mt-3 text-center">
                        <span>Do you want to apply to be a seller?</span>
                        <a type="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#regsalerModal" data-bs-dismiss="modal">Register-Saler</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end-Modal Register -->

<!-- Modal Register-Saler -->
<div class="modal fade" id="regsalerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img class="mb-4" src="./assets/imgs/logo-bg.png" alt="" width="100" height="100">
                </div>
                <!-- form -->
                <form method="post" action="./regsaler.php" enctype="multipart/form-data">
                    <h1 class="h3 mb-3 fw-normal text-center">Register-Saler</h1>

                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php } ?>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingusername" name="username" required>
                        <label for="floatingusername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingemail" name="email" required>
                        <label for="floatingemail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword2" name="password2" required>
                        <label for="floatingPassword2">Confirm Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingtel" name="tel" required>
                        <label for="floatingtel">Telephone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingdesc" name="descs" required>
                        <label for="floatingdesc">Description</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="floatingaddress" name="address" cols="10" required></textarea>
                        <label for="floatingaddress">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingidcard" name="idcard" required>
                        <label for="floatingidcard">IDCard</label>
                    </div>
                    <div class="form-control mb-3">
                        <input type="file" class="form-control" placeholder="IMG IDCard" name="imgid" required>
                    </div>
                    <input type="hidden" name="role" value="saler">
                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="regsaler">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end-Modal Register-Saler -->

<!-- Modal Add code -->
<?php
$id = $_SESSION['id'];

$sql = "SELECT * FROM category WHERE Mid = :id";
$checkdatalist = $conn->prepare($sql);
$checkdatalist->bindParam(':id', $id);
$checkdatalist->execute();

$resultlist = $checkdatalist->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="modal fade" id="addcodemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มสินค้า </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./add.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">

                        <select class="form-select" aria-label="Default select example" name="Cid">
                            <?php if ($checkdatalist->rowCount() > 0) {
                                foreach ($resultlist as $row) {
                            ?>

                                    <option value="<?= $row['Cid'] ?>"><?= $row['name'] ?></option>
                            <?php }
                            } ?>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">รหัสสินค้า(Code)</label>
                        <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary" name="submit">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Modal Add code -->

<!-- MOdal add category -->
<div class="modal fade" id="addcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มเกม</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./addcate.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="namecate" class="form-label">ชื่อเกม</label>
                        <input type="text" class="form-control" name="namecate" required>
                    </div>
                    <div class="mb-3">
                        <label for="descgame" class="form-label">รายละเอียดเกม</label>
                        <input type="text" class="form-control" name="descgame" required>
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">ราคา</label>
                        <input type="text" class="form-control" name="cost" required>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">รูปเกม</label>
                        <input type="file" class="form-control" name="img" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary" name="addcate">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end MOdal add category -->


<!-- MOdal credit -->
<div class="modal fade" id="credit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ทำรายการถอน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./in-outcome.php" method="post">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ชื่อธนาคาร:</label>
                        <input type="text" class="form-control" id="recipient-name" name="namebank" required>
                    </div>
                    <div class="mb-3">
                        <label for="bank-num" class="col-form-label">เลขบัญชีธนาคาร:</label>
                        <input type="text" class="form-control" id="bank-num" name="banknum" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">จำนวนเงินที่ต้องการถอน :</label>
                        <input type="number" class="form-control" id="message-text" name="amount" required>
                        <p>จำนวนเงินจะถูกหักค่าธรรมเนียมเมื่อถอน 5% จากจำนวนเงินที่ถอน</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">กลับ</button>
                    <button type="submit" class="btn btn-primary" name="credit">ยืนยันการถอน</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end MOdal credit -->

