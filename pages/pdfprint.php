<?php
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('../php_action/dbconnect.php');

session_start();
if (!isset($_SESSION['id_staff']) || !isset($_SESSION['name_staff'])) {
    header('location: login.php');
}
$id_staff = $_SESSION['id_staff'];
$name_staff = $_SESSION['name_staff'];

if ($_GET['noworder'] && $_GET['transfer']) {
    $id_history = $_GET['noworder'];
    $transfer = $_GET['transfer'];
} else {
    $id_history = $_SESSION['noworder'];
    $transfer = $_SESSION['transfer'];
}
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');

$pdf->SetCreator('shopmanager by Ongarj Dev');
$pdf->SetAuthor('Ongarj Dev(github)');
$pdf->SetTitle('ใบเสร็จชำระเงิน    เลขที่' . $id_history);
$pdf->SetSubject('ใบเสร็จชำระเงิน กำกับสินค้า');
$pdf->SetKeywords('ใบเสร็จชำระเงิน, TCPDF, PDF ,' . $id_history);

$pdf->setHeaderFont(array('thsarabun', '2', 22));
$pdf->setFooterFont(array('thsarabun', '2', 15));

$pdf->SetHeaderData(false, false, 'บริษัท Github: Ongarj Dev จำกัด มหาชน                              ใบเสร็จชำระเงิน', ' สาขา กรุงเทพ  เลขที่สาขา 258849 เบอร์ติดต่อ 00000000000');
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();


$pdf->SetFont('thsarabun', '2', 15);

$sql = "SELECT * FROM history INNER JOIN staff ON history.id_staff = staff.id_staff WHERE history.id_history = '$id_history'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

$fname = $row['fname_staff'];
$lname = $row['lname_staff'];
$number = $row['number_staff'];
$date = $row['datetime_history'];
$datetime = explode('.',$date);
$income = $row['income_history'];
if ($transfer == 'bank') {
    $tran = 'ธนาคาร';
}
if ($transfer == 'cash') {
    $tran = 'เงินสด';
}
$content = <<<END
    <p>ชื่อพนักงาน  : $fname    $lname       รหัสพนักงาน :  $number </p>
    <p>วัน-เวลาที่ซื้อสินค้า :  $datetime[0]</p>
    <p>เลขที่ใบชำระเงิน :  $id_history </p>
    <p>ช่องทางการชำระเงิน :  $tran</p>
END;
if ($transfer == 'cash') :
    $content .= <<<END
        <p>จำนวนเงินที่ได้รับ :   $income</p>
    END;
endif;
$content .= <<<TABLE
    <h3 align="center" >รายละเอียดสินค้า</h3>
    <table border="1" align="center">
        <tr>
        <th>ลำดับ</th>
        <th>ชื่อสินค้า</th>
        <th>จำนวน(ที่ซื้อ)</th>
        <th>ราคา(สินค้า)</th>
        <th>รวม</th>
        </tr>
TABLE;

$sql = "SELECT * FROM history WHERE id_history = '$id_history'";
$result = $con->query($sql);

$row = $result->fetch_assoc();
$item = explode(",", $row['id_item']);
$values = explode(",", $row['values_item']);
$price = explode(",", $row['price_item']);
$name = explode(",", $row['name_item']);
$pin = $row['pin_history'];
$order = 1;
$sumvalues = [];
$sumprice = [];
$num_item = count($item);
for ($i = 0; $i < $num_item; $i++) {
    $name_item = $name[$i];
    $price_item = $price[$i];
    $sum = $price_item * $values[$i];
    array_push($sumvalues, $values[$i]);
    array_push($sumprice, $sum);
    $content .= <<<TABLE
        <tr>
        <td>$order</td>
        <td>$name_item</td>
        <td>$values[$i]</td>
        <td>$price_item  บาท</td>
        <td>$sum  บาท</td>
        </tr>
        TABLE;
    $order++;
}
$order = $order - 1;
$sumvalues = array_sum($sumvalues);
$sumprice = array_sum($sumprice);
$content .= <<<TABLE
<tr>
    <td colspan="2">ทั้งหมด  $order รายการ</td>
    <td>จำนวน   $sumvalues ชิ้น</td>
    <td colspan="2">ราคาทั้งหมด  $sumprice บาท</td>
</tr>
    </table>
    <p>*** ก่อนออกจากร้าน โปรดตรวจสอบรายละเอียดอีกครั้ง มิฉะนั้นข้อมูลทุกอย่างถูกต้อง ***</p>
TABLE;

$style = array(
    'position' => 'R',
    'align' => 'R',
    'stretch' => true,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
$pdf->writeHTML($content);

$pdf->write1DBarcode($pin, 'c128', '', '', '', 18, 0.4, $style, 'N');

$pdf->Cell(0, 0, '(โปรดอย่าทำให้รหัสเสียหาย)', 0, 2, 'R');

$pdf->setBarcode(date('Y-m-d H:i:s'));
$pdf->Output('shopmanager.pdf', 'I');
