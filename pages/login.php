<<<<<<< HEAD

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
                    <h5 class="card-title">
                        หัวข้อ :
                        <?php echo $row['title_News']; ?>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">รายละเอียด : <?php echo $row['content_News']; ?></p>
                        <p class="mt-2 mb-0">ลงวันที่-เวลา : <?php echo $row['datetime_News']; ?></p>
                    </div>
                    <hr>
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
                                <strong>เกิดข้อผิดพลาด!</strong> <?= $_GET['error'] ?>
                                <button type="button" class="btn-close" onclick="hiddenalert()"></button>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['info'])) { ?>
                            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert" id="alert">
                                <strong>ข้อความจากระบบ!</strong> <?= $_GET['info'] ?>
                                <button type="button" class="btn-close" onclick="hiddenalert()"></button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    session_start();
    if(isset($_SESSION['id_staff'])){
        require_once('../php_action/classcheck.php');
        $Limit = new check();
        $Limit->LimitData(); /// กำหนดระยะเวลาของข้อมูลจำกัดขนาดข้อมูล
        $Limit->UpdateStatus($_SESSION['id_staff']); /// กำหนดสถานะออนไลน์กับ ออฟไลน์ของพนักงาน
        $Limit->lognote($_SESSION['id_staff']); /// บันทึกเวลาออกพนักงาน
    }
    session_destroy();
    ?>
    <script>
        function datetime() {
            let datetime = new Date();
            time = datetime.toLocaleString();
            document.getElementById('time').innerHTML = time;
        }
        setInterval(datetime, 1000);

        function hiddenalert() {
            document.getElementById('alert').setAttribute('hidden', 'true');
        }
    </script>
</body>

=======
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
                    <h5 class="card-title">
                        หัวข้อ :
                        <?php echo $row['title_News']; ?>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">รายละเอียด : <?php echo $row['content_News']; ?></p>
                        <p class="mt-2 mb-0">ลงวันที่-เวลา : <?php echo $row['datetime_News']; ?></p>
                    </div>
                    <hr>
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
                                <strong>เกิดข้อผิดพลาด!</strong> <?= $_GET['error'] ?>
                                <button type="button" class="btn-close" onclick="hiddenalert()"></button>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['info'])) { ?>
                            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert" id="alert">
                                <strong>ข้อความจากระบบ!</strong> <?= $_GET['info'] ?>
                                <button type="button" class="btn-close" onclick="hiddenalert()"></button>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    session_start();

    require_once('../php_action/classcheck.php');
    $Limit = new check();
    $Limit->LimitData(); /// กำหนดระยะเวลาของข้อมูลจำกัดขนาดข้อมูล
    $Limit->UpdateStatus($_SESSION['id_staff']); /// กำหนดสถานะออนไลน์กับ ออฟไลน์ของพนักงาน
    $Limit->lognote($_SESSION['id_staff']); /// บันทึกเวลาออกพนักงาน

    session_destroy();
    ?>
    <script>
        function datetime() {
            let datetime = new Date();
            time = datetime.toLocaleString();
            document.getElementById('time').innerHTML = time;
        }
        setInterval(datetime, 1000);

        function hiddenalert() {
            document.getElementById('alert').setAttribute('hidden', 'true');
        }
    </script>
</body>

>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
</html>