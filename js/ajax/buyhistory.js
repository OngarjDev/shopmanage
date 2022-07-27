function showsearch() {
    if (document.getElementById('btn_search').textContent == "ค้นหาสินค้าผ่านรหัส ยืนยันเลขที่") {
        document.getElementById('btn_search').textContent = "ยกเลิกการค้นหา"
        document.getElementById('input_search').removeAttribute('hidden');
    } else{
        document.getElementById('btn_search').textContent = "ค้นหาสินค้าผ่านรหัส ยืนยันเลขที่";
        document.getElementById('input_search').setAttribute('hidden', 'True');
    }
}

function ageen(id_history) {
    document.getElementById(id_history).removeAttribute("hidden");
}

function autosearch(keyword, page) {
    var url = '../php_action/buyhistory.php?action=search&page=' + page + '&keyword=' + keyword;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (keyword.length != 0) {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById('resultsearch').hidden = false;
                if (xmlhttp.responseText != null) {
                    document.getElementById('resultsearch').innerHTML = xmlhttp.responseText;
                } else {
                    document.getElementById('resultsearch').hidden = false;
                }
            }
        } else {
            document.getElementById('resultsearch').setAttribute('hidden', 'True');
        }
    }
    xmlhttp.open('GET', url);
    xmlhttp.send();
}
function checkenter(keyword, Keyboard, page) {
    if (Keyboard.keyCode == 13) {
        sendaddcart(keyword, page);
    }
}
function sendaddcart(keyword, page) {
    if (keyword.length != 0) {
        window.location.replace('../php_action/buyhistory.php?action=additembysearch&keyword=' + keyword + '&page=' + page);
    } else {
        alert("โปรดใส่ข้อมูลก่อนกดปุ่มEnterยืนยัน");
    }
};