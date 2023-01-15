<?php
include 'include/configs.php';
require_once('tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetAuthor(Company_Name);
$pdf->setTitle(Company_Name);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, Company_Name, Company_Info);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}
$pdf->setFontSubsetting(true);
$pdf->setFont('dejavusans', '', 10, '', true);
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
$pdf->SetFont('helvetica', 'B', 10);
$pdf->AddPage();


// define barcode style
$style = array(
  'position' => '',
  'align' => 'C',
  'stretch' => false,
  'fitwidth' => true,
  'cellfitalign' => '',
  'border' => true,
  'hpadding' => 'auto',
  'vpadding' => 'auto',
  'fgcolor' => array(0, 0, 0),
  'bgcolor' => false, //array(255,255,255),
  'text' => true,
  'font' => 'helvetica',
  'fontsize' => 8,
  'stretchtext' => 4
);

$productCode = rand(100000, 999999);

// CODE 93 - USS-93
$pdf->Cell(0, 0, 'PRODUCT CODE :' . $productCode . '', 0, 10);
$pdf->write1DBarcode($productCode, 'C93', '', '', '', 20, 0.4, $style, 'N');

// set style for barcode
$style = array(
  'border' => 2,
  'vpadding' => 'auto',
  'hpadding' => 'auto',
  'fgcolor' => array(0, 0, 0),
  'bgcolor' => false, //array(255,255,255)
  'module_width' => 1, // width of a single module in points
  'module_height' => 1 // height of a single module in points
);

//CONVERT $productCode TO STRING
$productCode = (string)$productCode;

// QRCODE,L : QR-CODE Low error correction
$pdf->write2DBarcode($productCode, 'QRCODE,M', 90, 40, 60, 50, $style, 'N');

$pdf->Output('example_027.pdf', 'I');