<h2>Data Guru</h2>
<form action="<?=base_url('web/dosen')?>" method="post" accept-charset="utf-8">
<label>Cari Guru:&nbsp;&nbsp;&nbsp;</label><input type="text" class="text"  name="cari" value="<?=$cari?>">&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-hover-green">Cari</button>
</form>
<table  class="table table-bordered table-striped">
  <thead>
    <th>No</th>
    <th>NIDN</th>
    <th>Nama</th>
    <th>Jabatan Akademik</th>
    <th>Detail</th>
  </thead>
  <tbody>
  
<?php
$no=0;
foreach ($record->result_array() as $row) {
$no++; 
  echo '
        <tr>
          <td>'.$no.'</td>
          <td>'.$row['nidn'].'</td>
          <td>'.viewSdm($row['idsdm']).'</td>
          <td>'.viewKodeApp('JABAKAD',$row['jabatan_fungsional']).'</td>
          <td><a href="'.base_url('web/dosendetail/'.enkrip($row['idsdm'])).'" title="">Detail</a></td>
        </tr>
        
        ';
}

?>
</tbody>
</table>

<?php echo $this->pagination->create_links(); ?>