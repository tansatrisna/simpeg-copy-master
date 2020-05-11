<h2>Pengumuman</h2>

<table>
  <tbody>
    
  
<?php
foreach ($record->result_array() as $row) {
  $isi_berita =(strip_tags($row['isi'])); 
  $isi = substr($isi_berita,0,200); 
  $isi = substr($isi_berita,0,strrpos($isi," "));
  echo '
        <tr>
          <td colspan="2"><b>'.$row['judul'].'<b></td>
        </tr>
        <tr>
          <td>'.$isi.'<br><i class="badge">Oleh: '.viewUser($row['user']).', '.tgl_indo($row['tanggal']).'</i></td>
          <td width="1%"><a href="'.base_url('web/pengumumandetail/'.$row['seo']).'" class="btn btn-sm btn-info">Selengkapnya</a></td> 
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        ';
}

?>

</tbody>
</table>
<?php echo $this->pagination->create_links(); ?>