<head>
    <title>หมายเลขคำสั่งซื้อ <?= $_GET['keyword'] ?></title>
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
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $keyword = $_GET['keyword'];
                        $sql = "SELECT * FROM history WHERE id_history = '$keyword'";
                        $result = $con->query($sql);
                        if ($result->num_rows == 0) :
                            echo "<h1 class='text-center'>ไม่พบรายการสินค้า<h1>";
                        endif;
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
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-2">

    </div>
    </div>
<?php
                            $taxsum = 0;
                        endwhile ?>
<script src="../js/ajax/buyhistory.js"></script>
<?php include('../php_action/scripts.php') ?>
</body>