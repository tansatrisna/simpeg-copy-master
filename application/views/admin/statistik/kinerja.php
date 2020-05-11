
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
                                <label class="control-label m-r-20 m-l-20">NIP/NIDN</label>
                                 <input type="text" name="jenis" placeholder="NIP/NIDN"  class="form-control" onchange="submit()" value="<?php if (isset($_POST['jenis'])) echo $_POST['jenis']; ?>">
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
    <h5>
    <?php print_r($record['identitas'][0]['nama']); ?>
    </h5>
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
                          <th>Kinerja</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Penelitian</td>
                          <td><?php echo $record['penelitian']; ?></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Publikasi</td>
                          <td><?php echo $record['publikasi']; ?></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Pengabdian</td>
                          <td><?php echo $record['pengabdian']; ?></td>
                        </tr>
                        <?php
                        $jk = [];
                        array_push($jk, ["label"=>'publikasi', "jlh"=>$record['publikasi']]);
                        array_push($jk, ["label"=>'penelitian', "jlh"=>$record['penelitian']]);
                        array_push($jk, ["label"=>'pengabdian', "jlh"=>$record['pengabdian']]);

                        $warna=dataWarna($jk,1);
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
        labels: [<?php echo labelGrafik($jk,'label'); ?>],
        datasets: [{
            label: 'Jumlah',
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