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
                                  <?=aksiKembali($kembali)?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                            
                           
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered width-full">
                                 <thead>
                                  <tr>
                                    
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Tahun</th>
                                    <th>Link</th>
                                                                       
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no=0;
                                  foreach ($record as $row) {
                                    $no++;
                                    echo '<tr>
                                            <td>'.$no.'</td>
                                            <td>'.viewSdm($row['idsdm']).'</td>
                                            <td>'.$row['judul'].'</td>
                                            <td>'.$row['tahun'].'</td>
                                            <td>'.aksiUrl($row['url'],'Detail').'</td>
                                           
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

