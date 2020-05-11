<?php
$tgl_lahir=explode("-",$rows['tgl_lahir']);
$tanggal=$tgl_lahir[2];
$bulan=$tgl_lahir[1];
$tahun=$tgl_lahir[0];
?>




  <div class="form-group row">
    <label class="col-sm-2 control-label "><b>Jenis SDM</b></label>
    <div class="col-sm-10">
     <select name="jenis" id="jenis" class="form-control" required>
       <option value="">..::Pilih Jenis SDM::..</option>
       <?=opEnum('m_sdm','jenis',$rows['jenis'])?>
     </select>
    </div>
  </div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Status SDM</b></label>
    <div class="col-sm-10">
     <select name="status" id="status" class="form-control" required>
       <option value="">..::Pilih Status SDM::..</option>
       <?=opStatusSdm($rows['jenis'],$rows['status'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>NIP/ Kode Pegawai</b></label>
    <div class="col-sm-10">
      <input type="text" name="nip" class="form-control" value="<?=$rows['nip']?>" placeholder="NIP/ Kode Pegawai" >
    </div>
</div><!-- row -->

<div class="form-group row" id="nidn">
    <label class="col-sm-2 control-label "><b>NIDN</b></label>
    <div class="col-sm-10">
      <input type="text" name="nidn" class="form-control" value="<?=$rows['nidn']?>" placeholder="NIDN Dosen" >
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Unit</b></label>
    <div class="col-sm-10">
      <select name="unit" id="unit" class="form-control unit" required>
        <option value=""></option>
        <?=opUnit($rows['unit'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Nama</b></label>
    <div class="col-sm-3">
      <input type="text" name="gelar_depan" class="form-control" value="<?=$rows['gelar_depan']?>" placeholder="Gelar Depan">
      <small>Gelar Depan</small>
    </div>
    <div class="col-sm-4">
      <input type="text" name="nama" class="form-control" value="<?=$rows['nama']?>" placeholder="Nama Lengkap" required>
      <small>Nama Lengkap</small>
    </div>
    <div class="col-sm-3">
      <input type="text" name="gelar_belakang" class="form-control" value="<?=$rows['gelar_belakang']?>" placeholder="Gelar Belakang" required>
      <small>Gelar Belakang</small>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Agama</b></label>
    <div class="col-sm-10">
      <select name="agama"  class="form-control" required>
        <?=opKodeApp('AGAMA',$rows['agama'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Jenis Kelamin</b></label>
    <div class="col-sm-10">
      <select name="jk"  class="form-control" required>
        <?=opKodeApp('KELAMIN',$rows['jk'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Status Menikah</b></label>
    <div class="col-sm-10">
      <select name="status_nikah"  class="form-control" required>
        <?=opKodeApp('STSSIPIL',$rows['status_nikah'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Tempat Lahir</b></label>
    <div class="col-sm-10">
      <input type="text" name="tempat_lahir" class="form-control" value="<?=$rows['tempat_lahir']?>" placeholder="Tempat Lahir" >
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Tanggal Lahir</b></label>
    <div class="col-sm-3">
      <select name="tanggal" class="form-control" required>
        <?=opTanggal($tanggal)?>
      </select>
      <small>Tanggal Lahir</small>
    </div>
    <div class="col-sm-4">
      <select name="bulan" class="form-control" required>
        <?=opBulan($bulan)?>
      </select>
      <small>Bulan Lahir</small>
    </div>
    <div class="col-sm-3">
      <select name="tahun" class="form-control" required>
        <?=opTahun($tahun)?>
      </select>
      <small>Tahun Lahir</small>
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>NIK</b></label>
    <div class="col-sm-10">
      <input type="text" name="nik" class="form-control" value="<?=$rows['nik']?>" placeholder="NIK/ Nomor KTP" >
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>HP</b></label>
    <div class="col-sm-10">
      <input type="text" name="hp" class="form-control" value="<?=$rows['hp']?>" placeholder="Nomor HP" >
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Alamat</b></label>
    <div class="col-sm-10">
      <input type="text" name="alamat" class="form-control" value="<?=$rows['alamat']?>" placeholder="Alamat" >
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Kode Pos</b></label>
    <div class="col-sm-10">
      <input type="text" name="kodepos" class="form-control" value="<?=$rows['kodepos']?>" placeholder="Kode Pos" >
    </div>
</div><!-- row -->


<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Email</b></label>
    <div class="col-sm-10">
      <input type="email" name="email" class="form-control" value="<?=$rows['email']?>" placeholder="Email" required>
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Email Institusi</b></label>
    <div class="col-sm-10">
      <input type="email" name="email_institusi" class="form-control" value="<?=$rows['email_institusi']?>" placeholder="Email Institusi">
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>ORCID Id</b></label>
    <div class="col-sm-10">
      <input type="text" name="orcid_id" class="form-control" value="<?=$rows['orcid_id']?>" placeholder="ORCID ID">
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Google Scholar Id</b></label>
    <div class="col-sm-10">
      <input type="text" name="scholar_id" class="form-control" value="<?=$rows['scholar_id']?>" placeholder="Google Scholar ID">
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Sinta Id</b></label>
    <div class="col-sm-10">
      <input type="text" name="sinta_id" class="form-control" value="<?=$rows['sinta_id']?>" placeholder="SINTA ID">
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>NPWP</b></label>
    <div class="col-sm-10">
      <input type="text" name="npwp" class="form-control" value="<?=$rows['npwp']?>" placeholder="NPWP">
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>BANK</b></label>
    <div class="col-sm-10">
      <select name="bank"  class="form-control" >
        <?=opKodeApp('BANK',$rows['bank'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Nomor Rekening</b></label>
    <div class="col-sm-10">
      <input type="text" name="norek" class="form-control" value="<?=$rows['norek']?>" placeholder="Nomor Rekening">
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Nomor SK</b></label>
    <div class="col-sm-10">
      <input type="text" name="no_sk" class="form-control" value="<?=$rows['no_sk']?>" placeholder="Nomor SK" required>
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Mulai Masuk Kerja</b></label>
    <div class="col-sm-10">
      <input type="date" name="mulai_masuk" class="form-control" value="<?=$rows['mulai_masuk']?>" placeholder="Mulai Masuk Kerja" required="">
    </div>
</div><!-- row -->



<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Pendidikan Terakhir</b></label>
    <div class="col-sm-10">
       <select name="kode_pendidikan"  class="form-control" required>
        <?=opKodeApp('JENJPEND',$rows['kode_pendidikan'])?>
      </select>
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Instansi Induk</b></label>
    <div class="col-sm-10">
      <select name="instansi_induk"  class="form-control" required>
        <?=opKodeApp('INSTANSI',$rows['instansi_induk'])?>
      </select>
    </div>
</div><!-- row -->


<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Pangkat Golongan</b></label>
    <div class="col-sm-10">
      <select name="pangkat_golongan" class="form-control" >
        <?=opKodeApp('GOLPNS',$rows['pangkat_golongan'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Jabatan Fungsional</b></label>
    <div class="col-sm-10">
      <select name="jabatan_fungsional" class="form-control" >
        <?=opKodeApp('JABAKAD',$rows['jabatan_fungsional'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Jabatan Struktural</b></label>
    <div class="col-sm-10">
      <select name="jabatan_struktural" class="form-control" >
        <?=opKodeApp('STRUKTURAL',$rows['jabatan_struktural'])?>
      </select>

    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Foto</b></label>
    <div class="col-sm-10">
      <input type="file" name="gambar" class="form-control" value="" placeholder="">
      <small>Kosongkan Jika Tidak Mengganti Foto</small>

    </div>
</div><!-- row -->

              

             


<script type="text/javascript">
 $(document).ready(function() {
  var jenis = $('#jenis').val();
  if(jenis=='DOSEN')
      {
        $('#nidn').show();
      }
      else
      {
        $('#nidn').hide();
      }
     $(".unit").select2({placeholder:"..::Pilih Unit::.."});
    });

 $('#jenis').change(function(){
      var jenis = $(this).val();

      if(jenis=='DOSEN')
      {
        $('#nidn').show();
      }
      else
      {
        $('#nidn').hide();
      }

      // AJAX request
      $.ajax({
        url:'<?=base_url()?>referensi/getStatusSdm',
        method: 'post',
        data: {jenis: jenis},
        dataType: 'json',
        success: function(response){

          // Remove options 
          $('#status').find('option').not(':first').remove();
               
          // Add options
          $.each(response,function(index,data){
             $('#status').append('<option value="'+data['id']+'">'+data['nama']+'</option>');

          });
        }
     });
   });
  </script> 