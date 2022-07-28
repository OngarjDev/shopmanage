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
};