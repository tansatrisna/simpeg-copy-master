
      <!-- begin page-header -->
      <h1 class="page-header"><?=$title?> <small></small></h1>
      <!-- end page-header -->

      
          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                
                                <h4 class="panel-title">Form Tambah <?=$title?></h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal"  action="<?=base_url()?>website/peraturantambah" enctype="multipart/form-data" method="POST">
            
              <!-- /.form-group row -->
              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Judul</b></label>
                  <div class="col-sm-10">
                    <input type="text" name="judul" class="form-control" value="" placeholder="Judul" required>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Berkas</b></label>
                  <div class="col-sm-10">
                    <input type="file" name="berkas" value="" placeholder="" required>
                  </div>
              </div>
               <!-- /.form-group row -->

                <!-- /.form-group row -->
              

              <div class="form-group row">
                <label class="col-sm-2 control-label ">&nbsp;</label>
                <div class="col-sm-10">
                  
                  <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
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
  