<?php
session_start();
if ($_SESSION['page'] == 0 || $_SESSION['page'] == null) {
?>
    <div class="text-center">
        <div class="card">
            <div class="card-header">
                <label>ใส่รหัสคิวบาร์โค้ดหรือชื่อ เพื่อเพิ่มสินค้านี้</label>
                <input type="search" class="form-control mt-2" name="barcode" id="search" onkeypress="return checkbarcode(event)" placeholder="ใส่ชื่อสินค้าหรือรหัสบาร์โค้ดได้ที่นี่">
                <button type='button' class='btn btn-primary w-100 mt-2' id="loadtable" onclick="additemintable(document.getElementById('search').value)">เพิ่มสินค้าลงในตะกร้า</button>
                <div id="livesearch" class="mt-2">
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <h1>รายการสินค้า</h1>
    </div>
    <div class="table-responsive">
        <table class="table mt-3">
            <thead>
                <tr class="table-info">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสบาร์โค้ด</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">ราคา(ต่อชิ้น)</th>
                    <th scope="col">จำนวน(ที่ซื้อ)</th>
                    <th scope="col">ลบสินค้า</th>
                </tr>

                <?php
                require('dbconnect.php');
                session_start();
                $id_staff = $_SESSION['id_staff'];

                $sqls = "SELECT * FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'";
                $results = $con->query($sqls);
                $i = 1;
                $row_num = $results->num_rows;
                $price = [];
                $number = [];
                $id_item = [];
                while ($rows = $results->fetch_assoc()) {
                    array_push($price, $rows['price_item']);
                    array_push($number, $rows['values_item']);
                    if ($rows['values_item'] > $rows['number_item']) {
                        echo "
                        <div class='alert alert-danger' role='alert'>
                            <h4>จำนวนสินค้ามีจำกัด  ชื่อสินค้า" . $rows['name_item'] . "    จำนวนในสต็อกสินค้า" . $rows['number_item'] . "</h4>
                        </div>
                        ";
                        $_SESSION['value_showtable'] = 1;
                    } else {
                        unset($_SESSION['value_showtable']);
                    } ?>
                    <tr>
                        <th scope='row'><?php echo $i ?></th>
                        <td><?php echo $rows['barcode'] ?></td>
                        <td><?php echo $rows['name_item'] ?></td>
                        <td><?php echo $rows['price_item'] ?> บาท</td>

                        <td><input type="number" name="" onchange="addnumber_item(this.value,<?php echo $rows['id_item'] ?>,<?php echo $rows['id_staff'] ?>)" id="<?php echo $rows['id_item'] ?>" class="form-control" value="<?php echo $rows['values_item'] ?>"></td>
                        <td><button type='button' class='btn btn-danger w-100' onclick="delectcart(this.value,'item')" value="<?php echo $rows['id_cart'] ?>">ลบรายการสินค้า</button></td>
                    </tr>
                <?php
                    $i++;
                }
                $z = $i - 1;
                ?>
            </thead>
            <tbody id="data">
                <tr>
                    <?php
                    $multiply = [];
                    $x = count($number);
                    for ($i = 0; $i <= $x; $i++) {
                        $p = $price[$i] * $number[$i];
                        array_push($multiply, $p);
                    }
                    ?>
                    <td colspan="3" class="table-info">รายการทั้งหมด <?php echo $z ?> รายการ</td>
                    <td class="table-info" id="price"><?php echo array_sum($multiply) ?> บาท</td>
                    <td class="table-info" id="number"><?php echo array_sum($number) ?> ชิ้น</td>
                    <td class="table-info"><button type='button' class='btn btn-danger w-100' onclick="delectcart(this.value,'staff')" value="<?php echo $id_staff ?>">ลบรายการสินค้าทั้งหมด</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type='button' class='btn btn-success w-100 mb-3' onclick="repage('pay')">ยืนยันคำสั่งซื้อ</button>
<?php } ?>


<?php if ($_SESSION['page'] == 1) { ?>
    <button type="button" class="btn btn-secondary" onclick="repage('cart')" onmousemove="loadtable()">กลับไปยังหน้าตะกร้า</button>
    <h3 class="mt-3">ช่องทางชำระเงิน</h3>
    <button class="btn btn-primary w-100 mt-3" onclick="showform()">ชำระเงินด้วยเงินสด</button>
    <form action="../php_action/buyitems.php?action=finish&bank=cash" id="form-hidden" method="GET" hidden>
        <input type="number" name="money" id="cash" class="form-control mt-2" placeholder="จำนวนเงินสดที่รับมา">
        <input type="hidden" name="action" value="finish">
        <input type="hidden" name="bank" value="cash">
        <input type="submit" class="mt-2 btn btn-danger w-100" value="ยืนยันการชำระเงิน">
    </form>
    <button class="btn btn-success w-100 mt-3" onclick="buyitems()">ชำระเงินด้วยการโอนผ่านธนาคาร</button>
    <p class="mt-1">*หากท่านเลือกโอนผ่านธนาคาร โปรดถ่ายสลิปเพื่อเป็นหลักฐานการชำระเงิน</p>
    <?php if (isset($_SESSION['alert'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['alert'] ?>
        </div>
    <?php endif;
    unset($_SESSION['alert']);
    ?>
    <h3>รายละเอียดคำสั่งซื้อ</h3>
    <table class="table mt-3" onmousemove="loadtable()">
        <thead>
            <tr class="table-info">
                <th scope="col">ลำดับ</th>
                <th scope="col">รหัสบาร์โค้ด</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">ราคา(ต่อชิ้น)</th>
                <th scope="col">จำนวน(ที่ซื้อ)</th>
            </tr>

            <?php
            require('dbconnect.php');
            session_start();
            $id_staff = $_SESSION['id_staff'];

            $sqls = "SELECT * FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'";
            $results = $con->query($sqls);
            $i = 1;
            while ($rows = $results->fetch_assoc()) { ?>
                <tr>
                    <th scope='row'><?php echo $i ?></th>
                    <td><?php echo $rows['barcode'] ?></td>
                    <td><?php echo $rows['name_item'] ?></td>
                    <td><?php echo $rows['price_item'] ?> บาท</td>
                    <td><?php echo $rows['values_item'] ?></td>
                </tr>
            <?php
                $i++;
            }
            $z = $i - 1;
            ?>
        </thead>
        <tbody id="data">
            <tr>
                <?php
                $sql = "SELECT * FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'";
                $result = $con->query($sql);
                $price = [];
                $number = [];
                while ($row = $result->fetch_assoc()) {
                    array_push($price, $row['price_item']);
                    array_push($number, $row['values_item']);
                }
                $multiply = [];
                $x = count($number);
                for ($i = 0; $i <= $x; $i++) {
                    $p = $price[$i] * $number[$i];
                    array_push($multiply, $p);
                }
                ?>
                <td colspan="3" class="table-info">รายการทั้งหมด <?php echo $z ?> รายการ</td>
                <td class="table-info" id="price"><?php echo array_sum($multiply) ?> บาท</td>
                <td class="table-info" id="number"><?php echo array_sum($number) ?> ชิ้น</td>
            </tr>
        </tbody>
    </table>
<?php } ?>
<?php if ($_SESSION['page'] == 2) { ?>
    <div class="text-center">
        <h1>รายการซื้อสินค้าเสร็จสิ้น</h1>
        <h3>รายการยืนยันเลขที่ : <?php echo $_SESSION['noworder'] ?></h3>
        <h3>ช่องทางการชำระเงิน : <?php echo $_SESSION['transfer'] ?></h3>
        <button type="button" class="btn btn-secondary" onclick="repage('cart')">กลับไปยังหน้าตะกร้า</button>
        <a href="pdfprint.php" class="btn btn-success">ปริ้นใบเสร็จ</a><br>
        <hr>
        <?php if ($_SESSION['transfer'] == 'bank') { ?>
            <div class="mt-5">
                <h3>สำหรับการยืนยัน ช่องทางชำระเงินด้วย ธนาคาร</h3>
                <p>คุณจำเป็นต้องยืนยันด้วยรูปภาพสลิปธนาคาร ที่ประวัติการซื้อสินค้า</p>
                <a href="buyhistory.php#<?= $_SESSION['noworder'] ?>" class="btn btn-info">ไปที่หน้า ประวัติการซื้อสินค้า</a>
            </div>
        <?php } ?>
    </div>
<?php } ?>