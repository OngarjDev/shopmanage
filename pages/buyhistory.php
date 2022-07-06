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
                                    <input type="text" id="" class="form-control w-100" placeholder="ใส่เลขที่รายการเท่านั้นไม่มีเว้นวรรคไม่มีตัวอักษร">
                                    <button class="btn btn-primary w-100 mt-1">ยืนยันการค้นหา</button>
                                </div>
                                <h3 class="mt-2">คำแนะนำ</h3>
                                <p>ตัวเลือก การทำรายการล่าสุดจะเห็นภายใน 24 ชั่วโมงเท่านั้น</p>
                                <p>ตัวเลือก ค้นหาสินค้าผ่านรหัสจะเห็นทั้งหมด ใช้กรณีหาไม่เจอ หรือ การทำรายการมีปัญหา</p>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['menu'])) : ?>
                            <?php
                            require_once('../php_action/dbconnect.php');
                            $limititempage = 6; //จำกัดการแสดงผล 12 ชิ้นต่อ 1 หน้า
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }
                            $start = ($page - 1) * $limititempage;

                            $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' AND datetime_history > (NOW() -INTERVAL 1 DAY) ORDER BY id_history DESC LIMIT $start,$limititempage";
                            $result = $con->query($sql);
                            while ($row = $result->fetch_assoc()) :
                            ?>
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-9">
                                            <img src="..." class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card-body">
                                                <h5 class="card-title">หมายเลขคำสั่งซื้อที่ <?= $row['id_history'] ?></h5>
                                                <p class="card-text"></p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <?php
                                        if ($row['transfer_history'] == "bank" && $row['transfer_history'] != "cash" && $row['image_history'] == 0) { ?>
                                            <button type="button" class="btn btn-primary">ยืนยันการชำระเงิน</button>
                                        <?php }
                                        if ($row['transfer_history'] == "bank" && $row['transfer_history'] != "cash" && $row['image_history'] != 0) { ?>
                                            <button type="button" class="btn btn-primary">ตรวจสอบหลักฐานการชำระเงิน</button>
                                        <?php } ?>
                                        <button type="button" class="btn btn-warning">ใบเสร็จชำระเงินแบบเต็ม</button>
                                        <button type="button" class="btn btn-success">ใบเสร็จชำระเงินแบบย่อ</button>
                                    </div>
                                </div>
                            <?php endwhile ?>
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