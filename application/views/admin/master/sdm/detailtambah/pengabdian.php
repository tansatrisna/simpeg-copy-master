<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Judul</b></label>
    <div class="col-sm-10">
     <textarea name="judul" class="form-control" rows="3" required><?=$rows['judul']?></textarea>
    </div>
  </div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tahun</b></label>
    <div class="col-sm-10">
     <select name="tahun" class="form-control" required>
       <?=opTahun($rows['tahun'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Peran</b></label>
    <div class="col-sm-10">
      <select name="peran" class="form-control" required>
        
       <?=opKodeApp('PERANPENELITIAN',$rows['peran'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tempat</b></label>
    <div class="col-sm-10">
     <input type="text" name="tempat" class="form-control" value="<?=$rows['tempat']?>" placeholder="Tempat">
    </div>
  </div><!-- row -->

  <div class="form-group row">
    <label class="col-sm-2 control-label "><b>Biaya Pengabdian</b></label>
    <div class="col-sm-10">
      <input type="number" name="biaya" class="form-control" value="<?=$rows['biaya_pengabdian']?>" placeholder="Biaya Pengabdian" >
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Sumber Dana</b></label>
    <div class="col-sm-10">
      <select name="sumber_dana" class="form-control" required>
        <?=opKodeApp('DANAPENLIT',$rows['sumber_dana'])?>
     </select>
    </div>
</div><!-- row -->


