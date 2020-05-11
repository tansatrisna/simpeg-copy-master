  <div class="panel panel-inverse">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <?php
        echo aksiKembali($link);
        if(bisaUbah($link,$id_level))
        {
          echo aksiEdit('master/sdmdetailedit/'.$seo,$tab,'Edit Status');
        }
        ?>
      </div>
      <h2 class="panel-title"><?=$title.' '.strtoupper($rows['nama'])?></h2>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <tbody>
            
            <tr>
              <td>Status</td>
              <td><?=viewKodeApp('STSPEGAWAI',$rows['status_aktif'])?></td>
            </tr>
            <tr>
              <td width="1%" nowrap>Tanggal Status</td>
              <td><?=tgl_waktu_indo($rows['tgl_aktif'])?></td>
            </tr>
            <tr>
              <td>Keterangan</td>
              <td><?=$rows['ket_aktif']?></td>
            </tr>
            

          </tbody>
        </table>
      </div>
    </div>
</div>