<?php if($_POST['action'] == "change"){
    require_once('dbconnect.php');
    $action = $con->real_escape_string($_POST['setting']);
    $id_setting = $con->real_escape_string($_POST['id_setting']);
    $sql = "UPDATE settings SET action_setting = $action Where id_setting = $id_setting";
    $result = $con->query($sql);

}