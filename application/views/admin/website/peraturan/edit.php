
      <!-- begin page-header -->
      <h1 class="page-header"><?=$title?> <small></small></h1>
      <!-- end page-header -->

      
          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                
                                <h4 class="panel-title">Form Edit <?=$title?></h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal"  action="<?=base_url()?>website/peraturanedit" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?=$rows['id']?>">
             
              
                                
               
              <!-- /.form-group row -->
              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Judul</b></label>
                  <div class="col-sm-10">
                    <input type="text" name="judul" class="form-control" value="<?=$rows['judul']?>" placeholder="Judul" required>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Berkas</b></label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="berkas" value="" placeholder="">
                    <small>Kosongkan jika tidak mengganti</small>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Berkas Sebelumnya</b></label>
                  <div class="col-sm-10">
                    <?=aksiModalLihat('#modalLihat',$rows['id'],'Lihat')?>
                  </div>
              </div>

               <!-- /.form-group row -->

              
              <div class="form-group row">
                <label class="col-sm-2 control-label ">&nbsp;</label>
                <div class="col-sm-10">
                  
                  <button type="submit" name="edit" class="btn btn-success">Simpan</button>
                  <a href="<?=base_url($link)?>" class="btn btn-danger">Cancel</a>
                </div>
              </div><!-- row -->
                      
            </form>
          </div>
            
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-8 -->
</div>
<!-- end row -->
  
<div class="modal fade" id="modalLihat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header ">
              <h4 class="modal-title">File Peraturan</h4>
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
        $('#modalLihat').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'POST',
                url : '<?=base_url('website/peraturanlihat')?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>