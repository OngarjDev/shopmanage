<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('../php_action/bootstrap.php') ?>
    <title>login/เข้าสู่ระบบ</title>
</head>

<body onload="datetime()">
    <div class="form-signin">
        <div class="container card mt-5">
            <div class="row mb-3">
                <div class="col-lg-6 mt-3">
                    <h1 class="text-center">ข่าวประชาสัมพันธ์</h1>
                    <p class="text-center" id="time"><?php echo date("d-m-Y h:i:s") ?>
                    <p>
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $sql = "SELECT * FROM news WHERE major_News = 1 ORDER BY id_news DESC LIMIT 2";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                    <div class="card mt-2 bg-light border-primary">
                        <div class="card-header">
                            <h5 class="card-title">
                                หัวข้อ :
                                <?php echo $row['title_News']; ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">รายละเอียด : <?php echo $row['content_News']; ?></p>
                            <p class="mt-2 mb-0">ลงวันที่-เวลา : <?php echo $row['datetime_News']; ?></p>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <div class="col-lg-6">
                    <form action="../php_action/login_staff.php" name="login" method="post" class="form-control text-center mb-3 mt-5">
                        <h2 class="mt-3 text-center">ยินดีต้อนรับ เข้าสู่ระบบ</h2>
                        <label for="" class="form-label">รหัสพนักงาน</label>
                        <input type="text" class="form-control" name="numberstaff" id="" placeholder="รหัสพนักงาน เช่น 64209010025" required>
                        <label for="" class="form-label">รหัสผ่านพนักงาน</label>
                        <input type="password" class="form-control" name="password" placeholder="รหัสผ่านของคุณ" required>
                        <input type="hidden" name="form" value="login">
                        <input type="submit" class="btn btn-success mt-2 w-100" value="เข้าสู่ระบบ">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="alert">
                                <strong>เกิดข้อผิดพลาด!</strong> <?= $_GET['error']?>
                                <button type="button" class="btn-close" onclick="hiddenalert()"></button>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['info'])) { ?>
                            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert" id="alert">
                                <strong>ข้อความจากระบบ!</strong> <?= $_GET['info']?>
                                <button type="button" class="btn-close" onclick="hiddenalert()"></button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function datetime() {
            let datetime = new Date();
            time = datetime.toLocaleString();
            document.getElementById('time').innerHTML = time;
        }
        setInterval(datetime, 1000);
        function hiddenalert(){
            document.getElementById('alert').setAttribute('hidden','true');
        }
    </script>
    <?php
    session_start();
    require_once('../php_action/dbconnect.php');
    $sql = "UPDATE staff SET login_staff = '0' WHERE id_staff = '" . $_SESSION['id_staff'] . "'";
    $result = $con->query($sql);
    
    $sql = "SELECT * FROM note WHERE id_staff = '" . $_SESSION['id_staff'] . "' AND type_note = 'login'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    date_default_timezone_set('Asia/Bangkok');
    $date_logout = $row['datetime_note'] . '//' . date("Y-m-d h:i:s");
    $sql = "UPDATE note SET type_note = 'logout',content_note = '$date_logout' WHERE id_staff = '" . $_SESSION['id_staff'] . "'";
    $result = $con->query($sql);
    session_destroy();
    ?>
</body>

</html>