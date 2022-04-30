<!DOCTYPE html>
<html lang="en">

<head>
    <title>เพิ่มพนักงาน</title>
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
            <div class="container-xl">
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <?php if (isset($_GET['info'])) : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </symbol>
                            </svg>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                    <use xlink:href="#check-circle-fill" />
                                </svg>
                                <strong>การลงทะเบียนสำเร็จ</strong> <?php echo $_GET['info'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif ?>
                        <h1 class="text-center mt-3">สร้างพนักงานใหม่</h1>
                        <form class="row g-3" action="../php_action/addstaff.php" method="POST">
                            <div class="col-md-6">
                                <label class="form-label">ชื่อ</label>
                                <input type="text" name="fname" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">นามสกุล</label>
                                <input type="text" name="lname" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">รหัสผ่าน</label>
                                <input type="password" name="password" class="form-control" required>
                                <button type="submit" class="btn btn-primary mt-3 w-100">สร้างพนักงานใหม่</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>