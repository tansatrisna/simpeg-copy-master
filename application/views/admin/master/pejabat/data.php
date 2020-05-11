      <!-- begin page-header -->
      <h1 class="page-header"><?=$header?> <small></small></h1>
      <!-- end page-header -->
<!-- begin section-container -->
     

          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                     <?php
                                  if(bisaTulis($link,$id_level))
                                  {
                                    echo aksiTambah('master/pejabattambah');
                                  }
                                  ?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                              
                           
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered width-full">
                                 <thead>
                                  <tr>
                                    <th>No. Peserta</th>
                                    <th>Nama</th>
                                    <th>Kelompok</th>
                                    <th>Jabatan</th>
                                    <th width="1%">Aksi</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                  <?php
                                 
                                  foreach ($record as $row) {
                                    $no++;
                                   echo '<tr>
                                          <td>'.$no.'</td>
                                          <td>'.viewSdm($row['idsdm']).'</td>
                                          <td>'.viewKelompokUnit($row['kelompok']).'</td>
                                          <td>'.$row['jabatan'].'</td>
                                          
                                         
                                          <td class="with-btn" nowrap>';
                                          if(bisaUbah($link,$id_level))
                                          {
                                            echo aksiEdit('master/pejabatedit',enkrip($row['id']));
                                          }
                                          echo '&nbsp;';
                                          if(bisaHapus($link,$id_level))
                                          {
                                            echo aksiHapus('master/pejabathapus',enkrip($row['id']));
                                          }
                                          echo'</td>
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
                    <!-- end col-8 -->
                </div>
                <!-- end row -->



