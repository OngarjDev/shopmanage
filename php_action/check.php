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
        window.location.href = '../pages/login.php?info=ระบบไม่พบการเคลื่อนไหวของคุณ จึงตัดการเชื่อมต่อจากระบบ';
    }

    function updatetime() {
        var xhttp = new XMLHttpRequest();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/login_staff.php?action=updatetime");
        xmlhttp.send();
    }
    window.onload = updatetime();
    setInterval(checktime,400000);
</script>