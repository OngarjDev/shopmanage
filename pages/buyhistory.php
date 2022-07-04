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
                        <?php if (isset($_GET['menu'])) { ?>
                            <ul class="nav nav-tabs">
                                <?php
                                switch($_GET['active_menu']){
                                //case "true":
                                    
                                
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">ประวัติการซื้อสินค้า</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">ประวัติไม่ได้รับการยืนยัน</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">ประวัติที่ได้รับการยืนยัน</a>
                                </li>
                            </ul>
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