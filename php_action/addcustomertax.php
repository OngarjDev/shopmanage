<?php
if($_GET['action'] == 'addnametax'){
    $id_history = $_GET['id_history'];
    $fname = $_GET['fname'];
    $address = $_GET['address'];
    require_once('../php_action/dbconnect.php');
    $sql = "UPDATE history SET nametax_history = '$fname', address_history = '$address' WHERE id_history = '$id_history'";
    $result = $con->query($sql);
    header('location:../pages/finishbuyitem.php?id_history='.$id_history);
}
?>