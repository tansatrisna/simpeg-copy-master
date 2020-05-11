<?php
$pdf = new ST('L','mm','A4');


$pdf->SetMargins(15,10,15);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetFont("Arial","",9);
$pdf->SetWidths(array(10,20,60,50,85,50));
$no=0;
foreach ($record as $row) {
	if($row['jk']=='L')
	{
		$jk='Laki-laki';
	}
	else
	{
		$jk='Perempuan';
	}

	
	$no++;
	$pdf->Row(array($no,'',$row['nama']."\r\n".$row['tempat_lahir'].', '.tgl_indo($row['tgl_lahir'])."\r\n".$row['nip']."\r\n".$jk,$row['email']."\r\n".$row['hp']."\r\n".$row['nik']."\r\n".$row['npwp'],$row['no_sk']."\r\n".usia($row['mulai_masuk'])."\r\n".$row['alamat'].'/'.$row['kodepos']."\r\n".viewKodeApp('JENJPEND',$row['kode_pendidikan']),$row['jenis']."\r\n".viewKodeApp('GOLPNS',$row['pangkat_golongan'])."\r\n".viewKodeApp('JABAKAD',$row['jabatan_fungsional'])."\r\n".viewKodeApp('STRUKTURAL',$row['jabatan_struktural'])));
}






$pdf->SetTitle('Cetak SDM');
$pdf->Output();