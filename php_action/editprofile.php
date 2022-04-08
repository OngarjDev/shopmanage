<?php
if($_POST['action'] == 'resetpassword'){
    require_once('dbconnect.php');
    $password = hash('sha512', $_POST['data']);
    $id_staff = $_POST['id_staff'];
    $sql = "UPDATE staff SET pass = '$password' WHERE id_staff = '$id_staff'";
    $result = $con->query($sql)or die("sdadsada");
    if($result){
        echo "<p class='text-center text-success'>เปลี่ยนรหัสผ่านเรียบร้อย</p>";
    }else{
        echo "<p class='text-center text-danger'>เเปลี่ยนรหัสผ่านไม่สำเร็จ</p>";
    }
}
?>