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
                        </div>

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