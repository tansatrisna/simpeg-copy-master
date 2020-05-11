<div class="panel panel-inverse">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <?php
        echo aksiKembali($link);
        if(bisaTulis($link,$id_level))
        {
          echo aksiTambah('master/sdmdetailtambah/'.$seo.'/'.$tab);
        }
        ?>
      </div>
      <h2 class="panel-title"><?=$title.' '.strtoupper($rows['nama'])?></h2>
    </div>
    <div class="panel-body">
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
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($record as $row) {
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
                      <td nowrap>';
                      if(bisaUbah($link,$id_level))
                      {
                        echo aksiEdit('master/sdmdetailedit/'.$seo.'/'.$tab,enkrip($row['id']));
                      }
                      if(bisaHapus($link,$id_level))
                      {
                        echo '&nbsp;';
                        echo aksiHapus('master/sdmdetailhapus/'.$seo.'/'.$tab,enkrip($row['id']));
                      }
                      echo'</td>
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
</div>