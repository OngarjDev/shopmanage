<!DOCTYPE html>
<html lang="en">

<head>
    <title>หน้าหลัก</title>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="container-fluid">
                            <div class="row mt-2">

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header  text-white bg-success">จำนวนรายการที่คุณทำตลอด 1 เดือน</div>
                                        <div class="card-body bg-light">
                                            <?php
                                            require_once('../php_action/dbconnect.php');
                                            $year = date('Y');
                                            $month = date('m');
                                            $sql = "SELECT datetime_history FROM history WHERE id_staff = '$id_staff' AND (datetime_history BETWEEN '$year-$month-01' AND '$year-$month-31')";
                                            $result = $con->query($sql);
                                            $count = $result->num_rows;
                                            ?>
                                            <h5 class="card-title">ในเดือนนี้คุณทำรายการไป <?= $count ?> รายการ</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header text-white bg-success">จำนวนการเข้าทำงานตลอด 1 เดือน</div>
                                        <div class="card-body bg-light">
                                            <?php
                                            require_once('../php_action/dbconnect.php');
                                            $year = date('Y');
                                            $month = date('m');
                                            $sql = "SELECT datetime_note FROM note WHERE id_staff = '$id_staff'AND type_note = 'logout' AND (datetime_note BETWEEN '$year-$month-01' AND '$year-$month-31')";
                                            $result = $con->query($sql);
                                            $count = $result->num_rows;
                                            ?>
                                            <h5 class="card-title">ในเดือนนี้คุณเข้าสู่ระบบ <?= $count ?> ครั้ง</h5>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row mb-3">
                                <div class="col-xl-7 col-lg-7 col-md-7">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">ข่าวสาร</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="item-tab" data-bs-toggle="tab" data-bs-target="#item" type="button" role="tab" aria-controls="item" aria-selected="false">สินค้าที่ต้องตรวจสอบ</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <?php
                                        $sql = "SELECT title_News,content_News,major_News,datetime_News FROM news ORDER BY datetime_news DESC LIMIT 5";
                                        $result = $con->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <div class="card mb-3">
                                               <div class="card-header">
                                                   <?= $row['title_News'] ?>
                                               </div>
                                               <div class="card-body">
                                                   <h5 class="card-title"><?= $row['content_News'] ?></h5>
                                                   <p class="card-text">ความสำคัญ : <?php if($row['major_News'] == 1){ echo"สำคัญ"; }else{ echo"ทั่วไป";}?> , วันที่ลงข่าวสาร : <?= $row['datetime_News']?></p>
                                               </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="tab-pane fade" id="item" role="tabpanel" aria-labelledby="item-tab">
                                        <?php
                                            $sql = "SELECT name_item,number_item,barcode FROM item WHERE number_item < 10 LIMIT 20";
                                            $result = $con->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <?= $row['name_item'] ?>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">จำนวนคงเหลือ <?= $row['number_item'] ?> ชิ้น</h5>
                                                        <p class="card-text">รหัสบาร์โค้ด <?= $row['barcode'] ?></p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="card mt-2">
                                        <div class="card-header bg-success text-white">
                                            <h3 class="text-center mt-3">ประวัติการทำรายการล่าสุดของคุณ</h3>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            require_once('../php_action/dbconnect.php');
                                            $sql = "SELECT name_item,values_item,id_history FROM history WHERE id_staff = '$id_staff' ORDER BY datetime_history DESC LIMIT 3";
                                            $result = $con->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                                $name_item = explode(',', $row['name_item']);
                                                $number_item = explode(',', $row['values_item']);
                                                $count = count($name_item);
                                            ?>
                                                <h3 class="text-center mt-2" onclick="window.location.href = 'buyhistory.php?#<?= $row['id_history'] ?>r'">หมายเลขคำสั่งซื้อ <?= $row['id_history'] ?></h3>
                                                <div class="container-fluid">
                                                    <div class="row" onclick="window.location.href = 'buyhistory.php?#<?= $row['id_history'] ?>r'">
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <h5 class="text-primary">ชื่อสินค้า</h5>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <h5 class="text-end text-primary">จำนวน</h5>
                                                        </div>
                                                    </div>
                                                    <?php for ($i = 0; $i < $count; $i++) : ?>
                                                        <div class="row">
                                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                                <p><?= $name_item[$i] ?></p>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                                <p class="text-end"><?= $number_item[$i] ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endfor ?>
                                                </div>
                                            <?php } ?>
                                            <p class="text-center text-secondary mt-3">คุณสามารถดูรายละเอียดเพิ่มเติ่มได้ที่ ประวัติการซื้อสินค้า</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script src="../node_modules/chart.js/dist/chart.js"></script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>