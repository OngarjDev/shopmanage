function resetpassword(id_staff) {
    if (confirm("โปรดตรวจสอบให้แน่ใจ ก่อนรีเซ็ตรหัสผ่าน")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("alert").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("POST", "../php_action/staff.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("action=resetpassword&id_staff=" + id_staff);
    } else {
        alert("การรีเซ็ตรหัสผ่าน ถูกยกเลิกโดยผู้ใช้");
    }
}
function suspend(id_staff) {
    if (confirm("โปรดตรวจสอบให้แน่ใจ ก่อนพักบัญชี")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "../php_action/staff.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("action=suspend&id_staff=" + id_staff);
        window.location = window.location.href;
        alert("บัญชีได้ถูกพักชั่วคราวเรียบร้อยแล้ว");
    } else {
        alert("ระบบ ถูกยกเลิกโดยผู้ใช้");
    }
}
function deletestaff(id_staff) {
    if (confirm("โปรดตรวจสอบให้แน่ใจ ก่อนลบบัญชีถาวร")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "../php_action/staff.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("action=deletestaff&id_staff=" + id_staff);
        window.location = window.location.href;
        alert("ระบบได้ลบบัญชีเรียบร้อยแล้ว");
    } else {
        alert("การรีเซ็ตรหัสผ่าน ถูกยกเลิกโดยผู้ใช้");
    }
}
function unsuspend(id_staff) {
    if (confirm("โปรดตรวจสอบให้แน่ใจ ก่อนยกเลิกพักบัญชี")) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "../php_action/staff.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("action=unsuspend&id_staff=" + id_staff);
        window.location = window.location.href;
        alert("การพักบัญชีได้ถูกยกเลิก");
    } else {
        alert("ไม่สามารถพักบัญชีได้ ถูกยกเลิกโดยผู้ใช้");
    }
}
function search() {
    var keyword = document.getElementById('searchstaff').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("datasearch").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("POST", "../php_action/staff.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("action=search&keyword=" + keyword);
}