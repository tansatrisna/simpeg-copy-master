<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Nama Pelatihan</b></label>
    <div class="col-sm-10">
     <textarea name="nama_pelatihan" class="form-control" rows="3" required><?=$rows['nama_pelatihan']?></textarea>
    </div>
  </div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tahun Pelatihan</b></label>
    <div class="col-sm-10">
     <select name="tahun" class="form-control" required>
       <?=opTahun($rows['tahun'])?>
     </select>
    </div>
</div><!-- row -->



<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Jumlah Jam Pelatihan</b></label>
    <div class="col-sm-10">
      <input type="number" name="jumlah_jam" class="form-control" value="<?=$rows['jumlah_jam']?>" placeholder="Jumlah Jam" required>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Sertifikat</b></label>
    <div class="col-sm-10">
      <input type="file" name="sertifikat" class="form-control"  >
    </div>
</div><!-- row -->


