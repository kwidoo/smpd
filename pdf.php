<?php

// composer dependencies
require_once 'vendor/autoload.php';
// configuration
$config = require('config.php');

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

define('SCOPES', implode(' ', array(Google_Service_Sheets::SPREADSHEETS)));
date_default_timezone_set('Europe/Riga');
$client = new Google_Client();
$client->setApplicationName('Spreadsheet');
$client->setClientId($config['client_id']);
$client->setAuthConfig($config['key_file_path']);
$client->setScopes(SCOPES);
$service = new Google_Service_Sheets($client);

// editable part
$fileId = $config['fileId'];

$lang = 'lat';
$range = $config['categories'];
$response = $service->spreadsheets_values->get($fileId, $range);

// TCPDF part
define ('PDF_LINE', 8);

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	public $lang = 'lat';
	
	public function SetLang($lang)
	{
		$this->lang = $lang;
	}
	//Page header
	public function Header() {
		// Logo
	
		$image_file = '/assets/images/logo.jpg';

	//	$this->ImageSVG('/assets/images/logo-svg.svg', 10, 14, 60, '', 'http://www.smpd.lv', '', '', 0, false);
//$pdf->ImageSVG($file='path/to/testsvg.svg', $x=15, $y=30, $w='', $h='', $link='http://www.tcpdf.org', $align='', $palign='', $border=1, $fitonpage=false);

		$this->Image($image_file, 10, 14, 60, '', 'JPG', 'http://www.smpd.lv', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('trebuchet_ms_b', 'b', 14);
		// Title
		$this->SetY(15);
		$this->SetX(75);
		$this->Cell(58, 14, 'SIA SMP Doktorāts', 0, 0, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetFont('trebuchet_ms', '', 11);
		$this->Cell(60, 12, 'tālr. +371 27 036 036', 0, 1, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetX(75);
		$this->Cell(58, 12, 'ārst.reģ. kods 0100-01557', 0, 0, 'L', 0, '', 0, false, 'M', 'M');
		$this->Cell(13, 12, 'e-pasts: ', 0, 0, 'L', 0, '', 0, false, 'M', 'M');
		$this->Cell(24, 12, 'info@smpd.lv,', 0, 0, 'L', 0, 'mailto:info@smpd.lv', 0, false, 'M', 'M');
		$this->Cell(20, 12, 'www.smpd.lv', 0, 1, 'L', 0, 'http://www.smpd.lv', 0, false, 'M', 'M');
		$this->SetX(75);
		$this->Cell(58, 12, 'Vienotais reģ. Nr. 40003736608', 0, 0, 'L', 0, '', 0, false, 'M', 'M');
		$this->Cell(60, 12, 'AS SEB banka, kods UNLALV2X', 0, 1, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetX(75);
		$this->Cell(58, 12, 'Tērbatas iela 36-4, Rīga, LV-1011', 0, 0, 'L', 0, '', 0, false, 'M', 'M');
		$this->Cell(60, 12, 'n/konts EUR: LV49 UNLA 0050 0060 2366 9', 0, 1, 'L', 0, '', 0, false, 'M', 'M');

		$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(220, 220, 220));
		$this->Line(5, 40, 205, 40, $style);		
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('trebuchet_ms', '', 10);
		// Page number 
		// kakim obrazim eto rabotaet ne jasno
		if ($this->lang == 'rus'){
			$this->Cell(200, 10, 'Все цены указаны с НДС. Цены в силе с '.date('d.m.Y'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$this->Cell(0, 10, 'стр. '.$this->getAliasNumPage().' из '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		} elseif ($this->lang == 'lat') {
			$this->Cell(200, 10, 'Visas cenas norādītas ar PVN. Cenas spēkā no '.date('d.m.Y'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
			$this->Cell(0, 10, 'lpp '.$this->getAliasNumPage().' no '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		} 
	}	
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$fontname = $pdf->addfont('trebuchet_ms');
$fontname = $pdf->addfont('trebuchet_ms_b');

// set document information
$pdf->SetCreator('https://www.smpd.lv');
$pdf->SetAuthor('SMP Doktorāts, SIA');
$pdf->SetTitle('Pakalpojumu cenrādis');
$pdf->SetSubject('Pakalpojumu cenrādis');
$pdf->SetKeywords('pakalpojumu cenrādis');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(PDF_MARGIN_LEFT, 45, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(50);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

$info = array(
    'Name' => 'SMP Doktorāts SIA',
    'Location' => 'Tērbatas 36/4, Rīga, LV-1011, Latvia',
    'Reason' => 'Pakalpojumu cenrādis',
    'ContactInfo' => 'mailto:info@smpd.lv',
    );
$pdf->setSignature($config['certificate'], $config['certificate'], 'tcpdfdemo', '', 2, $info);

// add a page
$pdf->AddPage();
$pdf->SetY(50);

$pdf->SetFont('trebuchet_ms_b', 'B', 14);

$pdf->SetLang($lang);
if ($lang == 'rus') $pdf->Cell(180, 10, 'ЦЕНООБРАЗОВАНИЕ УСЛУГ', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
if ($lang == 'lat') $pdf->Cell(180, 10, 'PAKALPOJUMU CENRĀDIS', 0, 1, 'C', 0, '', 0, false, 'M', 'M');

$pdf->SetFont('trebuchet_ms', '', 10);

// google spreadsheets part
// create array of categories 
for ($i=1;$i < sizeof($response->values);$i++){
	$categories[] = $response->values[$i][0];
}

// read values
for ($k=0;$k < sizeof($categories);$k++){
	$range = $categories[$k].'!'.$config['values'];   
	$response = $service->spreadsheets_values->get($fileId, $range);

	// здесь надо проверять order
	for ($i=1;$i < sizeof($response->values);$i++){

		
		$y = $pdf->GetY();
		if (($y + PDF_LINE) >= 270) {
   			 $pdf->AddPage();
   			 $y = 0; // should be your top margin
		}

		// service category print
		if ($response->values[$i][0] == 'elemCat'){
			$pdf->SetFillColor(123,166,61);
		//	$pdf->MultiCell(180, 10, '', 0, 'C', 0, 1, '', '', true);
			if ($lang == 'rus') $txt = $response->values[$i][3];
			if ($lang == 'lat') $txt = $response->values[$i][4];
			$pdf->MultiCell(180, PDF_LINE, $txt, 1, 'C', 1, 1, '', '', true);
		}
		// заливка для линии, через одну
		$fill = 1;
		if ($i % 2 == 0) $pdf->SetFillColor(229,239,214);
			else
		$pdf->SetFillColor(255, 255, 255);
		// print price pos here			
		if ($response->values[$i][0] == 'elemPrice'){
			// service code print
			$pdf->MultiCell(25, PDF_LINE, $response->values[$i][2], 1, 'C', $fill, 0, '', '', true);
			// service name print
			if ($lang == 'rus') $txt = $response->values[$i][3]; 
			if ($lang == 'lat') $txt = $response->values[$i][4]; 		
			$pdf->MultiCell(130, PDF_LINE, $txt, 1, 'L', $fill, 0, '', '', true);
			// service full price print			
			if ($response->values[$i][5] > 0) $pdf->MultiCell(25, PDF_LINE, '€ '.$response->values[$i][5], 1, 'C', $fill, 1, '', '', true);
			else {
				// service variable price print
				if ($lang == 'rus') {
					$from = 'от '; $to = 'до ';
				}
				if ($lang == 'lat') {
					$from = 'no '; $to = 'līdz ';
				}
				if ($response->values[$i][6]) $pdf->MultiCell(25, PDF_LINE, $from.'€ '.$response->values[$i][6].' ', 1, 'C', $fill, 1, '', '', true);
				if ($response->values[$i][7]) $pdf->MultiCell(25, PDF_LINE, $to.'€ '.$response->values[$i][7], 1, 'C', $fill, 1, '', '', true);
			}
		}
	}
}
$pdf->lastPage();
// ---------------------------------------------------------
ob_get_clean();
//Close and output PDF document
$filename = 'pricelist';

if ($lang == 'rus')
	$filename .= '_rus';
else
	$filename .= '_lat';

$filename .= '.pdf';

$pdf->Output($filename, 'D');
