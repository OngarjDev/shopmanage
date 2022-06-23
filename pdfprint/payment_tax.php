<?php
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('ใบเสร็จแบบย่อ');
$pdf->SetKeywords('TCPDF, PDF,');

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setPrintHeader(false);


// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font
$pdf->SetFont('helvetica', '', 10);
$pdf->SetFont('thsarabun', '2', 15);

// add a page
$pdf->AddPage();
$pdf->resetColumns();
$pdf->setEqualColumns(2, 84);
$pdf->selectColumn(2);

if(!isset($_GET['id_history'])){
    header('location: ../index.php');
}else{
    $id_history = $_GET['id_history'];
    $sql = "SELECT * FROM history INNER JOIN staff ON history.id_staff = staff.id_staff WHERE history.id_history = '$id_history'";
    require_once('../php_action/dbconnect.php');
    $query = $con->query($sql);
    $row = $query->fetch_assoc();
}
$shoptitle = <<<EOD
<style>
h1{
    font-size: 30px;
    line-height: 64%
}
p{
    font-size: 20px;
    line-height: 80%
}
</style>
<h1>ร้านค้า ยิ้มแย้มshop รหัสสาขา 111<br><h1><br>
<p>ที่อยู่ 123/456 ถนนรัชดาภิเษก เขตบึงกุ่ม กรุงเทพฯ 10900 เบอร์0000000000</p>

EOD;
$pdf->writeHTML($shoptitle, true, false, false, false, '');
$pdf->selectColumn(1);
$datenow = date('Y-m-d');
$datetime = explode(' ',$row['datetime_history']);
if($row['transfer_history'] == 'cash'){
    $transfer = 'เงินสด';
}
if($row['transfer_history'] == 'bank'){
    $transfer = 'โอนผ่านบัญชีธนาคาร';
}
$title = <<<EOF
<style>
h6 {
    font-size: 55px;
    text-align: right;
    color: #4CAF50;
    line-height: 20%
}
.details{
    text-align: right;
}
</style>
<h6>ใบกำกับภาษี</h6>
<div class="details">
รายการยืนยันเลขที่ : $id_history
วันที่ออกใบเสร็จ : $datenow <br>
วันที่ทำรายการ : $datetime[0]
เวลาทำรายการ : $datetime[1]<br>
ชื่อผู้ทำรายการ : $row[fname_staff] $row[lname_staff]<br>
รหัสผู้ทำรายการ : $row[id_staff]
ช่องทางชำระเงิน : $transfer<br>
</div>
EOF;

$pdf->writeHTML($title, true, true, true, false, '');   // write the HTML into the PDF

$pdf->resetColumns();
$user_show = <<<DATA
<br>
    ชื่อผู้ซื้อ $row[nametax_history]<br>
    ที่อยู่(ผู้ซื้อ) $row[address_history]
DATA;
$pdf->writeHTML($user_show, true, true, true, false, ''); 

///ส่วนต่อไปนี้ คือ ส่วนของรายการสินค้า หรือ table
$table = <<<EOD
<h1 align="center">รายการสั่งซื้อสินค้า</h1>
<table border="1" align="center">
<tr style="background-color:AliceBlue;">
    <th>ลำดับ</th>
    <th>รายการ</th>
    <th>จำนวน</th>
    <th>ราคาต่อหน่อย</th>
    <th>จำนวนเงิน</th>
</tr>
EOD;
$name_item = explode(',',$row['name_item']);
$amount_item = explode(',',$row['values_item']);
$price_item = explode(',',$row['price_item']);
$allprice_notax = [];
$allnumber_item = [];
for ($i=0; $i < count($name_item); $i++) { 
    $priceall_item = $amount_item[$i] * $price_item[$i];
    array_push($allprice_notax,$priceall_item);
    array_push($allnumber_item,$amount_item[$i]);
    $number = $i + 1;
    $table .= <<<EOD
<tr>
    <td>$number</td>
    <td>$name_item[$i]</td>
    <td>$amount_item[$i]</td>
    <td>$price_item[$i]</td>
    <td>$priceall_item</td>
</tr>
EOD;
}
$money = array_sum($allprice_notax);
$tax = $money * 0.07;
$money_tax = $money + $tax;
$allnumber_item = array_sum($allnumber_item);

$table .= <<<EOD
<tr>
<td colspan="2" align="center">ราคาเดิม</td>
<td colspan="3" align="center">$money บาท</td>
</tr>
<tr>
<td colspan="2" align="center">ภาษีมูลค่าเพิ่ม 7 %</td>
<td colspan="3" align="center">$tax บาท</td>
</tr>
<tr style="background-color:AliceBlue;">
    <td colspan="2" align="center">จำนวนรายการ $number รายการ</td>
    <td align="center">$allnumber_item ชิ้น</td>
    <td colspan="2" align="center">ราคาทั้งหมด(รวมภาษี) $money_tax บาท</td>
</tr>
EOD;
$table .= <<<EOD
</table>
EOD;

$pdf->writeHTML($table, true, true, true, false, ''); 

$pdf->setEqualColumns(2, 84);
$pdf->selectColumn(1);
$customer .= <<<EOD
<p align="right">ลงชื่่อพนักงานรับเงิน.........................................</p>
EOD;
$pdf->writeHTML($customer, true, true, true, false, '');

$pdf->selectColumn(2);
$staff .= <<<EOD
<p align="right">ลงชื่่อผู้ซื้อ.........................................</p>
EOD;
$pdf->writeHTML($staff, true, true, true, false, '');

//Close and output PDF document
$pdf->Output('ใบเสร็จแบบเต็ม.pdf', 'I');
