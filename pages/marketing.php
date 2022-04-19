<!DOCTYPE html>
<html lang="en">

<head>
    <title>การตลาด</title>
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
                        <h2 class="text-center mt-3">สรุปภาพรวมธุรกิจทั้งหมด</h2>
                        <div class="card mt-3">
                            <div class="card-header">
                                ยอดขายรวมในแต่ละเดือน
                            </div>
                            <canvas id="profit" style="position: relative; height:65vh; width:150vh"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
                <div class="row mt-3 mb-4 h-75">
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                ช่องทางการชำระเงิน(รวมทั้งหมดที่เก็บได้)
                            </div>
                            <canvas id="transfer" style="position: relative; height:143vh; width:100vh"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                พนักงาน
                            </div>
                            <canvas id="staffs" style="position: relative; height:143vh; width:100vh"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                จำนวนสินค้าทั้งหมด
                            </div>
                            <canvas id="sumtoday" style="position: relative; height:70vh;" class="mb-3 mt-3"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
    </div>
    </main>
    </div>
    </div>
    <script src="../node_modules/chart.js/dist/chart.js"></script>
    <script>
        <?php require_once('../js/chart/marketing.php') ?>
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>