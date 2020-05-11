<div class="content-heading">
  <!-- .app-content-inner -->
  <div class="app-content-inner">
    <!-- .content-breadcrumb -->
    <div class="content-toolbar content-toolbar-left">
      <h3 class="page-header">Level</h3>
    </div>
    
      <div class="content-toolbar content-toolbar-right">
        <ol class="content-breadcrumb breadcrumb breadcrumb-arrow">
          <li><a href="<?=base_url()?>home"><i class="icon-home mr-1"></i> Beranda</a></li>
          <li a href="<?=base_url()?>level">Level</li>
          <li class="active">Tambah Level</li>
        </ol>
      </div>
   
    <!-- /.content-breadcrumb -->
  </div>
  <!-- /.app-content-inner -->
</div>

<div class="app-content-inner">
  <!-- .row -->
    <div class="row">
      
      <!-- form horizontal -->
      <!-- .col -->
      <div class="col-xs-12">
        <!-- .panel -->
        <div class="panel">
          <!-- .form-horizontal -->
          <form class="form-horizontal"  action="<?=base_url()?>level/tambah" method="POST">
            <h3 class="form-section-heading">Form Tambah Level</h3>
            <!-- .form-section -->
            <div class="form-section">
              
              <div class="form-group row">
                  <label class="col-sm-2 control-label ">Level</label>
                  <div class="col-sm-10">
                    <input type="text" name="level" class="form-control" placeholder="Nama Level" required>
                  </div>
                </div><!-- row -->
              <div class="form-group row">
                  <label class="col-sm-2 control-label ">Perlu Unit?</label>
                  <div class="col-sm-10">
                    <select name="unit" required class="form-control"><?=opEnum('level','unit')?></select>
                  </div>
                </div><!-- row -->
                             
             
            </div>
           
            <!-- .form-actions -->
            <div class="form-actions">
              <!-- .form-actions-right -->
              <div class="form-actions-right">
                <a href="<?=base_url()?>level" class="btn btn-danger">Cancel</a>
                <button type="submit" name="tambah" class="btn btn-success">Save</button>
              </div>
              <!-- /.form-actions-right -->
            </div>
            <!-- /.form-actions -->
          </form>
          <!-- /.form-horizontal -->
        </div>
        <!-- /.panel -->
      </div>
      <!-- /.col -->
    </div>
  <!-- /.row -->
</div>