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
                                            $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' AND (datetime_history BETWEEN '$year-$month-01' AND '$year-$month-31')";
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
                                            $sql = "SELECT * FROM note WHERE id_staff = '$id_staff'AND type_note = 'logout' AND (datetime_note BETWEEN '$year-$month-01' AND '$year-$month-31')";
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
                                    <div class="card">
                                        <canvas id="sumtoday" style="position: relative; height:75vh;"></canvas>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-center mt-3">ประวัติการทำรายการล่าสุดของคุณ</h3>
                                            <hr>
                                            <?php
                                            require_once('../php_action/dbconnect.php');
                                            $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' ORDER BY datetime_history DESC LIMIT 3";
                                            $result = $con->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                                $name_item = explode(',', $row['name_item']);
                                                $number_item = explode(',', $row['values_item']);
                                                $count = count($name_item);
                                            ?>
                                                <h3 class="text-center">หมายเลขคำสั่งซื้อ <?= $row['id_history'] ?></h3>
                                                <div class="container-fluid">
                                                    <div class="row">
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
    <script>
        const ctxtransfer = document.getElementById('sumtoday');
        const Charttransfer = new Chart(ctxtransfer, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'ช่องทางชำระเงิน',
                    <?php
                    require_once('../php_action/dbconnect.php');
                    date_default_timezone_set("Asia/Bangkok");
                    $month = date('m');
                    $year = date('Y');
                    $number_date = [];
                    $data = [];
                    for ($i = 0; $i < 31; $i++) {
                        $sql = "SELECT * FROM note WHERE (YEAR(datetime_note) = '$year') AND (MONTH(datetime_note) = '$month') AND (DAY(datetime_note) = '$i') AND id_staff = '$id_staff' AND type_note = 'logout'";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc();
                        array_push($number_date, $result->num_rows);
                        array_push($data, 'วันที่ ' . $i + 1);
                    }
                    ?>
                    data: [<?php for($i=0;$i < 31;$i++){if($i == 30){echo "'".$number_date[$i]."'" ;}else{echo "'".$number_date[$i]."'" . ',';}}?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }],
                labels: [<?php for($i=0;$i < 31;$i++){if($i == 30){echo "'".$data[$i]."'" ;}else{echo "'".$data[$i]."'" . ',';}}?>],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>