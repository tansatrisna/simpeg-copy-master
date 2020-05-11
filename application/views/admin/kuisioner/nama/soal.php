
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
                                <div class="panel-heading-btn">
                                    <a href="<?=base_url($link)?>" class="btn btn-warning btn-xs" ><i class="fa fa-times"></i> Tutup</a>
                                    <?=aksiTambah('kuisioner/soaltambah/'.$seo,'Tambah Soal Kuisioner')?>
                                    
                                </div>
                                <h4 class="panel-title"><?=$title?></title></h4>
                            </div>
                            
                       
                            <div class="table-responsive">
                                <table  class="table table-striped table-bordered">
                                 
                                 <thead>
                      <tr>
                        
                        <th width="1%">No</th>
                        
                        <th>Soal Kuisioner</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=0;
                        if(count($record)==0)
                        {
                          echo'<tr><td colspan="5" class="text-center">Belum Ada Soal Kuisioner</td></tr>';
                        }
                        else
                        {

                        foreach ($record as $row) {
                        $no++;
                        echo'<tr>
                       
                        <td>'.$no.'</td>
                        <td>'.$row['soal'].'</td>
                        <td>'.$row['jenis'].'</td>
                        <td>'.$row['kategori'].'</td>';
                     
                        
                        
                        echo'<td>';
                       if(bisaHapus($link,$id_level))
                       {
                        echo aksiHapus('kuisioner/soalhapus/'.$seo,enkrip($row['id']));
                       }
                       echo'</td>
                        </tr>';

                          
                        }

                      }
                      ?>
                    </tbody>
                                 
                                </table>
                            </div>
                            
                           
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-8 -->
                </div>
                <!-- end row -->
      </div>
      <!-- end section-container -->




