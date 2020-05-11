<?php
foreach ($record as $row) {
	
		echo '<h4>'.stripcslashes($row['judul_penelitian']).'</h4>';
	
 	echo '<p>'.viewSdm($row['idsdm']).' ('.$row['tahun'].')</p>';
 	echo '<hr>';
 } 
?>