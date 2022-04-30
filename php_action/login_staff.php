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
            if ($data_staff['login_staff'] == 0) {
                $_SESSION['id_staff'] = $data_staff['id_staff'];
                $_SESSION['name_staff'] = $data_staff['fname_staff'];
                if ($data_staff['admin'] == 1) {
                    $_SESSION['admin'] = 1;
                }
                $sql = "UPDATE staff SET login_staff = 1,datelogin_staff = Now() WHERE id_staff = '$data_staff[id_staff]'";
                $result = $con->query($sql);

                $sql = "INSERT INTO note(id_staff,content_note,datetime_note,type_note,name_staff) VALUES('$data_staff[id_staff]',Now(),Now(),'login','$data_staff[fname_staff]')";
                $result = $con->query($sql);
                header('location: ../pages/index.php');
            } else {
                $sql = "SELECT id_staff FROM staff WHERE id_staff = '$data_staff[id_staff]' AND (datelogin_staff + INTERVAL 30 MINUTE) < Now()";
                $result = $con->query($sql);
                if ($result->num_rows == 1) {
                    $sql = "UPDATE staff SET login_staff = 1,datelogin_staff = Now() WHERE id_staff = '$data_staff[id_staff]'";
                    $result = $con->query($sql);

                    $sql = "SELECT datetime_note FROM note WHERE id_staff = '" . $_SESSION['id_staff'] . "' AND type_note = 'login'";
                    $result = $con->query($sql);
                    $row = $result->fetch_assoc();

                    date_default_timezone_set('Asia/Bangkok');
                    $date_logout = $row['datetime_note'] . '//' . date("Y-m-d h:i:s");
                    $sql = "UPDATE note SET type_note = 'logout',content_note = '$date_logout' WHERE id_staff = '" . $_SESSION['id_staff'] . "'";
                    $result = $con->query($sql);

                    $sql = "INSERT INTO note(id_staff,content_note,datetime_note,type_note,name_staff) VALUES('$data_staff[id_staff]',Now(),Now(),'login','$data_staff[fname_staff]')";
                    $result = $con->query($sql);

                    $_SESSION['id_staff'] = $data_staff['id_staff'];
                    $_SESSION['name_staff'] = $data_staff['fname_staff'];
                    if ($data_staff['admin'] == 1) {
                        $_SESSION['admin'] = 1;
                    }

                    header('location: ../pages/index.php');
                } else {
                    header('location: ../pages/login.php?error=พบการลงทะเบียนระบบซ้ำกัน กรุณาติดต่อผู้ดูแลระบบ');
                }
            }
        } else {
            header('location: ../pages/suspend-account.php');
        }
    } else {
        header('location: ../pages/login.php?error=ไม่พบผู้ใช้ในระบบ หรือ รหัสผ่านไม่ถูกต้อง กรุณาติดต่อผู้ดูแลระบบ');
    }
}

if ($_GET['action'] == 'updatetime') {
    session_start();
    $id_staff = $_SESSION['id_staff'];
    require('dbconnect.php');
    $sql = "UPDATE staff SET datelogin_staff = Now() WHERE id_staff = '$id_staff'";
    $result = $con->query($sql);
}
