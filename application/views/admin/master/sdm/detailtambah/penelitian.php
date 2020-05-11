<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Judul Penelitian</b></label>
    <div class="col-sm-10">
     <textarea name="judul_penelitian" class="form-control" rows="3" required><?=$rows['judul_penelitian']?></textarea>
    </div>
  </div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tahun Penelitian</b></label>
    <div class="col-sm-10">
     <select name="tahun" class="form-control" required>
       <?=opTahun($rows['tahun'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Peran Penelitian</b></label>
    <div class="col-sm-10">
      <select name="peran_penelitian" class="form-control" required>
        
       <?=opKodeApp('PERANPENELITIAN',$rows['peran_penelitian'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Biaya Penelitian</b></label>
    <div class="col-sm-10">
      <input type="number" name="biaya_penelitian" class="form-control" value="<?=$rows['biaya_penelitian']?>" placeholder="Biaya Penelitian" >
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
