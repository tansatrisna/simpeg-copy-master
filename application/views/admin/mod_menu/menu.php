      <!-- begin page-header -->
      <h1 class="page-header">Menu <small></small></h1>
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
                                    <a href="<?=base_url()?>menu/tambah" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Tambah</a>
                                </div>
                                <h4 class="panel-title">Menu</h4>
                            </div>
                            <div class="panel-body">
                              
                            
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                 
                                 <thead>
                      <tr>
                        <th>No</th>
                        <th>Modul</th>
                        <th>Nama Menu</th>
                        <th>Link</th>
                        <th>Urutan</th>
                        
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=0;
                        foreach ($record as $row) {
                        $no++;
                        echo'<tr>
                          <td>'.$no.'</td>
                          <td>'.viewModul($row['id_modul']).'</td>
                          <td>'.$row['nama_menu'].'</td>
                          <td>'.$row['link'].'</td>
                          <td>'.$row['urutan'].'</td>
                          <td class="with-btn">'.aksiEdit('menu/edit',enkrip($row['id_menu'])).'&nbsp;'.aksiHapus('menu/hapus',enkrip($row['id_menu'])).'</td>
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
      </div>
      <!-- end section-container -->

 




