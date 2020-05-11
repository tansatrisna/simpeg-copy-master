
      <!-- begin page-header -->
      <h1 class="page-header"><?=$header?> <small></small></h1>
      <!-- end page-header -->
<?php
$sdm=explode("|",$rows['sdm']);
?>
      
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
                            <form class="form-horizontal"  action="<?=base_url()?>master/pengumumanedit" enctype="multipart/form-data" method="POST">
            
             
              
              <input type="hidden" name="id" value="<?=$rows['id']?>">               
             
              <!-- /.form-group row -->
              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Judul</b></label>
                  <div class="col-sm-10">
                    <input type="text" name="judul" class="form-control" value="<?=$rows['judul']?>" placeholder="Judul" required>
                  </div>
              </div><!-- row -->
               <!-- /.form-group row -->
              

                <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Target</b></label>
                  <div class="col-sm-10">
                   <select name="target" id="target" class="form-control" required>
                     <option value="">..::Pilih Target::..</option>
                     <?=opEnum('simpeg_pengumuman_sdm','target',$rows['target'])?>
                   </select>
                  </div>
                </div><!-- row -->

             

              <div  class="form-group row">
                  <label class="col-sm-2 control-label "><b>SDM</b></label>
                  <div class="col-sm-9">
                   <select name="idsdm[]" id="idsdm" class="form-control sdm" multiple>
                     <option value=""></option>
                     <?=opSdmMultiple($sdm)?>   
                   </select>
                  </div>
              </div><!-- row -->

              <div class="form-group row">
                  <label class="col-sm-2 control-label "><b>Isi</b></label>
                  <div class="col-sm-10">
                   <textarea name="isi" class="mytextarea" required><?=$rows['isi']?></textarea>
                  </div>
              </div><!-- row -->

             

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
   

      


<script type="text/javascript">
          
 $(document).ready(function() {
     $(".sdm").select2({placeholder:"..::Pilih SDM::.."});
     var target=$(this).val();
       if(target=='KHUSUS')
       {
        $('#sdm').show();
        $('#idsdm').prop('required',true);
       }
       else
       {
        $('#sdm').hide();
        $('#idsdm').prop('required',false);
       }
    });


 $('#target').change(function () {
   var target=$(this).val();
   if(target=='KHUSUS')
   {
    $('#sdm').show();
    $('#idsdm').prop('required',true);
   }
   else
   {
    $('#sdm').hide();
    $('#idsdm').prop('required',false);
   }
   // $.ajax({
   //      url:'<?=base_url()?>referensi/getSdmJenis',
   //      method: 'post',
   //      data: {jenis: target},
   //      dataType: 'json',
   //      success: function(response){

   //        // Remove options 
   //        $('#idsdm').find('option').not(':first').remove();
               
   //        // Add options
   //        $.each(response,function(index,data){
   //           $('#idsdm').append('<option value="'+data['idsdm']+'">'+data['gelar_depan']+' '+data['nama']+' '+data['gelar_belakang']+'</option>');

   //        });
   //      }
   //   });
   
 });

 
  </script> 