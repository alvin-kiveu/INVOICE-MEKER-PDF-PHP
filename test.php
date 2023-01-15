<?php
include 'include/configs.php';
require_once('tcpdf/tcpdf.php');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetAuthor(Company_Name);
$pdf->setTitle(Company_Name);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setHeaderData(Company_Logo, PDF_HEADER_LOGO_WIDTH, Company_Name, Company_Info);
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
$pdf->setFont('dejavusans', '', 14, '', true);
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
$pdf->SetFont('helvetica', 'B', 20);
$pdf->AddPage();
$html = '<h1>Invoice</h1>';
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('invoiceexample.pdf', 'I');