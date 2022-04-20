<?php
if ($_POST['action'] == 'delete_item') {
    $id_item = $_POST['id_item'];
    require_once('dbconnect.php');
    $sql = "DELETE FROM item WHERE id_item = '$id_item'";
    $result = $con->query($sql);
}
if ($_POST['action'] == 'group') {
    $name = $_POST['name'];
    $content = $_POST['content'];
    require_once('dbconnect.php');
    $sql = "INSERT INTO category(name_category,type_category,content_category) values('$name','group','$content')";
    $result = $con->query($sql);
    header('location: ../pages/product.php');
}
if ($_POST['action'] == 'brand') {
    $name = $_POST['name'];
    $content = $_POST['content'];
    require_once('dbconnect.php');
    $sql = "INSERT INTO category(name_category,type_category,content_category) values('$name','brand','$content')";
    $result = $con->query($sql);
    header('location: ../pages/product.php');
}
if ($_POST['action'] == 'product') {
    $name = $_POST['name'];
    $barcode = $_POST['barcode'];
    $content = $_POST['content'];
    $number = $_POST['number'];
    $price = $_POST['price'];
    $group = $_POST['group'];
    $brand = $_POST['brand'];
    $id_item = $_POST['id_item'];
    require_once('dbconnect.php');
    $sql = "UPDATE item SET name_item = '$name',barcode = '$barcode',content_item = '$content',number_item = '$number',price_item = '$price',group_item = '$group',brand_item = '$brand'  WHERE id_item = '$id_item'";
    $result = $con->query($sql);
    if ($_FILES['image']['name'] != '') {
        $tar_dir = "../image/item/";
        $newname = rand() . $_FILES['image']['name'];
        $upload = $tar_dir . $newname;

        move_uploaded_file($_FILES['image']['tmp_name'], $upload);

        $sql = "UPDATE item SET image_item = '$upload' WHERE id_item = '$id_item'";
        $result = $con->query($sql);
    }
    header('location: ../pages/product.php');
}
if ($_GET['action'] == 'deleteimage') {
    $id_item = $_GET['id_item'];
    require_once('dbconnect.php');
    $sql = "SELECT * FROM item WHERE id_item = '$id_item'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $row_image = $row['image_item'];

    $sql_up = "UPDATE item SET image_item = '../image/system/unknown-file.png' WHERE id_item = '$id_item'";
    $result_up = $con->query($sql_up);

    if ($row_image != '../image/system/unknown-file.png') {
        unlink($row_image);
    }
    header('location: ../pages/from-item.php?fromtype=product&id_item=' . $id_item);
}
if($_GET['action'] == 'deletegroup'){
    $id_category = $_GET['id_category'];
    require_once('dbconnect.php');

    $sql = "SELECT * FROM category WHERE id_category = '$id_category'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    $sql = "DELETE FROM category WHERE id_category = '$id_category'";
    $result = $con->query($sql);
    $name = $row['name_category'];

    if($_GET['type'] == 'group'){
        $sql = "UPDATE item SET group_item = '-' WHERE group_item = '$name'";
        $result = $con->query($sql);
    }
    if($_GET['type'] == 'brand'){
        $sql = "UPDATE item SET brand_item = '-' WHERE brand_item = '$name'";
        $result = $con->query($sql);
    }
    
    header('location: ../pages/product.php');
}