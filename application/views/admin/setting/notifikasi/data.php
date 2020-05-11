            <!-- begin page-header -->
      <h1 class="page-header"><?=$title?> <small></small></h1>
      <!-- end page-header -->
<!-- begin section-container -->
      <div class="section-container section-with-top-border p-b-5">
          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    <?php
                                    if(bisaTulis($link,$id_level)==1)
                                    {
                                       echo aksiModalTambah('#modalTambah','Tambah');
                                    }
                                    ?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                              
                           
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                                 
                                <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                    $no = 1;
                    foreach ($record as $row){
                      
                    echo '<tr><td>'.$no.'</td>
                             
                              <td>'.$row['nama'].'</td>
                              <td>'.$row['email'].'</td>
                              
                              <td width="1%" nowrap><center>';
                              if(bisaUbah($link,$id_level)==1)
                              {
                                echo aksiModalEdit('#modalEdit',$row['id'],'');
                              }
                              echo'&nbsp;';
                              if(bisaHapus($link,$id_level)==1)
                              {
                               echo aksiHapus('setting/notifikasihapus',enkrip($row['id']));
                              }
                              echo'</center></td>
                          </tr>';
                      $no++;
                    }
                  ?>
                    </tbody>
                                 
                                </table>
                            </div>
                             </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-8 -->
                </div>
                <!-- end row -->
      </div>
      <!-- end section-container -->


<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
              <h4 class="modal-title">Form Tambah Penerima Notifikasi Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" action="<?=base_url($link)?>" method="POST">
            <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="email" class="form-control"  required>
                  </div>
                </div><!-- row -->
                
                
                
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal">Tutup</a>
                <button type="submit" name="tambah" class="btn width-100 btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


 <div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
              <h4 class="modal-title">Form Edit Penerima Notifikasi Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" action="<?=base_url($link)?>" method="POST">
            
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn width-100 btn-danger" data-dismiss="modal">Tutup</a>
                <button type="submit" name="edit" class="btn width-100 btn-primary">Simpan</button>
            </div>
          </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        $('#modalEdit').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'POST',
                url : '<?=base_url('setting/notifikasiedit')?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>