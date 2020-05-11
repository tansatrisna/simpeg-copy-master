<!-- begin page-header -->
      <h1 class="page-header">Daftar Option Kuisioner <small></small></h1>
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
                                  echo aksikembali($link);
                                  if(bisaTulis($link,$id_level))
                                  {
                                    echo'&nbsp;<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i> Tambah</a>';
                                  }
                                  ?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                            
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                 
                                 <thead>
                                  <tr>
                                      <th colspan="4"><?=$rows['soal']?></th>
                                    </tr>
                                    <tr>
                                      <th>No</th>
                                      <th>Option</th>
                                      <th>Skor</th>
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
                                        <td>'.$row['skor'].'</td>
                                        <td>';
                                        if(bisaUbah($link,$id_level)==1)
                                              {
                                                echo '<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalEdit" data-id="'.$row['id'].'"><i class="fa fa-edit"></i></a>';
                                               
                                              }
                                              echo '&nbsp;';    
                                              if(bisaHapus($link,$id_level)==1)
                                              {
                                                echo aksiHapus('kuisioner/hapusoption',enkrip($row['id']));
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
                <h4 class="modal-title">Form Tambah Option Kuisioner</h4>
                <button type="button" class="close full-right" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <form class="form-horizontal" action="<?=base_url('kuisioner/option')?>" method="POST">
              <input type="hidden" name="kuisioner" value="<?=$rows['id']?>">
            <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama Option Kuisioner</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Option Kuisioner" required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Skor</label>
                  <div class="col-sm-9">
                    <input type="number" name="skor" class="form-control" placeholder="" required>
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
              <h4 class="modal-title">Form Edit Option Kuisioner</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <form class="form-horizontal form-group-sm" action="<?=base_url()?>kuisioner/option" method="POST">
            
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
                url : '<?=base_url()?>kuisioner/editoption',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>