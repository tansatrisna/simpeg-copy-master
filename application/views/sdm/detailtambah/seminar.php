<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Judul Seminar</b></label>
    <div class="col-sm-10">
     <textarea name="judul" class="form-control" rows="3" required><?=$rows['judul']?></textarea>
    </div>
  </div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tahun Seminar</b></label>
    <div class="col-sm-10">
     <select name="tahun" class="form-control" required>
       <?=opTahun($rows['tahun'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Jenis Seminar</b></label>
    <div class="col-sm-10">
      <select name="jenis" class="form-control" required>
        
       <?=opKodeApp('JENISSEMINAR',$rows['jenis'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Peran Seminar</b></label>
    <div class="col-sm-10">
      <select name="peran" class="form-control" required>
        
       <?=opKodeApp('PERANSEMINAR',$rows['peran'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Penyelenggara</b></label>
    <div class="col-sm-10">
      <input type="text" name="penyelenggara" class="form-control" value="<?=$rows['penyelenggara']?>" placeholder="Penyelenggara Seminar" >
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>URL</b></label>
    <div class="col-sm-10">
      <input type="text" name="url" class="form-control" value="<?=$rows['url']?>" placeholder="URL" >
    </div>
</div><!-- row -->


