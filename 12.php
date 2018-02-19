<?php
// Include the main TCPDF library (search for installation path).
require_once('./TCPDF-master/tcpdf.php');
require_once('./TCPDF-master/tcpdf_import.php');
require_once('./TCPDF-master/tcpdf_autoconfig.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    public function MultiRow($left, $right) {
//$this->SetFont('pdfazapfdingbats', '', 10);
        // /$this->MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0);

        $page_start = $this->getPage();
        $y_start = $this->GetY();

        //$this->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0,122, 255)));
        // write the left cell
        $this->MultiCell(140, 0, $left, 0, 'L', 0, 2, '', '', true, true);

        $page_end_1 = $this->getPage();
        $y_end_1 = $this->GetY();

        $this->setPage($page_start);
        $this->SetFont('dejavusans', 'B', 14);
        // write the right cell
        //$this->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(255, 0, 0)));

        $this->MultiCell(0, 0, $right, 0, 'L', 0, 1, $this->GetX() ,$y_start, true, 0);

        $page_end_2 = $this->getPage();
        $y_end_2 = $this->GetY();

        // set the new row position by case
        if (max($page_end_1,$page_end_2) == $page_start) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 == $page_end_2) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 > $page_end_2) {
            $ynew = $y_end_1;
        } else {
            $ynew = $y_end_2;
        }

        $this->setPage(max($page_end_1,$page_end_2));
        $this->SetXY($this->GetX(),$ynew);
    }

}

$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 045', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// remove default header/footer
$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
// set default monospaced font14
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(10);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/ru.php')) {
    require_once(dirname(__FILE__).'/lang/ru.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set core font
$pdf->SetFont('dejavusans', 'L', 14);
// add a page
$pdf->AddPage();
// set display mode
$pdf->SetDisplayMode($zoom='fullpage', $layout='TwoColumnRight', $mode='UseNone');
// set pdf viewer preferences
$pdf->setViewerPreferences(array('Duplex' => 'DuplexFlipLongEdge'));
// set booklet mode
$pdf->SetBooklet(true, 10, 10);

$queryObject = "SELECT id, name, position FROM object ORDER BY position ASC";
$aObject = pg_query($connection, $queryObject);
while($Object = pg_fetch_array($aObject))	{

  //$pdf->AddPage();
	$pdf->Bookmark($Object['name'], 0, 0, '', 'B', array(0,0,0));
  $pdf->SetFont('', 'B', 14);
  $pdf->Cell(0, 10, $Object['name'], 0, 1, 'L');

	$subdivisionSql = "SELECT id, name, position FROM subdivision WHERE object_id = ".$Object['id']." ORDER BY position ASC";
	$subdivisionQuery = pg_query($connection, $subdivisionSql);
	while($subdivision = pg_fetch_array($subdivisionQuery)) {

    //$pdf->AddPage();
		$pdf->Bookmark($subdivision['name'], 1, 0, '', 'L', array(0,0,0));
    $pdf->SetFont('', 'B', 14);
		$pdf->Cell(0, 10, $subdivision['name'], 0, 1, 'L');

    $subscriberSql = "SELECT id, name, phone0, phone1,phone2,phone3, position FROM subscriber WHERE subdivision_id = ".$subdivision['id']." ORDER BY position ASC";
    $subscriberQuery = pg_query($connection, $subscriberSql);

    while($subscriber = pg_fetch_array($subscriberQuery)) {
      // set cell padding
      $pdf->setCellPaddings(1, 1, 1, 1);
      //// set cell margins
      //$pdf->setCellMargins(1, 1, 1, 1);
    // set color for background
    //$pdf->SetFillColor(255, 255, 255);
    // set color for text
    $pdf->SetFont('dejavusans', 'L', 14);
    // write the first column
    $phone = "";
    if ($subscriber['phone0'] != "           ") $phone .= $subscriber['phone0'];
    if ($subscriber['phone1'] != "           ") $phone .= "\n".$subscriber['phone1'];
    if ($subscriber['phone2'] != "           ") $phone .= "\n".$subscriber['phone2'];
    if ($subscriber['phone3'] != "           ") $phone .= "\n".$subscriber['phone3'];

    //$pdf->SetFont('', 'b', 12);
  //  $pdf->SetTextColor(0, 0, 0);

  // create columns content

  $y = $pdf->getY();
  // write the first column
  $pdf->writeHTMLCell(80, '', '', '', $subscriber['name'], 0, 0, 0, true, 'L', true);
  $pdf->writeHTMLCell(80, '', '', '', $phone, 0, 0, 0, true, 'R', true);
    //$pdf->MultiRow($subscriber['name'], $phone);

    }
	}
}
// add a new page for TOC
//$pdf->addTOCPage('L', 'A4');
$pdf->addTOCPage();
// write the TOC title
$pdf->SetFont('dejavusansb', 'L', 16);
$pdf->MultiCell(0, 0, 'Содержание', 0, 'C', 0, 1, '', '', true, 0);
$pdf->Ln();
$pdf->SetFont('dejavusans', 'L', 14);
$pdf->addTOC(1, 'courier', '.', 'INDEX', 'C', array(128,0,0));

// ---------------------------------------------------------
// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('example_045.pdf', 'I');
