
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
                            <form class="form-horizontal"  action="<?=base_url()?>master/unitedit" enctype="multipart/form-data" method="POST">
            
             
              <input type="hidden" name="id" value="<?=$rows['id']?>">
                                
             
              <!-- /.form-group row -->
              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Nama Unit</b></label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" value="<?=$rows['nama']?>" placeholder="Nama Unit" required>
                  </div>
              </div><!-- row -->
               <!-- /.form-group row -->
              

                <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Kelompok Unit</b></label>
                  <div class="col-sm-10">
                   <select name="kelompok" class="form-control">
                     <option value="">..::Pilih Kelompok Unit::..</option>
                     <?=opKelompokUnit($rows['kelompok'])?>
                   </select>
                  </div>
                </div><!-- row -->

              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Unit Di Atasnya</b></label>
                  <div class="col-sm-10">
                   <select name="parent" class="form-control select2">
                     <option value=""></option>
                     <option value="0">Tidak Ada</option>
                     <?=opParentUnit($rows['parent'])?>
                   </select>
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
     $(".select2").select2({placeholder:"..::Tidak Ada::..", allowClear: true});
      
    });
  </script> 