<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ค้นหาขั้นสูง</title>
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
            <div class="container">
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="card mt-3">
                            <div class="card-body">
                                <form method="GET" action="">
                                    <input type="text" name="keyword" class="form-control text-center" placeholder="กรอกข้อมูลที่นี่เพื่อค้นหาข้อมูลทั้งหมด" id="">
                                    <input type="submit" class="btn btn-primary mt-2 w-100" value="ค้นหาข้อมูล">
                                </form>
                            </div>
                        </div>
                        <h1 class="text-center mt-3">คำค้นหาของคุณคือ <?= $_GET['keyword']; ?></h1>
                    <h4>ผลลัพธ์เกี่ยวกับสินค้า</h4>
                    <h4>ผลลัพธ์เกี่ยวกับข่าวสาร</h4>
                    <h4>ผลลัพธ์เกี่ยวกับประวัติการสั่งซื้อ</h4>
                    <h4>ผลลัพธ์เกี่ยวกับหมวดหมู่สินค้า</h4>
                    <h4>ผลลัพธ์เกี่ยวกับพนักงาน</h4>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>