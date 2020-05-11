<!-- begin page-header -->
      <h1 class="page-header">Daftar Link Terkait <small></small></h1>
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
                                  if(bisaTulis($link,$id_level))
                                  {
                                    echo'<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i> Tambah</a>';
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
                                      <th>Nama </th>
                                      <th>Url</th>
                                      <th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $no=0;
                                      foreach ($record as $row) {
                                      $no++;
                                      echo'<tr>
                                        <td>'.$no.'</td>
                                        <td>'.$row['nama'].'</td>
                                        <td>'.$row['url'].'</td>
                                        <td>';
                                        if(bisaUbah($link,$id_level)==1)
                                              {
                                                echo '<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalEdit" data-id="'.$row['id'].'"><i class="fa fa-edit"></i></a>';
                                               
                                              }
                                              echo '&nbsp;';    
                                              if(bisaHapus($link,$id_level)==1)
                                              {
                                                echo aksiHapus('website/hapustautan',enkrip($row['id']));
                                              }
                                              echo'</td>
                                      </tr>';

                                        
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
                <h4 class="modal-title">Form Tambah Link Terkait</h4>
                <button type="button" class="close full-right" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <form class="form-horizontal" action="<?=base_url('website/tautan')?>" method="POST">
            <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Link Terkait" required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Url</label>
                  <div class="col-sm-9">
                    <input type="url" name="url" class="form-control" placeholder="Url Link Terkait" required>
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
              <h4 class="modal-title">Form Edit Link Terkait</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <form class="form-horizontal form-group-sm" action="<?=base_url()?>website/tautan" method="POST">
            
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
                url : '<?=base_url()?>website/edittautan',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>