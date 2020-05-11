<div class="panel panel-inverse">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <?php
        
          echo aksiTambah('sdm/tambah/'.$tab);
        
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
              <th>Nama Dokumen</th>
              <th>Berkas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($record as $row) {
                $no++;
                if($row['berkas']=='')
                {
                  $sertifikat='Belum Upload';
                }
                else
                {
                  $sertifikat=aksiModalLihat('#modalDokumen',$row['id'],'Lihat');
                }
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.stripslashes($row['nama']).'</td>
                      <td>'.$sertifikat.'</td>
                      
                      <td nowrap>';
                       echo aksiEdit('sdm/edit/'.$tab,enkrip($row['id']));
                      
                        echo '&nbsp;';
                        echo aksiHapus('sdm/hapus/'.$tab,enkrip($row['id']));
                      echo'</td>
                    </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
</div>

