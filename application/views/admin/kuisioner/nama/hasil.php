      <!-- begin page-header -->
      <h1 class="page-header"><?=$title?> <small></small></h1>
      <!-- end page-header -->
      <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                  <?php
                                  echo aksiCetak('cetak/kuantitatif',$seo,'Cetak');
                                  echo aksiKembali('kuisioner/nama');
                                  ?>
                                </div>
                                <h4 class="panel-title">Filter</h4>
                            </div>
                            <div class="panel-body">
                             
                             <form class="form-inline m-b-15" action="<?=base_url('kuisioner/hasil/'.$seo)?>" method="post" accept-charset="utf-8">
                                <input type="hidden" name="cari">
                               <div class="form-group row">
                                <label class="control-label m-r-20 m-l-20">Target</label>
                                 <select name="jenis" class="form-control" onchange="submit()" <?php if($target!='SEMUA') echo 'disabled'; ?> >
                                   
                                   <?=opEnum('simpeg_kuisioner','target',$jenis)?>
                                 </select>

                                 <label class="control-label m-r-20 m-l-20">Unit</label>
                                 <select name="unit" class="form-control" onchange="submit()">
                                   <option value="">..::SEMUA::..</option>
                                   <?=opUnit($unit)?>
                                 </select>

                               </div>
                              </form>
                           
                            
                             </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-8 -->
                </div>
<!-- begin section-container -->
        <?php
        $huruf=A;
        foreach ($record as $row ) {
           $responden=$row['responden'];
           echo
        
          '<!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    
                                </div>
                                <h4 class="panel-title">'.$huruf.'. '.viewKategoriKuisioner($row['kategori']).'</h4>
                            </div>
                            <div class="panel-body">
                            <h2>Kuantitatif</h2>  
                           
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered width-full table-valign-middle">
                                 <thead class="text-center">
                                  <tr>
                                    <th width="1%" rowspan="2">No</th>
                                    <th rowspan="2">Pertanyaan</th>
                                    <th rowspan="2">Responden</th>
                                    <th colspan="5">Skor</th>
                                    <th rowspan="2">Rata2</th>
                                    <th rowspan="2">Aksi</th>
                                  </tr>
                                  <tr>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                  </tr>
                                </thead>
                                <tbody>';
                                
                                $hasil =$this->model_app->view_hasil_kategori($kuisioner,$row['kategori'],$jenis,$unit);
                                  
                                  $no=0;
                                  $h1=0; 
                                  $h2=0;
                                  $h3=0;
                                  $h4=0;
                                  $h5=0; 
                                  $p1=0; 
                                  $p2=0;
                                  $p3=0;
                                  $p4=0;
                                  $p5=0;                              
                                  foreach ($hasil as $key) {
                                    $no++;
                                    $hk1=viewSkorHasil($kuisioner,$key['id_soal'],'1',$jenis,$unit);
                                    $hk2=viewSkorHasil($kuisioner,$key['id_soal'],'2',$jenis,$unit);
                                    $hk3=viewSkorHasil($kuisioner,$key['id_soal'],'3',$jenis,$unit);
                                    $hk4=viewSkorHasil($kuisioner,$key['id_soal'],'4',$jenis,$unit);
                                    $hk5=viewSkorHasil($kuisioner,$key['id_soal'],'5',$jenis,$unit);

                                   
                                    
                                    $pk1=$hk1;
                                    $pk2=$hk2*2;
                                    $pk3=$hk3*3;
                                    $pk4=$hk4*4;
                                    $pk5=$hk5*5;
                                                                        
                                    $rata2=$key['jlh']/$responden;
                                    echo '<tr>
                                          <td>'.$no.'</td>
                                          <td>'.viewKuisionerSoal($key['id_soal']).'</td>
                                          <td>'.$responden.'</td>
                                          <td>'.$hk1.' ('.$pk1.')</td>
                                          <td>'.$hk2.' ('.$pk2.')</td>
                                          <td>'.$hk3.' ('.$pk3.')</td>
                                          <td>'.$hk4.' ('.$pk4.')</td>
                                          <td>'.$hk5.' ('.$pk5.')</td>
                                          <td>'.angka($rata2).'</td>
                                           <td>'.aksiDetail('kuisioner/grafiksoal/'.$seo.'/'.enkrip($row['kategori']).'/'.enkrip($key['id_soal']),enkrip($responden),'Lihat Grafik').'</td>
                                          </tr>';

                                    $h1=$h1+$hk1;
                                    $h2=$h2+$hk2;
                                    $h3=$h3+$hk3;
                                    $h4=$h4+$hk4;
                                    $h5=$h5+$hk5;

                                    $p1=$p1+$pk1;
                                    $p2=$p2+$pk2;
                                    $p3=$p3+$pk3;
                                    $p4=$p4+$pk4;
                                    $p5=$p5+$pk5;

                                         
                                  } 
                                 
                                    $h1=$h1/$no;
                                    $p1=$p1/$no;
                                    $h2=$h2/$no;
                                    $p2=$p2/$no;
                                    $h3=$h3/$no;
                                    $p3=$p3/$no;
                                    $h4=$h4/$no;
                                    $p4=$p4/$no;
                                    $h5=$h5/$no;
                                    $p5=$p5/$no;
                                    
                               
                                    $rata=($p1+$p2+$p3+$p4+$p5)/$responden;
                                  
                              echo'  </tbody>
                                    <tfoot>
                                        <tr>
                                          <td></td>
                                          <td>Hasil Gabungan</td>
                                          <td>'.$responden.'</td>
                                          <td>'.$h1.' ('.$p1.')</td>
                                          <td>'.$h2.' ('.$p2.')</td>
                                          <td>'.$h3.' ('.$p3.')</td>
                                          <td>'.$h4.' ('.$p4.')</td>
                                          <td>'.$h5.' ('.$p5.')</td>
                                          <td>'.angka($rata).'</td>
                                          <td>'.aksiDetail('kuisioner/grafikkategori/'.$seo.'/'.enkrip($row['kategori']),enkrip($responden),'Lihat Grafik').'</td>
                                          
                              </tfoot>
                                      
                                </table>
                            </div>
                            <h2>Kualitatif</h2>';
                            $kualitatif=$this->model_app->view_where_ordering('simpeg_kuisioner_tes',array('kuisioner'=>$kuisioner,'kategori'=>$row['kategori'],'jenis'=>'Kualitatif'),'soal','ASC');

                            echo'<div class="table-responsive">
                            <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th width="1%" nowrap>No</th>
                                  <th>Pertanyaan</th>
                                  <th width="1%" nowrap>Responden</th>
                                  <th width="1%" nowrap>Lihat Hasil</th>
                                </tr>
                              </thead>
                              <tbody>';
                              if(count($kualitatif)==0)
                              {
                               echo'<tr class="text-center">
                                  <td colspan="4">Tidak Ada Pertanyaan Kualitatif</td>
                                </tr>'; 
                              }
                              else
                              {
                                $nop=0;
                                foreach ($kualitatif as $baris) {
                                  $nop++;
                                  echo '<tr>
                                      <td>'.$nop.'</td>
                                      <td>'.viewKuisionerSoal($baris['soal']).'</td>
                                      <td>'.$responden.'</td>
                                      <td>'.aksiDetailBlank('kuisioner/hasilkualitatif/'.enkrip($baris['id']).'/'.enkrip($jenis),enkrip($unit),'Lihat hasil').'</td>
                                      </tr>'; 
                                }
                              }
                              echo'</tbody>
                            </table>
                              
                            </div>';

                             echo'</div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-8 -->
                </div>
                <!-- end row -->';
              $huruf++;
              }
      ?>