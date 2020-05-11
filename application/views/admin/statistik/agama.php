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
                                  
                               </div>
                              </form>
               
                 </div>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
    		<div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <?=aksiDetail('statistik/detail','agama','Lihat Statistik Lengkap')?>
                    </div>
                    <h4 class="panel-title">Tabel Statistik <?=$title?> SDM</h4>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Agama</th>
                          <th>Laki-Laki</th>
                          <th>Perempuan</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                           $jk=[];
                           $tlk=0;
                           $tpr=0;
                           $tot=0;
                            foreach ($record as $row) {
                              $no++;
                              $lk=viewJkAgama('L',$row['agama'],$jenis,$unit);
                              $pr=viewJkAgama('P',$row['agama'],$jenis,$unit);
                              echo '<tr>
                                    <td>'.$no.'</td>
                                   
                                    <td>'.viewKodeApp('AGAMA',$row['agama']).'</td>
                                     <td>'.$lk.'</td>
                                    <td>'.$pr.'</td>
                                    <td>'.$row['jlh'].'</td>
                                  </tr>';
                              array_push($jk, ["label"=>viewKodeApp('AGAMA',$row['agama']), "jlh"=>$row['jlh']]);
                              $tlk=$tlk+$lk;
                              $tpr=$tpr+$pr;
                              $tot=$tot+$row['jlh'];
                            }
                            $warna=dataWarna($jk,1); 
                             echo '<tr>
                                    <td colspan="2">Total</td>
                                    <td>'.$tlk.'</td>
                                    <td>'.$tpr.'</td>
                                    <td>'.$tot.'</td>
                                    </tr>';
                            ?>
                        
                      </tbody>
                    </table>
                  </div>
                 </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        
                    </div>
                    <h4 class="panel-title">Grafik Statistik <?=$title?> SDM</h4>
                </div>
                <div class="panel-body">
                  
                <canvas id="myChart" ></canvas>
               
                 </div>
            </div>
        </div>
    </div>

<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [<?php echo labelGrafik($jk,'label'); ?>],
        datasets: [{
            label: 'Jumlah SDM',
            data: [<?php echo dataGrafik($jk,'jlh'); ?>],
            backgroundColor: [<?php echo $warna; ?>],
            borderColor: [<?php echo $warna; ?>],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: true,
            labels: {
                fontColor: 'rgb(255, 99, 132)'
            }
        }
    }
});
</script>