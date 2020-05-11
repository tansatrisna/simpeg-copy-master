<h2>Peraturan</h2>

<table  class="table table-bordered table-striped">
  <thead>
    <th>Judul</th>
    <th>Didownload</th>
    <th>Aksi</th>
  </thead>
  <tbody>
    
  
<?php
foreach ($record as $row) {
  
  echo '
        <tr>
          <td>'.$row['judul'].'</td>
          <td>'.$row['dibaca'].' Kali</td>
          <td>'.aksiDownload('download/peraturan',enkrip($row['id']),'').'</td>
        </tr>';
}

?>

</tbody>
</table>