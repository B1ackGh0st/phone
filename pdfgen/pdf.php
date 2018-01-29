<?php
require_once( "fpdf.php" );

// Начало конфигурации

$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "2009 Widget Sales Report";
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );
/*
$host = '127.0.0.1';
  $user = 'postgres';
  $pass = 'postgres';
  $db   = 'phone';

  $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$query = 'SELECT * FROM object';
        $a = pg_query($connection, $query);
$data = pg_fetch_array($a)
*/
$data = array(
          array( 9940, 10100, 9490, 11730 ),
          array( 19310, 21140, 20560, 22590 ),
          array( 25110, 26260, 25210, 28370 ),
          array( 27650, 24550, 30040, 31980 ),
        );

// Конец конфигурации


/**
  Создаем титульную страницу
**/

$pdf = new FPDF( 'L', 'mm', 'A4' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->AddPage();

// Логотип
$pdf->Image( $logoFile, $logoXPos, $logoYPos, $logoWidth );

// Название отчета
$pdf->SetFont( 'Arial', 'B', 24 );
$pdf->Ln( $reportNameYPos );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );


/**
  Создаем колонтитул, заголовок и вводный текст
**/

$pdf->AddPage();
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'Arial', '', 20 );
$pdf->Write( 10, "2009 Was A Good Year" );
$pdf->Ln( 10 );

$host = '127.0.0.1';
$user = 'postgres';
$pass = 'postgres';
$db   = 'phone';

$connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

$query = 'SELECT * FROM subscriber';
$a = pg_query($connection, $query);
while($row = pg_fetch_row($a)) {
  $pdf->Write( 10, $row[1]);
  $pdf->Ln( 10 );
}



/***
  Выводим PDF
***/

$pdf->Output( "report.pdf", "I" );

?>
