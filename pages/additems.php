<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <title>เพิ่มสินค้า</title>
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
            <?php if (isset($_GET['info'])) : ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $_GET['info'] ?>
                </div>
            <?php endif ?>
            <?php if (isset($_GET['warning'])) : ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $_GET['warning'] ?>
                </div>
            <?php endif ?>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-xl-1 col-lg-2 col-md-1"></div>
                    <div class="col-xl-10 col-lg-8 col-md-10">
                        <div class="text-center">
                            <div class="card">
                                <div class="card-header">
                                    <form action="additems.php" method="get">
                                        <label>ใส่รหัสคิวบาร์โค้ดลงในกล่องค้นหานี้</label>
                                        <input type="search" class="form-control mt-2" name="barcode" id="" placeholder="ใส่รหัสคิวบาร์โค้ดลงในนี้ เพื่อตรวจสอบสินค้าว่าถูกเพิ่มในระบบหรือไม่ เช่น 8859333713345 เป็นต้น" required>
                                        <input type="submit" class="btn btn-warning mt-2 w-100" value="ตรวจสอบ">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                        require('../php_action/dbconnect.php');
                        if (isset($_GET['barcode'])) :
                            $barcode = $con->real_escape_string($_GET['barcode']);
                            $sql = "SELECT id_item FROM item WHERE barcode = '$barcode'";
                            $result = $con->query($sql);
                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                        ?>


                                <div class="card mt-5">
                                    <div class="card-header">
                                        สินค้าที่ถูกพบ <h3>Name : <?php echo $row['name_item'] ?><br> Barcode : <?php echo $barcode ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="../php_action/additem.php" method="POST">

                                            <label for="">ใส่จำนวนสินค้า</label>
                                            <input type="number" name="number" class="form-control" id="" required>

                                            <input type="hidden" name="id_item" value="<?php echo $row['id_item'] ?>">
                                            <input type="hidden" name="action" value="updateitems">
                                            <h5 class="mt-3">***ระบบจะบวกเพิ่มของเดิมที่มีอยู่***</h5>
                                            <input type="submit" value="เพิ่มสินค้า" class="btn btn-success mt-3 w-100">
                                        </form>
                                    </div>
                                </div>


                            <?php } else { ?>
                                <div class="card mt-5 mb-3">
                                    <div class="card-header text-center">
                                        สินค้านี้ยังไม่ได้ลงทะเบียน โปรดลงทะเบียนก่อนเพิ่มสินค้า (<?php echo $barcode ?>)
                                    </div>
                                    <div class="card-body">
                                        <form action="../php_action/additem.php" method="POST" name="additems" enctype="multipart/form-data">
                                            <label for="" class="form-label">ชื่อสินค้า</label>
                                            <input type="text" name="name" id="" class="form-control" required>

                                            <label for="" class="form-label mt-3">ราคาสินค้า</label>
                                            <input type="number" name="price" id="" class="form-control" required>

                                            <label for="" class="form-label mt-3">จำนวนสินค้า</label>
                                            <input type="number" name="number" id="" class="form-control" required>

                                            <label for="" class="form-label mt-3">รายละเอียดสินค้า</label>
                                            <textarea class="form-control" name="content" aria-label="With textarea"></textarea>

                                            <label class="form-label mt-3">ประเภทสินค้า</label>
                                            <select class="form-select" name="group">
                                                <option selected value="-">ไม่ต้องการเลือก</option>
                                                <?php
                                                require_once('../php_action/dbconnect.php');
                                                $sql_category = "SELECT * FROM category WHERE type_category = 'group'";
                                                $result_category = $con->query($sql_category);
                                                while ($row_category = $result_category->fetch_assoc()) :
                                                ?>
                                                    <?php if ($row_category['name_category'] == $row['brand_item']) { ?>
                                                        <option value="<?= $row_category['name_category'] ?>" selected><?= $row_category['name_category'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $row_category['name_category'] ?>"><?= $row_category['name_category'] ?></option>
                                                    <?php } ?>
                                                <?php endwhile ?>
                                            </select>

                                            <label class="form-label mt-3">ผู้ผลิตสินค้า</label>
                                            <select class="form-select" name="brand">
                                                <option selected value="-">ไม่ต้องการเลือก</option>
                                                <?php
                                                require_once('../php_action/dbconnect.php');
                                                $sql_category = "SELECT * FROM category WHERE type_category = 'brand'";
                                                $result_category = $con->query($sql_category);
                                                while ($row_category = $result_category->fetch_assoc()) :
                                                ?>
                                                    <?php if ($row_category['name_category'] == $row['brand_item']) { ?>
                                                        <option value="<?= $row_category['name_category'] ?>" selected><?= $row_category['name_category'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $row_category['name_category'] ?>"><?= $row_category['name_category'] ?></option>
                                                    <?php } ?>
                                                <?php endwhile ?>
                                            </select>

                                            <label for="" class="form-label mt-3">รูปภาพประกอบ</label>
                                            <input type="file" name="image" id="" class="form-control">

                                            <input type="hidden" name="barcode" value="<?php echo $barcode ?>">
                                            <input type="hidden" name="action" value="additems">

                                            <input type="submit" value="เพิ่มสินค้า" class="mt-3 btn btn-info w-100">
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-1"></div>
            </div>
        </main>
    </div>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

=======
<!DOCTYPE html>
<html lang="en">

<head>
    <title>เพิ่มสินค้า</title>
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
            <?php if (isset($_GET['info'])) : ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $_GET['info'] ?>
                </div>
            <?php endif ?>
            <?php if (isset($_GET['warning'])) : ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $_GET['warning'] ?>
                </div>
            <?php endif ?>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-xl-1 col-lg-2 col-md-1"></div>
                    <div class="col-xl-10 col-lg-8 col-md-10">
                        <div class="text-center">
                            <div class="card">
                                <div class="card-header">
                                    <form action="additems.php" method="get">
                                        <label>ใส่รหัสคิวบาร์โค้ดลงในกล่องค้นหานี้</label>
                                        <input type="search" class="form-control mt-2" name="barcode" id="" placeholder="ใส่รหัสคิวบาร์โค้ดลงในนี้ เพื่อตรวจสอบสินค้าว่าถูกเพิ่มในระบบหรือไม่ เช่น 8859333713345 เป็นต้น">
                                        <input type="submit" class="btn btn-warning mt-2 w-100" value="ตรวจสอบ">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                        require('../php_action/dbconnect.php');
                        if (isset($_GET['barcode'])) :
                            $barcode = $con->real_escape_string($_GET['barcode']);
                            $sql = "SELECT * FROM item WHERE barcode = '$barcode'";
                            $result = $con->query($sql);
                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                        ?>


                                <div class="card mt-5">
                                    <div class="card-header">
                                        สินค้าที่ถูกพบ <h3>Name : <?php echo $row['name_item'] ?><br> Barcode : <?php echo $barcode ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="../php_action/additem.php" method="POST">

                                            <label for="">ใส่จำนวนสินค้า</label>
                                            <input type="number" name="number" class="form-control" id="" required>

                                            <input type="hidden" name="id_item" value="<?php echo $row['id_item'] ?>">
                                            <input type="hidden" name="action" value="updateitems">
                                            <h5 class="mt-3">***ระบบจะบวกเพิ่มของเดิมที่มีอยู่***</h5>
                                            <input type="submit" value="เพิ่มสินค้า" class="btn btn-success mt-3 w-100">
                                        </form>
                                    </div>
                                </div>


                            <?php } else { ?>
                                <div class="card mt-5 mb-3">
                                    <div class="card-header text-center">
                                        สินค้านี้ยังไม่ได้ลงทะเบียน โปรดลงทะเบียนก่อนเพิ่มสินค้า (<?php echo $barcode ?>)
                                    </div>
                                    <div class="card-body">
                                        <form action="../php_action/additem.php" method="POST" name="additems" enctype="multipart/form-data">
                                            <label for="" class="form-label">ชื่อสินค้า</label>
                                            <input type="text" name="name" id="" class="form-control" required>

                                            <label for="" class="form-label mt-3">ราคาสินค้า</label>
                                            <input type="number" name="price" id="" class="form-control" required>

                                            <label for="" class="form-label mt-3">จำนวนสินค้า</label>
                                            <input type="number" name="number" id="" class="form-control" required>

                                            <label for="" class="form-label mt-3">รายละเอียดสินค้า</label>
                                            <textarea class="form-control" name="content" aria-label="With textarea"></textarea>

                                            <label class="form-label mt-3">ประเภทสินค้า</label>
                                            <select class="form-select" name="group">
                                                <option selected value="-">ไม่ต้องการเลือก</option>
                                                <?php
                                                require_once('../php_action/dbconnect.php');
                                                $sql_category = "SELECT * FROM category WHERE type_category = 'group'";
                                                $result_category = $con->query($sql_category);
                                                while ($row_category = $result_category->fetch_assoc()) :
                                                ?>
                                                    <?php if ($row_category['name_category'] == $row['brand_item']) { ?>
                                                        <option value="<?= $row_category['name_category'] ?>" selected><?= $row_category['name_category'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $row_category['name_category'] ?>"><?= $row_category['name_category'] ?></option>
                                                    <?php } ?>
                                                <?php endwhile ?>
                                            </select>

                                            <label class="form-label mt-3">ผู้ผลิตสินค้า</label>
                                            <select class="form-select" name="brand">
                                                <option selected value="-">ไม่ต้องการเลือก</option>
                                                <?php
                                                require_once('../php_action/dbconnect.php');
                                                $sql_category = "SELECT * FROM category WHERE type_category = 'brand'";
                                                $result_category = $con->query($sql_category);
                                                while ($row_category = $result_category->fetch_assoc()) :
                                                ?>
                                                    <?php if ($row_category['name_category'] == $row['brand_item']) { ?>
                                                        <option value="<?= $row_category['name_category'] ?>" selected><?= $row_category['name_category'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $row_category['name_category'] ?>"><?= $row_category['name_category'] ?></option>
                                                    <?php } ?>
                                                <?php endwhile ?>
                                            </select>

                                            <label for="" class="form-label mt-3">รูปภาพประกอบ</label>
                                            <input type="file" name="image" id="" class="form-control">

                                            <input type="hidden" name="barcode" value="<?php echo $barcode ?>">
                                            <input type="hidden" name="action" value="additems">

                                            <input type="submit" value="เพิ่มสินค้า" class="mt-3 btn btn-info w-100">
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-1"></div>
            </div>
        </main>
    </div>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
</html>