 <h1 class="page-header"><?=$header?> <small></small></h1>

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
                                    echo'<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i> Tambah</button>';
                                    } 
                                    ?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                              
                           
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered width-full">
                                 <thead>
                                  <tr>
                                    
                                     
                                      <th width="1%">No</th>
                                      <th>Jenis</th>
                                      <th>Nama Status</th>
                                      <th width="1%">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $no = 1;
                    foreach ($record as $row){
                    
                    echo '<tr><td>'.$no.'</td>
                              <td>'.$row['jenis'].'</td>
                              <td>'.$row['nama'].'</td>
                              <td class="with-btn" nowrap>';
                              if(bisaUbah($link,$id_level)==1)
                                {
                                  echo aksiModalEdit('#modalEdit',$row['id']);
                                }
                                echo'&nbsp;';
                                if(bisaHapus($link,$id_level)==1)
                                {
                                 echo aksiHapus('referensi/statussdmhapus',enkrip($row['id']));
                                }
                              echo '</td>
                             
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

                <div class="modal fade" id="modalTambah">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    
                                    <h4 class="modal-title">Form Tambah Status SDM </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <form class="form-horizontal" action="<?=base_url($link)?>" enctype="multipart/form-data" method="POST">
                                
                                <div class="modal-body">
                                 
                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Jenis SDM</label>
                                      <div class="col-sm-9">
                                      <select name="jenis" class="form-control" required="">
                                        <option value="">..::Pilih Jenis SDM</option>
                                        <?=opEnum('m_status_sdm','jenis')?>
                                      </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Nama Status SDM</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control" name="nama" value="" placeholder="" required>
                                      </div>
                                    </div>
                                    
                                    
                                                                    
                                  
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
                                </div>
                              </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>



<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header ">
              <h4 class="modal-title">Form Edit Status SDM</h4>
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
                url : '<?=base_url('referensi/statussdmedit')?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>