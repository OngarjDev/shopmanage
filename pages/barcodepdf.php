<?php
session_start();
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');

if (!isset($_SESSION['id_staff']) || !isset($_SESSION['name_staff'])) {
    header('location: login.php');
}
$id_staff = $_SESSION['id_staff'];

require_once('../php_action/dbconnect.php');

$id_item = $con->real_escape_string($_GET['id_item']);
$sql = "SELECT barcode,name_item FROM item WHERE id_item = '$id_item'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('OngarjDev');
$pdf->SetAuthor('OngarjDev');
$pdf->SetTitle('รหัสบาร์โค้ดสินค้าชื่อ :  '.$row['name_item']);
$pdf->SetSubject('รหัสบาร์โค้ดสินค้าสำหรับปริ้น');
$pdf->SetKeywords('TCPDF, PDF,barcode');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);


$pdf->setHeaderFont(array('freeserif', '2', 15));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins('0', PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set font
$pdf->SetFont('times', 'BI', 12);
$pdf->SetFont('freeserif', '2', 13);
// add a page
$pdf->AddPage();
$style['cellfitalign'] = 'C';
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false, // border
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255),
             'text' => false, // whether to display the text below the barcode
             'font' => 'helvetica', //font
             'fontsize' => 6, //font size
    'stretchtext' => 6
);
//$pdf->Text($x+40,$y,"(QTY:$QTY)");
$x = 15;
$y = 11.3;
$z = 15;
$barcode = $row['barcode'];
$type = 'c128';
$fn_sku = $barcode;
for ($i = 0; $i < 10; $i++) {
             // barcode line
    $pdf->write1DBarcode($fn_sku, $type, $x, $y + $i * 25, 44.2, 14.4, 0.4, $style, 'N');
    $pdf->write1DBarcode($fn_sku, $type, $x + 48.7, $y + $i * 25, 44.2, 14.4, 0.4, $style, 'N');
    $pdf->write1DBarcode($fn_sku, $type, $x + 48.7 * 2, $y + $i * 25, 44.2, 14.4, 0.4, $style, 'N');
    $pdf->write1DBarcode($fn_sku, $type, $x + 48.7 * 3, $y + $i * 25, 44.2, 14.4, 0.4, $style, 'N');
             //The second line fn_sku
    $pdf->Text($z, $y + $i * 25 + 13, '   ' . $fn_sku);
    $pdf->Text($z + 48.7, $y + $i * 25 + 13, '   ' . $fn_sku);
    $pdf->Text($z + 48.7 * 2, $y + $i * 25 + 13, '   ' . $fn_sku);
    $pdf->Text($z + 48.7 * 3, $y + $i * 25 + 13, '   ' . $fn_sku);
}

$pdf->Output('barcodeitem.pdf', 'I');
?>