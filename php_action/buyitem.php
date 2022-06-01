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
    header('location: ../pages/buyitem.php');
}
if ($_GET['action'] == 'alldelete') {
    session_start();
    $id_item = $_GET['id_item'];
    require_once('dbconnect.php');
    $sql = "DELETE FROM cart WHERE id_staff = '" . $_SESSION['id_staff'] . "'";
    $result = $con->query($sql);
    header('location: ../pages/buyitem.php');
}
if ($_GET['action'] == 'search') {
    $keyword = $_GET['keyword'];
    require_once('dbconnect.php');
    $sql = "SELECT name_item,id_item FROM item WHERE name_item LIKE '%$keyword%' OR id_item LIKE '%$keyword%' OR barcode LIKE '%$keyword%' LIMIT 3";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo ' <div class="btn-group-vertical w-100 text-center mt-2">';
        while ($row = $result->fetch_assoc()) {
            echo '<a href="../php_action/buyitem.php?action=additembysearch&page='. $_GET['page'] .'&keyword=' . $row['name_item'] . '" class="btn btn-secondary">' . $row['name_item'] . '</a>';
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
    $sql = "SELECT id_item FROM item WHERE name_item = '$keyword' OR id_item = '$keyword' OR barcode = '$keyword'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {

        $sql_allitem_cart = "SELECT id_item FROM cart WHERE id_staff = '" . $_SESSION['id_staff'] . "'";///ตรวจสอบว่ามีสินค้าอยู่ในตะกร้าหรือยัง
        $result_allitem_cart = $con->query($sql_allitem_cart);
        $array_allitem_cart = [];

        while ($row_allitem_cart = $result_allitem_cart->fetch_assoc()) {
            array_push($array_allitem_cart, $row_allitem_cart['id_item']);
        }

        $row = $result->fetch_assoc();
        if (in_array($row['id_item'], $array_allitem_cart) == false) {
            $sql = "INSERT INTO cart(id_item,values_item,id_staff) values($row[id_item],1,'" . $_SESSION['id_staff'] . "')";
            $result = $con->query($sql);
            $message = 'ระบบได้เพิ่มสินค้าเข้าตะกร้าแล้ว';
        } else {
            $message = 'ตรวจพบสินค้าอยู่ในตะกร้าแล้ว โปรดตรวจสอบสินค้าอีกครั้ง';
        }
    } else {
        $message = 'ไม่พบสินค้า';
    }
    header('location: ../pages/buyitem.php?page='.$_GET['page'].'&message=' . $message);
}
