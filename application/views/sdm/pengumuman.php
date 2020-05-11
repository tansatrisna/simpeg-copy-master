<!-- begin page-header -->

<div class="profile">
        <div class="profile-header">
          <!-- BEGIN profile-header-cover -->
          <div class="profile-header-cover"></div>
          <!-- END profile-header-cover -->
          <!-- BEGIN profile-header-content -->
          <div class="profile-header-content">
            <!-- BEGIN profile-header-img -->
            <div class="profile-header-img">
              <?php
              if($rows['foto']=='')
              {
                echo '<img src="'.base_url('assets/img/sdm/no-foto.jpg').'" alt="" width="120px" height="150px">';
              }
              else
              {
                echo '<img src="'.base_url('assets/img/sdm/'.$rows['foto']).'" alt="" width="120px" height="150px">';
              }
              ?>
              
            </div>
            <!-- END profile-header-img -->
            <!-- BEGIN profile-header-info -->
            <div class="profile-header-info">
              <h4 class="m-t-10 m-b-5"><?=viewSdm($rows['idsdm'])?></h4>
              <h4 class="m-t-10 m-b-5"><?=$rows['jenis']?></h4>
              <h4 class="m-t-10 m-b-5"><?=$rows['email']?></h4>
              <h4 class="m-t-10 m-b-5"><?=viewUnit($rows['unit'])?></h4>
              </div>
            <!-- END profile-header-info -->
          </div>
          <!-- END profile-header-content -->
          <!-- BEGIN profile-header-tab -->
          
          <!-- END profile-header-tab -->
        </div>
      </div>
<!-- end page-header -->
<br>
<h1 class="page-header">Pengumuman <small>(<?=$total?> Hasil Ditemukan)</small></h1>
<!-- begin section-container -->
     <div class="row">
          <!-- begin col-12 -->
          <div class="col-md-9">
            <!-- begin result-container -->
              <div class="result-container">
                <!-- begin input-group -->
                  
                    <form class="form-horizontal" action="<?=base_url('sdm/pengumuman')?>" method="post" accept-charset="utf-8">
                        <div class="input-group input-group-lg m-b-20">
                          
                        
                            <input type="text" name="cari" class="form-control input-white" value="<?=$cari?>" placeholder="Ketik Disini Untuk Mencari Informasi..." />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Cari</button>
                                
                                
                            </div>
                        </div>
                    </form>    
                        
                        <!-- begin result-list -->
                        <ul class="result-list">
                        <?php
                        foreach ($record as $row) {
                          $isi_berita =(strip_tags($row['isi'])); 
                          $isi = substr($isi_berita,0,300); 
                          $isi = substr($isi_berita,0,strrpos($isi," "));
                            echo'<li>
                               
                                <div class="result-info">
                                    <h4 class="title"><a href="'.base_url('sdm/pengumumandetail/'.enkrip($row['id'])).'">'.$row['judul'].'</a></h4>
                                    
                                    <p class="desc">
                                        '.$isi.'
                                    </p>
                                    <div class="btn-row">
                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Ditulis Oleh : '.viewUser($row['user']).'"><i class="fa fa-fw fa-user"></i> '.viewUser($row['user']).'</a>
                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Di Tulis Pada Tanggal '.tgl_waktu_full($row['created_at']).'"><i class="fa fa-fw fa-time"></i> '.tgl_waktu_full($row['created_at']).'</a>
                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="dibaca '.$row['dibaca'].' Kali"><i class="fa fa-fw fa-eye"></i> '.$row['dibaca'].'</a>
                                        
                                        <a href="javascript:;" data-toggle="tooltip" data-container="body" data-title="Target: '.$row['target'].'"><i class="fa fa-fw fa-users"></i> '.$row['target'].'</a>
                                        <a  href="'.base_url('sdm/pengumumandetail/'.enkrip($row['id'])).'"  data-toggle="tooltip" data-container="body" data-title="Selengkapnya">Selengkapnya...</a>
                                        
                                    </div>
                                </div>
                                
                            </li>';
                          }
                            ?>
                            
                        </ul>
                        <!-- end result-list -->
                        <!-- begin pagination -->
                        <div class="clearfix m-t-20">
              <ul class="pagination pull-right">
                <?php echo $this->pagination->create_links(); ?>
              </ul>
                        </div>
                        <!-- end pagination -->
                    </div>
                    <!-- end result-container -->
          </div>
          <!-- end col-12 -->
          <div class="col-md-3">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    
                    <h4 class="panel-title">Link Terkait</h4>
                </div>
                <div class="panel-body">
                  <?php
                  foreach ($tautan as $key) {
                    echo '<a href="'.$key['url'].'" class="btn btn-block btn-success btn-sm" target="_blank">'.$key['nama'].'</a>';
                  }
                  ?>
                </div>
            </div>
          </div>
      </div>

         

