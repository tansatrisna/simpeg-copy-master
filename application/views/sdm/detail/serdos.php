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
              <th>Tahun Lulus</th>
              <th>No. Sertifkat</th>
              <th>Tanggal Sertifikat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=0;
              foreach ($record as $row) {
                $no++;
                
                echo'<tr>
                      <td>'.$no.'</td>
                      <td>'.$row['tahun'].'</td>
                      <td>'.stripslashes($row['nomor']).'</td>
                      <td>'.tgl_indo($row['tanggal']).'</td>
                      
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

