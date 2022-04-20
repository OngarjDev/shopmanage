<?php
session_start();
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('../php_action/dbconnect.php');

session_start();
if (!isset($_SESSION['id_staff']) || !isset($_SESSION['name_staff'])) {
    header('location: login.php');
}
$id_staff = $_SESSION['id_staff'];
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');

$pdf->SetCreator('shopmanager by Ongarj Dev');
$pdf->SetAuthor('Ongarj Dev(github)');
$pdf->SetTitle('รายการสินค้าทั้งหมด');
$pdf->SetKeywords('รายการสินค้าทั้งหมด, TCPDF, PDF');

$pdf->setHeaderFont(array('freeserif', '2', 15));
$pdf->setFooterFont(array('freeserif', '2', 15));

$pdf->SetHeaderData(false, false, 'บริษัท Github: Ongarj Dev จำกัด มหาชน                     ใบรายการสินค้าทั้งหมด', ' สาขา กรุงเทพ  เลขที่สาขา 258849 เบอร์ติดต่อ 00000000000');
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

$pdf->SetFont('freeserif', '2', 13);
date_default_timezone_set('asia/bangkok');
$pdf->Cell(0, 0, date('d-m-Y h:i:s') . '(เวลาประเทศไทย)', 0, 2, 'R');
$html = <<<ECHO
    <table border="1" align="center">
    <tr>
    <td>รหัสบาร์โค้ด</td>
    <td>ชื่อสินค้า</td>
    <td>จำนวน</td>
    <td>ราคา</td>
    <td>ประเภทสินค้า</td>
    <td>ชื่อผู้ผลิตสินค้า</td>
    </tr>
ECHO;
if ($_GET['action'] == 'allproduct') {
    $sql = "SELECT * FROM item";
} elseif ($_GET['action'] == 'allnumber') {
    $sql = "SELECT * FROM item WHERE number_item = '0'";
}
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
    $barcode = $row['barcode'];
    $name = $row['name_item'];
    $number = $row['number_item'];
    $price = $row['price_item'];
    $group = $row['group_item'];
    $brand = $row['brand_item'];
    $html .= <<<ECHO
        <tr>
        <td> $barcode </td>
        <td> $name </td>
        <td> $number </td>
        <td> $price </td>
        <td> $group </td>
        <td> $brand </td>
        </tr>
    ECHO;
}
$html .= <<<ECHO
    </table>
ECHO;
$pdf->writeHTML($html);

$pdf->Output('shopmanagerdfasdfas.pdf', 'I');
