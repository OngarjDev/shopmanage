<?php
if ($_GET['action'] == 'addtable') {
    require('dbconnect.php');
    $keyword = $con->real_escape_string($_GET['keyword']);


    $sql = "SELECT * FROM item WHERE barcode = '$keyword' OR name_item = '$keyword'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $id_item = $row['id_item'];
        $id_staff = $_SESSION['id_staff'];
        $product = $row['id_item'];
        $sql = "SELECT * FROM cart WHERE id_item = '$product' AND id_staff = '$id_staff'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['info'] = "พบสินค้าที่ซ้ำกันโปรดดูที่รายการอีกครั้ง";
        } else {
            $sql = "INSERT INTO cart(id_item,id_staff) VALUES('$id_item','$id_staff')";
            $result = $con->query($sql);
            $_SESSION['info'] = "เพิ่มสินค้าลงในตะกร้าเรียบร้อย";
        }
    } else {
        session_start();
        $_SESSION['info'] = "ไม่พบสินค้า";
    }
}

if ($_GET['action'] == 'deletedata') {
    $id_staff = $_GET['id_staff'];
    require('dbconnect.php');
    if ($_GET['actions'] == 'staff') {
        $sql = "DELETE FROM cart WHERE id_staff = '$id_staff'";
        $result = $con->query($sql);
    }
    if ($_GET['actions'] == 'item') {
        $sql_item = "DELETE FROM cart WHERE id_cart = '$id_staff'";
        $result_item = $con->query($sql_item);
    }
}

if ($_GET['action'] == 'number_item') {
    $number = $_GET['number'];
    $id_item = $_GET['id_item'];
    $id_staff = $_GET['id_staff'];
    require('dbconnect.php');
    $sql = "UPDATE cart SET values_item = '$number' WHERE id_item = '$id_item' AND id_staff = '$id_staff'";
    $result = $con->query($sql);
}

if ($_GET['action'] == 'repage') {
    session_start();
    if ($_GET['page']  == "cart") {
        $_SESSION['page'] = 0;
    }
    if ($_GET['page'] == "pay" && $_SESSION['value_showtable'] != 1) {
        $_SESSION['page'] = 1;
    }
    if ($_GET['page'] == "finish") {
        $_SESSION['page'] = 2;
    }
}

if ($_GET['action'] == 'finish') {
    require('dbconnect.php');
    session_start();
    $id_staff = $_SESSION['id_staff'];
    $sql_cart = "SELECT * FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'";
    $result_cart = $con->query($sql_cart);
    $price_item = [];
    $number = [];
    $id_item = [];
    $name_item = [];
    $values_item = [];
    while ($row = $result_cart->fetch_assoc()) {
        array_push($price_item, $row['price_item']);
        array_push($number, $row['values_item']);
        array_push($id_item, $row['id_item']);
        array_push($values_item, $row['values_item']);
    }

    for ($i = 0; $i < count($id_item); $i++) {
        $sql_name = "SELECT * FROM item WHERE id_item = '$id_item[$i]'";
        $result_name = $con->query($sql_name);
        $row_name = $result_name->fetch_assoc();
        array_push($name_item, $row_name['name_item']);
    }

    $multiply = [];
    $x = count($number);
    for ($i = 0; $i <= $x; $i++) {
        $p = $price_item[$i] * $number[$i];
        array_push($multiply, $p);
    }

    $money = array_sum($multiply);
    $item = implode(",", $id_item);
    $values = implode(",", $values_item);
    $name = implode(",", $name_item);
    $price = implode(",", $price_item);

    $pin = rand();
    if ($_GET['bank'] == 'bank') {
        $sql = "INSERT INTO history(id_staff,id_item,values_item,datetime_history,transfer_history,money_history,pin_history,name_item,price_item) values('$id_staff','$item','$values',NOW(),'bank',$money,$pin,'$name','$price')";
        $result = $con->query($sql);

        $sql_cart = "SELECT * FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'";
        $result_cart = $con->query($sql_cart);
        while ($row_cart = $result_cart->fetch_array()) {
            $id_removeitem = $row_cart['id_item'];
            $number = $row_cart['number_item'] - $row_cart['values_item'];
            $sql_removeitem = "UPDATE item set number_item = '$number'  WHERE id_item = '$id_removeitem'";
            $result = $con->query($sql_removeitem);
        }
        $sql = "DELETE FROM cart WHERE id_staff = '$id_staff'";
        $result = $con->query($sql);

        $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' ORDER BY id_history DESC";
        $result = $con->query($sql);
        $row_cart = $result->fetch_array();

        $_SESSION['noworder'] = $row_cart['id_history'];
        $_SESSION['transfer'] = $row_cart['transfer_history'];
        $_SESSION['page'] = 2;
        header('location: ../pages/buyitem.php');
    }
    if ($_GET['bank'] == 'cash') {
        $moneyincome = $_GET['money'];
        if ($moneyincome >= $money) {
            $sql = "INSERT INTO history(id_staff,id_item,values_item,datetime_history,transfer_history,money_history,pin_history,name_item,price_item,income_history) values('$id_staff','$item','$values',NOW(),'cash',$money,$pin,'$name','$price',$moneyincome)";
            $result = $con->query($sql);

            $sql_cart = "SELECT * FROM cart INNER JOIN item ON cart.id_item = item.id_item WHERE cart.id_staff = '$id_staff'";
            $result_cart = $con->query($sql_cart);
            while ($row_cart = $result_cart->fetch_array()) {
                $id_removeitem = $row_cart['id_item'];
                $number = $row_cart['number_item'] - $row_cart['values_item'];
                $sql_removeitem = "UPDATE item set number_item = '$number'  WHERE id_item = '$id_removeitem'";
                $result = $con->query($sql_removeitem);
            }
            $sql = "DELETE FROM cart WHERE id_staff = '$id_staff'";
            $result = $con->query($sql);

            $sql = "SELECT * FROM history WHERE id_staff = '$id_staff' ORDER BY id_history DESC";
            $result = $con->query($sql);
            $row_cart = $result->fetch_array();

            $_SESSION['noworder'] = $row_cart['id_history'];
            $_SESSION['transfer'] = $row_cart['transfer_history'];
            $_SESSION['page'] = 2;
            header('location: ../pages/buyitem.php');
        } else {
            session_start();
            $_SESSION['alert'] = "จำนวนเงินที่จะชำระไม่เพียงพอ";
            header('location: ../pages/buyitem.php');
        }
    }
}
