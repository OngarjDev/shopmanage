function changesetting(id_setting,action){
    if(action == 1){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "../php_action/settings.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("action=change&id_setting=" + id_setting +"&setting=0");
    }else if(action == 0){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "../php_action/settings.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("action=change&id_setting=" + id_setting +"&setting=1");
    }
}