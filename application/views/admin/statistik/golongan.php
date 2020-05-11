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
                        <?=aksiDetail('statistik/detail','golongan','Lihat Statistik Lengkap')?>
                    </div>
                    <h4 class="panel-title">Tabel Statistik <?=$title?> SDM</h4>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Golongan</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                            $tot=0;
                           $golongan=[];
                            foreach ($record as $row) {
                              $no++;
                              echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.viewKodeApp('GOLPNS',$row['pangkat_golongan']).'</td>
                                    <td>'.$row['jlh'].'</td>
                                  </tr>';
                              array_push($golongan, ["label"=>viewKodeApp('GOLPNS',$row['pangkat_golongan']), "jlh"=>$row['jlh']]);
                              $tot=$tot+$row['jlh'];
                            }
                            $warna=dataWarna($golongan,1); 
                             echo '<tr>
                                    <td colspan="2">Total</td>
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
                    <h4 class="panel-title">Grafik <?=$title?> Statistik SDM</h4>
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
    type: 'bar',
    data: {
        labels: [<?php echo labelGrafik($golongan,'label'); ?>],
        datasets: [{
            label: 'Jumlah SDM',
            data: [<?php echo dataGrafik($golongan,'jlh'); ?>],
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
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>