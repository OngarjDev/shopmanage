function ageen(id_history) {
    document.getElementById(id_history).removeAttribute("hidden");
}

function search() {
    var keyword = document.getElementById('search').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("result").innerHTML = this.responseText;
            document.getElementById("result-hidden").removeAttribute("hidden");
        }
    }
    xmlhttp.open("GET", "../php_action/buyhistory.php?action=search&keyword=" + keyword);
    xmlhttp.send();
}

function checkbarcode(Keyboard) {
    if (Keyboard.keyCode == 13) {
        search()
    }
}
function confirmorder(value){
    var xmlhttp = new XMLHttpRequest();
    if(value == 'uncomfirm'){
    document.getElementById('checkboxorder').value = 'comfirm';
    xmlhttp.open("GET", "../php_action/buyhistory.php?action=confirm&order=confirm");
    xmlhttp.send();
    window.location = window.location.href;
    }
    if(value == 'comfirm'){
    document.getElementById('checkboxorder').value = 'uncomfirm';
    xmlhttp.open("GET", "../php_action/buyhistory.php?action=confirm&order=unconfirm");
    xmlhttp.send();
    window.location = window.location.href;
    }
}