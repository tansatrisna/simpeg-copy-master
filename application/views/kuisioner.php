<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title><?=identitas('nama')?> | <?=$title?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,300,700" rel="stylesheet" id="fontFamilySrc" />
    <link href="<?=base_url()?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/animate.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/style.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?=base_url()?>assets/plugins/pace/pace.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>

 
    <!-- ================== END BASE JS ================== -->
    
    <!--[if lt IE 9]>
        <script src="<?=base_url()?>assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
</head>
<body >

    <!-- begin #page-loader -->
     <div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-container   page-without-sidebar">
        <!-- begin #header -->
        
        <!-- end #header -->
        
        <!-- begin #content -->
        <div id="content" class="content">
        
        <?php

                 if($this->session->flashdata('sukses')!='')
                   {
                    echo'  <script>
                      $(document).ready(function() {
                  
                      swal("Selamat!", "'.$this->session->flashdata('sukses').'", "success");
                    
                      });
                    </script>';
                   }
                    else if($this->session->flashdata('gagal')!='')
                    {
                  
                  echo'  <script>
                      $(document).ready(function() {
                  
                      swal("Maaf!", "'.$this->session->flashdata('gagal').'", "error");
                    
                      });
                    </script>';
                
                 }

     
                echo $contents;
            ?>
                
        </div>
        <!-- end #content -->
        
    </div>
    <!-- end page container -->

    
    <!-- ================== BEGIN BASE JS ================== -->
    
    <script src="<?=base_url()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script src="<?=base_url()?>assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    
    <script src="<?=base_url()?>assets/js/appss.min.js"></script>




    <script>
              
        $(document).ready(function() {
            App.init();
        });
    </script>
        

</body>

</html>
