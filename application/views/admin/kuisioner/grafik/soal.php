     <h1 class="page-header">Kuisoner <small></small></h1>
    
    <div class="row">
    	
        <div class="col-md-12">
        <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                       <?=aksiKembali('kuisioner/hasil/'.$seo)?> 
                    </div>
                    <h4 class="panel-title">Grafik Hasil Kuisioner Kuantitatif</h4>
                </div>
                <div class="panel-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th width="1%" nowrap>Kuisioner</th><th width="1%" nowrap>:</th><th><?=viewKuisioner($kuisioner)?></th>
                    </tr>
                    <tr>
                      <th>Kategori</th><th>:</th><th><?=viewKategoriKuisioner($kategori)?></th>
                    </tr>
                    
                    <tr>
                      <th>Target</th><th>:</th><th><?=$jenis?></th>
                    </tr>
                    <tr>
                      <th>Unit</th><th>:</th><th><?php 
                        if($unit=='') 
                          echo 'Semua';
                        else 
                          echo viewUnit($unit); 
                        ?></th>
                    </tr>
                  </thead>
                </table>
                <table class="table table-striped table-bordered width-full table-valign-middle text-center">
                   <thead >
                    <tr>
                      <th rowspan="2">Pertanyaan</th>
                      <th rowspan="2">Responden</th>
                      <th colspan="5">Skor</th>
                      <th rowspan="2">Rata2</th>
                      
                    </tr>
                    <tr>
                      <th>1</th>
                      <th>2</th>
                      <th>3</th>
                      <th>4</th>
                      <th>5</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left"><?=strip_tags(viewKuisionerSoal($soal))?></td>
                      
                    <?php
                    $total=0;
                    echo'<td>'.$responden.'</td>';
                      $hasil=array();
                      foreach ($record as $row) {
                        $skor=viewSkorHasil($kuisioner,$soal,$row,$jenis,$unit);
                        $jlh=$skor*$row;
                        echo '<td>'.$skor.'</td>';
                        array_push($hasil, ["label"=>'Skor '.$row, "jlh"=>$skor]);
                        $total=$total+$jlh;
                      }
                      $rata=$total/$responden;
                      $warna=satuWarna($hasil,1);
                      echo '<td>'.$rata.'</td>';
                      ?>
                     
                    </tr>
                  </tbody>
                </table>
                <canvas id="myChart" height="100"></canvas>
               
                 </div>
            </div>
        </div>
    </div>



<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo labelGrafik($hasil,'label'); ?>],
        datasets: [{
            label: 'Jumlah Responden',
            data: [<?php echo dataGrafik($hasil,'jlh'); ?>],
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
    },
    scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
});
</script>