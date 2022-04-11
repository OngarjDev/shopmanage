<?php
session_start();
if ($_SESSION['page_item'] == 0 || $_SESSION['page_item'] == null) {
    ///เป็นการแสดงข้อมูลแบบ card โดยเปลี่ยนอ้างตาม session
    require('dbconnect.php');
    session_start();
    if ($_SESSION['order'] == 'old') {
        $sql = "SELECT * FROM item ORDER BY id_item ASC";
    } elseif ($_SESSION['order_item'] == 'new') {
        $sql = "SELECT * FROM item ORDER BY id_item DESC";
    } elseif ($_SESSION['order_item'] == 'low') {
        $sql = "SELECT * FROM item ORDER BY price_item ASC";
    } elseif ($_SESSION['order_item'] == 'high') {
        $sql = "SELECT * FROM item ORDER BY price_item DESC";
    } elseif ($_SESSION['order_item'] == 'outofstock') {
        $sql = "SELECT * FROM item WHERE number_item <= 0";
    } else {
        $sql = "SELECT * FROM item";
    }
    $result = $con->query($sql);
    echo '<div class="container">';
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) :
        $path_image = $row['image_item'];
        $name = $row['name_item'];
        $content = $row['content_item'];
        $number = $row['number_item'];
        $barcode = $row['barcode'];
        $price = $row['price_item'];
        $id_item = $row['id_item'];
        $group = $row['group_item'];
        $brand = $row['brand_item'];
        $data =  <<<DATA
<div class="col-xl-4 mb-3 mt-2">
    <div class="card mt-2 rounded-3 border border-success h-100">
        <div class="bg-light bg-gradient">
            <img src="$path_image" class="mx-auto w-100 h-100">
        </div>
        <div class="card-body bg-secondary bg-gradient card-text" style="color: whitesmoke;">
            <h3>$name</h3>
            <p>รายละเอียด:  $content</p>
            <p>จำนวน:  $number</p>
            <p>ราคา:  $price</p>
            <p>ประเภทสินค้า: $group</p>
            <p>ผู้ผลิตสินค้า: $brand</p>
            <p>รหัสบาร์โค้ด: $barcode</p>
            <a href="barcodepdf.php?id_item=$id_item" class="btn btn-primary w-100">พิมพ์รหัส barcode</a>
            <a href="additems.php?barcode=$barcode" class="btn btn-success w-100 mt-3">เพิ่มจำนวนสินค้า</a>
        </div>
    </div>
</div>
DATA;
        echo $data;
    endwhile;
    echo '</div>';
    echo '</div>';
}
if ($_SESSION['page_item'] == 1) {
    ///เป็นการแสดงข้อมูลแบบตาราง
    require('dbconnect.php');
    session_start();
    if ($_SESSION['order'] == 'old') {
        $sql = "SELECT * FROM item ORDER BY id_item ASC";
    } elseif ($_SESSION['order_item'] == 'new') {
        $sql = "SELECT * FROM item ORDER BY id_item DESC";
    } elseif ($_SESSION['order_item'] == 'low') {
        $sql = "SELECT * FROM item ORDER BY price_item ASC";
    } elseif ($_SESSION['order_item'] == 'high') {
        $sql = "SELECT * FROM item ORDER BY price_item DESC";
    } elseif ($_SESSION['order_item'] == 'outofstock') {
        $sql = "SELECT * FROM item WHERE number_item <= 0";
    } else {
        $sql = "SELECT * FROM item";
    }
    $result = $con->query($sql);
    $headtable = <<<DATA
        <div class="table-responsive">
        <table class="table table-striped mt-2">
        <thead>
          <tr>
              <th scope="col">ชื่อสินค้า</th>
              <th scope="col">รหัสบาร์โค้ด</th>
              <th scope="col">จำนวน</th>
              <th scope="col">ราคา</th>
              <th scope="col">ประเภทสินค้า</th>
              <th scope="col">ผู้ผลิตสินค้า</th>
              <th scope="col">แก้ไขจำนวนสินค้า</th>
          </tr>
        </thead>
        <tbody>
        DATA;
    echo $headtable;
    while ($row = $result->fetch_assoc()) :
        $path_image = $row['image_item'];
        $name = $row['name_item'];
        $content = $row['content_item'];
        $number = $row['number_item'];
        $barcode = $row['barcode'];
        $price = $row['price_item'];
        $id_item = $row['id_item'];
        $brand = $row['brand_item'];
        $group = $row['group_item'];
        $data1 =  <<<DATA
    <tr>
        <th scope="row">$name</th>
        <td>
DATA;
        $data2 =  <<<DATA
</td>
<td>$number</td>
<td>$price</td>
<td>$group</td>
<td>$brand</td>
<td><a href="additems.php?barcode=$barcode" class="btn btn-success">แก้ไขจำนวนสินค้า</a></td> 
</tr>
DATA;
        require('../vendor/autoload.php');
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        echo $data1;
        echo $generator->getBarcode($barcode, $generator::TYPE_CODE_128, '2', '35');
        echo '<p>รหัสบาร์โค้ด :  ' . $barcode . '</p>';
        echo $data2;
    endwhile;
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

if ($_GET['view'] == 'card_item') {
    session_start();
    $_SESSION['page_item'] = 0;
} elseif ($_GET['view'] == 'table_item') {
    session_start();
    $_SESSION['page_item'] = 1;
}

if (isset($_GET['order'])) {
    session_start();
    $_SESSION['order_item'] = $_GET['order'];
}
