<?php
class check
{
    ///class นี้มีไว้เพื่อจำกัดขนาดของข้อมูลไม่ให้ฐานข้อมูลมีข้อมูลมากเกินไป
    private $id_staff;
    public function LimitData()
    {
        /// กำหนดระยะเวลาของข้อมูลจำกัดขนาดข้อมูล
        require('dbconnect.php');
        $sql = "DELETE FROM history WHERE datetime_history < DATE_SUB(NOW(), INTERVAL 24 MONTH)";//อย่าต่ำกว่า 12เดือน เพราะจะแสดงกราฟไม่ครบทุกเดือน
        $con->query($sql);
        $sql = "DELETE FROM note WHERE datetime_note < DATE_SUB(NOW(), INTERVAL 3 MONTH)";
        $con->query($sql);
        $sql = "DELETE FROM News WHERE datetime_News < DATE_SUB(NOW(), INTERVAL 5 MONTH)";
        $con->query($sql);
    }
    public function UpdateStatus($id_staff)
    {
        ///กำหนดสถานะออนไลน์กับ ออฟไลน์ของพนักงาน
        require('dbconnect.php');
        $sql = "UPDATE staff SET login_staff = '0' WHERE id_staff = '$id_staff'";
        $con->query($sql);
    }
    public function lognote($id_staff)
    {
        /// บันทึกเวลาออกพนักงาน
        require('dbconnect.php');
        $sql = "SELECT datetime_note,id_note FROM note WHERE id_staff = '$id_staff' AND type_note = 'login'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();

        date_default_timezone_set('Asia/Bangkok');
        $date_logout = $row['datetime_note'] . '//' . date("Y-m-d h:i:s");
        $sql = "UPDATE note SET type_note = 'logout',content_note = '$date_logout' WHERE id_note = '$row[id_note]' ";
        $con->query($sql);
    }
    public function securearea()//ป้องกันการเข้าถึงหน้าผู้จัดการร้านค้าผ่านUrl โดยไม่มีสิทธิเข้าถึง
    {
        session_start();
        if(!isset($_SESSION['admin'])){
            header("location: ../pages/login.php?error=คุณไม่มีสิทธิเข้าถึงหน้าดังกล่าว");
        }
    }
}
