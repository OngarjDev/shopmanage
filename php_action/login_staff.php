<?php
if (isset($_POST['form']) && $_POST['form'] == 'login') {
    require('dbconnect.php');
    $numberstaff = $con->real_escape_string($_POST['numberstaff']);
    $pass = $con->real_escape_string(hash('sha512', $_POST['password'], false));

    $sql = "SELECT * FROM staff WHERE number_staff = '$numberstaff' AND pass = '$pass'";
    $result = $con->query($sql);
    if ($result->num_rows == 1) {
        $data_staff = $result->fetch_assoc();
        session_start();
        if ($data_staff['statusstaff'] == 0) {
            $_SESSION['id_staff'] = $data_staff['id_staff'];
            $_SESSION['name_staff'] = $data_staff['fname_staff'];
            header('location: ../pages/index.php');
        }else{
            header('location: ../pages/suspend-account.php');
        }
    } else {
        header('location: ../pages/login.php?ไม่พบผู้ใช้');
    }
}
