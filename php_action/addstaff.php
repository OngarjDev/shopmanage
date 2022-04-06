<?php
require_once('dbconnect.php');
$fname = $con->real_escape_string($_POST['fname']);
$lname = $con->real_escape_string($_POST['lname']);
$pass = $con->real_escape_string(hash('sha512',$_POST['pass'],false));
$number = rand(1000,99999);
date_default_timezone_set('asia/bangkok');
$date_log = date('d-m-Y h:i:s');
$sql = "INSERT INTO staff(fname_staff,lname_staff,pass,number_staff,date_staff) values('$fname','$lname','$pass','$number','$date_log')";
$result = $con->query($sql);
header('location: ../pages/addstaff.php?info=รหัสพนักงานของคุณคือ'.$number.'   ชื่อ'.$fname.'   นามสกุล'.$lname);
?>