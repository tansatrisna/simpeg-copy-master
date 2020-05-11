<!-- begin breadcrumb -->
      
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">Menu <small></small></h1>
      <!-- end page-header -->

<!-- begin section-container -->
   
          <!-- begin row -->
                <div class="row">
                    
                    <!-- begin col-8 -->
                    <div class="col-md-12">
                        <!-- begin panel -->
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                
                                <h4 class="panel-title">Form Tambah Menu</h4>
                            </div>
                            <div class="panel-body">
                            <form class="form-horizontal"  action="<?=base_url()?>menu/tambah" method="POST">
            
          
              
              <div class="form-group row">
                <label class="col-sm-2 control-label ">Modul</label>
                <!-- .col -->
                <div class="col-sm-10">
                  <select class="form-control" id="modul" name="modul" required><?php echo opModul(); ?></select>
                </div>
                <!-- /.col -->
              </div>

              <div class="form-group row">
                <label class="col-sm-2 control-label ">Parent Menu</label>
                <!-- .col -->
                <div class="col-sm-10">
                  <select class="form-control" id="parent" name="parent" ><?php echo opParentMenu($modul); ?></select>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.form-group row -->
                <div class="form-group row">
                  <label class="col-sm-2 control-label ">Nama Menu</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Menu" required>
                  </div>
                </div><!-- row -->
                <div class="form-group row">
                  <label class="col-sm-2 control-label ">Link</label>
                  <div class="col-sm-3">
                    <input type="text" name="controller" id="controller" class="form-control" placeholder="Controller" readonly>
                  </div>
                  <label class="col-sm-1">/</label>
                  <div class="col-sm-4">
                    <input type="text" name="link" class="form-control" placeholder="Method" required>
                  </div>
                </div><!-- row -->
                <div class="form-group row">
                  <label class="col-sm-2 control-label ">Urutan</label>
                  <div class="col-sm-10">
                    <input type="number" name="urutan" class="form-control" placeholder="urutan">
                  </div>
                </div><!-- row -->

                                  <div class="form-group row">
                                    <label class="col-sm-2 control-label ">&nbsp;</label>
                                    <div class="col-sm-10">
                                      
                                      <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
                                      <a href="<?=base_url()?>menu" class="btn btn-danger">Cancel</a>
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
          

     

 $('#modul').change(function(){
      var modul = $(this).val();

      // AJAX request
      $.ajax({
        url:'<?=base_url()?>menu/getmodul',
        method: 'post',
        data: {modul: modul},
        dataType: 'json',
        success: function(response){

        $('#controller').val(response);
         
        }
     });

      $.ajax({
        url:'<?=base_url()?>menu/getMenu',
        method: 'post',
        data: {modul: modul},
        dataType: 'json',
        success: function(response){

          // Remove options 
          $('#parent').find('option').not(':first').remove();
         
         
        

          // Add options
          $.each(response,function(index,data){
             $('#parent').append('<option value="'+data['id_menu']+'">'+data['nama_menu']+'</option>');

          });
        }
     });

   });

 
  </script> 
    

  



    

        