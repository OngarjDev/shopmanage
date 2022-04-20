<?php

use Picqer\Barcode\Barcode;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ค้นหาขั้นสูง</title>
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
                        <div class="card mt-3">
                            <div class="card-body">
                                <form method="GET" action="">
                                    <input type="text" name="keyword" class="form-control text-center" placeholder="กรอกข้อมูลที่นี่เพื่อค้นหาข้อมูลทั้งหมด" id="" required>
                                    <input type="submit" class="btn btn-primary mt-2 w-100" value="ค้นหาข้อมูล">
                                </form>
                            </div>
                        </div>
                        <h1 class="text-center mt-3">คำค้นหาของคุณคือ <?= $_GET['keyword']; ?></h1>

                        <h4 class="mt-3">ผลลัพธ์เกี่ยวกับสินค้า</h4>
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $sql = "SELECT * FROM item WHERE name_item LIKE '%$_GET[keyword]%' OR barcode LIKE '%$_GET[keyword]%' OR group_item LIKE '%$_GET[keyword]%' OR brand_item LIKE '%$_GET[keyword]%' LIMIT 5";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                        ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered border-info">
                                        <thead>
                                            <tr class="table-primary text-center">
                                                <th>ชื่อสินค้า</th>
                                                <th>ราคา</th>
                                                <th>จำนวน</th>
                                                <th>รายละเอียด</th>
                                                <th>หมวดหมู่</th>
                                                <th>ผู้ผลิตสินค้า</th>
                                                <th>รหัสบาร์โค้ด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = $result->fetch_assoc()) :
                                            ?>
                                            <tr>
                                                <td><?= $row['name_item']; ?></td>
                                                <td><?= $row['price_item']; ?></td>
                                                <td><?= $row['number_item']; ?></td>
                                                <td><?= $row['content_item']; ?></td>
                                                <td><?= $row['group_item']; ?></td>
                                                <td><?= $row['brand_item']; ?></td>
                                                <td>
                                                    <?php
                                                    require('../vendor/autoload.php');
                                                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                    echo $generator->getBarcode($row["barcode"], $generator::TYPE_CODE_128, '2', '35');
                                                    echo '<p>รหัสบาร์โค้ด : ' . $row["barcode"] . '</p>';
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php endwhile ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                            <h3 class="text-center">ไม่พบคำค้นหา</h3>
                        <?php } ?>
                        <hr>

                        <h4>ผลลัพธ์เกี่ยวกับข่าวสาร</h4>
                        <?php
                        $sql = "SELECT * FROM news WHERE title_News LIKE '%$_GET[keyword]%' OR content_News LIKE '%$_GET[keyword]%' LIMIT 5";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table table-striped text-center table-bordered border-info">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>หัวข้อข่าวสาร</th>
                                            <th>รายละเอียดข่าวสาร</th>
                                            <th>ความสำคัญ</th>
                                            <th>วันที่ลงข่าว</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) :
                                        ?>
                                            <tr>
                                                <td><?= $row['title_News']; ?></td>
                                                <td><?= $row['content_News']; ?></td>
                                                <td><?php if ($row['major_News'] == 1) {
                                                        echo "สำคัญมาก";
                                                    } else {
                                                        echo "ปกติ";
                                                    } ?></td>
                                                <td><?= $row['datetime_News']; ?></td>
                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else { ?>
                            <h3 class="text-center">ไม่พบคำค้นหา</h3>
                        <?php } ?>
                        <hr>

                        <h4>ผลลัพธ์เกี่ยวกับพนักงาน</h4>
                        <?php
                        $sql = "SELECT * FROM staff WHERE fname_staff LIKE '%$_GET[keyword]%' OR lname_staff LIKE '%$_GET[keyword]%' OR number_staff LIKE '%$_GET[keyword]%' LIMIT 5";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table table-striped text-center table-bordered border-info">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>รหัสพนักงาน</th>
                                            <th>ชื่อ</th>
                                            <th>นามสกุล</th>
                                            <th>ระดับ</th>
                                            <th>สถานะการใช้งาน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) :
                                        ?>
                                            <tr>
                                                <td><?= $row['number_staff']; ?></td>
                                                <td><?= $row['fname_staff']; ?></td>
                                                <td><?= $row['lname_staff']; ?></td>
                                                <td><?php if ($row['admin'] == 1) {echo "ผู้จัดการ";} else {echo "พนักงาน";} ?></td>
                                                <td><?php if ($row['login_staff'] == 1) {echo "กำลังใช้งาน";} else {echo "ออฟไลน์";} ?></td>
                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <h3 class="text-center">ไม่พบคำค้นหา</h3>
                        <?php } ?>
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