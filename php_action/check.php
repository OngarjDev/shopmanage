<?php
session_start();
if(!isset($_SESSION['id_staff']) || !isset($_SESSION['name_staff'])){
    header('location: login.php');
}
$id_staff = $_SESSION['id_staff'];
$name_staff = $_SESSION['name_staff'];

?>