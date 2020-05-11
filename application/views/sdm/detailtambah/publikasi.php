<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Judul Publikasi</b></label>
    <div class="col-sm-10">
     <textarea name="judul" class="form-control" rows="3" required><?=$rows['judul']?></textarea>
    </div>
  </div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tahun Terbit</b></label>
    <div class="col-sm-10">
     <select name="tahun" class="form-control" required>
       <?=opTahun($rows['tahun'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Jenis Publikasi</b></label>
    <div class="col-sm-10">
      <select name="jenis" class="form-control" required>
        
       <?=opKodeApp('MEDIAPUB',$rows['jenis'])?>
     </select>
    </div>
</div><!-- row -->



<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Url/ Link Publikasi</b></label>
    <div class="col-sm-10">
      <input type="url" name="url" class="form-control" value="<?=$rows['url']?>" placeholder="Url/ Link Publikasi" >
    </div>
</div><!-- row -->


