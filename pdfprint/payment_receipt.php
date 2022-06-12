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
<h6>ใบเสร็จแบบย่อ</h6>
<div class="details">
รายการยืนยันเลขที่ : $id_history
วันที่ออกใบเสร็จ : $datenow <br>
วันที่ทำรายการ : $datetime[0]
เวลาทำรายการ : $datetime[1]<br>
ชื่อผู้ทำรายการ : $row[fname_staff] $row[lname_staff]<br>
รหัสผู้ทำรายการ : $row[id_staff]
ช่องทางชำระเงิน : $row[transfer_history]<br>
</div>
EOF;

$pdf->writeHTML($title, true, true, true, false, '');   // write the HTML into the PDF

///ส่วนต่อไปนี้ คือ ส่วนของรายการสินค้า หรือ table
$pdf->resetColumns();
$table = <<<EOD
<h1 align="center">รายการสั่งซื้อสินค้า</h1>
<table border="1" align="center">
<tr style="background-color:AliceBlue;">
    <th>ลำดับ</th>
    <th>ชื่อสินค้า</th>
    <th>จำนวน</th>
    <th>ราคา(ต่อชิ้น)</th>
    <th>ราคารวม</th>
</tr>
</table>
EOD;
$//รอแยกออกมาจากเป็นแต่ละชนิดไม่ใช่ array
for ($i=0; $i < ; $i++) { 
    $table .= <<<EOD
<tr>
    <td>dad</td>
    <td>dfasdf</td>
    <td>dfasdf</td>
    <td>dfasdf</td>
    <td>dfasdf</td>
</tr>
EOD;
}
$pdf->writeHTML($table, true, true, true, false, ''); 

//Close and output PDF document
$pdf->Output('ใบเสร็จแบบย่อ.pdf', 'I');
