<?php
$tgl=$rows['tgl_aktif'];
$tanggal=explode(" ", $tgl);
?>
<div class="form-group row">
    <label class="col-sm-2 control-label "><b>Status Aktif SDM</b></label>
    <div class="col-sm-10">
     <select name="status_aktif"  class="form-control" required>
      
       <?=opKodeApp('STSPEGAWAI',$rows['status_aktif'])?>
     </select>
    </div>
  </div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Tanggal Status</b></label>
    <div class="col-sm-10">
      <input type="date" name="tgl_aktif" class="form-control" value="<?=$tanggal[0]?>" placeholder="Tanggal Status" >
    </div>
</div><!-- row -->

<div class="form-group row" >
    <label class="col-sm-2 control-label "><b>Keterangan</b></label>
    <div class="col-sm-10">
      <textarea name="ket_aktif" class="mytextarea"><?=$rows['ket_aktif']?></textarea>
    </div>
</div><!-- row -->


