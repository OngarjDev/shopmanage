<?php
require_once('dbconnect.php');
$fname = $con->real_escape_string($_POST['fname']);
$lname = $con->real_escape_string($_POST['lname']);
$pass = $con->real_escape_string(hash('sha512',$_POST['password'],false));
$number = rand(1000,99999);

$sql = "INSERT INTO staff(fname_staff,lname_staff,pass,number_staff,date_staff) values('$fname','$lname','$pass','$number',NOW())";
$result = $con->query($sql);
header('location: ../pages/addstaff.php?info=รหัสพนักงานของคุณคือ'.$number.'   ชื่อ'.$fname.'   นามสกุล'.$lname);
?>