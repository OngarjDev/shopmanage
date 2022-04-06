<!DOCTYPE html>
<html lang="en">

<head>
    <title>HOME/หน้าหลัก</title>
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
                        <select class="form-select mt-4" aria-label="Default select example" onchange="form_select(this.value)">
                            <option selected disabled>โปรดเลือกก่อน เพิ่มข้อมูลลงในระบบ</option>
                            <?php if ($_GET['fromtype'] == 'group') { ?>
                                <option value="group" selected>เพิ่มประเภทของสินค้า</option>
                            <?php } else { ?>
                                <option value="group">เพิ่มประเภทของสินค้า</option>
                            <?php }
                            if ($_GET['fromtype'] == 'brand') { ?>
                                <option value="brand" selected>เพิ่มกลุ่มผู้ผลิตของสินค้า</option>
                            <?php } else { ?>
                                <option value="brand">เพิ่มกลุ่มผู้ผลิตของสินค้า</option>
                            <?php }
                            if ($_GET['fromtype'] == 'product') { ?>
                                <option value="product" selected>แก้ไขสินค้า</option>
                            <?php } else { ?>
                                <option value="product">แก้ไขสินค้า</option>
                            <?php } ?>
                        </select>
                        <?php
                        session_start();
                        if ($_GET['fromtype'] == 'group') : ?>
                            <form action="../php_action/product.php" method="POST" class="form-control mt-2">
                                <h2 class="text-center">ลงทะเบียน ประเภทสินค้า</h2>
                                <label for="">ใส่ชื่อประเภทสินค้าของคุณ</label>
                                <input type="text " class="form-control" name="name" id="" required>
                                <label for="" class="mt-2">ใส่รายละเอียดประเภทสินค้าของคุณ</label>
                                <textarea class="form-control" name="content" id=""></textarea>
                                <input type="hidden" name="action" value="group">
                                <input type="submit" class="btn btn-primary mt-3 w-100" value="ลงทะเบียน ประเภทสินค้า">
                            </form>
                        <?php endif;
                        if ($_GET['fromtype'] == 'brand') : ?>
                            <form action="../php_action/product.php" method="POST" class="form-control mt-2">
                                <h2 class="text-center">ลงทะเบียน ผู้ผลิตสินค้า</h2>
                                <label for="">ใส่ชื่อผู้ผลิตสินค้าของคุณ</label>
                                <input type="text" class="form-control" name="name" id="" required>
                                <label for="" class="mt-2">ใส่รายละเอียดผู้ผลิตสินค้าของคุณ</label>
                                <textarea class="form-control" name="content" id=""></textarea>
                                <input type="hidden" name="action" value="brand">
                                <input type="submit" class="btn btn-primary mt-3 w-100" value="ลงทะเบียน ผู้ผลิตสินค้า">
                            </form>
                            <?php endif;
                        if ($_GET['fromtype'] == 'product') :
                            if ($_GET['id_item'] != null) {
                                $id_item = $_GET['id_item'];
                                require_once('../php_action/dbconnect.php');
                                $sql = "SELECT * FROM item WHERE id_item = '$id_item'";
                                $result = $con->query($sql);
                                $row = $result->fetch_assoc();
                            ?>
                                <form action="../php_action/product.php" enctype="multipart/form-data" method="POST" class="form-control mt-2 mb-5">
                                    <h2 class="text-center">แก้ไขรายละเอียดสินค้า</h2>
                                    <label for="">ใส่ชื่อสินค้าของคุณ</label><br>
                                    <input type="text" class="form-control" name="name" id="" value="<?= $row['name_item'] ?>"><br>
                                    <label for="">รหัสบาร์โค้ด(ตัวเลขเท่านั้น)</label><br>
                                    <input type="text" class="form-control" name="barcode" id="" value="<?= $row['barcode'] ?>"><br>
                                    <label for="" class="mt-2">ใส่รายละเอียด สินค้าของคุณ</label><br>
                                    <textarea class="form-control" name="content" id="" value="<?= $row['content_item'] ?>"></textarea><br>
                                    <label for="">จำนวนสินค้า</label><br>
                                    <input type="text" class="form-control" name="number" id="" value="<?= $row['number_item'] ?>"><br>
                                    <label for="">ราคาสินค้า</label><br>
                                    <input type="text" class="form-control" name="price" id="" value="<?= $row['price_item'] ?>"><br>
                                    <label for="">ประเภทสินค้า</label><br>

                                    <select class="form-select" name="group">
                                        <option value="-">ไม่มีข้อมูล-ไม่ต้องการเลือก</option>
                                        <?php
                                        require_once('../php_action/dbconnect.php');
                                        $sql_category = "SELECT * FROM category WHERE type_category = 'group'";
                                        $result_category = $con->query($sql_category);
                                        while ($row_category = $result_category->fetch_assoc()) :
                                        ?>
                                            <?php if ($row_category['name_category'] == $row['group_item']) { ?>
                                                <option value="<?= $row_category['name_category'] ?>" selected><?= $row_category['name_category'] ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $row_category['name_category'] ?>"><?= $row_category['name_category'] ?></option>
                                            <?php } ?>
                                        <?php endwhile; ?>
                                    </select><br>


                                    <label for="">ใส่ชื่อผู้ผลิตสินค้าของคุณ</label><br>
                                    <select class="form-select" name="brand">
                                        <option value="-">ไม่มีข้อมูล-ไม่ต้องการเลือก</option>
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
                                    </select><br>


                                    <input type="hidden" name="action" value="product">
                                    <input type="hidden" name="id_item" value="<?= $_GET['id_item'] ?>">

                                    <label for="">ใส่รูปภาพที่คุณต้องการอัพโหลดลงที่นี่</label><br>
                                    <input type="file" name="image" id="" class="form-control">

                                    <img src="<?= $row['image_item'] ?>" class="mt-4 mx-auto img-fluid rounded d-block" width="200"><br>
                                    <a class="btn btn-danger w-25 mx-auto d-block" href="../php_action/product.php?action=deleteimage&id_item=<?= $row['id_item'] ?>">ลบรูปภาพสินค้า</a><br>

                                    <input type="submit" class="btn btn-primary mt-3 w-100" value="ยืนยัน แก้ไขสินค้า">
                                    <input type="reset" class="btn btn-warning mt-3 w-100" value="คืนค่าเดิม">
                                </form>
                        <?php
                            } else {
                                echo "<h3 class='text-center mt-2'>กรุณาเลือกสินค้าที่ต้องการแก้ไขจากหน้าสินค้าส่วนผู้จัดการก่อน</h3>";
                                echo "<a href='product.php' class='btn btn-primary w-100'> ไปที่หน้าสินค้า</a>";
                            }
                        endif
                        ?>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script>
        function form_select(typeform) {
            window.location = "from-item.php?fromtype=" + typeform;
        }
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>