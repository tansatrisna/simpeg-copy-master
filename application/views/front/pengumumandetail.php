<?php
echo'<h3>'.$rows['judul'].'</h3>';
echo'<i class="badge">Oleh: '.viewUser($rows['user']).', '.tgl_indo($rows['tanggal']).'</i>';

echo $rows['isi'];
?>