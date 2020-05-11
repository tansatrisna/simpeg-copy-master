<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle  collapsed" data-toggle="collapse" data-target="#bs-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-collapse-1">
      <ul class="nav navbar-nav">
        <?php
          foreach ($tabs as $tab) {
            $cl=($tab['seo']=='$hal') ? 'active' : '' ;
            echo '<li class="'.$cl.'">
            <a href="'.base_url('web/pejabat/'.$tab['seo']).'">'.$tab['kelompok'].'</a>
          </li>';
          }
        ?>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<br>
<table>
  <tbody>
    
  
<?php
foreach ($record as $row) {
  if($row['foto']=='')
  {
    $gambar='no-foto.jpg';
  }
  else
  {
    $gambar=$row['foto'];
  }
  echo '
        <tr>
          <td colspan="4"><b>'.$row['jabatan'].'<b></td>
        </tr>
        <tr>
          <td rowspan="4" width="1%"><img src="'.base_url('assets/img/sdm/'.$gambar).'" width="100" alt=""></td>
          <td>Nama</td>
          <td width="1%">:</td>
          <td>'.viewSdm($row['idsdm']).'</td>
        </tr>
        <tr>
          <td>NIP</td>
          <td>:</td>
          <td>'.$row['nip'].'</td>
        </tr>
        <tr>
          <td width="1%" nowrap>Pangkat/ Gol. Ruang</td>
          <td>:</td>
          <td>'.viewKodeApp1('GOLPNS',$row['pangkat_golongan']).' ('.viewKodeApp('GOLPNS',$row['pangkat_golongan']).')</td>
        </tr>
        <tr>
          <td>Pangkat Akademik</td>
          <td>:</td>
          <td>'.viewKodeApp('JABAKAD',$row['jabatan_fungsional']).'</td>
        </tr>';
}

?>
</tbody>
</table>