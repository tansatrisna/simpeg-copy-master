

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tahun Lulus</b></label>
    <div class="col-sm-10">
     <select name="tahun" class="form-control" required>
       <?=opTahun($rows['tahun'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Nomor Sertifikat</b></label>
    <div class="col-sm-10">
     <input type="text" name="nomor" class="form-control" value="<?=$rows['nomor']?>" placeholder="Nomor Sertifikat">
    </div>
  </div><!-- row -->

  <div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tanggal Sertifikat</b></label>
    <div class="col-sm-10">
     <input type="date" name="tanggal" class="form-control" value="<?=$rows['tanggal']?>" placeholder="Tanggal Sertifikat">
    </div>
  </div><!-- row -->


