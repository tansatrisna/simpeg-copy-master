<?php
$pdf = new ST('P','mm','A4');
$pdf->SetMargins(20, 5 ,10);
$pdf->AddPage();

$satu=array(10,70);
$tiga=array(20);
$dua=array();
for($i=1;$i<=$col;$i++)
{
  $dua[]=15;
}
$hasil=array_merge($satu,$dua,$tiga);
$pdf->SetWidths($hasil);
$pdf->SetFont("Arial", "",10);
$no=0;
foreach ($record as $row) {
 $no++;
 $satusatu=array($no,$row['nmaref1']);
 $duadua=array();
 $tot=0;
 for($i=$tahun2;$i>=$tahun1;$i--)
	{
	  $jlh=jlhPubTahun($row['kderef'],$i,$unit);
	  $duadua[]=$jlh;
	  $tot=$tot+$jlh;
	}
$tigatiga=array($tot);
$semua=array_merge($satusatu,$duadua,$tigatiga);
$pdf->Row($semua);
}

$satu1=array('','Jumlah');
$dua2=array();
$jumlah=0;
for($j=$tahun2; $j>=$tahun1; $j--)
{
$total=jlhPubTahun('',$j,$unit);
$jumlah=$jumlah+$total;
$dua2[]=$total;
}
$tiga3=array($jumlah);
$semuanya=array_merge($satu1,$dua2,$tiga3);
$pdf->Row($semuanya);


$pdf->Output();