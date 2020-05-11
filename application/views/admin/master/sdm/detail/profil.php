  <div class="panel panel-inverse">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <?php
        echo aksiKembali($link);
        if(bisaUbah($link,$id_level))
        {
          echo aksiEdit('master/sdmdetailedit/'.$seo,$tab,'Edit Profil');
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
              <td rowspan="25" width="1%"><img src="<?=gambar('sdm',$rows['foto'])?>" alt="" width="200px"></td>
              <td  width="20%">ID SDM</td>
              <td><?=$rows['idsdm']?></td>
            </tr>
            <tr>
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
              <td>Tempat, Tanggal Lahir</td>
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
              <td>Status Menikah</td>
              <td><?=viewKodeApp('STSSIPIL',$rows['status_nikah'])?></td>
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
              <td>ORCID ID</td>
              <td><?=$rows['orcid_id']?></td>
            </tr>
            <tr>
              <td>Google Scholar ID</td>
              <td><?=$rows['scholar_id']?></td>
            </tr>
            <tr>
              <td>Sinta ID</td>
              <td><?=$rows['sinta_id']?></td>
            </tr>
            <tr>
              <td>NIK</td>
              <td><?=$rows['nik']?></td>
            </tr>
            <tr>
              <td>NPWP</td>
              <td><?=$rows['npwp']?></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td><?=$rows['alamat']?></td>
            </tr>
            <tr>
              <td>Kode Pos</td>
              <td><?=$rows['kodepos']?></td>
            </tr>
            <tr>
              <td>Nomor Rekening</td>
              <td><?=$rows['norek'].' - '.viewKodeApp('BANK',$rows['bank'])?></td>
            </tr>
            <tr>
              <td>Nomor SK/ TMT</td>
              <td><?=$rows['no_sk'].', '.tgl_indo($rows['mulai_masuk'])?></td>
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
      </div>
    </div>
</div>