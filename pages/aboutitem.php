<!DOCTYPE html>
<html lang="en">

<head>
    <title>เกี่ยวกับสินค้า</title>
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
            <div class="container-xxl">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5 mt-3">
                        <div class="border border-success rounded-3">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center">ค้นหาข้อมูล</h5>
                                    <input type="search" class="form-control mt-2" name="barcode" id="search" onkeypress="return keyword(event)" placeholder="ใส่ชื่อสินค้าหรือรหัสบาร์โค้ดได้ที่นี่">
                                    <button type='button' class='btn btn-primary w-100 mt-2' id="loadtable" onclick="search()">ค้นหาสินค้า</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-hidden mt-3">
                            <div id="search_item">

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="container">
                            <div class="row">
                                <div class="card mt-3">
                                    <select class="form-select w-10 mt-3" onchange="option()" id="option" aria-label="Default select example">
                                        <option selected disabled>เรียงลำดับสินค้า หรือ ค้นหาสินค้าที่หมด</option>
                                        <option value="old">เก่าที่สุด -> ใหม่ที่สุด</option>
                                        <option value="new">ใหม่ที่สุด -> เก่าที่สุด</option>
                                        <option value="low">ราคาต่ำสุด -> ราคาสูงสุด</option>
                                        <option value="high">ราคาสูงสุด -> ราคาต่ำสุด</option>
                                        <option value="outofstock">แสดงเฉพาะสินค้าที่หมดแล้วเท่านั้น</option>
                                    </select>
                                    <div class="btn-group mt-2" role="group" aria-label="Basic radio toggle button group">
                                        <?php
                                        session_start();
                                        if ($_SESSION['page_item'] == 0 || $_SESSION['page_item'] == null) {
                                        ?>
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="card_item" onclick="showtable(this.value)" checked>
                                            <label class="btn btn-outline-primary" for="btnradio1">แสดงข้อมูล แบบช่องสินค้า</label>
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="table_item" onclick="showtable(this.value)">
                                            <label class="btn btn-outline-primary" for="btnradio2">แสดงข้อมูล แบบตาราง</label>
                                        <?php } else { ?>
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="card_item" onclick="showtable(this.value)">
                                            <label class="btn btn-outline-primary" for="btnradio1">แสดงข้อมูล แบบช่องสินค้า</label>
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="table_item" onclick="showtable(this.value)" checked>
                                            <label class="btn btn-outline-primary" for="btnradio2">แสดงข้อมูล แบบตาราง</label>
                                        <?php } ?>
                                    </div>
                                    <button class="btn btn-primary w-100 mt-2 mb-2" onclick="loaditem()">ยืนยัน กรองข้อมูล</button>
                                </div>
                                <div id="data_listitem">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script src='../js/ajax/aboutitem.js'></script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>