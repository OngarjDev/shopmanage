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
if($_POST['action'] == 'editdata'){
    require('dbconnect.php');
    $fname = $con->real_escape_string($_POST['fname']);
    $lname = $con->real_escape_string($_POST['lname']);
    $number_staff = $con->real_escape_string($_POST['number_staff']);
    session_start();
    $sql = "UPDATE staff SET fname_staff = '$fname', lname_staff = '$lname', number_staff = '$number_staff' WHERE id_staff = '$_SESSION[id_staff]'";
    $result = $con->query($sql);
    if($result){
        header('location: ../pages/editprofile.php?info=แก้ไขข้อมูลโปรไฟล์เรียบร้อย');
    }else{
        header('location: ../pages/editprofile.php?error=ไม่สามารถแก้ไขข้อมูลโปรไฟล์ได้');
    }
}
?>