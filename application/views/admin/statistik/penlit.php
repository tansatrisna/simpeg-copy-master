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
                                 <label class="control-label m-r-20 m-l-20">Tahun</label>
                                 <select name="tahun" class="form-control" onchange="submit()">
                                   <?=opTahun($tahun)?>
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
                    <h4 class="panel-title">Tabel <?=$title?> SDM</h4>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama/Unit</th>
                          <th>Judul Penelitian</th>
                          <th>Tahun</th>
                          <th>Sumber Dana</th>
                          <th>Biaya</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $no=0;
                             foreach ($record as $row) {
                              $no++;
                              $idsdm=$row['idsdm'];
                              $rowspan=$row['jlh']+1;
                                 echo'<tr>
                                 <td rowspan="'.$rowspan.'">'.$no.'</td>
                                 <td colspan="5">'.viewSdm($row['idsdm']).' ('.viewUnit($row['unit']).')</td></tr>';
                                 $sql=$this->model_app->view_where_ordering('simpeg_penelitian',array('idsdm'=>$idsdm),'tahun','ASC');
                                 echo'</tr>';
                                 foreach ($sql as $baris) {
                                   echo'<tr><td>'.$baris['tahun'].'</td><td>'.$baris['judul_penelitian'].'</td><td>'.viewKodeApp('PERANPENELITIAN',$baris['peran_penelitian']).'</td><td>'.viewKodeApp('DANAPENLIT',$baris['sumber_dana']).'</td><td class="text-right">'.rupiah($baris['biaya_penelitian']).'</td></tr>';
                                 }

                                
                             }
                             
                  ?>
                        
                      </tbody>
                    </table>
                  </div>
                 </div>
            </div>
        </div>
    </div>

