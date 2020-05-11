    <h1 class="page-header"><?=$title?> <small></small></h1>
    
    <div class="row">
      <div class="col-md-12">
        <div class="result-container">
                  <!-- begin input-group -->
                    
            <form class="form-horizontal" action="<?=base_url('dashboard')?>" method="post" accept-charset="utf-8">
                <div class="input-group input-group-lg m-b-20">
                  
                
                    <input type="text" name="cari" class="form-control input-white" value="<?=$cari?>" placeholder="Ketik Disini Untuk Mencari Data Pegawai Atau Dosen..." pattern=".{3,}"   required title="Minimal 3 Karakter"/>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Cari</button>
                        
                        
                    </div>
                </div>
            </form>    

        </div>
      </div>
    </div>
    <?php
    if($cari !='')
    {
    echo'<div class="row">
          <div class="col-md-12">
            <div class="panel panel-inverse">
                            <div class="panel-heading">
                                
                                <h4 class="panel-title">Hasil Pencarian</h4>
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
                                <tbody>';
                                  
                                  foreach ($hasil as $baris) {
                                    echo '<tr>
                                            <td>'.$baris['idsdm'].'<br>'.$baris['nip'].'</td>
                                            <td>'.viewSdm($baris['idsdm']).'<br>'.$baris['tempat_lahir'].', '.tgl_view($baris['tgl_lahir']).'</td>
                                            <td>'.$baris['jenis'].'<br>'.viewStatusSdm($baris['status']).'</td>
                                            <td>'.$baris['email'].'<br>'.$baris['email_institusi'].'</td>
                                            <td>'.viewUnit($baris['unit']).'<br>'.viewKodeApp('JABAKAD',$baris['jabatan_fungsional']).'</td>
                                            <td>'.$baris['no_sk'].'<br>'.tgl_view($baris['mulai_masuk']).'</td>
                                            <td>'.masaKerja($baris['mulai_masuk']).'</td>
                                            <td>'.aksiDetailBlank('master/sdmdetail',enkrip($baris['idsdm']),'Detail').'</td>
                                           
                                          </tr>';
                                  }
                                  
                                  
                               echo' </tbody>
                                 
                                </table>
                            </div>
                             </div>
                        </div>
          </div>
        </div>';
    }
    ?>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      
                    </div>
                    <h4 class="panel-title">Statistik Data Dosen dan Pegawai</h4>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead class="text-center">
                          <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Unit</th>
                            <th colspan="2">Dosen</th>
                            <th colspan="2">Pegawai</th>
                            <th colspan="3">Jumlah</th>
                          </tr>
                          <tr>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L</th>
                            <th>P</th>
                            <th>L + P</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                              <?php
                              $grafik=array();
                              $ttl=0;
                              $ttp=0;
                              $tdl=0;
                              $tdp=0;
                              $tpl=0;
                              $tpp=0;
                              foreach ($record as $row) {
                                $no++;
                                $dl=jlhJkUnit($row['id'],'DOSEN','L');
                                $dp=jlhJkUnit($row['id'],'DOSEN','P');
                                $pl=jlhJkUnit($row['id'],'PEGAWAI','L');
                                $pp=jlhJkUnit($row['id'],'PEGAWAI','P');
                                $tl=$dl+$pl;
                                $tp=$dp+$pp;
                                $ts=$tl+$tp;
                                echo '<tr >
                                      <td>'.$no.'</td>
                                      <td class="text-left">'.$row['nama'].'</td>
                                      <td>'.$dl.'</td>
                                      <td>'.$dp.'</td>
                                      <td>'.$pl.'</td>
                                      <td>'.$pp.'</td>
                                      <td>'.$tl.'</td>
                                      <td>'.$tp.'</td>
                                      <td>'.$ts.'</td>
                                    </tr>';
                                $tdl=$tdl+$dl;
                                $tdp=$tdp+$dp;
                                $tpl=$tpl+$pl;
                                $tpp=$tpp+$pp;
                                $ttl=$ttl+$tl;
                                $ttp=$ttp+$tp;
                                array_push($grafik,["label"=>viewUnit($row['id']), "laki"=>$ttl, "perempuan"=>$ttp]);
                                }
                              $tts=$ttl+$ttp;
                              $laki=satuWarna($grafik,1);
                              $perempuan=satuWarna($grafik,1);
                              ?>
                          
                        </tbody>
                        <tfoot class="text-center">
                          <?php
                          echo '<tr>
                                      <td colspan="2">Jumlah</td>
                                      <td>'.$tdl.'</td>
                                      <td>'.$tdp.'</td>
                                      <td>'.$tpl.'</td>
                                      <td>'.$tpp.'</td>
                                      <td>'.$ttl.'</td>
                                      <td>'.$ttp.'</td>
                                      <td>'.$tts.'</td>
                                    </tr>';
                          ?>
                        </tfoot>
                      </table>
                    </div>
          
            


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
                    <h4 class="panel-title">Grafik Data Dosen dan Pegawai</h4>
                </div>
                <div class="panel-body">
                  <canvas id="myChart" ></canvas>
                </div>
            </div>
        </div>
       
    </div>

    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      
                    </div>
                    <h4 class="panel-title">Penerimaan Dosen dan Pegawai 10 Tahun Terakhir</h4>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead class="text-center">
                         
                          <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Dosen</th>
                            <th>Pegawai</th>
                            <th>Jumlah</th>
                          </tr>
                        </thead>
                        <tbody class="text-center">
                              <?php
                              $statistik=array();
                              $sekarang=date('Y');
                              $terakhir=$sekarang-10;
                              $tdsn=0;
                              $tpgw=0;
                              $no=0;
                              for ($i=$sekarang; $i > $terakhir ; $i--) { 
                                $no++;
                                $dsn=jlhPenerimaanSdm($i,'DOSEN');
                                $pgw=jlhPenerimaanSdm($i,'PEGAWAI');
                                $sdm=$dsn+$pgw;
                                echo'<tr>
                                      <td>'.$no.'</td>
                                      <td>'.$i.'</td>
                                      <td>'.$dsn.'</td>
                                      <td>'.$pgw.'</td>
                                      <td>'.$sdm.'</td>
                                </tr>';
                                $tdsn=$tdsn+$dsn;
                                $tpgw=$tpgw+$pgw;
                                $tsdm=$tdsn+$tpgw;
                                array_push($statistik, ["label"=>$i, "dosen"=>$dsn, "pegawai"=>$pgw]);
                              }
                              $dosen=satuWarna($statistik,1);
                              $pegawai=satuWarna($statistik,1);
                              ?>
                          
                        </tbody>
                        <tfoot class="text-center">
                          <?php
                          echo '<tr>
                                      <td colspan="2">Jumlah</td>
                                      <td>'.$tdsn.'</td>
                                      <td>'.$tpgw.'</td>
                                      <td>'.$tsdm.'</td>
                                    </tr>';
                          ?>
                        </tfoot>
                      </table>
                    </div>
          
            


                 </div>
            </div>
        </div>
        <div class="col-md-7">
        <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      
                    </div>
                    <h4 class="panel-title">Grafik Penerimaan Dosen dan Pegawai</h4>
                </div>
                <div class="panel-body">
                  <canvas id="myGrafik" height="250"></canvas>
                </div>
            </div>
        </div>
       
    </div>

<script>
var ctx = document.getElementById("myChart");
var cty = document.getElementById("myGrafik");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo labelGrafik($grafik,'label'); ?>],
        datasets: [{
            label: 'Laki-Laki',
            data: [<?php echo dataGrafik($grafik,'laki'); ?>],
            backgroundColor: [<?php echo $laki; ?>],
            borderColor: [<?php echo $laki; ?>],
            borderWidth: 1
        },
        {
            label: 'Perempuan',
            data: [<?php echo dataGrafik($grafik,'perempuan'); ?>],
            backgroundColor: [<?php echo $perempuan; ?>],
            borderColor: [<?php echo $perempuan; ?>],
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
        responsive: true,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
    }
});

var myGrafik = new Chart(cty, {
    type: 'bar',
    data: {
        labels: [<?php echo labelGrafik($statistik,'label'); ?>],
        datasets: [{
            label: 'Dosen',
            data: [<?php echo dataGrafik($statistik,'dosen'); ?>],
            backgroundColor: [<?php echo $dosen; ?>],
            borderColor: [<?php echo $dosen; ?>],
            borderWidth: 1
        },
        {
            label: 'Pegawai',
            data: [<?php echo dataGrafik($statistik,'pegawai'); ?>],
            backgroundColor: [<?php echo $pegawai; ?>],
            borderColor: [<?php echo $pegawai; ?>],
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
        responsive: true,
        scales: {
          xAxes: [{
            stacked: true,
          }],
          yAxes: [{
            stacked: true
          }]
        }
    }
});
</script>