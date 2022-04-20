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

                                        <?php if ($_SESSION['dataselect'] == 'historyadditem') { ?>
                                            <option value="historyadditem" selected>ดูประวัติการเพิ่มสินค้าทั้งหมด</option>
                                        <?php } else { ?>
                                            <option value="historyadditem">ดูประวัติการเพิ่มสินค้าทั้งหมด</option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="action" value="selectdata">
                                    <button class="btn btn-warning mt-3 w-100" type="submit">ค้นหาข้อมูลทั้งหมด</button>
                                    <p class="text-center text-danger mt-3">โปรดทราบข้อมูลทั้งหมด มีอายุประมาณ 1 เดือน</p>
                                </form>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                require_once('../php_action/dbconnect.php');
                                ?>
                                <?php
                                if ($_SESSION['dataselect'] == 'login-logoutstaff' || $_SESSION['dataselect'] == null) :
                                    $sql_data = "SELECT * FROM note WHERE type_note = 'logout' ORDER BY id_note DESC";
                                ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">ชื่อพนักงาน</th>
                                                <th scope="col">เวลาเข้าสู่ระบบ</th>
                                                <th scope="col">เวลาออกจากระบบ</th>
                                                <th scope="col">เวลาที่บันทึก</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result_data = $con->query($sql_data);
                                            while ($row_data = $result_data->fetch_assoc()) {
                                                $datesum = explode("//", $row_data['content_note']);
                                            ?>
                                                <tr>
                                                    <td><?php echo $row_data['name_staff']; ?></td>
                                                    <td><?php echo $datesum[0] ?></td>
                                                    <td><?php echo $datesum[1] ?></td>
                                                    <td><?php echo $row_data['datetime_note']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php endif ?>
                                <?php if ($_SESSION['dataselect'] == 'historyadditem') :
                                    $sql_data = "SELECT * FROM note WHERE type_note = 'additem' ORDER BY id_note DESC";
                                ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">ชื่อพนักงาน</th>
                                                <th scope="col">ชื่อสินค้า</th>
                                                <th scope="col">จำนวนสินค้าเดิม</th>
                                                <th scope="col">จำนวนสินค้าที่เพิ่ม</th>
                                                <th scope="col">รวม</th>
                                                <th scope="col">วันที่-เวลาบันทึก</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result_data = $con->query($sql_data);
                                            while ($row_data = $result_data->fetch_assoc()) {
                                                $datasum = explode("-", $row_data['content_note']);
                                            ?>
                                                <tr>
                                                    <td><?= $row_data['name_staff']; ?></td>
                                                    <td><?= $datasum[0] ?></td>
                                                    <td><?= $datasum[2] ?></td>
                                                    <td><?= $datasum[1] ?></td>
                                                    <td><?= $datasum[1] + $datasum[2] ?></td>
                                                    <td><?= $row_data['datetime_note']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php endif ?>
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