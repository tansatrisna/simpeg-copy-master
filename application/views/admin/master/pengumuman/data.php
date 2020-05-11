      <!-- begin page-header -->
      <h1 class="page-header"><?=$header?> <small></small></h1>
      <!-- end page-header -->
<!-- begin section-container -->
     

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
                                    echo aksiTambah('master/pengumumantambah');
                                  }
                                  ?>
                                </div>
                                <h4 class="panel-title"><?=$title?></h4>
                            </div>
                            <div class="panel-body">
                              
                            <form class="form-inline m-b-15" action="<?=base_url($link)?>" method="post" accept-charset="utf-8">
                                <input type="hidden" name="cari">
                               <div class="form-group row">
                                 <label class="control-label m-r-20 m-l-20">Target</label>
                                 <select name="target" class="form-control" onchange="submit()">
                                   
                                   <?=opEnum('simpeg_pengumuman_sdm','target',$target)?>
                                 </select>

                                 
                               </div>
                              </form>
                           
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered width-full">
                                 <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Dibaca</th>
                                    <th>Target</th>
                                    
                                    <th width="1%">Aksi</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                  <?php
                                 
                                  foreach ($record as $row) {
                                    $no++;
                                  if($row['target']=='KHUSUS')
                                  {
                                    $khusus=aksiModalLihat('#modalKhusus',$row['id'],'Lihat');
                                  }
                                  else
                                  {
                                    $khusus='';
                                  }
                                   echo '<tr>
                                          <td>'.$no.'</td>
                                          <td>'.$row['judul'].'</td>
                                          <td>'.aksiModalLihat('#modalLihat',$row['id'],'Lihat').'</td>
                                          <td>'.$row['dibaca'].'</td>
                                          <td>'.$row['target'].'<br>'.$khusus.'</td>
                                          
                                          <td class="with-btn" nowrap>';
                                          if(bisaUbah($link,$id_level))
                                          {
                                            echo aksiEdit('master/pengumumanedit',enkrip($row['id']));
                                          }
                                          echo '&nbsp;';
                                          if(bisaHapus($link,$id_level))
                                          {
                                            echo aksiHapus('master/pengumumanhapus',enkrip($row['id']));
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


<div class="modal fade" id="modalLihat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
              <h4 class="modal-title">Isi Pengumuman</h4>
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

<div class="modal fade" id="modalKhusus">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
              <h4 class="modal-title">Target Pengumuman Khusus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            
            
            <div class="modal-body">
                <div class="fetched-data1"></div>
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
                url : '<?=base_url()?>master/lihatpengumuman',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });

        $('#modalKhusus').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'POST',
                url : '<?=base_url()?>master/khususpengumuman',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data1').html(data);//menampilkan data ke dalam modal
                }
            });
         });

       
    });
  </script>