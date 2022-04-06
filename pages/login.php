<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../php_action/bootstrap.php')?>
    <title>login/เข้าสู่ระบบ</title>
</head>
<body class="text-center" onload="datetime()">
<div class="form-signin">
    <div class="container card mt-5">
        <div class="row">
            <div class="col-lg-6 mt-3 align-items-center">
                <h1>ข่าวประชาสัมพันธ์</h1>
                <p id="time"><?php echo date("d-m-Y h:i:s")?><p>
            
            </div>
            <div class="col-lg-6 mt-3 align-items-center">
                <form action="../php_action/login_staff.php" name="login" method="post" class="form-control mb-3">
                    <h2 class="mt-3">ยินดีต้อนรับ โปรดเข้าสู่ระบบ</h2>
                    <label for="" class="form-label">รหัสพนักงาน</label>
                    <input type="text" class="form-control" name="numberstaff" id="" placeholder="รหัสพนักงาน เช่น 64209010025" required>
                    <label for="" class="form-label">รหัสผ่านพนักงาน</label>
                    <input type="password" class="form-control" name="password" placeholder="รหัสผ่านของคุณ" required>
                    <input type="hidden" name="form" value="login">
                    <input type="submit" class="btn btn-success mt-2" value="เข้าสู่ระบบ">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function datetime(){
    let datetime = new Date();
    time = datetime.toLocaleString();
    document.getElementById('time').innerHTML = time;
}
</script>
<?php 
session_start();
session_destroy();
?>
</body>
</html>