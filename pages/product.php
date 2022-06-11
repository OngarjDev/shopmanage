<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ข้อมูลสินค้า</title>
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
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 mt-3">
                        <div class="bg-light border rounded-3 shadow w-auto">
                        <h4 class="text-center mt-2">ประเภทสินค้า <a href="from-item.php?fromtype=group"><img src="../image/system/icons8-add-64.png" width="19"></a></h4>
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $sql = "SELECT name_category,id_category FROM category where type_category = 'group'";
                        $result = $con->query($sql);
                        if ($result->num_rows < 1) {
                            echo "<h6>ไม่พบประเภทสินค้า คุณสามารถเพิ่มได้ที่เครื่องหมายบวกด้านบน</h6>";
                        } else {
                            while ($row_category = $result->fetch_assoc()) {
                        ?>
                                <h4 class="ms-5"><?= $row_category['name_category'] ?><img src="../image/system/icons8-remove-48.png" width="15" onclick="deletegroub('group',<?= $row_category['id_category'] ?>)"></h4>
                        <?php
                            }
                        }
                        ?>
                        <hr>
                        <h4 class="text-center mt-2">แบรนด์ <a href="from-item.php?fromtype=brand"><img src="../image/system/icons8-add-64.png" width="19"></a></h4>
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $sql = "SELECT name_category,id_category FROM category where type_category = 'brand'";
                        $result = $con->query($sql);
                        if ($result->num_rows < 1) {
                            echo "<h6>ไม่พบแบรนด์ให้เลือก คุณสามารถเพิ่มได้ที่เครื่องหมายบวกด้านบน</h6>";
                        } else {
                            while ($row_category = $result->fetch_assoc()) {
                        ?>
                                <h4 class="ms-5"><?= $row_category['name_category'] ?><img src="../image/system/icons8-remove-48.png" width="15" onclick="deletegroub('brand',<?= $row_category['id_category'] ?>)"></h4>
                        <?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 bg-body">
                        <div class="btn-group w-100" role="group">
                            <a class="btn btn-primary mt-3" href="productpdf.php?action=allproduct">พิมพ์รายการสินค้าทั้งหมด</a>
                            <a class="btn btn-primary mt-3" href="productpdf.php?action=allnumber">พิมพ์รายการสินค้าที่หมด</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">รหัสบาร์โค้ด</th>
                                        <th scope="col">ชื่อสินค้า</th>
                                        <th scope="col">ประเภทสินค้า</th>
                                        <th scope="col">ผู้ผลิตสินค้า</th>
                                        <th scope="col">จำนวนสินค้าที่เหลือ</th>
                                        <th colspan="3" class="text-center">จัดการสินค้า</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('../php_action/dbconnect.php');
                                    $sql_item = "SELECT * FROM item";
                                    $result_item = $con->query($sql_item);
                                    while ($row_item = $result_item->fetch_assoc()) : ?>
                                        <tr>
                                            <th scope="row">
                                                <?php
                                                require('../vendor/autoload.php');
                                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                echo $generator->getBarcode($row_item['barcode'], $generator::TYPE_CODE_128, '2', '35');
                                                echo '<p>รหัสบาร์โค้ด :  ' . $row_item['barcode'] . '</p>'; ?></th>
                                            <td><?= $row_item['name_item'] ?></td>
                                            <td><?= $row_item['group_item'] ?></td>
                                            <td><?= $row_item['brand_item'] ?></td>
                                            <td><?= $row_item['number_item'] ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <a type="button" class="btn btn-success" href="from-item.php?fromtype=product&id_item=<?= $row_item['id_item'] ?>">แก้ไขสินค้า</a>
                                                    <a type="button" class="btn btn-warning" href="barcodepdf.php?id_item=<?= $row_item['id_item'] ?>">ปริ้นบาร์โค้ด</a>
                                                    <button type="button" class="btn btn-danger" onclick="deleteitem(this.value)" value="<?= $row_item['id_item'] ?>">ลบสินค้า</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script>
        function deleteitem(id_item) {
            if (confirm("โปรดยืนยันให้แน่ใจก่อนลบสินค้า")) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "../php_action/product.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("action=delete_item&id_item=" + id_item);
                window.location = window.location.href;
                alert("คุณได้ลบ สินค้าเรียบร้อยแล้ว");
            }
        }
        function deletegroub(type,id_category){
            alert("การกระทำนี้ส่งผลให้สินค้าทั้งหมดที่มีประเภทหรือผู้ผลิตนี้ถูกเปลี่ยนแปลงทั้งหมด");
            if (confirm("โปรดยืนยันให้แน่ใจก่อนลบประเภทสินค้าหรือหมวดหมู่สินค้า")) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "../php_action/product.php?action=deletegroup&type="+type+"&id_category="+id_category);
                xmlhttp.send();
                alert("คุณได้ลบ เรียบร้อยแล้ว");
                window.location = window.location.href;
            }
        }
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

=======
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ข้อมูลสินค้า</title>
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
                    <div class="col-xl-4 col-lg-4 col-md-4 mt-3">
                        <div class="bg-light border rounded-3 shadow w-auto">
                        <h4 class="text-center mt-2">ประเภทสินค้า <a href="from-item.php?fromtype=group"><img src="../image/system/icons8-add-64.png" width="19"></a></h4>
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $sql = "SELECT * FROM category where type_category = 'group'";
                        $result = $con->query($sql);
                        if ($result->num_rows < 1) {
                            echo "<h6>ไม่พบประเภทสินค้า คุณสามารถเพิ่มได้ที่เครื่องหมายบวกด้านบน</h6>";
                        } else {
                            while ($row_category = $result->fetch_assoc()) {
                        ?>
                                <h4 class="ms-5"><?= $row_category['name_category'] ?><img src="../image/system/icons8-remove-48.png" width="15" onclick="deletegroub('group',<?= $row_category['id_category'] ?>)"></h4>
                        <?php
                            }
                        }
                        ?>
                        <hr>
                        <h4 class="text-center mt-2">แบรนด์ <a href="from-item.php?fromtype=brand"><img src="../image/system/icons8-add-64.png" width="19"></a></h4>
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $sql = "SELECT * FROM category where type_category = 'brand'";
                        $result = $con->query($sql);
                        if ($result->num_rows < 1) {
                            echo "<h6>ไม่พบแบรนด์ให้เลือก คุณสามารถเพิ่มได้ที่เครื่องหมายบวกด้านบน</h6>";
                        } else {
                            while ($row_category = $result->fetch_assoc()) {
                        ?>
                                <h4 class="ms-5"><?= $row_category['name_category'] ?><img src="../image/system/icons8-remove-48.png" width="15" onclick="deletegroub('brand',<?= $row_category['id_category'] ?>)"></h4>
                        <?php
                            }
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 bg-body">
                        <div class="btn-group w-100" role="group">
                            <a class="btn btn-primary mt-3" href="productpdf.php?action=allproduct">พิมพ์รายการสินค้าทั้งหมด</a>
                            <a class="btn btn-primary mt-3" href="productpdf.php?action=allnumber">พิมพ์รายการสินค้าที่หมด</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">รหัสบาร์โค้ด</th>
                                        <th scope="col">ชื่อสินค้า</th>
                                        <th scope="col">ประเภทสินค้า</th>
                                        <th scope="col">ผู้ผลิตสินค้า</th>
                                        <th scope="col">จำนวนสินค้าที่เหลือ</th>
                                        <th colspan="3" class="text-center">จัดการสินค้า</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once('../php_action/dbconnect.php');
                                    $sql_item = "SELECT * FROM item";
                                    $result_item = $con->query($sql_item);
                                    while ($row_item = $result_item->fetch_assoc()) : ?>
                                        <tr>
                                            <th scope="row">
                                                <?php
                                                require('../vendor/autoload.php');
                                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                echo $generator->getBarcode($row_item['barcode'], $generator::TYPE_CODE_128, '2', '35');
                                                echo '<p>รหัสบาร์โค้ด :  ' . $row_item['barcode'] . '</p>'; ?></th>
                                            <td><?= $row_item['name_item'] ?></td>
                                            <td><?= $row_item['group_item'] ?></td>
                                            <td><?= $row_item['brand_item'] ?></td>
                                            <td><?= $row_item['number_item'] ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                    <a type="button" class="btn btn-success" href="from-item.php?fromtype=product&id_item=<?= $row_item['id_item'] ?>">แก้ไขสินค้า</a>
                                                    <a type="button" class="btn btn-warning" href="barcodepdf.php?id_item=<?= $row_item['id_item'] ?>">ปริ้นบาร์โค้ด</a>
                                                    <button type="button" class="btn btn-danger" onclick="deleteitem(this.value)" value="<?= $row_item['id_item'] ?>">ลบสินค้า</button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script>
        function deleteitem(id_item) {
            if (confirm("โปรดยืนยันให้แน่ใจก่อนลบสินค้า")) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "../php_action/product.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("action=delete_item&id_item=" + id_item);
                window.location = window.location.href;
                alert("คุณได้ลบ สินค้าเรียบร้อยแล้ว");
            }
        }
        function deletegroub(type,id_category){
            alert("การกระทำนี้ส่งผลให้สินค้าทั้งหมดที่มีประเภทหรือผู้ผลิตนี้ถูกเปลี่ยนแปลงทั้งหมด");
            if (confirm("โปรดยืนยันให้แน่ใจก่อนลบประเภทสินค้าหรือหมวดหมู่สินค้า")) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "../php_action/product.php?action=deletegroup&type="+type+"&id_category="+id_category);
                xmlhttp.send();
                alert("คุณได้ลบ เรียบร้อยแล้ว");
                window.location = window.location.href;
            }
        }
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
</html>