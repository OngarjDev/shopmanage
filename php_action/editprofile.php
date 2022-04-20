<?php
if($_POST['action'] == 'resetpassword'){
    require('dbconnect.php');
    $pass = $con->real_escape_string(hash('sha512', $_POST['data']));
    $staff = $con->real_escape_string($_POST['id_staff']);
    $sql_reset = "UPDATE staff SET pass = '$pass' WHERE id_staff = '$staff'";
    $result_reset = $con->query($sql_reset);
    if($result_reset){
        echo "<p class='text-center text-success'>เปลี่ยนรหัสผ่านเรียบร้อย</p>";
    }else{
        echo "<p class='text-center text-danger'>เปลี่ยนรหัสผ่านไม่สำเร็จ</p>";
    }
}
?>