<!DOCTYPE html>
<html lang="en">
    <head>
        <title>หน้าหลัก</title>
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
                        <div class="row">
                            <div class="col-xl-1 col-lg-1 col-md-1"></div>
                            <div class="col-xl-10 col-lg-10 col-md-10">
                                <h1 class="text-center mt-2">ยินดีต้อนรับ <?php echo $name_staff?></h1>
                                
                            </div>
                            <div class="col-xl-1 col-lg-1 col-md-1"></div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php include('../php_action/scripts.php')?>
    </body>
</html>
