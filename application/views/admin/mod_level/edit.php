<!-- begin breadcrumb -->
      <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>home">Home</a></li>
        <li><a href="<?=base_url()?>level">Level</a></li>
        <li class="active">Edit Level</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Level <small></small></h1>
      <!-- end page-header -->

<!-- begin section-container -->
      <div class="section-container section-with-top-border p-b-5">
          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                
                                <h4 class="panel-title">Form Edit Level</h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal "  action="<?=base_url()?>level/edit" method="POST">
                              <input type="hidden" name="id" value="<?=$row['id_level']?>">
            
                                <div class="form-group row">
                                  <label class="col-sm-2 control-label ">Level</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="level" class="form-control" value="<?=$row['nama_level']?>" placeholder="Nama Level" required>
                                  </div>
                                </div><!-- row -->
              
                                

                                  <div class="form-group row">
                                    <label class="col-sm-2 control-label ">&nbsp;</label>
                                    <div class="col-sm-10">
                                      
                                      <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                                      <a href="<?=base_url()?>level" class="btn btn-danger">Cancel</a>
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
      </div>
      <!-- end section-container -->