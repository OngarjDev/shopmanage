<!DOCTYPE html>
<html lang="en">

<head>
    <title>ข้อมูลพนักงาน</title>
    <?php
    require('../php_action/check.php');
    include('../php_action/bootstrap.php');
    ?>
</head>

<body class="sb-nav-fixed">
    <?php
    include('../layout/nav.html');
    include('../layout/menu.html');
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-xl-1 col-lg-2 col-md-1"></div>
                    <div class="col-xl-10 col-lg-8 col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills card-header-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active">ข้อมูลพนักงาน</a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            require('../php_action/dbconnect.php');
                            $sql = "SELECT fname_staff,lname_staff,number_staff,admin,date_staff,id_staff FROM staff WHERE id_staff = $id_staff";
                            $result = $con->query($sql);
                            $data_staff = $result->fetch_assoc();
                            ?>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <h4>ชื่อ : <?= $data_staff['fname_staff'] ?></h4>
                                            <h4>นามสกุล : <?= $data_staff['lname_staff'] ?></h4>
                                            <h4>รหัสพนักงาน : <?= $data_staff['number_staff'] ?></h4>
                                            <h4>ระดับสิทธิ : <?php if ($data_staff['admin'] == 1) {
                                                                    echo "เจ้าของร้าน";
                                                                } else {
                                                                    echo "พนักงาน";
                                                                } ?></h4>
                                            <h4>วันที่สร้างบัญชี : <?= $data_staff['date_staff'] ?></h4>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <h5 class="text-center">จัดการบัญชี</h5>
                                            <button class="btn btn-warning w-100" onclick="resetpassword()">เปลี่ยนรหัสผ่าน</button>
                                            <div id="formresetpassword" hidden>
                                                <label class="form-lable mt-2">รหัสผ่านใหม่</label>
                                                <input class="form-control" type="password" name="" id="password1" required>
                                                <label class="form-lable">ใส่รหัสผ่านใหม่อีกครั้ง</label>
                                                <input class="form-control" type="password" name="" id="password2" required>
                                                <button class="btn btn-danger w-100 mt-3" onclick="sendpassword()">เปลี่ยนรหัสผ่าน</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-1"></div>
            </div>
        </main>
    </div>
    <?php include('../php_action/scripts.php') ?>
    <script>
        function resetpassword() {
            document.getElementById('formresetpassword').hidden = false;
        }

        function sendpassword() {
            var pass1 = document.getElementById('password1').value;
            var pass2 = document.getElementById('password2').value;
            if (pass1 == pass2 && pass1 != '' && pass2 != '') {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("formresetpassword").innerHTML = this.responseText;
                    }
                }
                xmlhttp.open("POST", "../php_action/editprofile.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("action=resetpassword&data=" + pass2 + "&id_staff=" + <?= $id_staff ?>);
            } else {
                alert('รหัสผ่านไม่ตรงกัน,ไม่อนุญาติให้ใช้รหัสผ่านนี้');
                return false;
            }
        }
    </script>
</body>

</html>