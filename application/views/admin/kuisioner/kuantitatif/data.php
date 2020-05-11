            <!-- begin page-header -->
      <h1 class="page-header">Kuisioner <small></small></h1>
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
                                <div class="panel-heading-btn">
                                    <?php

                                    if(bisaTulis($link,$id_level)==1)
                                    {
                                       echo aksiTambah('kuisioner/kuantitatiftambah');
                                    }
                                    ?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                              
                           
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                                 
                                <thead>
                      <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Kategori</th>
                        <th>Option</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                    $no = 1;
                    foreach ($record as $row){
                    echo '<tr><td>'.$no.'</td>
                             
                              <td>'.$row['soal'].'</td>
                              <td>'.viewKategoriKuisioner($row['kategori']).'</td>
                              <td>'.viewOptionKuisioner($row['id']).' '.aksiDetail('kuisioner/option',enkrip($row['id']),'Detail').'</td>
                              
                              <td width="1%" nowrap><center>';
                              if(bisaUbah($link,$id_level)==1)
                              {
                                echo aksiEdit('kuisioner/kuantitatifedit',enkrip($row['id']));
                              }
                              echo'&nbsp;';
                              if(bisaHapus($link,$id_level)==1)
                              {
                               echo aksiHapus('kuisioner/kuantitatifhapus',enkrip($row['id']));
                              }
                              echo'</center></td>
                          </tr>';
                      $no++;
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
      </div>
      <!-- end section-container -->


