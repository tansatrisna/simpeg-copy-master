<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?=identitas('nama')?>| <?=$title?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,300,700" rel="stylesheet" id="fontFamilySrc" /> -->
    <link href="<?=base_url()?>assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/animate.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/style.min.css" rel="stylesheet" />
    <!-- <link href="<?=base_url()?>assets/css/body.css" rel="stylesheet" /> -->
    <!-- ================== END BASE CSS STYLE ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="<?=base_url()?>assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <noscript>
   Ujian ini harus mengaktifkan javascript di browser anda 
   <style>div { display:none; }</style>
 </noscript>
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?=base_url()?>assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!--[if lt IE 9]>
        <script src="<?=base_url()?>assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
</head>
<body id="text" class="text">
    <!-- begin #page-loader -->
    <!-- <div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div> -->
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer page-without-sidebar">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
            <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <div class="navbar-brand">
                      KUISIONER  
                    </div>
                    
                </div>
                
                
                <ul class="nav navbar-nav navbar-right">

                    <li class="navbar-user">
                        <a href="javascript:;" >
                            
                            <span class="hidden-xs"><?=$user?></span>
                        </a>
                        
                    </li>
                    
                </ul>
                <!-- end mobile sidebar expand / collapse button -->
                
                
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end #header -->
        
        <!-- begin #content -->
        <div id="content" class="content">
                
            
            
                <!-- begin row -->
                <div class="row">
                    <form class="form-inline" id="simpankuisioner" action="<?=base_url()?>isikuisioner/simpan" method="POST" >
                    <!-- begin col-6 -->
                    <div class="col-md-12">
                        
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                
                                <h4 class="panel-title">Soal Nomor : <?=$nomor?> -> <?=viewKategoriKuisioner($kategori)?> -> <?=$rows['jenis']?></h4>
                            </div>
                            <div class="panel-body">
                              <?=$rows['soal']?>                                   
                               
                            </div>
                        
                            <input type="hidden" name="kuisioner" value="<?=$kuis?>">
                                    <input type="hidden" name="id" value="<?=$jawab['id']?>">
                                    <input type="hidden" name="no_soal" value="<?=$jawab['nomor']?>">
                                    <input type="hidden" name="jenis" value="<?=$jawab['jenis']?>">
                                    <input type="hidden" name="id_soal" value="<?=$jawab['id_soal']?>">
                                    <input type="hidden" name="simpan" value="">
                            
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover" >
                                <tbody>
                                <?php
                                    if($rows['jenis']=='Kuantitatif')
                                    {
                                        $option=$this->model_app->view_where_ordering('simpeg_kuisioner_option',array('kuisioner'=>$rows['id']),'id','ASC');
                                        foreach ($option as $key) {
                                        $cl=($key['id']==$jawab['jawaban']) ? 'checked' : ''; 
                                    echo'<tr>
                                        <td style="width :55px;  padding-left: 20px; padding-right: 3px;"><input type="radio" name="jawaban" value="'.$key['id'].'" '.$cl.' required>&nbsp;</td>
                                        <td style="padding-left: 5px; padding-right: 3px;">'.$key['nama'].'</td>
                                        </tr>';

                                        }
                                    }
                                    else
                                    {
                                    
                                        echo'<tr>

                                        <td><textarea style=" width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;" name="jawaban" class="form-group form-control"  rows="3" required></textarea> </td>
                                        
                                        
                                        </tr>';
                                    
                                    }
                                    ?>
                                </tbody>
                                </table>
                                </div>
                            
                            <div class="panel-footer text-center">
                                <?php
                                if($nomor<$soal)
                                {
                                  echo '<button type="submit" class="btn btn-block btn-success">Simpan & Lanjutkan</button>';   
                                }
                                else
                                {
                                    echo '<button type="submit" class="btn btn-block btn-danger">Simpan & Selesai</button>';
                                }
                                ?>
                                

                            </div>
                        
                            
                                <div class="clearfix m-b-25">
                                    <div class="btn-group btn-group-justified">
                                        <a class="btn btn-white">Jumlah Soal Kuisioner : <?=$soal?></a>
                                        
                                       
                                        
                                    </div>
                                </div>
                                
                        </div>
                        <!-- end panel -->
                        
                    </div>
                    <!-- end col-6 -->
                    
                   
                        
                    
        </form>
    </div>
                <!-- end row -->
             
   
            
            
            <!-- begin #footer -->
            <div id="footer" class="footer">
                <span class="pull-right">
                    <a href="javascript:;" class="btn-scroll-to-top" data-click="scroll-top">
                        <i class="fa fa-arrow-up"></i> <span class="hidden-xs">Back to Top</span>
                    </a>
                </span>
               
            </div>
            <!-- end #footer -->
        </div>
        <!-- end #content -->
        
    </div>
    <!-- end page container -->
    
    <!-- begin theme-panel -->
    
    <!-- end theme-panel -->
   
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?=base_url()?>assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
        <script src="<?=base_url()?>assets/crossbrowserjs/html5shiv.js"></script>
        <script src="<?=base_url()?>assets/crossbrowserjs/respond.min.js"></script>
    <![endif]-->
    <script src="<?=base_url()?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=base_url()?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <!-- ================== END BASE JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?=base_url()?>assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
    <script src="<?=base_url()?>assets/js/demo.min.js"></script>
    <script src="<?=base_url()?>assets/js/appss.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            Demo.init();
            function disableBack() { window.history.forward() }
            window.onload = disableBack();
            window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
            $("tr").click(function () {
            $(this).find('input:radio').attr('checked', true);

            });
        });

        
    </script>

</body>
</html>
