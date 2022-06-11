<<<<<<< HEAD
function loaditem() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("data_listitem").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "../php_action/allitem.php");
    xmlhttp.send();
}

function showtable(value){
    if(value == 'card_item'){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/allitem.php?view=card_item");
        xmlhttp.send();
    }
    if(value == 'table_item'){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/allitem.php?view=table_item");
        xmlhttp.send();
    }
}

function option(){
    var xmlhttp = new XMLHttpRequest();
    var option = document.getElementById('option').value;
    console.log(option);
    xmlhttp.open("GET", "../php_action/allitem.php?order="+option);
    xmlhttp.send();
}

function search(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("search_item").innerHTML = this.responseText;
        }
    }
    var keyword = document.getElementById('search').value;
    xmlhttp.open("GET", "../php_action/aboutitem.php?search="+keyword);
    xmlhttp.send();
}

function keyword(Keyboard){
    if (Keyboard.keyCode == 13) {
        search();
    }
}
=======
function loaditem() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("data_listitem").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "../php_action/allitem.php");
    xmlhttp.send();
}

function showtable(value){
    if(value == 'card_item'){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/allitem.php?view=card_item");
        xmlhttp.send();
    }
    if(value == 'table_item'){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/allitem.php?view=table_item");
        xmlhttp.send();
    }
}

function option(){
    var xmlhttp = new XMLHttpRequest();
    var option = document.getElementById('option').value;
    console.log(option);
    xmlhttp.open("GET", "../php_action/allitem.php?order="+option);
    xmlhttp.send();
}

function search(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("search_item").innerHTML = this.responseText;
        }
    }
    var keyword = document.getElementById('search').value;
    xmlhttp.open("GET", "../php_action/aboutitem.php?search="+keyword);
    xmlhttp.send();
}

function keyword(Keyboard){
    if (Keyboard.keyCode == 13) {
        search();
    }
}
>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
