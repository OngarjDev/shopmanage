<!DOCTYPE html>
<html lang="en">

<head>
    <title>ข่าวสาร</title>
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
                <div class="row mt-3">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <form method="" action="" class="form-control">
                            <label class="form-label">หัวข้อ</label>
                            <input class="form-control" type="text" name="" id="">
                            <label class="form-label">รายละเอียด</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                            <label class="form-label">ลำดับความสำคัญ</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                                <label class="form-check-label">
                                    ทุกคนต้องเห็นข้อความนี้
                                </label>
                            </div>
                            <input type="submit" class="btn btn-primary mt-2 w-100" value="ส่งข่าวสาร">
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="border border-info rounded">
                            <h3 class="text-center mt-2">ข่าวสารทั้งหมด</h3>
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>