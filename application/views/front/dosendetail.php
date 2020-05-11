<h2>Profil</h2>

<table class="table">
  <tbody>
    
    <tr>
      <td rowspan="24" width="1%"><img src="<?=gambar('sdm',$rows['foto'])?>" alt="" width="100px"></td>
      <td>NIP</td>
      <td><?=$rows['nip']?></td>
    </tr>
    <tr>
      <td>NIDN</td>
      <td><?=$rows['nidn']?></td>
    </tr>
    <tr>
      <td>Unit</td>
      <td><?=viewUnit($rows['unit'])?></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><?=stripslashes(viewSdm($rows['idsdm']))?></td>
    </tr>
    <tr>
      <td width="1%" nowrap>Tempat, Tanggal Lahir</td>
      <td><?=$rows['tempat_lahir'].', '.tgl_indo($rows['tgl_lahir'])?></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><?=viewKodeApp('KELAMIN',$rows['jk'])?></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><?=viewKodeApp('AGAMA',$rows['agama'])?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?=$rows['email']?></td>
    </tr>
    <tr>
      <td>Email Institusi</td>
      <td><?=$rows['email_institusi']?></td>
    </tr>
    
    <tr>
      <td>Pendidikan Terakhir</td>
      <td><?=viewKodeApp('JENJPEND',$rows['kode_pendidikan'])?></td>
    </tr>
    <tr>
      <td>Pangkat/ Golongan</td>
      <td><?=viewKodeApp('GOLPNS',$rows['pangkat_golongan'])?></td>
    </tr>
    <tr>
      <td>Jabatan Fungsional</td>
      <td><?=viewKodeApp('JABAKAD',$rows['jabatan_fungsional'])?></td>
    </tr>
    <tr>
      <td>Jabatan Struktural</td>
      <td><?=viewKodeApp('STRUKTURAL',$rows['jabatan_struktural'])?></td>
    </tr>
    <tr>
      <td>Instansi Induk</td>
      <td><?=viewKodeApp('INSTANSI',$rows['instansi_induk'])?></td>
    </tr>

  </tbody>
</table>

<?php
if(count($pendidikan)>0)
{
  echo '<h2>Riwayat Pendidikan</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenjang</th>
              <th>Nama Sekolah</th>
              <th>Propinsi/ Kabupaten/ Kecamatan</th>
              <th>Nomor / Tanggal Ijazah</th>
              <th>Jurusan/ Keahlian</th>
              <th>Pendidikan Terakhir</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($pendidikan as $row) {
                if($row['tamatan']=='DN')
                {
                  $tamatan=viewProp($row['prop']).'<br>'.viewKab($row['kab']).'<br>'.viewKec($row['kec']);
                }
                else
                {
                  $tamatan='Tamatan Luar Negeri';
                }
                $no++;
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.viewKodeApp('JENJPEND',$row['jenjang']).'</td>
                      <td>'.stripslashes($row['nama_sekolah_pt']).'</td>
                      <td>'.$tamatan.'</td>
                      <td>'.$row['nomor_ijazah'].'<br>'.tgl_indo($row['tgl_ijazah']).'</td>
                      <td>'.$row['jurusan'].'<br>'.$rows['bidang_keahlian'].'</td>
                      <td>'.$row['pendidikan_terakhir'].'</td>
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
<?php
}
if(count($pelatihan)>0)
{
  echo '<h2>Riwayat Pelatihan</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pelatihan</th>
              <th>Tahun</th>
              <th>Jumlah Jam</th>
              <th>Sertifikat</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($pelatihan as $row) {
                $no++;
                if($row['sertifikat']=='')
                {
                  $sertifikat='Belum Upload';
                }
                else
                {
                  $sertifikat=aksiModalLihat('#modalSertifikat',$row['id'],'Lihat');
                }
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['nama_pelatihan']).'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.$row['jumlah_jam'].' Jam</td>
                      <td>'.$sertifikat.'</td>
                      
                     
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>

<?php
}
if(count($seminar)>0)
{
  echo '<h2>Riwayat Seminar</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tahun</th>
              <th>Jenis</th>
              <th>Peran</th>
              <th>Penyelenggara</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($seminar as $row) {
                $no++;
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['judul']).'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.viewKodeApp('JENISSEMINAR',$row['jenis']).'</td>
                      <td>'.viewKodeApp('PERANSEMINAR',$row['peran']).'</td>
                      <td>'.$row['penyelenggara'].'</td>
                      
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>

<?php
}
if(count($penghargaan)>0)
{
  echo '<h2>Riwayat Penghargaan</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Penghargaan</th>
              <th>Tahun</th>
              <th>Instansi Pemberi Penghargaan</th>
            
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($penghargaan as $row) {
                $no++;
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['nama_penghargaan']).'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.$row['instansi_pemberi'].'</td>
                      
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
<?php
}
if(count($penelitian)>0)
{
  echo '<h2>Riwayat Penelitian</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tahun</th>
              <th>Biaya</th>
              <th>Sumber Dana</th>
              <th>Peran</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($penelitian as $row) {
                $no++;
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['judul_penelitian']).'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.rupiah($row['biaya_penelitian']).'</td>
                      <td>'.viewKodeApp('DANAPENLIT',$row['sumber_dana']).'</td>
                      <td>'.viewKodeApp('PERANPENELITIAN',$row['peran_penelitian']).'</td>
                      
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
<?php
}
if(count($pengabdian)>0)
{
  echo '<h2>Riwayat Pengabdian Kepada Masyarakat</h2>';
?>

 <div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tahun</th>
              <th>Peran</th>
              <th>Tempat</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($pengabdian as $row) {
                $no++;
                
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['judul']).'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.viewKodeApp('PERANPENELITIAN',$row['peran']).'</td>
                      <td>'.stripslashes($row['tempat']).'</td>
                      
                      
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>

<?php
}
if(count($publikasi)>0)
{
  echo '<h2>Riwayat Publikasi</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tahun</th>
              <th>Jenis</th>
              <th>Url</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($publikasi as $row) {
                if($row['url']=='')
                {
                  $url='Tidak Ada';
                }
                else
                {
                  $url=aksiUrl($row['url'],'Buka');
                }
                $no++;
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['judul']).'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.viewKodeApp('MEDIAPUB',$row['jenis']).'</td>
                      
                      <td>'.$url.'</td>
                      
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
<?php
}
if(count($serdos)>0)
{
  echo '<h2>Sertifikasi Dosen</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Tahun Lulus</th>
              <th>No. Sertifkat</th>
              <th>Tanggal Sertifikat</th>
             
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($serdos as $row) {
                $no++;
                
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.stripslashes($row['nomor']).'</td>
                      <td>'.tgl_indo($row['tanggal']).'</td>
                     
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
<?php
}
if(count($kegmhs)>0)
{
  echo '<h2>Peran dalam Kegiatan Kemahasiswaan</h2>';
?>
<div class="table-responsive">
        <table id="data-table" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Tahun</th>
              <th>Peran</th>
              <th>Tempat</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($kegmhs as $row) {
                $no++;
                
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['judul']).'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.$row['peran'].'</td>
                      <td>'.stripslashes($row['tempat']).'</td>
                      
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
<?php
}
?>

