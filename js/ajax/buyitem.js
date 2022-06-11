<<<<<<< HEAD
function autosearch(keyword, page) {
    var url = '../php_action/buyitem.php?action=search&page=' + page + '&keyword=' + keyword;
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
        window.location.replace('../php_action/buyitem.php?action=additembysearch&keyword=' + keyword + '&page=' + page);
    } else {
        alert("โปรดใส่ข้อมูลก่อนกดปุ่มEnterยืนยัน");
    }
};
function deletecart(id_item, page) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-2',
            cancelButton: 'btn btn-danger me-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'คุณยืนยันที่จะลบหรือไม่?',
        text: "การกระทำนี้จะไม่สามารถกู้คืนได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันที่จะลบ!',
        cancelButtonText: 'ยกเลิกการกระทำ',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('../php_action/buyitem.php?action=delete&id_item=' + id_item + '&page=' + page);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'การลบถูกยกเลิก',
                'ระบบถูกยกเลิกการลบข้อมูลโดยผู้ใช้',
                'error'
            )
        }
    })
}
function deleteallcart(page) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-2',
            cancelButton: 'btn btn-danger me-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        title: 'คุณยืนยันที่จะลบหรือไม่?',
        text: "การกระทำนี้จะไม่สามารถกู้คืนได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยันที่จะลบ!',
        cancelButtonText: 'ยกเลิกการกระทำ',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.replace('../php_action/buyitem.php?action=alldelete&page=' + page);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'การลบถูกยกเลิก',
                'ระบบถูกยกเลิกการลบข้อมูลโดยผู้ใช้',
                'error'
            )
        }
    })
}
function updatenumber_item(id_item, values, page) {
    if (values < 0) {
        Swal.fire(
            'ระบบไม่สามารถเพิ่มจำนวนสินค้าได้',
            'โปรดตรวจสอบจำนวนที่คุณใส่ไปอีกครั้ง ว่ามีสถานะติดลบหรือไม่',
            'error'
        )
    } else {
        window.location.replace('../php_action/buyitem.php?action=updatenumber_item&id_item=' + id_item + '&values=' + values + '&page=' + page);
    }
=======
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
>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
}