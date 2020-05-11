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
          <ul class="profile-header-tab nav nav-tabs">
            <?php
            foreach ($tabs as $key => $value) {
              $cl = ($key == $tab) ? 'active' : '';
            echo '<li class="nav-item"><a href="'.base_url('master/sdmdetail/'.$seo.'/'.$key).'" class="nav-link '.$cl.'" >'.$value.'</a></li>';
                                    
            }
            // echo '<li class="nav-item"><a href="'.base_url($link).'" class="nav-link" >Kembali</a></li>';
            // echo '<li class="nav-item"><a title="Cetak Data" href="'.base_url('cetak/buktidaftar/'.$rows['nisn'].'/'.$rows['id_pendaftaran']).'" class="nav-link" onclick="window.open(this.href, \'popupwindow\',\'width=800,height=600,left=200, top=50, scrollbars=yes,resizable=yes\'); return false;">Cetak</a></li>';
            ?>
            
            
          </ul>
          <!-- END profile-header-tab -->
        </div>
      </div>
<div class="row">
    <!-- begin col-8 -->
    <div class="col-lg-12">
      <?php
      $this->load->view('admin/master/sdm/detail/'.$tab);
      ?> 
    </div>
    
</div>

<div class="modal fade" id="modalSertifikat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header ">
              <h4 class="modal-title">Lihat Sertifikat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            
            
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal">Tutup</a>
               
            </div>
          
        </div>
    </div>
</div>

<div class="modal fade" id="modalDokumen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header ">
              <h4 class="modal-title">Lihat Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            
            
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal">Tutup</a>
               
            </div>
          
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $('#modalSertifikat').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'POST',
                url : '<?=base_url('master/sertifikat/'.$tab)?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });

        $('#modalDokumen').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'POST',
                url : '<?=base_url('master/dokumen/'.$tab)?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>

