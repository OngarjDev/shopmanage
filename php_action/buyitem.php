<?php
if ($_GET['action'] == 'addcart') {
    session_start();
    $id_item = $_GET['id_item'];
    require_once('dbconnect.php');
    $sql = "INSERT INTO cart(id_item,values_item,id_staff) values('$id_item',1,'" . $_SESSION['id_staff'] . "')";
    $result = $con->query($sql);
    header('location: ../pages/buyitem.php?page=' . $_GET['page']);
}
if ($_GET['action'] == 'delete') {
    $id_item = $_GET['id_item'];
    require_once('dbconnect.php');
    $sql = "DELETE FROM cart WHERE id_item = '$id_item'";
    $result = $con->query($sql);
    header('location: ../pages/buyitem.php?page=' . $_GET['page'] . '&message=' . 'ระบบได้ลบสินค้าเรียบร้อยแล้ว');
}
if ($_GET['action'] == 'alldelete') {
    session_start();
    require_once('dbconnect.php');
    $sql = "DELETE FROM cart WHERE id_staff = '" . $_SESSION['id_staff'] . "'";
    $result = $con->query($sql);
    header('location: ../pages/buyitem.php?page=' . $_GET['page'] . '&message=' . 'ระบบได้ลบสินค้าทั้งหมดเรียบร้อยแล้ว');
}
if ($_GET['action'] == 'search') {
    $keyword = $_GET['keyword'];
    require_once('dbconnect.php');
    $sql = "SELECT name_item,id_item FROM item WHERE name_item LIKE '%$keyword%' OR id_item LIKE '%$keyword%' OR barcode LIKE '%$keyword%' LIMIT 3";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo ' <div class="btn-group-vertical w-100 text-center mt-2">';
        while ($row = $result->fetch_assoc()) {
            echo '<a href="../php_action/buyitem.php?action=additembysearch&page=' . $_GET['page'] . '&keyword=' . $row['name_item'] . '" class="btn btn-secondary">' . $row['name_item'] . '</a>';
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-danger mt-2" role="alert">';
        echo 'ไม่พบคำค้นหา';
        echo '</div>';
    }
}
if ($_GET['action'] == 'additembysearch') {
    session_start();
    $keyword = $_GET['keyword'];
    require_once('dbconnect.php');
    $sql = "SELECT id_item,number_item FROM item WHERE name_item = '$keyword' OR id_item = '$keyword' OR barcode = '$keyword'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {

        $sql_allitem_cart = "SELECT id_item FROM cart WHERE id_staff = '" . $_SESSION['id_staff'] . "'"; ///ตรวจสอบว่ามีสินค้าอยู่ในตะกร้าหรือยัง
        $result_allitem_cart = $con->query($sql_allitem_cart);
        $array_allitem_cart = [];

        while ($row_allitem_cart = $result_allitem_cart->fetch_assoc()) {
            array_push($array_allitem_cart, $row_allitem_cart['id_item']);
        }

        $row = $result->fetch_assoc();
        if (in_array($row['id_item'], $array_allitem_cart) == false) {
            if ($row['number_item'] > 0) {
                $sql = "INSERT INTO cart(id_item,values_item,id_staff) values($row[id_item],1,'" . $_SESSION['id_staff'] . "')";
                $result = $con->query($sql);
                $message = 'ระบบได้เพิ่มสินค้าเข้าตะกร้าแล้ว';
            } else {
                $message = 'สินค้าหมดหรือจำนวนไม่พอตามความต้องการ';
            }
        } else {
            $message = 'ตรวจพบสินค้าอยู่ในตะกร้าแล้ว โปรดตรวจสอบสินค้าอีกครั้ง';
        }
    } else {
        $message = 'ไม่พบสินค้า';
    }
    header('location: ../pages/buyitem.php?page=' . $_GET['page'] . '&message=' . $message);
}
if ($_GET['action'] == 'updatenumber_item') {
    $id_item = $_GET['id_item'];
    $number_item = $_GET['values'];
    require_once('dbconnect.php');
    $sql_item = "SELECT number_item FROM item WHERE id_item = '$id_item'";
    $result_item = $con->query($sql_item);
    $row_item = $result_item->fetch_assoc();
    if ($number_item <= $row_item['number_item']) {
        $sql_cart = "UPDATE cart SET values_item = '$number_item' WHERE id_item = '$id_item'";
        $result = $con->query($sql_cart);
        $message = 'ระบบได้เพิ่มจำนวนสินค้าเรียบร้อยแล้ว';
    } else {
        $message = 'สินค้าในคลังมีไม่เพียงพอ สินค้าสูงสุดที่สามารถซื้อได้คือ ' . $row_item['number_item'] . ' ชิ้น';
    }
    header('location: ../pages/buyitem.php?page=' . $_GET['page'] . '&message=' . $message . '&page=' . $_GET['page']);
}
if ($_GET['action'] == 'payment') {
    require('dbconnect.php');
    session_start();
    $id_staff = $_SESSION['id_staff'];
    $sql_cart = "SELECT * FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'"; //ตรวจสอบดึงข้อมูลจาก cart และ item ที่มีการซื้อสินค้า
    $result_cart = $con->query($sql_cart);

    $price_item = [];
    $number = [];
    $id_item = [];
    $name_item = [];
    $values_item = [];
    $number_removeitem = $result_cart->num_rows;

    while ($row = $result_cart->fetch_assoc()) { ///ทำเป็น array เพื่อนำไปใช้งานในการคำนวณราคาสินค้า
        array_push($price_item, $row['price_item']);
        array_push($number, $row['values_item']);
        array_push($id_item, $row['id_item']);
        array_push($name_item, $row['name_item']);
    }
    $multiply = [];
    $x = count($number);
    for ($i = 0; $i <= $x; $i++) { // สูตรคำนวณราคาสินค้า คือ ราคาสินค้า * จำนวนสินค้า = $multiply
        $p = $price_item[$i] * $number[$i];
        array_push($multiply, $p);
    }

    $money = array_sum($multiply);
    $item = implode(",", $id_item);
    $values = implode(",", $number);
    $name = implode(",", $name_item);
    $price = implode(",", $price_item);

    $pin = $id_staff + rand() + $money; //รหัสบาร์โค้ดสินค้าประกอบไปด้วย รหัสพนักงาน + จำนวนสินค้า + รหัสสุ่ม เพื่อป้องกันการปลอมแปลงข้อมูล
    $sql_staff = "SELECT fname_staff,lname_staff FROM staff WHERE id_staff = '$id_staff'";
    $result_staff = $con->query($sql_staff);
    $row_staff = $result_staff->fetch_assoc();
    $fullname = $row_staff['fname_staff'] . ' ' . $row_staff['lname_staff'];

    if ($_GET['bank'] == 'bank') {
        if ($_GET['image'] == 'noimage') {
            $sql = "INSERT INTO history(id_staff,id_item,values_item,datetime_history,transfer_history,money_history,pin_history,name_item,price_item,fullname_staff) values('$id_staff','$item','$values',NOW(),'bank',$money,$pin,'$name','$price','$fullname')";
            $result = $con->query($sql);
        }
        if ($_GET['image'] == 'image') {
            $tar_dir = "../image/bank/";
            $newname = rand() . $_FILES['image']['name'];
            $upload = $tar_dir . $newname;

            move_uploaded_file($_FILES['image']['tmp_name'], $upload);

            $sql = "INSERT INTO history(id_staff,id_item,values_item,datetime_history,transfer_history,money_history,pin_history,name_item,price_item,fullname_staff,image_history) values('$id_staff','$item','$values',NOW(),'bank',$money,$pin,'$name','$price','$fullname','$upload')";
            $result = $con->query($sql);
        }
    }
    if ($_GET['bank'] == 'cash') {
        $moneyincome = $_GET['money'];
        if ($moneyincome >= $money) {
            $sql = "INSERT INTO history(id_staff,id_item,values_item,datetime_history,transfer_history,money_history,pin_history,name_item,price_item,income_history,fullname_staff) values('$id_staff','$item','$values',NOW(),'cash',$money,$pin,'$name','$price',$moneyincome,'$fullname')";
            $result = $con->query($sql);
        } else {
            header('location: ../pages/payment.php?message=' . 'จำนวนเงินที่รับไม่ถูกต้อง');
        }
    }
    $sql_cart = "SELECT item.id_item,item.number_item,cart.values_item FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'"; //ตรวจสอบดึงข้อมูลจาก cart และ item ที่มีการซื้อสินค้า
    $result_cart = $con->query($sql_cart);

    while ($row = $result_cart->fetch_assoc()) {
        $total = $row['number_item'] - $row['values_item']; ///ทำการลบจำนวนสินค้าในคลัง
        $sql_removeitem = "UPDATE item set number_item = '$total'  WHERE id_item = '$row[id_item]'";
        $result = $con->query($sql_removeitem);
        echo $total;
    }
    $sql = "DELETE FROM cart WHERE id_staff = '$id_staff'";
    $result = $con->query($sql);

    $sql_history = "SELECT id_history,transfer_history FROM history WHERE id_staff = '$id_staff' ORDER BY id_history DESC LIMIT 1";
    $result_history = $con->query($sql_history);
    $row_cart_history = $result_history->fetch_array();

    header('location: ../pages/finishbuyitem.php?message=การชำระเงินเสร็จสิ้น&id_history=' . $row_cart_history['id_history'] . '&transfer_history=' . $row_cart_history['transfer_history']);
}
