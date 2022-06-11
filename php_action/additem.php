<?php

if($_POST['action'] == 'additems'){
    require('dbconnect.php');
    $name_item = $con->real_escape_string($_POST['name']);
    $price_item = $con->real_escape_string($_POST['price']);
    $number_item = $con->real_escape_string($_POST['number']);
    $content_item = $con->real_escape_string($_POST['content']);
    $barcode_item = $con->real_escape_string($_POST['barcode']);
    $brand_item = $con->real_escape_string($_POST['brand']);
    $group_item = $con->real_escape_string($_POST['group']);
    $type_image = array('image/jpeg','image/png','image/gif');
    if($_FILES['image']['name'] != '' && in_array($_FILES['image']['type'],$type_image)){

        $tar_dir = "../image/item/";
        $newname = rand() . $_FILES['image']['name'];
        $upload = $tar_dir . $newname;

        move_uploaded_file($_FILES['image']['tmp_name'],$upload);

        $sql = "INSERT INTO item(name_item,price_item,content_item,number_item,barcode,image_item,group_item,brand_item) values('$name_item','$price_item','$content_item','$number_item','$barcode_item','$upload','$group_item','$brand_item')";
        $result = $con->query($sql);
        header('location: ../pages/additems.php?info=ระบบได้เพิ่มสินค้าเรียบร้อยแล้ว');

    }elseif($_FILES['image']['name'] != null && !in_array($type_image,$_FILES['image']['type'])){
        
        $sql = "INSERT INTO item(name_item,price_item,content_item,number_item,barcode,group_item,brand_item) values('$name_item','$price_item','$content_item','$number_item','$barcode_item','$group_item','$brand_item')";
        $result = $con->query($sql);
        header('location: ../pages/additems.php?warning=เพิ่มข้อมูลเรียบร้อย,ไม่รองรับชนิดรูปภาพที่คุณอัพโหลด');

    }else{

        $sql = "INSERT INTO item(name_item,price_item,content_item,number_item,barcode,group_item,brand_item) values('$name_item','$price_item','$content_item','$number_item','$barcode_item','$group_item','$brand_item')";
        $result = $con->query($sql);
        header('location: ../pages/additems.php?info=เพิ่มข้อมูลเรียบร้อย');
        
    }
}

if($_POST['action'] == 'updateitems'){
    require('dbconnect.php');
    session_start();
    $number_item = $con->real_escape_string($_POST['number']);
    $id_item = $con->real_escape_string($_POST['id_item']);

    $sql = "SELECT * FROM item WHERE id_item = '$id_item'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    $update = $row['number_item'] + $number_item ; 

    $sql = "UPDATE item SET number_item = '$update' WHERE id_item = '$id_item'";
    $result = $con->query($sql);

    $data = $row['name_item'].'-'. $number_item .'-'.$row['number_item'];

    $sql = "INSERT INTO note (type_note,datetime_note,id_staff,content_note,name_staff) values('additem',NOW(),'".$_SESSION['id_staff']."','$data','".$_SESSION['name_staff']."')";
    $result = $con->query($sql);
    header('location: ../pages/additems.php?info=เพิ่มข้อมูลเรียบร้อย');
}
