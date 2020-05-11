<!-- begin breadcrumb -->
      <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?=base_url()?>home">Home</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url()?>modul">Modul</a></li>
        <li class="breadcrumb-item active">Edit Modul</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Modul <small></small></h1>
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
                                
                                <h4 class="panel-title">Form Edit Modul</h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal "  action="<?=base_url()?>modul/edit" method="POST">
                             <input type="hidden" name="id" value="<?=$rows['id_modul']?>">
          
                                <div class="form-group row">
                                  <label class="col-sm-2 control-label ">Nama Modul</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="nama" class="form-control" value="<?=$rows['nama_modul']?>" placeholder="Nama Modul" required>
                                  </div>
                                </div><!-- row -->
                                <div class="form-group row">
                                  <label class="col-sm-2 control-label ">Controller</label>
                                  <div class="col-sm-10">
                                    <input type="text" name="controller" id="controller"  value="<?=$rows['controller']?>" class="form-control" placeholder="Controller" >
                                  </div>
                                  
                                </div><!-- row -->
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label ">Icon</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="icon"  class="form-control" value="<?=$rows['icon']?>" placeholder="Cth: home" >
                                    </div>
                                    
                                  </div><!-- row -->
                                <div class="form-group row">
                                  <label class="col-sm-2 control-label ">Urutan</label>
                                  <div class="col-sm-10">
                                    <input type="number" name="urutan" class="form-control" value="<?=$rows['urutan']?>" placeholder="urutan">
                                  </div>
                                </div><!-- row -->
                                <!-- /.form-group row -->
                                

                                  <div class="form-group row">
                                    <label class="col-sm-2 control-label ">&nbsp;</label>
                                    <div class="col-sm-10">
                                      
                                      <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                                      <a href="<?=base_url()?>modul" class="btn btn-danger">Cancel</a>
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






  



