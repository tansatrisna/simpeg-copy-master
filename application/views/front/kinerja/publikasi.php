<?php
foreach ($record as $row) {
	if($row['url']!='')
	{
		echo '<h4><a href="'.$row['url'].'" target="_blank">'.stripcslashes($row['judul']).'</a></h4>';
	}
	else
	{
		echo '<h4>'.stripcslashes($row['judul']).'</h4>';
	}
 	
 	echo '<p>'.viewSdm($row['idsdm']).' ('.$row['tahun'].')</p>';
 	echo '<hr>';
 } 
?>