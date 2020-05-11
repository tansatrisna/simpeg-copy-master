
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header"><?=$header?> <small></small></h1>
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
                                
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal form-group row-sm" enctype="multipart/form-data"  action="<?=base_url()?>setting/login" method="POST">
                               <input type="hidden" name="id" value="<?=$rows['id']?>">
              
                       <?php
                       echo'         
                      

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-9 controls">
                          <input type="text" name="judul" class="form-control" value="'.$rows['judul'].'" placeholder="Judul" required>
                          </div>
                      </div>

                      

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Background</label>
                        <div class="col-sm-4 controls">
                          <input type="file" class="form-control" name="gambar">
                          </div>
                         <div class="col-sm-5">Kosongkan Jika Tidak Mengganti Background</div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Logo Sebelumnya</label>
                        <div class="col-sm-2 controls">';
                        if($rows['gambar']=='')
                         {
                          echo'<p>Belum Ada Background</p>';
                         }
                         else
                         {
                          echo '<img src="'.base_url().'assets/img/bg/'.$rows['gambar'].'" width="200">';
                         }
                          echo'</div>
                         
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Isi</label>
                        
                         <div class="col-sm-8">
                         <textarea name="isi" class="mytextarea" >'.$rows['isi'].'</textarea> 
                         </div>
                      </div>';

                      if(bisaUbah($link,$id_level))
                        {
                          echo'<div class="form-group row">
                                    <label class="col-sm-2 control-label ">&nbsp;</label>
                                    <div class="col-sm-10">
                                      
                                      <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                                      
                                    </div>
                                  </div><!-- row -->';
                        }
                      ?>

                                  
                      
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