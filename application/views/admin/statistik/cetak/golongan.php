<?php
$pdf = new ST('P','mm','A4');
$pdf->SetMargins(20, 5 ,10);
$pdf->AddPage();

$pdf->SetWidths(array(10,60,15,15,15,15,15,15,20));
$pdf->SetFont("Arial", "",10);
$no=0;


$ttl=0;
          $ttp=0;
          $tdl=0;
          $tdp=0;
          $tpl=0;
          $tpp=0;
          foreach ($record as $row) {
            $no++;
            $dl=jlhJkGol($row['kderef'],'DOSEN','L',$unit);
            $dp=jlhJkGol($row['kderef'],'DOSEN','P',$unit);
            $pl=jlhJkGol($row['kderef'],'PEGAWAI','L',$unit);
            $pp=jlhJkGol($row['kderef'],'PEGAWAI','P',$unit);
            $tl=$dl+$pl;
            $tp=$dp+$pp;
            $ts=$tl+$tp;
            $pdf->Row(array($no,$row['nmaref1'],$dl,$dp,$pl,$pp,$tl,$tp,$ts));
            $tdl=$tdl+$dl;
            $tdp=$tdp+$dp;
            $tpl=$tpl+$pl;
            $tpp=$tpp+$pp;
            $ttl=$ttl+$tl;
            $ttp=$ttp+$tp;
            }
          $tts=$ttl+$ttp;
	$pdf->SetWidths(array(70,0,15,15,15,15,15,15,20));
    $pdf->Row(array('Jumlah','',$tdl,$tdp,$tpl,$tpp,$ttl,$ttp,$tts));  



$pdf->Output();
