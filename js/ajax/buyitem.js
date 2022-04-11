function loadtable() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("data").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "../php_action/showtable.php?action=repage");
    xmlhttp.send();
}

function repage(page) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../php_action/buyitems.php?action=repage&page="+ page);
    xmlhttp.send();
    loadtable();
}

function additemintable(word) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET", "../php_action/buyitems.php?action=addtable&keyword=" + word);
    xmlhttp.send();
    window.location = window.location.href;
}

function checkbarcode(Keyboard){
    if (Keyboard.keyCode == 13) {
        additemintable()
    }
}


function delectcart(id_staff, action) {
    if (confirm("โปรดยืนยัน อีกครั้งเพื่อลบข้อมูลในระบบ") == true) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "../php_action/buyitems.php?action=deletedata&id_staff=" + id_staff + "&actions=" + action);
        xmlhttp.send();
        loadtable();
        window.location = window.location.href;
    } else {
    }
}

function addnumber_item(number, id_item, id_staff) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../php_action/buyitems.php?action=number_item&number=" + number + "&id_item=" + id_item + "&id_staff=" + id_staff);
    xmlhttp.send();
    loadtable();
}

function buyitems(){
    if(confirm("โปรดยืนยัน คำสั้งซื้ออีกครั้ง") == true){
        window.location.href = '../php_action/buyitems.php?action=finish&bank=bank';
    }
}
function showform(){
    document.getElementById('form-hidden').removeAttribute("hidden");
}