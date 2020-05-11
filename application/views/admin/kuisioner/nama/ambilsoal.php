
      <!-- begin page-header -->
      <h1 class="page-header"><?=$header?> <small></small></h1>
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
                                    
                                </div>
                                <h4 class="panel-title"><?=$title?></title></h4>
                            </div>
                            <div class="panel-body">
                           
                            
                         <form class="form-horizontal form-sm" action="<?=base_url()?>kuisioner/soaltambah" method="POST">   
                            <div class="table-responsive">
                                <table  class="table table-striped table-bordered">
                                 
                                 <thead>
                      <tr>
                        <th width="1%"><input type="checkbox" id="checkAll">All</th>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Soal</th>
                        <th>Jenis</th>
                        
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=0;
                        foreach ($record as $row) {
                        $no++;
                        echo'<tr>
                        <td><input type="checkbox"  name="check[]" value="'.$row['id'].'"></td>
                          <td>'.$no.'</td>
                          
                        
                        <td>'.viewKategoriKuisioner($row['kategori']).'</td>
                        <td>'.$row['soal'].'</td>
                        <td>'.$row['jenis'].'</td>
                        
                                              
                        </tr>';

                          
                        }
                      ?>
                    </tbody>
                                 
                                </table>
                            </div>
                            <div class="panel-footer text-right">
                              
                              <input type="hidden" name="id" value="<?=$id?>">
                             
                              <a href="<?=base_url('kuisioner/soal/'.$seo)?>" class="btn btn-warning btn-sm" ><i class="fa fa-reply"></i> Kembali</a>
                                <button type="submit" id="simpan"  class="btn btn-info btn-sm" name="ambil"  ><i class="fa fa-save"></i> Simpan</button>
                            </div>
                           </form>
                           </div>
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-8 -->
                </div>
                <!-- end row -->
      </div>
      <!-- end section-container -->



<script type="text/javascript">
$(document).ready(function () {
  
  $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });

    $('#simpan').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("Kamu Harus Memilih Soal Minimal 1 Soal");
        return false;
      }

    });
});

</script>
