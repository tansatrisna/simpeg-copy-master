<!-- begin breadcrumb -->
      <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?=base_url()?>home">Home</a></li>
        <li class="breadcrumb-item active">Modul</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Modul <small></small></h1>
      <!-- end page-header -->
     

          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    <a href="<?=base_url()?>modul/tambah" class="btn btn-info btn-xs"><i class="fa fa-plus"></i> Tambah</a>
                                </div>
                                <h4 class="panel-title">Modul</h4>
                            </div>
                            <div class="table-responsive">
                                <table  class="table table-striped table-bordered width-full m-0">
                                  <thead>
                                    <tr>
                                      <th width="1%">No</th>
                                      <th>Nama Modul</th>
                                      <th>Controller</th>
                                      <th>Urutan</th>
                                      
                                      <th width="1%">Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $no=0;
                                      foreach ($record as $row) {
                                      $no++;
                                      echo'<tr>
                                        <td>'.$no.'</td>
                                        <td>'.$row['nama_modul'].'</td>
                                        <td>'.$row['controller'].'</td>
                                        <td>'.$row['urutan'].'</td>
                                        <td class="with-btn" nowrap>'.aksiEdit('modul/edit',enkrip($row['id_modul'])).'&nbsp;'.aksiHapus('modul/hapus',enkrip($row['id_modul'])).'</td>
                                      </tr>';

                                  
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
    

 


