<?php
$pdf = new ST('P','mm','A4');
$pdf->SetMargins(20, 5 ,10);
$pdf->AddPage();
$huruf=A;
foreach ($record as $row) {
	$responden=$row['responden'];
	$pdf->SetFont("Arial", "B",11);
	$pdf->SetWidths(array(180));
	$pdf->Row6(array($huruf.'. '.viewKategoriKuisioner($row['kategori'])));
	
	$hasil =$this->model_app->view_hasil_kategori($kuisioner,$row['kategori'],$jenis,$unit);
                                  
	  $no=0;
	  $h1=0; 
	  $h2=0;
	  $h3=0;
	  $h4=0;
	  $h5=0; 
	  $p1=0; 
	  $p2=0;
	  $p3=0;
	  $p4=0;
	  $p5=0;

	  foreach ($hasil as $key) {
		    $no++;
		    $hk1=viewSkorHasil($kuisioner,$key['id_soal'],'1',$jenis,$unit);
		    $hk2=viewSkorHasil($kuisioner,$key['id_soal'],'2',$jenis,$unit);
		    $hk3=viewSkorHasil($kuisioner,$key['id_soal'],'3',$jenis,$unit);
		    $hk4=viewSkorHasil($kuisioner,$key['id_soal'],'4',$jenis,$unit);
		    $hk5=viewSkorHasil($kuisioner,$key['id_soal'],'5',$jenis,$unit);

		   
		    
		    $pk1=$hk1;
		    $pk2=$hk2*2;
		    $pk3=$hk3*3;
		    $pk4=$hk4*4;
		    $pk5=$hk5*5;
		                                        
		    $rata2=$key['jlh']/$responden;
		    $pdf->SetWidths(array(10,65,15,15,15,15,15,15,15));
		    $pdf->SetFont("Arial", "",10);
		    $pdf->Row(array($no,strip_tags(viewKuisionerSoal($key['id_soal'])),$responden,$hk1.' ('.$pk1.')',$hk2.' ('.$pk2.')',$hk3.' ('.$pk3.')',$hk4.' ('.$pk4.')',$hk5.' ('.$pk5.')',angka($rata2)));
		   

		    $h1=$h1+$hk1;
		    $h2=$h2+$hk2;
		    $h3=$h3+$hk3;
		    $h4=$h4+$hk4;
		    $h5=$h5+$hk5;

		    $p1=$p1+$pk1;
		    $p2=$p2+$pk2;
		    $p3=$p3+$pk3;
		    $p4=$p4+$pk4;
		    $p5=$p5+$pk5;

		         
		  } 
		 
		    $h1=$h1/$no;
		    $p1=$p1/$no;
		    $h2=$h2/$no;
		    $p2=$p2/$no;
		    $h3=$h3/$no;
		    $p3=$p3/$no;
		    $h4=$h4/$no;
		    $p4=$p4/$no;
		    $h5=$h5/$no;
		    $p5=$p5/$no;
		    

		    $rata=($p1+$p2+$p3+$p4+$p5)/$responden;
		    $pdf->SetFont("Arial", "B",10);
		    $pdf->Row(array('','Hasil Gabungan',$responden,$h1.' ('.$p1.')',$h2.' ('.$p2.')',$h3.' ('.$p3.')',$h4.' ('.$p4.')',$h5.' ('.$p5.')',angka($rata)));
		   
	$huruf++;
}


$pdf->Output();
