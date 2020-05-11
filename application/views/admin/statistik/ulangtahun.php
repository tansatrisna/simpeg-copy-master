    <h1 class="page-header"><?=$header?> <small></small></h1>
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        
                    </div>
                    <h4 class="panel-title">Filter</h4>
                </div>
                <div class="panel-body">
                  
                <form class="form-inline m-b-15" action="<?=base_url($link)?>" method="post" accept-charset="utf-8">
                                <input type="hidden" name="cari">
                               <div class="form-group row">
                                <label class="control-label m-r-20 m-l-20">Tanggal</label>
                                 <input type="date" name="tanggal" value="<?=$tanggal?>" class="form-control" placeholder="" onchange="submit()" >
                                <label class="control-label m-r-20 m-l-20">Jenis SDM</label>
                                 <select name="jenis" class="form-control" onchange="submit()">
                                   <option value="">..::Semua SDM::..</option>
                                   <?=opEnum('m_sdm','jenis',$jenis)?>
                                 </select>
                                 <label class="control-label m-r-20 m-l-20">Unit</label>
                                 <select name="unit" class="form-control" onchange="submit()">
                                   <option value="">..::Semua Unit::..</option>
                                   <?=opUnit($unit)?>
                                 </select>
                                  
                               </div>
                              </form>
               
                 </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        
                    </div>
                    <h4 class="panel-title">Data Ulang Tahun</h4>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Ulang Tahun Ke</th>
                          <th>Unit</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                          
                            foreach ($record as $row) {
                              $no++;
                              echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.viewSdm($row['idsdm']).'</td>
                                    <td>'.viewKodeApp('STRUKTURAL',$row['jabatan_struktural']).'</td>
                                    <td>'.ultah($row['tgl_lahir'],$tanggal).'</td>
                                    <td>'.viewUnit($row['unit']).'</td>
                                  </tr>';
                              
                            }
                           
                             
                            ?>
                        
                      </tbody>
                    </table>
                  </div>
                 </div>
            </div>
        </div>
       
    </div>

