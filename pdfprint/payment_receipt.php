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

// define some HTML content with style
$html = <<<EOF
<style src="../css/bootstrap.min.css"></style>
<button class="btn btn-primary">พิมพ์ใบเสร็จ</button>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_061.pdf', 'I');
?>