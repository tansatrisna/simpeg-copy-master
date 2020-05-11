<?php
$pdf = new ST('L','mm','A4');
$pdf->SetMargins(20, 5 ,10);
$pdf->AddPage();


$pdf->SetWidths(array(10,60,120,50,30));
$pdf->SetFont("Arial", "",10);
$no=0;
$total=0;
foreach ($record as $row) {
 $no++;
 
$pdf->Row(array($no,viewSdm($row['idsdm'])."\r\n".viewUnit($row['unit']),stripcslashes($row['judul']),viewKodeApp('DANAPENLIT',$row['sumber_dana']),rupiah($row['biaya'])));
$total=$total+$row['biaya'];
}
$pdf->SetFont("Arial", "B",10);
$pdf->SetWidths(array(240,30));
$pdf->Row6(array('Jumlah Biaya Pengabdian',rupiah($total)));

$pdf->Output();