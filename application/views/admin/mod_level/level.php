<!-- begin breadcrumb -->
      <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url()?>home">Home</a></li>
        <li class="active">Level</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Level <small></small></h1>
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
                                    <a href="<?=base_url()?>level/tambah" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                                </div>
                                <h4 class="panel-title">Level</h4>
                            </div>
                            <div class="panel-body">
                              
                            
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                 
                                 <thead>
                      <tr>
                        <th>No</th>
                        <th>Level</th>
                        
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
                              <td>'.$row['nama_level'].'</td>
                              
                              <td>'.aksiEdit('level/edit',enkrip($row['id_level'])).' &nbsp; '.aksiHapus('level/hapus',enkrip($row['id_level'])).'</td>
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