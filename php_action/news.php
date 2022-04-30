<?php
if ($_POST['action'] == 'addnews') {
    require_once('dbconnect.php');
    $title = $con->real_escape_string($_POST['title']);
    $content = $con->real_escape_string($_POST['content']);
    $major = $con->real_escape_string($_POST['major']);
    if($major == 'true'){
        $star = 1;
    }else{
        $star = 0;
    }
    $sql = "INSERT INTO news (title_News, content_News, major_News,datetime_News) VALUES ('$title', '$content', '$star',NOW())";
    $result=$con->query($sql);
    header('location: ../pages/news.php');
}
if($_POST['action'] == 'deletenews'){
    require_once('dbconnect.php');
    $id_news = $con->real_escape_string($_POST['id_news']);
    $sql = "DELETE FROM news WHERE id_News = '$id_news'";
    $result=$con->query($sql);
    header('location: ../pages/news.php');
}