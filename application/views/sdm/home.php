<h1 class="page-header">Profil<small></small></h1>
<div class="row">
    <!-- begin col-8 -->
    <div class="col-lg-12">
      <?php
      $this->load->view('sdm/detail/'.$tab);
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
                url : '<?=base_url('sdm/sertifikat/'.$tab)?>',
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
                url : '<?=base_url('sdm/dokumen/'.$tab)?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>

