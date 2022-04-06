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
                        <div class="card text-center">
                            <div class="card-header">
                                <ul class="nav nav-pills card-header-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active">ข้อมูลพนักงาน</a>
                                    </li>
                                </ul>
                            </div>
                            <?php
                            require('../php_action/dbconnect.php');
                            $sql = "SELECT * FROM staff WHERE id_staff = $id_staff";
                            $result = $con->query($sql);
                            $data_staff = $result->fetch_assoc();
                            ?>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-1 col-lg-2 col-md-1"></div>
            </div>
        </main>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>