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
            <h1 class="text-center mt-3 text-success">การชำระเงินเสร็จสิ้น</h1>
            <div class="btn-group w-100" role="group">
                <a class="btn btn-secondary" href="buyitem.php">กลับไปตะกร้าสินค้า</a>
                <a class="btn btn-primary" href="buyhistory.php">ดูประวัติการซื้อสินค้า</a>
                <a class="btn btn-secondary" href="../pdfprint/payment_receipt.php?id_history=<?= $_GET['id_history']?>">ใบเสร็จชำระเงิน</a>
                <a class="btn btn-primary" href="../pdfprint/payment_tax.php?id_history=<?= $_GET['id_history']?>">ใบกำกับภาษี</a>
            </div>
            <hr>
            <h3 class="text-center">รายละเอียดการชำระเงิน</h3>
            <div class="table-responsive mt-3">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col">ราคาต่อชิ้น</th>
                            <th scope="col">รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('../php_action/dbconnect.php');
                        $sql_history = "SELECT * FROM history WHERE id_history = '$_GET[id_history]'";
                        $result_history = $con->query($sql_history);
                        $row_history = $result_history->fetch_assoc();
                        $name_item = explode(',', $row_history['name_item']);
                        $amount = explode(',', $row_history['values_item']);
                        $price = explode(',', $row_history['price_item']);
                        for ($i=0; $i < count($name_item); $i++) { 
                        ?>
                        <tr>
                            <th scope="row"><?= $i + 1 ?></th>
                            <td><?= $name_item[$i]?></td>
                            <td><?= $amount[$i]?></td>
                            <td><?= $price[$i]?></td>
                            <td><?= $price[$i] * $amount[$i] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </main>
    </div>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>