<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Jenjang Pendidikan</b></label>
    <div class="col-sm-10">
      <select name="jenjang" class="form-control" required>
        
       <?=opKodeApp('JENJPEND',$rows['jenjang'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Nomor Ijazah</b></label>
    <div class="col-sm-10">
      <input type="text" name="nomor_ijazah" class="form-control" value="<?=$rows['nomor_ijazah']?>" placeholder="Nomor Ijazah" required>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tanggal Ijazah</b></label>
    <div class="col-sm-10">
      <input type="date" name="tgl_ijazah" class="form-control" value="<?=$rows['tgl_ijazah']?>" placeholder="Tanggal Ijazah" required>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Jurusan</b></label>
    <div class="col-sm-10">
      <input type="text" name="jurusan" class="form-control" value="<?=$rows['jurusan']?>" placeholder="" >
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Bidang Keahlian</b></label>
    <div class="col-sm-10">
      <input type="text" name="bidang_keahlian" class="form-control" value="<?=$rows['bidang_keahlian']?>" placeholder="" >
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tamatan Dari</b></label>
    <div class="col-sm-10">
      <select name="tamatan" id="tamatan" class="form-control" required>
        <option value="">..::Tamatan Dari::..</option>
        <?=opEnum('simpeg_pendidikan','tamatan',$rows['tamatan'])?>
      </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Nama Sekolah/ PT</b></label>
    <div class="col-sm-10">
      <input type="text" name="nama_sekolah_pt" class="form-control" value="<?=$rows['nama_sekolah_pt']?>" placeholder="Nama Sekolah/ Perguruan Tinggi" >
    </div>
</div><!-- row -->


<div id="dn">
  

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Propinsi Sekolah/ PT</b></label>
    <div class="col-sm-10">
      <select name="prop" id="prop" class="form-control prop">
        <option value=""></option>
        <?=opProp($rows['prop'])?>
      </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Kabupaten Sekolah/ PT</b></label>
    <div class="col-sm-10">
      <select name="kab" id="kab" class="form-control kab">
        <option value=""></option>
        <?=opKab($rows['prop'],$rows['kab'])?>
      </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Kecamatan Sekolah/ PT</b></label>
    <div class="col-sm-10">
      <select name="kec" id="kec" class="form-control kec">
        <option value=""></option>
        <?=opKec($rows['kab'],$rows['kec'])?>
      </select>
    </div>
</div><!-- row -->

</div>

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Pendidikan Terakhir?</b></label>
    <div class="col-sm-10">
      <select name="pendidikan_terakhir" class="form-control" required>
        <?=opEnum('simpeg_pendidikan','pendidikan_terakhir',$rows['pendidikan_terakhir'])?>
      </select>
    </div>
</div><!-- row -->


<script type="text/javascript">
          
 $(document).ready(function(){
      $(".prop").select2({placeholder:"..::Pilih Propinsi::.."});
      $(".kab").select2({placeholder:"..::Pilih Kabupaten::.."});
      $(".kec").select2({placeholder:"..::Pilih Kecamatan::.."}); 
    var dn=$('#tamatan').val();
    if(dn=='DN')
    {
      $('#dn').show();
      $('#prop').prop('required',true);
      $('#kab').prop('required',true);
      $('#kec').prop('required',true);
    }
    else
    {
      $('#dn').hide();
      $('#prop').prop('required',false);
      $('#kab').prop('required',false);
      $('#kec').prop('required',false);
    }
     
    })
 
 $('#tamatan').change(function(){
  var dn=$(this).val();
    if(dn=='DN')
    {
      $('#dn').show();
      $('#prop').prop('required',true);
      $('#kab').prop('required',true);
      $('#kec').prop('required',true);
    }
    else
    {
      $('#dn').hide();
      $('#prop').prop('required',false);
      $('#kab').prop('required',false);
      $('#kec').prop('required',false);
    }
     
 });

  

 $('#prop').change(function(){
      var prop = $(this).val();

      // AJAX request
      $.ajax({
        url:'<?=base_url()?>referensi/getKab',
        method: 'post',
        data: {prop: prop},
        dataType: 'json',
        success: function(response){

          // Remove options 
          $('#kab').find('option').not(':first').remove();
          $('#kec').find('option').not(':first').remove();
         
         
        

          // Add options
          $.each(response,function(index,data){
             $('#kab').append('<option value="'+data['KDEKKB']+'">'+data['NMAKKB']+'</option>');

          });
        }
     });
   });

 $('#kab').change(function(){
      var kab = $(this).val();

      // AJAX request
      $.ajax({
        url:'<?=base_url()?>referensi/getKec',
        method: 'post',
        data: {kab: kab},
        dataType: 'json',
        success: function(response){

          // Remove options 
          
          $('#kec').find('option').not(':first').remove();
         
         
        

          // Add options
          $.each(response,function(index,data){
             $('#kec').append('<option value="'+data['KDEKEC']+'">'+data['NMAKEC']+'</option>');

          });
        }
     });
   });
 
  </script> 