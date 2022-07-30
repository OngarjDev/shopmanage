<!DOCTYPE html>
<html lang="en">

<head>
    <title>ประวัติการซื้อสินค้าทั้งหมด</title>
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
            <div class="col-xl-2 col-lg-2 col-md-2">

            </div>
            <div class="col-xl-8 col-lg-8 col-md-8">
                <?php if($_GET[''] == "")?>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2">

            </div>
        </main>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>