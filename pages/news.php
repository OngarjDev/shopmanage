<!DOCTYPE html>
<html lang="en">

<head>
    <title>ข่าวสาร</title>
    <?php
    require('../php_action/classcheck.php');
    $check = new check();
    $check->securearea();
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
                <div class="row mt-3">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <form method="POST" action="../php_action/news.php" class="form-control">
                            <label class="form-label">หัวข้อ</label>
                            <input class="form-control" type="text" name="title" id="">
                            <label class="form-label">รายละเอียด</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
                            <label class="form-label">ลำดับความสำคัญ</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="true" name="major">
                                <label class="form-check-label">
                                    ทุกคนต้องเห็นข้อความนี้
                                </label>
                            </div>
                            <input type="hidden" name="action" value="addnews">
                            <input type="submit" class="btn btn-primary mt-2 w-100" value="ส่งข่าวสาร">
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <h3 class="text-center mt-2">ข่าวสารทั้งหมด</h3>
                        <?php
                        require_once('../php_action/dbconnect.php');
                        $sql = "SELECT * FROM news ORDER BY id_news DESC LIMIT 4";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <div class="card mt-2 bg-light">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        หัวข้อ :
                                        <?php echo $row['title_News']; ?>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">รายละเอียด : <?php echo $row['content_News']; ?></p>
                                    <?php
                                    if ($row['major_News'] == '1') {
                                        echo "<div class='text-success'>(สำคัญ)</div>";
                                    } else {
                                        echo "<div class='text-danger'>(ทั่วไป)</div>";
                                    }
                                    ?>
                                    <p class="mt-2 mb-0">ลงวันที่-เวลา : <?php echo $row['datetime_News']; ?></p>
                                </div>
                                <button class="btn btn-danger" onclick="deletenews(<?= $row['id_News'] ?>)">ลบข้อมูล</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
        </main>
    </div>
    </div>
    <script>
        function deletenews(id_News) {
            if (confirm("โปรดตรวจสอบให้แน่ใจ ก่อนลบบัญชีถาวร")) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "../php_action/news.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("action=deletenews&id_news=" + id_News);
                window.location = window.location.href;
                alert("ระบบได้ ลบเรียบร้อยแล้ว");
            }
        }
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>