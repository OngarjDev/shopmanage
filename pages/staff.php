<<<<<<< HEAD
<!DOCTYPE html>
<html lang="th">

<head>
    <title>พนักงานทั้งหมด</title>
    <?php
    require('../php_action/classcheck.php');
    $check = new check();
    $check->securearea();
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
            <div id="alert">
            </div>
            <div class="container-xl">
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="card mt-2 bg-light">
                            <div class="card-body">
                                <h3 class="text-center">ตัวกรอง พนักงาน</h3>
                                <input type="search" name="" class="form-control" id="searchstaff" placeholder="ชื่อพนักงาน-นามสกุล,รหัสพนักงาน  อย่างใดอย่างหนึ่ง">
                                <button class="btn btn-primary mt-2 w-100" onclick="search()">ค้นหาพนักงาน</button>
                                <div id="datasearch">

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mt-2 table-bordered table-striped text-center">
                                <tr class="fw-bolder table-info">
                                    <td>รหัสพนักงาน</td>
                                    <td>ชื่อพนักงาน</td>
                                    <td>นามสกุล</td>
                                    <td>วันที่-เวลาสร้างบัญชี</td>
                                    <td>ระดับสิทธิ</td>
                                    <td>จัดการผู้ใช้</td>
                                </tr>
                                <?php
                                require_once('../php_action/dbconnect.php');
                                $sql = "SELECT * FROM staff";
                                $result = $con->query($sql);
                                $row_num = $result->num_rows;
                                for ($i = 0; $i < $row_num; $i++) :
                                    $row = $result->fetch_assoc();
                                ?>
                                    <tr id="<?= $row['id_staff']?>">
                                        <td><?= $row['number_staff'] ?></td>
                                        <td><?= $row['fname_staff'] ?></td>
                                        <td><?= $row['lname_staff'] ?></td>
                                        <td><?= $row['date_staff'] ?></td>
                                        <?php if ($row['admin'] == 1) { ?>
                                            <td>ผู้จัดการ</td>
                                        <?php } else { ?>
                                            <td>พนักงาน</td>
                                        <?php } ?>
                                        <td>
                                            <div class="btn-group w-100" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-success" onclick="resetpassword(this.value)" value="<?= $row['id_staff'] ?>">รีเซ็ตรหัสผ่าน</button>
                                                <?php if($row['statusstaff'] == 1){?>
                                                    <button type="button" class="btn btn-warning" onclick="unsuspend(this.value)" value="<?= $row['id_staff'] ?>">ยกเลิกถูกพักบัญชี</button>
                                                <?php }else{?>
                                                    <button type="button" class="btn btn-warning" onclick="suspend(this.value)" value="<?= $row['id_staff'] ?>">พักบัญชี</button>
                                                <?php }?>
                                                <button type="button" class="btn btn-danger" onclick="deletestaff(this.value)" value="<?= $row['id_staff'] ?>">ลบบัญชีถาวร</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endfor ?>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
        </main>
    </div>
    </div>
    <script src="../js/ajax/staff.js"></script>
    <?php include('../php_action/scripts.php') ?>
</body>

=======
<!DOCTYPE html>
<html lang="th">

<head>
    <title>พนักงานทั้งหมด</title>
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
            <div id="alert">
            </div>
            <div class="container-xl">
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="card mt-2 bg-light">
                            <div class="card-body">
                                <h3 class="text-center">ตัวกรอง พนักงาน</h3>
                                <input type="search" name="" class="form-control" id="searchstaff" placeholder="ชื่อพนักงาน-นามสกุล,รหัสพนักงาน  อย่างใดอย่างหนึ่ง">
                                <button class="btn btn-primary mt-2 w-100" onclick="search()">ค้นหาพนักงาน</button>
                                <div id="datasearch">

                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mt-2 table-bordered table-striped text-center">
                                <tr class="fw-bolder table-info">
                                    <td>รหัสพนักงาน</td>
                                    <td>ชื่อพนักงาน</td>
                                    <td>นามสกุล</td>
                                    <td>วันที่-เวลาสร้างบัญชี</td>
                                    <td>ระดับสิทธิ</td>
                                    <td>จัดการผู้ใช้</td>
                                </tr>
                                <?php
                                require_once('../php_action/dbconnect.php');
                                $sql = "SELECT * FROM staff";
                                $result = $con->query($sql);
                                $row_num = $result->num_rows;
                                for ($i = 0; $i < $row_num; $i++) :
                                    $row = $result->fetch_assoc();
                                ?>
                                    <tr id="<?= $row['id_staff']?>">
                                        <td><?= $row['number_staff'] ?></td>
                                        <td><?= $row['fname_staff'] ?></td>
                                        <td><?= $row['lname_staff'] ?></td>
                                        <td><?= $row['date_staff'] ?></td>
                                        <?php if ($row['admin'] == 1) { ?>
                                            <td>ผู้จัดการ</td>
                                        <?php } else { ?>
                                            <td>พนักงาน</td>
                                        <?php } ?>
                                        <td>
                                            <div class="btn-group w-100" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-success" onclick="resetpassword(this.value)" value="<?= $row['id_staff'] ?>">รีเซ็ตรหัสผ่าน</button>
                                                <?php if($row['statusstaff'] == 1){?>
                                                    <button type="button" class="btn btn-warning" onclick="unsuspend(this.value)" value="<?= $row['id_staff'] ?>">ยกเลิกถูกพักบัญชี</button>
                                                <?php }else{?>
                                                    <button type="button" class="btn btn-warning" onclick="suspend(this.value)" value="<?= $row['id_staff'] ?>">พักบัญชี</button>
                                                <?php }?>
                                                <button type="button" class="btn btn-danger" onclick="deletestaff(this.value)" value="<?= $row['id_staff'] ?>">ลบบัญชีถาวร</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endfor ?>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
        </main>
    </div>
    </div>
    <script src="../js/ajax/staff.js"></script>
    <?php include('../php_action/scripts.php') ?>
</body>

>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
</html>