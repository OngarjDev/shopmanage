<!DOCTYPE html>
<html lang="en">

<head>
    <title>บันทึก</title>
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
                        <div class="card mt-2">
                            <div class="card-body border border-primary rounded">
                                <h3 class="text-center">ค้นหารายละเอียดในระบบบันทึก</h3>
                                <form action="../php_action/note.php" method="GET">
                                    <select class="form-select" name="dataselect">
                                        <?php
                                        session_start();
                                        if ($_SESSION['dataselect'] == 'login-logoutstaff') { ?>
                                            <option value="login-logoutstaff" selected>ข้อมูลการเข้า-ออก ของพนักงาน</option>
                                        <?php } else { ?>
                                            <option value="login-logoutstaff">ข้อมูลการเข้า-ออก ของพนักงาน</option>
                                        <?php } ?>

                                        <?php if ($_SESSION['dataselect'] == 'historybuy') { ?>
                                            <option value="historybuy" selected>ดูประวัติการชำระเงินทั้งหมด</option>
                                        <?php } else { ?>
                                            <option value="historybuy">ดูประวัติการชำระเงินทั้งหมด</option>
                                        <?php } ?>

                                        <?php if ($_SESSION['dataselect'] == 'historyadditem') { ?>
                                            <option value="historyadditem" selected>ดูประวัติการเพิ่มสินค้าทั้งหมด</option>
                                        <?php } else { ?>
                                            <option value="historyadditem">ดูประวัติการเพิ่มสินค้าทั้งหมด</option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="action" value="selectdata">
                                    <button class="btn btn-warning mt-3 w-100" type="submit">ค้นหาข้อมูลทั้งหมด</button>
                                </form>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <?php
                                require_once('../php_action/dbconnect.php');
                                $sql = "SELECT * FROM note WHERE id_staff = '" . $_SESSION['id_staff'] . "' AND type_note = 'logout' ORDER BY id_note DESC";
                                if (isset($_SESSION['dataselect'])) {
                                    if ($_SESSION['dataselect'] == 'historybuy') {
                                        $sql = "SELECT * FROM history WHERE id_staff = '" . $_SESSION['id_staff'] . "' ORDER BY id_history DESC";
                                    } else if ($_SESSION['dataselect'] == 'historyadditem') {
                                        $sql = "SELECT * FROM note WHERE id_staff = '" . $_SESSION['id_staff'] . "' AND type_note = 'additem' ORDER BY id_note DESC";
                                    }
                                }
                                $result = $con->query($sql);
                                ?>
                                <?php if ($_SESSION['dataselect'] == 'historyadditem' || $_SESSION['dataselect'] == 'login-logoutstaff' || $_SESSION['dataselect'] == null) { ?>
                                    <?php //รอแยก เข้า ออก กับ เพิ่มสินค้า 
                                    ?>
                                    $result = $con->query($sql);
                                    <h3>historyadditem</h3>
                                    <?php
                                } else if ($_SESSION['dataselect'] == 'historybuy') {
                                    $result = $con->query($sql);
                                    while ($row_historybuy = $result->fetch_assoc()) {
                                        $name_all = explode(',', $row_historybuy['name_item']);
                                        $price_all = explode(',', $row_historybuy['price_item']);
                                    ?>
                                        <h3 class="text-center mt-2">รายการสั่งซื้อ <?= $row_historybuy['id_history'] ?></h3>
                                        <div class="container-fuild">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <h2>ชื่อสินค้า</h2>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <h2 class="text-end">ราคาสินค้า</h2>
                                                </div>
                                            </div>

                                            <?php for ($i = 0; $i < count($name_all); $i++) { ?>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                        <h5><?= $name_all[$i] ?></h5>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                        <h5 class="text-end me-5"><?= $price_all[$i] ?> บาท</h5>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <hr>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
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