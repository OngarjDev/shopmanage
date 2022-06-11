<!DOCTYPE html>
<html lang="en">

<head>
    <title>ช่องทางการชำระเงิน</title>
    <?php
    require('../php_action/check.php');
    include('../php_action/bootstrap.php');
    ?>
</head>

<body class="sb-nav-fixed">
    <?php
    include('../layout/nav.html');
    include('../layout/menu.html');
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">ส่วนช่องทางการชำระเงิน</h3>
                </div>
                <div class="card-body">
                    <a class="btn btn-secondary" href="buyitem.php">กลับไปหน้าตะกร้าสินค้า</a>
                    <h1 class="text-center">รายละเอียดสินค้า</h1>
                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered">
                            <thead>

                                <td>ลำดับ</td>
                                <td>ชื่อสินค้า</td>
                                <td>จำนวน</td>
                                <td>ราคา(ต่อชิ้น)</td>
                                <td>ราคารวม</td>
                            </thead>
                            <tbody>
                                <?php
                                require_once('../php_action/dbconnect.php');
                                $sqlcart = "SELECT cart.id_item,cart.values_item,item.name_item,item.price_item FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'";
                                $resultcart = $con->query($sqlcart);
                                $i = 1;
                                $priceall_array = []; //ราคาสินค้าที่รวมจำนวนสินค้าทั้งหมดแล้ว
                                $numberall_array = []; //จำนวนสินค้าที่ทั้งหมดแล้ว
                                while ($rowcart = $resultcart->fetch_assoc()) :
                                    array_push($priceall_array, $rowcart['values_item'] * $rowcart['price_item']);
                                    array_push($numberall_array, $rowcart['values_item']);
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $rowcart['name_item'] ?></td>
                                        <td><?= $rowcart['values_item'] ?></td>
                                        <td><?= $rowcart['price_item'] ?> บาท</td>
                                        <td><?= $rowcart['values_item'] * $rowcart['price_item'] ?> บาท</td>
                                    </tr>
                                <?php
                                    $i++;
                                endwhile
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center">ภาษีมูลค่าเพิ่ม(7%) <?= $taxsum = array_sum($priceall_array) * 7 / 100 ?> บาท</td>
                                    <td colspan="3" class="text-center">ราคาสินค้าเดิม <?= array_sum($priceall_array) ?> บาท</td>
                                </tr>
                                <tr>
                                    <td colspan="2">รายการทั้งหมด <?= $i - 1 ?> รายการ</td>
                                    <td class="text-center">จำนวน <?= array_sum($numberall_array) ?> ชิ้น</td>
                                    <td colspan="2">ราคารวม <?php echo $taxsum + array_sum($priceall_array) ?> บาท</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <hr>
                    <h1 class=text-center>ช่องทางการชำระเงิน</h1>
                    <div id="form_paycash" hidden>
                        <h2 class="text-center" id="textchange">โปรดกรอกจำนวนเงินที่ได้รับ</h2>
                        <input type="text" placeholder="กรอกจำนวนเงินที่ได้รับ" class="form-control" id="textmoney" onkeyup="calculator(this.value,<?= $taxsum + array_sum($priceall_array) ?>)" required>
                        <button type="submit" class="btn btn-warning mt-2 w-100" onclick="agree_paymentcash()" id="ageepaycash" disabled>ยืนยันการชำระเงิน</button>
                    </div>
                    <form action="../php_action/buyitem.php?action=payment&bank=bank&image=image" method="post" enctype="multipart/form-data" id="form_paybank" hidden>
                        <input type="file" name="image" class="form-control" id="textmoney" required>
                        <input type="submit" class="btn btn-warning mt-2 w-100" value="ยืนยันการชำระเงิน">
                    </form>
                    <div class="btn-group w-100 mt-2" role="group">
                        <button type="button" class="btn btn-primary" onclick="paymentcash()" id="btnpaycash">ช่องทางการรับเงินสด</button>
                        <button type="button" class="btn btn-success" onclick="paymentbank()" id="btnpaybank">ช่องทางการโอนเงิน</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/ajax/payment.js"></script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>