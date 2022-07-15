<!DOCTYPE html>
<html lang="en">

<head>
    <title>ตั้งค่าร้านค้า</title>
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
                <p class="text-danger text-center mt-2">คำแนะนำ : การแก้ไขค่าใหม่ควรทำในตอนที่ยังไม่เริ่มการขาย เพื่อลดความผิดพลาดจากระบบ</p>
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1">

                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="card mt-2">
                            <div class="card-header">
                                การตั้งค่าส่วนคนขาย
                            </div>
                            <div class="card-body">
                                <table class="table-responsive table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">ยืนยันการใช้งาน</th>
                                            <th scope="col">รายละเอียด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once("../php_action/dbconnect.php");
                                        $sql = "SELECT * FROM settings";
                                        $result = $con->query($sql);
                                        while($row = $result->fetch_assoc()):
                                        ?>
                                        <tr>
                                        <th scope="row">
                                            <?php if($row['action_setting'] == 1){?>
                                                <input class="form-check-input" type="checkbox" checked onchange="changesetting(<?= $row['id_setting']?>,<?= $row['action_setting']?>)">
                                            <?php } else{?>
                                                <input class="form-check-input" type="checkbox" onchange="changesetting(<?= $row['id_setting']?>,<?= $row['action_setting']?>)">
                                            <?php } ?>
                                        </th>
                                            <td>เปิดการใช้ระบบจัดเก็บภาษี 7 % (หากติ๊กระบบจะเก็บภาษี)</td>
                                        </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1">

                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../js/ajax/settings.js"></script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>