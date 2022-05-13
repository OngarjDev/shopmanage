<!DOCTYPE html>
<html lang="en">

<head>
    <title>ชำระเงิน</title>
    <?php
    require('../php_action/check.php');
    include('../php_action/bootstrap.php');
    ?>
</head>

<body class="sb-nav-fixed" onload="loadtable()">
    <?php
    include('../layout/nav.html');
    include('../layout/menu.html');
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-xl-5 col-lg-6 col-md-7">
                        <?php
                        session_start();
                        if (isset($_SESSION['info'])) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>แจ้งเตือนจากระบบ</strong> <?php echo $_SESSION['info'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php }
                        unset($_SESSION['info']);
                        ?>
                        <div id="data">

                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center mt-2">รายการสินค้า</h3>
                                <button class="btn btn-primary w-100" onclick="if(filter.hidden == true){document.getElementById('filter').hidden = false;}else{document.getElementById('filter').hidden = true;}">กรองข้อมูลสินค้า</button>
                                <form action="buyitem.php" method="get" id="filter" hidden>
                                    <label>ประเภทสินค้า</label>
                                    <select class="form-select" name="group">
                                        <option value="nogroup">ไม่เลือกประเภทสินค้า</option>
                                        <?php
                                        require_once('../php_action/dbconnect.php');
                                        $sql = "SELECT name_category FROM category WHERE type_category = 'group'";
                                        $result = $con->query($sql);
                                        while($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['name_category']?>"><?= $row['name_category']?></option>
                                        <?php } ?>
                                    </select>
                                    <label>แบรนด์</label>
                                    <select class="form-select" name="brand">
                                        <option value="nobrand">ไม่เลือกแบรนด์</option>
                                        <?php
                                        require_once('../php_action/dbconnect.php');
                                        $sql = "SELECT name_category FROM category WHERE type_category = 'brand'";
                                        $result = $con->query($sql);
                                        while($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['name_category']?>"><?= $row['name_category']?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="submit" value="กรองข้อมูลสินค้า" class="btn btn-info mt-3 w-100">
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="container-xxl">
                                    <div class="row">
                                        <?php
                                        require_once('../php_action/dbconnect.php');
                                        if((isset($_GET['brand']) && isset($_GET['group']) && ($_GET['brand'] != 'nobrand' || $_GET['group'] != 'nogroup'))){
                                            $sql = "SELECT image_item,name_item,price_item,number_item,id_item,barcode FROM item WHERE group_item = '$_GET[group]' || brand_item = '$_GET[brand]'";
                                        }
                                        else{
                                            $sql = "SELECT image_item,name_item,price_item,number_item,id_item,barcode FROM item";
                                        }
                                        $result = $con->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
                                                <div class="card">
                                                    <img src="<?= $row['image_item'] ?>" width="auto" class="bg-light card-img-top">
                                                    <div class="text-body">
                                                        <h5 class="mx-auto mt-2" style="display: block;width: 100px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;text-align:center;"><?= $row['name_item'] ?></h5>
                                                    </div>
                                                    <div class=" text-center mb-5">
                                                        <small>ราคา <?= $row['price_item'] ?> </small><small>จำนวน <?= $row['number_item'] ?></small>
                                                    </div>
                                                    <?php
                                                    if ($row['number_item'] != 0) {
                                                        require_once('../php_action/dbconnect.php');
                                                        $product = $row['id_item'];
                                                        session_start();
                                                        $id_staff = $_SESSION['id_staff'];
                                                        $sql_check = "SELECT id_item FROM cart WHERE id_item = '$product' AND id_staff = '$id_staff'";
                                                        $result_check = $con->query($sql_check);
                                                        if ($result_check->num_rows > 0) {
                                                    ?>
                                                            <button class="btn btn-danger w-100 rounded-0" disabled>สินค้าอยู่ในรายการ</button>
                                                        <?php } else { ?>
                                                            <button class="btn btn-success w-100 rounded-0" onclick="additemintable(this.value)" value="<?= $row['barcode'] ?>">เพิ่มลงในรายการ</button>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <button class="btn btn-danger w-100 rounded-0" disabled>สินค้าหมด</button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
    </div>
    <script src="../js/ajax/buyitem.js"></script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>