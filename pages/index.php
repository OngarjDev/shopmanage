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
                    
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; ongarjdev.000webhostapp.com</div>
                            <a href="#">เงื่อนไขการใช้งาน</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php include('../php_action/scripts.php')?>
    </body>
</html>
