<<<<<<< HEAD
<?php
if($_GET['action'] == 'selectdata'){
    session_start();
    $_SESSION['dataselect'] = $_GET['dataselect'];
    header('location: ../pages/note.php');
}
=======
<?php
if($_GET['action'] == 'selectdata'){
    session_start();
    $_SESSION['dataselect'] = $_GET['dataselect'];
    header('location: ../pages/note.php');
}
>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
?>