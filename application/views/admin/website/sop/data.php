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
                                       echo aksiTambah('website/soptambah');
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
                        <th>Judul</th>
                        <th>Didownload</th>
                        <th>File</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                    $no = 1;
                    foreach ($record as $row){
                   

                    echo '<tr><td>'.$no.'</td>
                              
                              <td>'.$row['judul'].'</td>
                              <td>'.$row['dibaca'].'</td>
                              <td>'.aksiModalLihat('#modalLihat',$row['id'],'Lihat').'</td>
                              <td width="1%" nowrap><center>';
                              if(bisaUbah($link,$id_level)==1)
                              {
                                echo aksiEdit('website/sopedit',enkrip($row['id']));
                              }
                              echo'&nbsp;';
                              if(bisaHapus($link,$id_level)==1)
                              {
                               echo aksiHapus('website/sophapus',enkrip($row['id']));
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

<div class="modal fade" id="modalLihat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header ">
              <h4 class="modal-title">File SOP</h4>
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
                url : '<?=base_url('website/soplihat')?>',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>