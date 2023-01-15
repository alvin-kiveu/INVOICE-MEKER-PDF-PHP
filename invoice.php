<?php
include 'include/configs.php';
require_once('tcpdf/tcpdf.php');
//INCIATE TCPDF
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
$html = <<<EOD
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap");
body {
  background-color: #f5f5f5;
}
.customers {
    font-family: "Poppins", sans-serif;
    width: 100%;
    border: 1px solid #ccc;
  }
  .customers td{
    border: 0.25px solid black;
    padding: 30px;
  font-weight: normal;
  }
  .customers th {
    border: 1px solid white;
    padding: 8px;
    text-align: center;
    background: #4CAF50;
    color: white;
    font-weight: bold;
  }
  .customers tr:nth-child(even) {
    background-color: black;
  }
  

  .customers tr:hover {
    background-color: #ddd;
  }
  
  .customers th {
    padding-top: 5px;
    padding-bottom: 5px;
  
    background-color: black;
    color: white;
    font-size:14px;
  }
.infocard{
    font-family: "Poppins", sans-serif;
    font-size:10px;
    color: black;
    text-align: left;
}
.dec{
    width: 80%;
}

.tot{
    width: 20%;
    text-align: center;
}
.info{
    display: flex;
    justify-content: space-between;
    padding: 5px;
}

.info1{
    width: 50%;
    background-color: #f5f5f5;
}

.info2{
    width: 50%;
}

.recipt{
    margin-top: 1%;
}

p span{
    font-weight: none;
}
.title{
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
}
.totals td {
  border-top: 2px solid #ccc;
  font-weight: bold;
  padding: 10px;
  text-align: right;
}

.amount{
    text-align: center;
}
.total{
    text-align: center;
    color: green;
}

.paid {
  font-weight: bold;
  text-transform: uppercase;
  color: green;
  width: 100px;
}

.unpaid {
  font-weight: bold;
  text-transform: uppercase;
  color: #f44336;
}
</style>
<div class="recipt">
<div class="infocard">
<p class="title">WEB DEVELOPMENT</p>

<div class="info1">
<p >Invoice Number: <span>UMS_62987</span></p>
<p>Invoice Date: <span>1/01/2023</span></p>
<p>Due Date: <span>1/01/2024</span></p>
</div>
<div class="info2">
<h3>Invoiced To</h3>
<p>Name: <span>Alvin Kiveu</span></p>
<p>Email: <span>alvo967@gmail.com</span></p>
<p>Phone: <span>+254 11 3015674</span></p>
</div>
</div>
<table class="customers">
<tr>
<th class="dec">Description</th>
<th class="tot">Total</th>
</tr>
<tr>
<td>Backend Development</td>
<td class="amount">Ksh 8000</td>
</tr>

<tr>
<td>Frontend Development</td>
<td class="amount">Ksh 8000</td>
</tr>

<tr>
<td>Database Design</td>
<td class="amount">Ksh 8000</td>
</tr>

<tr>
<td>Website Hosting</td>
<td class="amount">Ksh 8000</td>
</tr>

<tr>
<td>Website Maintenance</td>
<td class="amount">Ksh 8000</td>
</tr>

<tr>
<td>Website Security</td>
<td class="amount">Ksh 8000</td>
</tr>

<tr>
<td>Website Design</td>
<td class="amount">Ksh 2000</td>
</tr>

<tr>
<td>Website Development</td>
<td class="amount">Ksh 8000</td>
</tr>
<tfoot>
<tr class="totals">
<td>Total</td>
<td class="total">KSh 3,500.00</td>
</tr>
<tr class="totals">
<td>Status</td>
<td>
<span class="paid">Paid</span>

</td>
</tr>
</tfoot>
</table>



<p><span style="text-align: center; margin-top:40px;">PDF Generated on 15/01/2023</span></p>


</div>
EOD;
$pdf->writeHTML($html, true, false, true, false, '');
// <span class="unpaid">Unpaid</span>
//Close and output PDF document
$pdf->Output('invoiceexample.pdf', 'I');