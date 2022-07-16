<?php
if($_GET['action'] == "gonowhistory"){
    header('location: ../pages/buyhistory.php?menu=true');
}
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
        header('location: ../pages/buyhistory.php?info=ระบบได้เพิ่มสินค้าเรียบร้อยแล้ว&menu=true');
    } else {
        header('location: ../pages/buyhistory.php?info=ชนิดรูปภาพไม่ถูกต้องโปรดลองอีกครั้ง');
    }
}
?>