<?php
if ($_POST['action'] == 'resetpassword') {
    require_once('dbconnect.php');
    $id_staff = $_POST['id_staff'];
    $newpass = 'AB' . rand(0, 50000) . 'RAN';
    $pass = hash('sha512', $newpass, false);
    $sql = "UPDATE staff SET pass = '$pass' WHERE id_staff = '$id_staff'";
    $result = $con->query($sql);
    $txt = 'ระบบได้รีเซ็ตรหัสผ่านเรียบร้อยแล้ว รหัสผ่านใหม่ของคุณคือ' . $newpass . 'หลังจากเข้าสู่ระบบแล้วโปรดเปลี่ยนใหม่อีกครั้ง';
    $html = <<<ECHO
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
    </svg>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <strong>รีเซ็ตรหัสผ่านเรียบร้อย</strong> $txt
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ECHO;
    echo $html;
}
if ($_POST['action'] == 'suspend') {
    require_once('dbconnect.php');
    $id_staff = $_POST['id_staff'];
    $sql = "UPDATE staff SET statusstaff = '1' WHERE id_staff = '$id_staff'";
    $result = $con->query($sql);
}
if ($_POST['action'] == 'deletestaff') {
    require_once('dbconnect.php');
    $id_staff = $_POST['id_staff'];
    $sql = "DELETE FROM staff WHERE id_staff = '$id_staff'";
    $result = $con->query($sql);
    $html = <<<ECHO
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
    </svg>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <strong>ระบบได้ลงบัญชีเรียบร้อยแล้ว</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ECHO;
    echo $html;
}
if ($_POST['action'] == 'unsuspend') {
    require_once('dbconnect.php');
    $id_staff = $_POST['id_staff'];
    $sql = "UPDATE staff SET statusstaff = '0' WHERE id_staff = '$id_staff'";
    $result = $con->query($sql);
}
if ($_POST['action'] == 'search') {
    require_once('dbconnect.php');
    $keyword = $_POST['keyword'];
    $sql = "SELECT * FROM staff WHERE fname_staff LIKE '%$keyword%' OR lname_staff LIKE '%$keyword%' OR number_staff LIKE '%$keyword%'";
    $result = $con->query($sql);
    $html1 = <<<ECHO
        <div class="card mt-2 bg-light">
            <div class="card-body">
            <h2 class="text-center">ผลการค้นหาที่คล้ายกัน</h2>
    ECHO;
    echo $html1;
    $row_num = $result->num_rows;
    if ($row_num = $result->num_rows > 0) {
        for ($i=0; $i < 3 && $i <= $row_num; $i++) { 
        $row = $result->fetch_assoc();
        $fname = $row['fname_staff'];
        $lname = $row['lname_staff'];
        $number = $row['number_staff'];
        $id_staff = $row['id_staff'];
        $html2 = <<<ECHO
            <h6>ชื่อ : $fname </h6>
            <h6>นามสกุล : $lname </h6>
            <h6>รหัสพนักงาน : $number </h6>
            <a class="btn btn-primary w-100" href="#$id_staff">ไปที่ข้อมูล</a>
        <hr>
        ECHO;
        echo $html2;
        }
    } else {
        echo "<h1 class='text-center'>ไม่มีผลลัพธ์ที่ตรงกับคำค้นหา</h1>";
    }
    $html3 = <<<ECHO
        </div>
    </div>
    ECHO;
    echo $html3;
}
