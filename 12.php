<?php
// Include the main TCPDF library (search for installation path).
require_once('TCPDF-master/tcpdf.php');
$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 045');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 045', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/ru.php')) {
    require_once(dirname(__FILE__).'/lang/ru.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusansb', 'L', 14);

// add a page
$pdf->AddPage('L', 'A4');

$queryObject = "SELECT id, name, position FROM object ORDER BY position ASC";
$aObject = pg_query($connection, $queryObject);
while($Object = pg_fetch_array($aObject))	{
	$pdf->AddPage('L', 'A4');

	$pdf->Bookmark($Object['name'], 0, 0, '', 'B', array(0,64,128));

	$subdivisionSql = "SELECT id, name, position FROM subdivision WHERE object_id = ".$Object['id']." ORDER BY position ASC";
	$subdivisionQuery = pg_query($connection, $subdivisionSql);
	while($subdivision = pg_fetch_array($subdivisionQuery)) {
		$pdf->AddPage('L', 'A4');
		$pdf->Bookmark($subdivision['name'], 1, 0, '', 'L', array(0,64,128));
		$pdf->Cell(0, 10, $subdivision['name'], 0, 1, 'L');

	}

	//$pdf->Cell(0, 10, 'Chapter 1', 0, 1, 'L');

}


// Create a fixed link to the first page using the * character
/*$index_link = $pdf->AddLink();
$pdf->SetLink($index_link, 0, '*1');
$pdf->Cell(0, 10, 'Link to INDEX', 0, 1, 'R', false, $index_link);*/
/*C
$pdf->AddPage();
$pdf->Bookmark('Paragraph 1.1', 1, 0, '', '', array(128,0,0));
$pdf->Cell(0, 10, 'Paragraph 1.1', 0, 1, 'L');

$pdf->AddPage();
$pdf->Bookmark('Paragraph 1.2', 1, 0, '', '', array(128,0,0));
$pdf->Cell(0, 10, 'Paragraph 1.2', 0, 1, 'L');

$pdf->AddPage();
$pdf->Bookmark('Sub-Paragraph 1.2.1', 2, 0, '', 'I', array(0,128,0));
$pdf->Cell(0, 10, 'Sub-Paragraph 1.2.1', 0, 1, 'L');

$pdf->AddPage();
$pdf->Bookmark('Paragraph 1.3', 1, 0, '', '', array(128,0,0));
$pdf->Cell(0, 10, 'Paragraph 1.3', 0, 1, 'L');

// fixed link to the first page using the * character
$html = '<a href="#*1" style="color:blue;">link to INDEX (page 1)</a>';
$pdf->writeHTML($html, true, false, true, false, '');


// add some pages and bookmarks
for ($i = 2; $i < 12; $i++) {
    $pdf->AddPage();
    $pdf->Bookmark('Chapter '.$i, 0, 0, '', 'B', array(0,64,128));
    $pdf->Cell(0, 10, 'Chapter '.$i, 0, 1, 'L');
}
*/
// . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .

// add a new page for TOC
$pdf->addTOCPage();

// write the TOC title
$pdf->SetFont('dejavusansb', 'L', 16);
$pdf->MultiCell(0, 0, 'Содержание', 0, 'C', 0, 1, '', '', true, 0);
$pdf->Ln();
$pdf->SetFont('dejavusans', 'L', 12);
$pdf->addTOC(1, 'courier', '.', 'INDEX', 'C', array(128,0,0));
$pdf->endTOCPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_045.pdf', 'I');
