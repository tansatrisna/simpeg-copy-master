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
                                    
                                    <th>ID/NIP</th>
                                    <th>Nama/ Tempat Tanggal Lahir</th>
                                    <th>Jenis/ Status</th>
                                    <th>Email/ Email Institusi</th>
                                    <th>Unit/ Jabatan Fungsional</th>
                                    <th>No. Sk/ TMT</th>
                                    <th>Masa Kerja</th>
                                    <th>Detail</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  foreach ($record as $row) {
                                    echo '<tr>
                                            <td>'.$row['idsdm'].'<br>'.$row['nip'].'</td>
                                            <td>'.viewSdm($row['idsdm']).'<br>'.$row['tempat_lahir'].', '.tgl_view($row['tgl_lahir']).'</td>
                                            <td>'.$row['jenis'].'<br>'.viewStatusSdm($row['status']).'</td>
                                            <td>'.$row['email'].'<br>'.$row['email_institusi'].'</td>
                                            <td>'.viewUnit($row['unit']).'<br>'.viewKodeApp('JABAKAD',$row['jabatan_fungsional']).'</td>
                                            <td>'.$row['no_sk'].'<br>'.tgl_view($row['mulai_masuk']).'</td>
                                            <td>'.masaKerja($row['mulai_masuk']).'</td>
                                            <td>'.aksiDetailBlank('master/sdmdetail',enkrip($row['idsdm']),'Detail').'</td>
                                           
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

