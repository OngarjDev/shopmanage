<?php

$type_image = array('image/jpeg', 'image/png', 'image/gif');
if ($_POST['action'] == 'image') {
    if (in_array($_FILES['image']['type'], $type_image)) {

        require_once('check.php');
        require_once('dbconnect.php');
        $id_history = $_POST['id_history'];
        $tar_dir = "../image/bank/";
        $newname = rand() . $_FILES['image']['name'];
        $upload = $tar_dir . $newname;

        move_uploaded_file($_FILES['image']['tmp_name'], $upload);

        $sql = "UPDATE history set image_history = '$upload' WHERE id_history = '$id_history'";
        $result = $con->query($sql);
        header('location: ../pages/buyhistory.php?info=ระบบได้เพิ่มสินค้าเรียบร้อยแล้ว');
    } else {
        header('location: ../pages/buyhistory.php?info=ชนิดรูปภาพไม่ถูกต้องโปรดลองอีกครั้ง');
    }
}
if ($_GET['action'] == 'search') {
    $keyword = $_GET['keyword'];
    session_start();
    require_once('dbconnect.php');
    $sql = "SELECT * FROM history WHERE id_history = '$keyword' OR pin_history = '$keyword' AND id_staff = ". $_SESSION['id_staff'] ." AND datetime_history > DATE_SUB(NOW(), INTERVAL 24 Hour)";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $order = $row['id_history'];
        $transfer = $row['transfer_history'];
        $money = $row['money_history'];
        $cash = $row['income_history'];
        $datetime = explode(" ", $row['datetime_history']);
        $move = '#' . $order .'r';
        $html = <<<ECHO
            <h3 class="mx-auto">หมายเลขคำสั่งซื้อ : $order</h3>
            <p class="card-text">ช่องทางการรับเงิน : $transfer<br>
            จำนวนเงินที่ได้รับ : $cash<br>
            ราคารวม : $money
            <p class="card-text"><small class="text-muted">วันที่ซื้อสินค้า : $datetime[0]<br>เวลาที่ซื้อสินค้า : $datetime[1] (เวลา ประเทศไทย)</small></p>
            <a class="btn btn-primary w-100" href="$move">ดูข้อมูลทั้งหมด</a>
    ECHO;
    } else {
        $html = <<<ECHO
            <h3 class="text-center">ไม่พบคำค้นหา</h3>
    ECHO;
    }
    echo $html;
}

if($_GET['action'] == 'confirm'){
    if($_GET['order'] == 'confirm'){
        session_start();
        $_SESSION['order'] = 'confirm';
    }
    if($_GET['order'] == 'unconfirm'){
        session_start();
        unset($_SESSION['order']);
    }
}