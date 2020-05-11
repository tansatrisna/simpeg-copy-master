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
              <th>Nama Pelatihan</th>
              <th>Tahun</th>
              <th>Jumlah Jam</th>
              <th>Sertifikat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($record as $row) {
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

