<?php
require_once('../php_action/dbconnect.php');
$sql = "SELECT id_history FROM history WHERE id_history = '$_GET[id_history]' AND nametax_history IS Null AND address_history IS Null";
$result = $con->query($sql);
echo $result->num_rows;
if($result->num_rows == 0){ ///ตรวจสอบว่ามีข้อมูลหรือไม่ ถ้าหากมากกว่า 0 แสดงว่ายังไม่มีเพราะ เป็น IS Null คือยังไม่มีข้อมูล
    header('location:../pdfprint/payment_tax.php?id_history='.$_GET['id_history']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ฟอร์มกรอกข้อมูลใบภาษี</title>
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
                        <h1 class="text-center mt-3">กรอกใบภาษีแบบเต็ม</h1>
                        <div class="row g-3">
                            <label class="form-label">ชื่อ(ผู้ขอใบภาษีแบบเต็ม)</label>
                            <input type="text" id="fname" class="form-control" required>
                            <label class="form-label">ที่อยู่(ผู้ขอใบภาษีแบบเต็ม)</label>
                            <input type="text" id="address" class="form-control" required>
                            <button class="btn btn-danger w-100" onclick="ageen()">ยืนยันการสร้างใบกำกับภาษีแบบเต็ม</button>
                        </div>
                        <div class="text-center">
                            <h3 class="mt-3">คำชี้แจง</h3>
                            <p>การขอใบภาษีแบบเต็ม จำเป็นต้องใช้ชื่อผู้ซื้อ เช่น บริษัท พัดลม จำกัด มหาชน ตามกฎหมาย มาตรา 86/3 แห่งประมวลรัษฎากร</p>
                            <p>รวมทั้งที่อยู่ผู้ขอภาษีแบบเต็ม หากยืนยันสร้างภาษีแบบเต็มแล้วข้อมูลทั้งหมดจะแก้ไขไม่ได้อีก ดังนั้นโปรดตรวจสอบให้ละเอียดก่อนบันทึก</p>
                            <p>อ้างอิงแบบย่อ <a href="../document/vatdoc.pdf">คลิกที่นี่</a></p>
                            <p>อ้างอิงแบบละเอียด <a href="https://www.rd.go.th/5207.html">คลิกที่นี่</a></p>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1"></div>
                </div>
            </div>
        </main>
    </div>
    </div>
    <script>
        function ageen() {
            var fname = document.getElementById("fname").value;
            var address = document.getElementById("address").value;
            if (fname == " " || address == "") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'โปรดกรอกข้อมูลให้ครบถ้วน'
                })
            } else {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success me-2',
                        cancelButton: 'btn btn-danger me-2'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: 'คุณยืนยันที่จะสร้างใบกำกับภาษีแบบเต็มหรือไม่?',
                    text: "การกระทำนี้จะไม่สามารถกู้คืนได้!",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'ยืนยันที่จะสร้าง',
                    cancelButtonText: 'ยกเลิกการกระทำ',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../php_action/addcustomertax.php?action=addnametax&fname=" + fname + "&address=" + address + "&id_history=" + <?php echo $_GET['id_history'] ?>;
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'ถูกยกเลิกการกระทำ',
                            'การสร้างใบกำกับภาษีแบบเต็มถูกยกเลิก',
                            'error'
                        )
                    }
                })
            }
        }
    </script>
    <?php include('../php_action/scripts.php') ?>
</body>

</html>