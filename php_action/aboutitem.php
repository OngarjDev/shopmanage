<?php
///หน้านี้สำรองไว้ สำหรับการค้นหาในอนาคต
if(isset($_GET['search'])){
    $keyword = $_GET['search'];
    require('dbconnect.php');
    $sql = "SELECT * FROM item WHERE name_item LIKE '%$keyword%' OR barcode LIKE '%$keyword%' OR brand_item LIKE '%$keyword%' OR group_item LIKE '%$keyword%'";
    $result = $con->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $name = $row['name_item'];$price = $row['price_item'];$number = $row['number_item'];$barcode = $row['barcode'];$image = $row['image_item'];
        $result = <<<DATA
        <div class='card text-center'>
            <img src="$image" class="mx-auto w-50">
            <h2 class='mt-2'>$name</h2>
            <p>จำนวนสินค้า : $number</p>
            <p>รหัสบาร์โค้ด : $barcode</p>
            <a href="barcodepdf.php" class="btn btn-primary mt-3 mx-auto w-100">พิมพ์บาร์โค้ดสินค้า</a>
            <a href="additems.php" class="btn btn-success mt-3 mb-3 mx-auto w-100">แก้ไขจำนวนสินค้า</a>
        </div>
        DATA;
        echo $result;
    }else{
        echo "
        <div class='card'>
            <h2 class='text-center mt-2'>ไม่พบคำค้นหา</h2>
        </div>
        ";
    }
}
