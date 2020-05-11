<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Nama Penghargaan</b></label>
    <div class="col-sm-10">
     <input type="text" name="nama_penghargaan" class="form-control" value="<?=$rows['nama_penghargaan']?>" placeholder="Nama Penghargaan" >
    </div>
  </div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Tahun Penghargaan</b></label>
    <div class="col-sm-10">
     <select name="tahun" class="form-control" required>
       <?=opTahun($rows['tahun'])?>
     </select>
    </div>
</div><!-- row -->

<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Istansi Pemberi Penghargaan</b></label>
    <div class="col-sm-10">
      <input type="text" name="instansi_pemberi" class="form-control" value="<?=$rows['instansi_pemberi']?>" placeholder="Istansi Pemberi Penghargaan" >
    </div>
</div><!-- row -->


