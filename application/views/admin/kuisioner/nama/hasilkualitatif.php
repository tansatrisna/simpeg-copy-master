      <!-- begin page-header -->
      <h1 class="page-header"><?=$title?> <small></small></h1>
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
                                  <?=aksiCetak('cetak/kualitatif',$seo,'Cetak')?>  
                                </div>
                                <h4 class="panel-title"> <?=viewKategoriKuisioner($rows['kategori'])?></h4>
                            </div>
                            <div class="panel-body">
                              <h3><?=viewKuisionerSoal($rows['soal'])?></h3>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th width="1%" nowrap>No</th>
                                  <th>Jawaban</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              
                                $nop=0;
                                foreach ($record as $row) {
                                  $nop++;
                                  echo '<tr>
                                      <td>'.$nop.'</td>
                                      <td>'.$row['jawaban'].'</td>
                                      
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