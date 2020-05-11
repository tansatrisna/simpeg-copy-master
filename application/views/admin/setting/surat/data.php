
      <!-- begin page-header -->
      <h1 class="page-header">Setting <small></small></h1>
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
                                
                                <h4 class="panel-title">Kop Surat</h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal form-group row-sm" enctype="multipart/form-data"  action="<?=base_url()?>setting/surat" method="POST">
                               <input type="hidden" name="id" value="<?=$rows['id']?>">
              
                       <?php
                       echo'         
                      

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Header</label>
                        <div class="col-sm-9 controls">
                          <input type="text" name="header" class="form-control" value="'.$rows['header'].'" placeholder="Nama" required>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Sub Header</label>
                        <div class="col-sm-9 controls">
                          <input type="text" name="subheader" class="form-control" value="'.$rows['subheader'].'" placeholder="Nama" required>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Alamat Kampus I</label>
                        <div class="col-sm-9 controls">
                          <input type="text" name="kampus1" class="form-control" value="'.$rows['kampus1'].'" placeholder="Alamat Kampus I" required>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Alamat Kampus II</label>
                        <div class="col-sm-9 controls">
                          <input type="text" name="kampus2" class="form-control" value="'.$rows['kampus2'].'" placeholder="Alamat Kampus II" required>
                          </div>
                      </div>

                      
                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Kabupaten/ Propinsi/ Kode Pos</label>
                        <div class="col-sm-9 controls">
                          <input type="text" name="kabprop" class="form-control" value="'.$rows['kabprop'].'" placeholder="Kabupaten/ Propinsi/ Kode Pos">
                          </div>
                      </div>

                      

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Website</label>
                        <div class="col-sm-9 controls">
                          <input type="text" name="website" class="form-control" value="'.$rows['website'].'" placeholder="Website">
                          </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-9 controls">
                          <input type="email" name="email" class="form-control" value="'.$rows['email'].'" placeholder="Email">
                          </div>
                      </div>

                     

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Logo</label>
                        <div class="col-sm-4 controls">
                          <input type="file" class="form-control" name="gambar">
                          </div>
                         <div class="col-sm-5">Kosong Jika Tidak Mengganti Logo</div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-2 control-label">Logo Sebelumnya</label>
                        <div class="col-sm-2 controls">';
                        if($rows['logo']=='')
                         {
                          echo'<p>Belum Ada Logo</p>';
                         }
                         else
                         {
                          echo '<img src="'.base_url().'assets/img/'.$rows['logo'].'" width="200">';
                         }
                          echo'</div>
                         
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