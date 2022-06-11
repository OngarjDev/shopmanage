<<<<<<< HEAD
<?php
session_start();

if (!isset($_SESSION['id_staff']) || !isset($_SESSION['name_staff'])) {///ตรวจสอบการเข้าสู่ระบบ
    header('location: login.php');
}
$id_staff = $_SESSION['id_staff'];
$name_staff = $_SESSION['name_staff'];

?>
<script>
    function checktime() {
        window.location.href = '../pages/login.php?info=ระบบไม่พบการเคลื่อนไหวของคุณ ถูกตัดการเชื่อมต่อโดยระบบ';
    }

    function updatetime() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/login_staff.php?action=updatetime");
        xmlhttp.send();
    }
    window.onload = updatetime();
    setInterval(checktime,3000000);/// เป็น 30 นาที ตรวจสอบการเชื่อมต่อ
</script>
=======
<?php
session_start();

if (!isset($_SESSION['id_staff']) || !isset($_SESSION['name_staff'])) {
    header('location: login.php');
}
$id_staff = $_SESSION['id_staff'];
$name_staff = $_SESSION['name_staff'];

?>
<script>
    function checktime() {
        window.location.href = '../pages/login.php?info=ระบบไม่พบการเคลื่อนไหวของคุณ ถูกตัดการเชื่อมต่อโดยระบบ';
    }

    function updatetime() {
        var xhttp = new XMLHttpRequest();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/login_staff.php?action=updatetime");
        xmlhttp.send();
    }
    window.onload = updatetime();
    setInterval(checktime,3000000);
</script>
?>
>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
