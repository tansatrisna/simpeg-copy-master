<section class="content-title">
  <h1>
    Edit Menu
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Dashboard</a></li>
    <li>Menu</li>
    <li class="active">Edit Menu</li>
  </ol>
</section>

<section class="content">
  <div class="box box-form">
    
    <!-- /.box-header -->
    <form action="<?=base_url()?>menu/edit" method="POST">
      <input type="hidden" name="id" value="<?=$row['id_menu']?>">
    <div class="box-body">
      <div class="row form-group">
        <label class="col-sm-3 form-control-label text-dark">Posisi Menu</label>
        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
          <select class="form-control" name="parent"><?php echo opParent($row['id_parent']); ?></select>
        </div>
      </div><!-- row -->
      <div class="row form-group">
        <label class="col-sm-3 form-control-label text-dark">Nama Menu</label>
        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
          <input type="text" name="nama" class="form-control" value="<?=$row['nama_menu']?>" placeholder="Nama Menu">
        </div>
      </div><!-- row -->
      <div class="row form-group">
        <label class="col-sm-3 form-control-label text-dark">Link</label>
        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
          <input type="text" name="link" class="form-control" value="<?=$row['link']?>" placeholder="Link Menu">
        </div>
      </div><!-- row -->
      <div class="row form-group">
        <label class="col-sm-3 form-control-label text-dark">Urutan</label>
        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
          <input type="number" name="urutan" class="form-control" value="<?=$row['urutan']?>" placeholder="urutan">
        </div>
      </div><!-- row -->
      <div class="row form-group ">
        <label class="col-sm-3 form-control-label text-dark">Akses</label>
        <div class="col-sm-9">
          <?=opAksesMenu($row['levelakses'])?>
        </div>
      </div>

      <div class='row'>

        <div class='form-group'>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-9">
          <button type="submit" name="edit" class="btn btn-primary">Submit</button>
          <a href="<?=base_url()?>menu" class="btn btn-danger">Cancel</a>
         </div>

        </div>

      </div>
      <!-- /.box-body -->
    </div>
  </form>


  </section>

    

        