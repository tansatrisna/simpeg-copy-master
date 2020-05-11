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
                                  echo aksiCetak('cetak','sdm','Cetak');
                                  if(bisaTulis($link,$id_level))
                                  {
                                    echo aksiTambah('master/sdmtambah');
                                  }
                                  ?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                             
                             <form class="form-inline m-b-15" action="<?=base_url($link)?>" method="post" accept-charset="utf-8">
                                <input type="hidden" name="cari">
                               <div class="form-group row">
                                 <label class="control-label m-r-20 m-l-20">Unit</label>
                                 <select name="unit" class="form-control" onchange="submit()">
                                   <option value="">..::Semua Unit::..</option>
                                   <?=opUnit($unit)?>
                                 </select>

                                 <label class="control-label m-r-20 m-l-20">Jenis SDM</label>
                                 <select name="jenis" class="form-control" onchange="submit()">
                                   <option value="">..::Semua SDM::..</option>
                                   <?=opEnum('m_sdm','jenis',$jenis)?>
                                 </select>

                                 <label class="control-label m-r-20 m-l-20">Status Aktif</label>
                                 <select name="aktif" class="form-control" onchange="submit()">
                                   
                                   <?=opKodeApp('STSPEGAWAI',$aktif)?>
                                 </select>

                                  
                               </div>
                              </form>
                           
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
                                    <th>Detail/ Status Aktif</th>
                                    <th width="1%">Aksi</th>
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
                                            <td>'.aksiDetail('master/sdmdetail',enkrip($row['idsdm']),'Detail').'<br>'.viewKodeApp('STSPEGAWAI',$row['status_aktif']).'</td>
                                            <td nowrap>';
                                            if(bisaUbah($link,$id_level))
                                            {
                                              echo aksiEdit('master/sdmedit',enkrip($row['idsdm']));
                                            }

                                            if(bisaUbah($link,$id_level))
                                            {
                                              echo '&nbsp;';
                                              echo aksiHapus('master/sdmedit',enkrip($row['idsdm']));
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



<!-- <script type="text/javascript">
    var table;
    $(document).ready(function() {
 
        //datatables
        table = $('#server-side').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
             
            "ajax": {
                "url": "<?php echo base_url('master/get_data_sdm')?>",
                "type": "POST"
            },
 
             
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],
 
        });
 
    });
 
</script> -->