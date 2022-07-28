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
                    <div class="col-xl-2 col-lg-2 col-md-2">

                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <?php if (!isset($_GET['menu'])) { ?>
                            <div class="border border-light border-3 rounded px-3 py-3 text-center">
                                <h3>เมนูสำหรับการค้นหาประวัติสั่งซื้อสินค้า</h3>
                                <a class="btn btn-primary w-100" href="../php_action/buyhistory.php?action=gonowhistory">การทำรายการล่าสุด</a>
                                <button class="btn btn-primary w-100 mt-2" onclick="showsearch()" id="btn_search">ค้นหาสินค้าผ่านรหัส ยืนยันเลขที่</button>
                                <div class="mt-2" id="input_search" hidden>
                                    <label>กรอกเฉพาะเลขรหัสเท่านั้น</label>
                                    <form action="searchhistory.php" method="get">
                                    <input type="text" name="keyword" class="form-control w-100" placeholder="ใส่เลขที่รายการเท่านั้นไม่มีเว้นวรรคไม่มีตัวอักษร">
                                    <input type="submit" class="btn btn-success mt-2 w-100" value="ค้นหา">
                                </form>
                                </div>
                                <h3 class="mt-2">คำแนะนำ</h3>
                                <p>ตัวเลือก การทำรายการล่าสุดจะเห็นภายใน 24 ชั่วโมงเท่านั้น</p>
                                <p>ตัวเลือก ค้นหาสินค้าผ่านรหัสจะเห็นทั้งหมด ใช้กรณีหาไม่เจอ หรือ การทำรายการมีปัญหา</p>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['menu'])) : ?>
                            <?php
                            require_once('../php_action/dbconnect.php');
                            $limititempage = 6; //จำกัดการแสดงผล 6 ต่อ 1 หน้า
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }
                            $start = ($page - 1) * $limititempage;

                            $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' AND datetime_history > (NOW() -INTERVAL 1 DAY) ORDER BY id_history DESC LIMIT $start,$limititempage";
                            $result = $con->query($sql);
                            while ($row = $result->fetch_assoc()) :
                                if ($row['transfer_history'] == 'cash') {
                                    $transfer = 'เงินสด';
                                }
                                if ($row['transfer_history'] == 'bank') {
                                    $transfer = 'โอนผ่านบัญชีธนาคาร';
                                }
                            ?>
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-9">
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

                                                        $multiply = [];
                                                        for ($i = 0; $i <= $num_table; $i++) { // สูตรคำนวณราคาสินค้า คือ ราคาสินค้า * จำนวนสินค้า = $multiply
                                                            array_push($multiply, $price_table[$i] * $values_table[$i]);
                                                        }

                                                        for ($i = 0; $i < $num_table; $i++) { ?>
                                                            <tr>
                                                                <td><?= $i + 1 ?></td>
                                                                <td class="text-break"><?= $name_table[$i] ?></td>
                                                                <td class="text-break"><?= $values_table[$i] ?></td>
                                                                <td class="text-break text-center"><?= $price_table[$i] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        <?php if ($row['tax_setting'] == 1) {
                                                            $taxsum = round(array_sum($multiply) * 7 / 100);
                                                        ?>
                                                            <tr>
                                                                <td colspan="3" class="text-center">ภาษีมูลค่าเพิ่ม(7%) <?= $taxsum ?> บาท</td>
                                                                <td colspan="3" class="text-center">ราคาสินค้าเดิม <?= array_sum($multiply) ?> บาท</td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr>
                                                            <td colspan="2">รวมทั้งหมด : <?= $num_table ?> รายการ</td>
                                                            <td><?php echo array_sum($values_table) ?> ชิ้น</td>
                                                            <td class="text-center"><?= array_sum($multiply) + $taxsum ?> บาท</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card-body">
                                                <h5 class="card-title">หมายเลขคำสั่งซื้อที่ : <?= $row['id_history'] ?></h5>
                                                <p class="card-text">ช่องทางการชำระเงิน : <?= $transfer ?></p>
                                                <p class="card-text"><small class="text-muted"><?= $row['datetime_history'] ?></small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <?php
                                        if ($row['transfer_history'] == "bank" && $row['transfer_history'] != "cash" && $row['image_history'] == 0) { ?>
                                            <button type="button" class="btn btn-primary" onclick="ageen(this.value)" value="<?php echo $row['id_history'] ?>">ยืนยันการชำระเงิน</button>
                                        <?php }
                                        if ($row['transfer_history'] == "bank" && $row['transfer_history'] != "cash" && $row['image_history'] != 0) { ?>
                                            <a type="button" class="btn btn-primary" href="<?= $row['image_history'] ?>">ตรวจสอบหลักฐานการชำระเงิน</a>
                                        <?php }
                                        if ($row['tax_setting'] == 1) :
                                        ?>
                                            <a class="btn btn-warning" href="addcustomertax.php?id_history=<?= $row['id_history'] ?>">ใบเสร็จชำระเงินแบบเต็ม</a>
                                            <a type="button" class="btn btn-success" href="../pdfprint/payment_receipt.php?id_history=<?= $row['id_history'] ?>">ใบเสร็จชำระเงินแบบย่อ</a>
                                        <?php else : ?>
                                            <a type="button" class="btn btn-success" href="../pdfprint/payment_notax.php?id_history=<?= $row['id_history'] ?>">ใบเสร็จรับเงิน</a>
                                        <?php endif
                                        ?>
                                    </div>
                                    <form method="POST" action="../php_action/buyhistory.php" class="mt-2" enctype="multipart/form-data" id="<?php echo $row['id_history'] ?>" hidden>
                                        <input type="hidden" name="id_history" value="<?php echo $row['id_history'] ?>">
                                        <input type="hidden" name="action" value="image">
                                        <input type="file" class="form-control" name="image" required>
                                        <input type="submit" value="ยืนยันการชำระเงินด้วยธนาคาร" class="btn btn-primary mt-2 w-100">
                                        <p class="text-center">รับรองรับชนิดรูปภาพ 'jpeg','png' เท่านั้น</p>
                                    </form>
                                </div>
                            <?php 
                            $taxsum = 0;
                            endwhile ?>
                            <div class="btn-group me-2 my-2" role="group">
                                <?php
                                $checkpage_sql = "SELECT id_history FROM history WHERE id_staff = '$id_staff' AND datetime_history > (NOW() -INTERVAL 1 DAY) ORDER BY id_history";
                                $checkpage_result = $con->query($checkpage_sql);
                                $total_record = mysqli_num_rows($checkpage_result);
                                $total_page = ceil($total_record / $limititempage);
                                for ($i = 1; $i <= $total_page; $i++) { ?>
                                    <a type="button" class="btn btn-secondary mt-2" href='buyhistory.php?menu=true&page=<?= $i ?>'><?= $i ?></a>
                                <?php } ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2">
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