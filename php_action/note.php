<?php
if($_GET['action'] == 'selectdata'){
    session_start();
    $_SESSION['dataselect'] = $_GET['dataselect'];
    header('location: ../pages/note.php');
}
?>