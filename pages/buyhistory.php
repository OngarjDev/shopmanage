<!DOCTYPE html>
<html lang="en">

<head>
    <title>ประวัติการซื้อสินค้า</title>
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
            <div class="container-xxl">
                <div class="row mt-2">
                    <div class="col-xl-4 col-lg-4 col-md-3">
                        <div class="card mt-2">
                            <div class="card-body">
                                <h3 class="text-center mt-2">รหัสบาร์โค้ดกำกับใบเสร็จชำระเงิน</h3>
                                <input type="text" class="form-control" id="search" onkeypress="return checkbarcode(event)" placeholder="ใส่หมายเลขใบเสร็จชำระเงินหรือหมายเลขคำสั่งซื้อ">
                                <?php if ($_SESSION['order'] == 'confirm') { ?>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" value="comfirm" id="checkboxorder" onclick="confirmorder(this.value)" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            แสดงเฉพาะสินค้าที่ยืนยันเรียบร้อย
                                        </label>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" value="uncomfirm" id="checkboxorder" onclick="confirmorder(this.value)">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            แสดงเฉพาะสินค้าที่ยืนยันเรียบร้อย
                                        </label>
                                    </div>
                                <?php } ?>
                                <button class="btn btn-primary mt-2 w-100" onclick="search()">ค้นหารหัสใบเสร็จ</button>
                            </div>
                        </div>
                        <div class="card mt-2" id="result-hidden" hidden>
                            <div class="card-body">
                                <div id="result">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-9">
                        <?php
                        require('../php_action/dbconnect.php');
                        session_start();
                        if ($_SESSION['order'] == 'confirm') {
                            $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' AND image_history != '0' ORDER BY id_history DESC";
                        } else {
                            $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' ORDER BY id_history DESC";
                        }
                        $result = $con->query($sql);
                        ?>
                        <h1 class="text-center mt-3">ประวัติชำระสินค้า</h1>
                        <div class="card">
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-7 col-md-6">
                                        <div class="card-body" id="<?= $row['id_history'] ?>r">
                                            <h5 class="card-title mt-2">หมายเลขคำสั่งซื้อ : <?= $row['id_history'] ?></h5>
                                            <p class="card-text">ช่องทางการรับเงิน : <?= $row['transfer_history'] ?><br>
                                                <?php if ($row['transfer_history'] == 'cash') { ?>
                                                    จำนวนเงินที่ได้รับ : <?= $row['income_history'] ?><br>
                                                <?php } ?>
                                                ราคารวม : <?= $row['money_history'] ?>
                                                <?php if ($row['image_history'] != 0 && $row['transfer_history'] != 'cash') { ?>
                                            <p class="text-success fw-bolder">สถานะการชำระเงิน : ยืนยันเรียบร้อย
                                            <p>
                                            <?php } ?>
                                            </p>
                                            <?php
                                            $datetime = explode(" ", $row['datetime_history']);
                                            ?>
                                            <p class="card-text"><small class="text-muted">วันที่ซื้อสินค้า : <?= $datetime[0] ?><br>เวลาที่ซื้อสินค้า : <?= $datetime[1] ?> (เวลา ประเทศไทย)<br>รหัสกำกับใบชำระเงิน : <?= $row['pin_history'] ?></small></p>
                                            <?php if ($row['image_history'] == 0 && $row['transfer_history'] != 'cash') { ?>
                                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                                    <button type="button" onclick="window.location.href = 'pdfprint.php?noworder=<?php echo $row['id_history'] ?>&transfer=<?php echo $row['transfer_history'] ?>'" class="btn btn-primary">ตราจสอบใบเสร็จ</button>
                                                    <button type="button" onclick="ageen(this.value)" value="<?php echo $row['id_history'] ?>" class="btn btn-primary">ยืนยันการชำระเงิน</button>
                                                </div>
                                                <form method="POST" action="../php_action/buyhistory.php" class="mt-2" enctype="multipart/form-data" id="<?php echo $row['id_history'] ?>" hidden>
                                                    <input type="hidden" name="id_history" value="<?php echo $row['id_history'] ?>">
                                                    <input type="hidden" name="action" value="image">
                                                    <input type="file" class="form-control" name="image" required>
                                                    <input type="submit" value="ยืนยันการชำระเงินด้วยธนาคาร" class="btn btn-primary mt-2 w-100">
                                                    <label>รับรองรับชนิดรูปภาพ 'jpeg','png' เท่านั้น</label>
                                                </form>
                                            <?php } else { ?>
                                                <button type="button" onclick="window.location.href = 'pdfprint.php?noworder=<?php echo $row['id_history'] ?>&transfer=<?php echo $row['transfer_history'] ?>'" class="btn btn-primary w-100">ตราจสอบใบเสร็จ</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-5 col-md-6">
                                        <div class="card-body table-responsive">
                                            <table class="table rounded-3 table-striped">
                                                <thead class="bg-secondary text-light">
                                                    <tr>
                                                        <td>รายการที่</td>
                                                        <td>ชื่อสินค้า</td>
                                                        <td>จำนวน</td>
                                                        <td>ราคาสินค้า(ต่อชิ้น)</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $name_table = explode(",", $row['name_item']);
                                                    $values_table = explode(",", $row['values_item']);
                                                    $price_table = explode(",", $row['price_item']);
                                                    $num_table = count($name_table);
                                                    for ($i = 0; $i < $num_table; $i++) { ?>
                                                        <tr>
                                                            <td><?= $i + 1 ?></td>
                                                            <td class="text-break"><?= $name_table[$i] ?></td>
                                                            <td class="text-break"><?= $values_table[$i] ?></td>
                                                            <td class="text-break"><?= $price_table[$i] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="3">ทั้งหมด : <?= $i ?> รายการ</td>
                                                        <td colspan="2">ราคาทั้งหมด : <?= $row['money_history'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script src="../js/ajax/buyhistory.js"></script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>