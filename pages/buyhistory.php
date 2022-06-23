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
                    <div class="col-xl-8 col-lg-8 col-md-8 mt-auto align-items-center justify-content-center">
                        <?php if(!isset($_GET['menu'])){?>
                        <div class="border border-danger border-3 rounded px-3 py-3 text-center">
                            <h3>เมนูสำหรับการค้นหาประวัติสั่งซื้อสินค้า</h3>
                            <button class="btn btn-primary w-100">การทำรายการล่าสุด</button>
                            <button class="btn btn-primary w-100 mt-2">ค้นหาสินค้าผ่านรหัส ยืนยันเลขที่</button>
                            <label></label>
                            <input type="text" name="" class="form-control w-100" placeholder="ใส่เลขที่รายการเท่านั้นไม่มีเว้นวรรคไม่มีตัวอักษร" id="">
                            <h3 class="mt-2">คำแนะนำ</h3>
                            <p>ตัวเลือก การทำรายการล่าสุดจะเห็นภายใน 24 ชั่วโมงเท่านั้น</p>
                            <p>ตัวเลือก ค้นหาสินค้าผ่านรหัสจะเห็นทั้งหมด ใช้กรณีหาไม่เจอ หรือ การทำรายการมีปัญหา</p>
                        </div>
                        <?php } ?>
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