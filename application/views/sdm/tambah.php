
      <!-- begin page-header -->
      <h1 class="page-header"><?=$header?></small></h1>
      <!-- end page-header -->

      
          <!-- begin row -->

    <div class="row">
        
        <!-- begin col-8 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    
                    <h4 class="panel-title"><?=$title?></h4>
                </div>
                <div class="panel-body">
                <form class="form-horizontal"  action="<?=base_url($aksi)?>" enctype="multipart/form-data" method="POST">
              <!-- /.form-group row -->
                  <div class="form-group row">
                      <label class="col-sm-2 control-label "><b>ID SDM</b></label>
                      <div class="col-sm-10">
                        <input type="text" name="idsdm" class="form-control" value="<?=$idsdm?>" placeholder="" readonly>
                      </div>
                  </div><!-- row -->
               <!-- /.form-group row -->
              
                  <?php
                  $this->load->view('sdm/detailtambah/'.$tab);
                  ?>
                    <div class="form-group row">
                      <label class="col-sm-2 control-label ">&nbsp;</label>
                      <div class="col-sm-10">
                        
                        <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
                        <a href="<?=base_url($kembali)?>" class="btn btn-danger">Cancel</a>
                      </div>
                    </div><!-- row -->
                </form>
            </div>
          </div>
        </div>

          
            
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-8 -->
</div>
<!-- end row -->

