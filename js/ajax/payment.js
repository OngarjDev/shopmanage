function paymentcash() {
    if (document.getElementById('btnpaycash').textContent != 'ยกเลิกการชำระเงินด้วยเงินสด') {
        document.getElementById('form_paycash').removeAttribute('hidden');
        document.getElementById('btnpaycash').textContent = 'ยกเลิกการชำระเงินด้วยเงินสด';
    } else {
        document.getElementById('form_paycash').setAttribute('hidden', 'True');
        document.getElementById('btnpaycash').textContent = 'ช่องทางการรับเงินสด';
    }
}
function agree_paymentcash() {
    var money = document.getElementById('textmoney').value;
    Swal.fire({
        title: 'คุณจะชำระเงินด้วยเงินสดหรือไม่?',
        text: "การดำเนินการนี้ จะทำให้คุณไม่สามารถแก้ไขรายการสินค้าได้อีก",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันที่จะชำระเงิน',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../php_action/buyitem.php?action=payment&bank=cash&money=' + money;
        }
    })
}
function paymentbank() {
    Swal.fire({
        title: 'คุณจะลงรูปสลิปใบเสร็จเลยหรือไม่?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'ใช่ยืนยันที่จะลงรูป',
        denyButtonText: `ไว้คราวหลัง`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            if (document.getElementById('btnpaybank').textContent != 'ยกเลิกการชำระเงินด้วยเงินสด') {
                document.getElementById('form_paybank').removeAttribute('hidden');
                document.getElementById('btnpaybank').textContent = 'ยกเลิกการชำระเงินด้วยเงินสด';
            } else {
                document.getElementById('form_paybank').setAttribute('hidden', 'True');
                document.getElementById('btnpaybank').textContent = 'ช่องทางการรับเงินสด';
            }
        } else if (result.isDenied) {
            Swal.fire({
                title: 'คุณยืนยันที่จะทำธุรกรรม หรือไม่?',
                text: "คำแนะนำ คุณสามารถเพิ่มรูปสลิปได้ ในคราวหลัง (แต่ไม่สามารถแก้ไขข้อมูลสั่งซื้อได้)",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยันที่จะทำธุรกรรม',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../php_action/buyitem.php?action=payment&bank=bank&image=noimage';
                }
            })
        }
    })
}
function calculator(paycash,total) {
    var change = paycash - total;
    if(paycash >= total){
        document.getElementById('textchange').textContent = 'จำนวนเงินทอน '+ Math.ceil(change) + ' บาท';
        document.getElementById('textchange').classList.add('text-success');
        document.getElementById('textchange').classList.remove('text-danger');
        document.getElementById('ageepaycash').removeAttribute('disabled');
    }else if(paycash < total){
    var change = total - paycash;
        document.getElementById('textchange').textContent = 'จำนวนเงินที่ชำระไม่ถูกต้อง จำนวนเงินไม่เพียงพอ';
        document.getElementById('textchange').classList.add('text-danger');
        document.getElementById('textchange').classList.remove('text-success');
        document.getElementById('ageepaycash').setAttribute('disabled','True');
    }

}