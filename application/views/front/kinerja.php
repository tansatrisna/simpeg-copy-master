<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle  collapsed" data-toggle="collapse" data-target="#bs-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-collapse-1">
      <ul class="nav navbar-nav">
        <?php
          foreach ($tabs as $row => $key) {
            $cl=($row=='$hal') ? 'active' : '' ;
            echo '<li class="'.$cl.'">
            <a href="'.base_url('web/kinerja/'.$row).'">'.$key.'</a>
          </li>';
          }
        ?>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<h2>Kinerja Guru</h2>
<form action="<?=base_url('web/kinerja/'.$tab)?>" method="post" accept-charset="utf-8">
<input type="text" class="text" placeholder="Cari <?=$hal?>"  name="cari" value="<?=$cari?>">&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-hover-green">Cari</button>
</form>
<br>

<?php
$this->load->view('front/kinerja/'.$tab);

echo $this->pagination->create_links();
?>