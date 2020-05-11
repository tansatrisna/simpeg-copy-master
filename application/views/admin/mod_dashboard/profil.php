
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Profil <small></small></h1>
      <!-- end page-header -->

<div class="section-container section-with-top-border p-b-5">
          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-6 -->
                    <div class="col-md-3">
                                     
                                <div class="thumbnail">
                                   <?php
                                      if($rows['gambar']=='')
                                      {
                                        echo'
                                          <img src="'.base_url().'assets/img/user/user.png" alt="" width="100%">
                                          ';
                                      }
                                      else
                                      {
                                        echo'<img src="'.base_url().'assets/img/user/'.$rows['gambar'].'"  alt="" width="100%">';
                                      }
                                  ?>
                                    <div class="caption">
                                        
                                        <p class="m-b-0">
                                          <center><button type="button" data-toggle="modal" data-target="#modalFoto" class="btn btn-success">Edit Foto</button></center>  
                                        </p>
                                    </div>
                                </div>
                          
                    </div>
                    <!-- end col-6 -->
                    <div class="col-md-9">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    <a href="<?=base_url('dashboard/editprofil')?>" class="btn btn-info btn-sm"  ><i class="fa fa-edit"></i> Edit</a>
                                </div>
                                <h4 class="panel-title">Biodata</h4>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-hover ">
                                <tbody>
                                 <tr>
                                  <td>Username</td><td>:</td><td><?=$rows['username']?></td>
                                 </tr>
                                 <tr>
                                  <td>Nama</td><td>:</td><td><?=$rows['nama']?></td>
                                 </tr>
                                 <tr>
                                  <td>Email</td><td>:</td><td><?=$rows['email']?></td>
                                 </tr>
                                 <tr>
                                  <td>HP</td><td>:</td><td><?=$rows['hp']?></td>
                                 </tr>
                                 <tr>
                                  <td>Level</td><td>:</td><td><?=viewLevel($rows['level'])?></td>
                                 </tr>
                                  
                                </tbody>
                              </table>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
                </div>
          <!-- end row -->
      </div>

   <div class="row">
    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                   
                                </div>
                                <h4 class="panel-title">Riwayat Login</h4>
                            </div>
                            <div class="panel-body">
                            <div class="table-responsive">
                    <table id="data-table" class="table table-hover ">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>IP Addres</th>
                          <th>OS</th>
                        
                          <th>Browser</th>
                          <th>Waktu</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                        $no=0;
                        foreach ($riwayat->result_array() as $key) {
                          $no++;
                           
                          echo '<tr>
                          
                           <td>'.$no.'</td>
                          <td>'.$key['ip_address'].'</td>
                         <td>'.$key['os'].'</td>
                          <td>'.$key['browser'].'</td>
                          <td>'.$key['waktu'].'</td>
                        </tr>';
                        }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- end panel -->
          </div>
        </div>
    

    




  <div class="modal fade" id="modalFoto">
          <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Foto Profil</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      
                  </div>
                   <form action="<?=base_url()?>dashboard/profil" enctype="multipart/form-data" method="POST">
                  <div class="modal-body">
                       <div class="form-group row">
                
                        <input type="file" name="gambar" class="form-control" required>
               
                        </div><!-- row -->
                  </div>
                  <div class="modal-footer">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                      <button type="submit" name="ganti" class="btn btn-primary">Edit</button>
                  </div>
                </form>
              </div>
          </div>
      </div>   
              



