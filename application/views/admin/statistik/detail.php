    <h1 class="page-header"><?=$header?> <small></small></h1>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <?=aksiKembali($link)?>
                      <?=aksiCetak('cetak/statistik/'.$seo,enkrip($unit),'Cetak')?>
                    </div>
                    <h4 class="panel-title"><?=$title?></h4>
                </div>
                <div class="panel-body">
                  <?php
                  $this->load->view('admin/statistik/detail/'.$seo);
                  ?>
                 </div>
            </div>
        </div>
       
    </div>

