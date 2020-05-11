<h2><?=$judul?></h2>
<form action="<?=base_url('web/dosen')?>" method="post" accept-charset="utf-8">
<label>Cari Pegawai:&nbsp;&nbsp;&nbsp;</label><input type="text" class="text"  name="cari" value="<?=$cari?>">&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-hover-green">Cari</button>
</form>
<table  class="table table-bordered table-striped">
  <thead>
    <th>No</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Jabatan Struktural</th>
  </thead>
  <tbody>
  
<?php
$no=0;
foreach ($record->result_array() as $row) {
$no++; 
  echo '
        <tr>
          <td>'.$no.'</td>
          <td>'.$row['nip'].'</td>
          <td>'.viewSdm($row['idsdm']).'</td>
          <td>'.viewKodeApp('STRUKTURAL',$row['jabatan_struktural']).'</td>
        </tr>
        
        ';
}

?>
</tbody>
</table>

<?php echo $this->pagination->create_links(); ?>