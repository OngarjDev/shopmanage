function autosearch(keyword,page) {
    var url = '../php_action/buyitem.php?action=search&page='+ page +'&keyword=' + keyword;
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
function checkenter(keyword, Keyboard ,page) {
    if (Keyboard.keyCode == 13) {
        sendaddcart(keyword,page);
    }
}
function sendaddcart(keyword,page) {
    if(keyword.length != 0){ /// สาเหตุที่ไม่ส่งแบบ ajax เพราะว่า ajax ส่งมาเฉพาะข้อมูลที่ต้องการไม่ได้อัพเดตตะกร้าให้ใหม่
        window.location.replace('../php_action/buyitem.php?action=additembysearch&keyword=' + keyword + '&page=' + page);
    }else{
        alert("โปรดใส่ข้อมูลก่อนกดปุ่มEnterยืนยัน");
    }
};
