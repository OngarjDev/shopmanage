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
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h3 class="card-title text-center mt-2">จำนวนสินค้าที่มีอยู่ในระบบ</h3>
                                        </div>
                                        <canvas id="sumtoday" style="position: relative; height:70vh;"></canvas>
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
                                                <h3 class="text-center mt-2">หมายเลขคำสั่งซื้อ <?= $row['id_history'] ?></h3>
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
        const ctxstaff = document.getElementById('sumtoday');
        const Chartstaff = new Chart(ctxstaff, {
            type: 'doughnut',
            data: {
                label:'จำนวนสินค้าที่มีอยู่',
                <?php
                require_once('../php_action/dbconnect.php');
                $sql = "SELECT name_item,number_item FROM item";
                $result = $con->query($sql);
                $name_item = array();
                $number_item = array();
                while($row = $result->fetch_assoc()){
                    array_push($name_item,$row['name_item']);
                    array_push($number_item,$row['number_item']);
                }
                ?>
                datasets: [{
                    data: [<?php foreach($number_item as $values){ echo $values.',';}?>],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    borderWidth: 1
                }],
                labels: [<?php foreach($name_item as $name){ echo "'".$name."'".',';}?>],
            },
            hoverOffset: 4
        });
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>