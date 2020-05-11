<?php
$pdf = new ST('P','mm','A4');
$pdf->SetMargins(20, 5 ,10);
$pdf->AddPage();

$pdf->SetWidths(array(10,170));
$pdf->SetFont("Arial", "",10);
$no=0;
foreach ($record as $row) {
	$no++;
	$pdf->Row(array($no,$row['jawaban']));
}



$pdf->Output();
