<!DOCTYPE html>
<html lang="en">

<head>
    <title>คู่มือการใช้งานระบบ</title>
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
            <h3 class="text-center mt-3">คู่มือการใช้งาน เวอร์ชั่น 1.0 (ภาษาไทย)</h3>
            <div class="card mx-auto w-50">
                <div class="card-body">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <h6>แบบออนไลน์(ใหม่ล่าสุดและทันสมัย)</h6>
                                <a href="https://docs.google.com/document/d/17o-yVkox0AemxmC88T2iD9OT7LMZVVCioML5izN8cLY/edit?usp=sharing" class="text-decoration-none">สำหรับ การใช้งานระบบ</a>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <h6>แบบออฟไลน์(ไม่แนะนำ)</h6>
                                <a href="../document/1.0.html" class="text-decoration-none">สำหรับ การใช้งานระบบ</a>
                            </div>
                            <p class="mt-5 text-secondary">สำหรับคู่มือการติดตั้งระบบ สามารถดูได้ที่โฟล์เดอร์ Documentที่ติดมา กับระบบ</p>
                        </div>
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