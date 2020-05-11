
      <!-- begin page-header -->
      <h1 class="page-header"><?=$header?> <small></small></h1>
      <!-- end page-header -->

      
          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                
                                <h4 class="panel-title">Form Edit <?=$title?></h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal"  action="<?=base_url()?>master/pejabatedit" enctype="multipart/form-data" method="POST">
            
             
              
              <input type="hidden" name="id" value="<?=$rows['id']?>">             
             
              <!-- /.form-group row -->
              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Nama</b></label>
                  <div class="col-sm-10">
                   <select name="idsdm" class="form-control sdm">
                     <option value=""></option>
                     <?=opSdm($rows['idsdm'])?>
                   </select> 
                  </div>
              </div><!-- row -->
               <!-- /.form-group row -->
              

                <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Kelompok Jabatan</b></label>
                  <div class="col-sm-10">
                   <select name="kelompok" class="form-control">
                     <option value="">..::Pilih Kelompok Jabatan::..</option>
                     <?=opKelompokUnit($rows['kelompok'])?>
                   </select>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Jabatan</b></label>
                  <div class="col-sm-10">
                   <input type="text" name="jabatan" class="form-control" value="<?=$rows['jabatan']?>" placeholder="">
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Urutan</b></label>
                  <div class="col-sm-10">
                   <input type="number" name="urutan" class="form-control" value="<?=$rows['urutan']?>" placeholder="">
                  </div>
                </div><!-- row -->

              

              

             

              <div class="form-group row">
                <label class="col-sm-2 control-label ">&nbsp;</label>
                <div class="col-sm-10">
                  
                  <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                  <a href="<?=base_url($link)?>" class="btn btn-danger">Cancel</a>
                </div>
              </div><!-- row -->
                      
            </form>
          </div>
            
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-8 -->
</div>
<!-- end row -->
   

      



<script type="text/javascript">
          
 $(document).ready(function() {
     $(".sdm").select2({placeholder:"..::Pilih Dosen/ Pegawai::..", allowClear: true});
      
    });
  </script> 