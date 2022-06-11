<!DOCTYPE html>
<html lang="en">

<head>
    <title>ชำระสินค้า</title>
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
            <div class="container-fulid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">ส่วนเพิ่มสินค้า</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7 col-md-7">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h3 class="text-center">สินค้าทั้งหมด</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fulid">
                                            <div class="row">
                                                <?php
                                                require('../php_action/dbconnect.php');
                                                $limititempage = 12; //จำกัดการแสดงผล 12 ชิ้นต่อ 1 หน้า
                                                if (isset($_GET['page'])) {
                                                    $page = $_GET['page'];
                                                } else {
                                                    $page = 1;
                                                }
                                                $start = ($page - 1) * $limititempage;

                                                $sql = "SELECT id_item FROM cart WHERE id_staff = '$id_staff'"; ///เช็คของว่ามีสินค้าในตะกร้าหรือไม่
                                                $result = $con->query($sql);
                                                $checkcart = [];
                                                while ($row = $result->fetch_assoc()) {
                                                    array_push($checkcart, $row['id_item']);
                                                }

                                                $sql = "SELECT * FROM item LIMIT $start, $limititempage";
                                                $result = $con->query($sql);
                                                while ($row = $result->fetch_assoc()) :
                                                ?>
                                                    <div class="col-xl-3 col-lg-4 col-md-4">
                                                        <div class="card my-2">
                                                            <img src="<?= $row['image_item'] ?>" class="card-img-top">
                                                            <div class="card-body">
                                                                <div class="card-title">
                                                                    <h5 class="text-center" style="display: block;overflow: auto;white-space: nowrap;"><?= $row['name_item'] ?></h5>
                                                                </div>
                                                                <div class="card-text">
                                                                    <p class="text-center">ราคา <?= $row['price_item'] ?> บาท</p>
                                                                    <?php if ($row['number_item'] == 0) { ?>
                                                                        <a class="btn btn-danger w-100">สินค้าหมด</a>
                                                                    <?php } else if (in_array($row['id_item'], $checkcart)) { ?>
                                                                        <a class="btn btn-warning w-100">มีสินค้าอยู่ในตะกร้า</a>
                                                                    <?php } else { ?>
                                                                        <a class="btn btn-success w-100" href="../php_action/buyitem.php?id_item=<?= $row['id_item'] ?>&action=addcart&page=<?= $page ?>">หยิบลงตะกร้าสินค้า</a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group me-2 my-2" role="group">
                                    <?php
                                    $checkpage_sql = "SELECT id_item FROM item";
                                    $checkpage_result = $con->query($checkpage_sql);
                                    $total_record = mysqli_num_rows($checkpage_result);
                                    $total_page = ceil($total_record / $limititempage);
                                    for ($i = 1; $i <= $total_page; $i++) { ?>
                                        <a type="button" class="btn btn-secondary mt-2" href='buyitem.php?page=<?= $i ?>'><?= $i ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5">
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h3 class="text-center">รายการสินค้าในตะกร้า</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php if(isset($_GET['message'])):?>
                                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                            <?= $_GET['message'] ?>
                                        </div>
                                        <?php endif ?>
                                        <input class="form-control" type="text" id="searchaddbarcode" onkeyup="autosearch(this.value,<?php echo $page ?>)" onkeypress="return checkenter(this.value,event,<?php echo $page ?>)" placeholder="ใส่ชื่อสินค้า หรือ รหัสบาร์โค้ดที่นี่ จากนั้นกด Enter">
                                        <div id="resultsearch">
                                            
                                        </div>
                                        <div class="table-responsive mt-2">
                                            <table class="table table-striped table-bordered">
                                                <thead>

                                                    <td>ลำดับ</td>
                                                    <td>ชื่อสินค้า</td>
                                                    <td>จำนวน</td>
                                                    <td>ราคา(ต่อชิ้น)</td>
                                                    <td>ราคารวม</td>
                                                    <td>ลบสินค้าในตะกร้า</td>
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
                                                            <td><input type="text" onchange="updatenumber_item(<?= $rowcart['id_item']?>,this.value,<?= $page ?>)" class="form-control w-100" value="<?= $rowcart['values_item'] ?>"></td>
                                                            <td><?= $rowcart['price_item'] ?> บาท</td>
                                                            <td><?= $rowcart['values_item'] * $rowcart['price_item'] ?> บาท</td>
                                                            <td><a class="btn btn-danger w-100" onclick="deletecart(<?= $rowcart['id_item'] ?>,<?= $page ?>)">ลบสินค้า</a></td>
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
                                                        <td><a class="btn btn-danger w-100" onclick="deleteallcart(<?= $page ?>)">นำออกทั้งหมด</a></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <?php if($i <= 1){?>
                                            <a class="btn btn-warning w-100" disabled>กรุณาเลือกสินค้า ก่อนทำรายการ</a>
                                        <?php }else{ ?>
                                        <a class="btn btn-success w-100" href="payment.php">ชำระเงิน</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
    </div>
    <script src='../js/ajax/buyitem.js'></script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>