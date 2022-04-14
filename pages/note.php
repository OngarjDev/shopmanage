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
                                </form>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <?php
                                require_once('../php_action/connect.php');
                                if($_SESSION['dataselect'] == 'login-logoutstaff'){
                                $sql = "SELECT * FROM note WHERE type_note = 'login-logoutstaff'";
                                }
                                if($_SESSION['dataselect'] == 'login-logoutstaff'){
                                    $sql = "SELECT * FROM note WHERE type_note = 'login-logoutstaff'";
                                }
                                ?>
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