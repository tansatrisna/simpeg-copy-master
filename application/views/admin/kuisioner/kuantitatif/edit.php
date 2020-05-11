
      <!-- begin page-header -->
      <h1 class="page-header">Kuisioner <small></small></h1>
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
                            <form class="form-horizontal"  action="<?=base_url()?>kuisioner/kuantitatifedit" enctype="multipart/form-data" method="POST">
            
             
              
                                
               <input type="hidden" name="id" value="<?=$rows['id']?>">
             
              <!-- /.form-group row -->
              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Kategori</b></label>
                  <div class="col-sm-10">
                    <select name="kategori" class="form-control" required>
                      <option value="">..::Pilih Kategori::..</option>
                      <?=opKategoriKuisioner($rows['kategori'])?>
                    </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Soal</b></label>
                  <div class="col-sm-10">
                    <textarea name="soal" class="mytextarea"><?=$rows['soal']?></textarea>
                  </div>
              </div>
               <!-- /.form-group row -->
              
                <!-- /.form-group row -->
              
            

             

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
  