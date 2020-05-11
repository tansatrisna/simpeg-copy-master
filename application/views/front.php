<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Decision Support Sistem | <?=$title?></title>

	<!-- Framework CSS -->
	<link href="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/plugins/bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="<?=base_url()?>assets/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" />  
	<link rel="stylesheet" href="<?=base_url()?>assets/css/front/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/front/print.css" type="text/css" media="print">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/front/custom.css" type="text/css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/front/fancy-type/screen.css" type="text/css" media="screen, projection">
	<script src="<?=base_url()?>assets/plugins/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/bootstrap3/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Vollkorn:wght@600&display=swap" rel="stylesheet">
<style>
.main{
-webkit-box-shadow: 0 8px 6px -6px black;
		-moz-box-shadow: 0 8px 6px -6px #9BAD77;
			box-shadow: 0 8px 6px -6px #9BAD77;

}
.circular-top-border {
	border-top-left-radius: 6px;
	border-top-right-radius: 6px;
}
.circular-bottom-border {
	border-bottom-left-radius: 6px;
	border-bottom-right-radius: 6px;
}
.white-font-border {
	text-shadow: -0.6px 0 white, 0 0.6px white, 0.6px 0 white, 0 -0.6px white;
}
</style>
</head>
<body id="target-element" style="margin: auto; padding: 10px;">
	<div class="container circular-top-border" id="header">
		<div class="span-20">
			<h1 class="" style="font-family: 'Vollkorn', serif; padding: 20px 0px 0px 20px">SIMPEG</h1>
			<h3 style="font-style: italic; color:#F5F5F5; font-family: 'Roboto', sans-serif; padding: 0; padding-left: 20px; margin-top: -10px"><?=identitas('nama')?></h3>
		</div>
		<div class="span-3" style="margin: 10px 0px">
			<img src="<?=base_url()?>assets/img/<?=identitas('logo')?>" height="91" alt="" class="" >
		</div>
	</div>
	<div id="">
		<div class="container" id="navbar">
			<div class="span-24" style="margin: 4px 0px">
				<div id="primary_nav_wrap">
					<ul>
						<li><a href="<?=base_url()?>">Home</a></li>
						<li><a href="<?=base_url('web/pejabat')?>">Pejabat</a></li>
						<li><a href="<?=base_url('web/pengumuman')?>">Pengumuman</a></li>
						<li><a href="<?=base_url('web/sop')?>">SOP</a></li>
						<li><a href="<?=base_url('web/peraturan')?>">Peraturan</a></li>
						<li><a href="<?=base_url('web/dosen')?>">Dosen</a></li>
						<li><a href="<?=base_url('web/pegawai')?>">Pegawai</a></li>
						<li><a href="<?=base_url('web/kinerja')?>">Kinerja Guru</a></li>
						
					</ul>            
				</div>
			</div>
		</div>
	</div>

	<div class="container main circular-bottom-border">
		<hr class="space">
		<div class="span-15 prepend-1" style="padding-left: 20px;">
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
		<div class="span-7 last" style="border-left: 1px solid #ddd; padding-left: 20px; margin-bottom: 10px">
			<h3 style="font-family: 'Roboto', sans-serif;">Login Pegawai</h3>
				<form action="<?=base_url('login')?>" method="post" accept-charset= utf-8>
					<input type="hidden" name="token" value="<?=$token?>">
					<label for="uid">Email</label><br>
					
					<input type="email" class="text form-control" id="username" name="email" style="width: 90%">
					<label for="pass">Password</label><br>
					
					<input type="password" class="text form-control" id="pass" name="password" style="width: 90%">
					<label for="pass"><?=$captcha?></label>
					
					<input type="number" class="text form-control" id="pass" name="captcha" style="width: 90%" required>
					<div style="margin-top: 6px">
						<input type="submit" name="login" value="Login" class="btn btn-primary btn-hover-green" style="width: 90%; margin-top: 0.5em">
						<input type="hidden" name="diajukan" value="1">
					</div>
				</form>
				<br>
			<p style="margin-top: 10px; font-size: 11px; color: #777">Jika Anda ingin bantuan lebih lanjut, silakan hubungi bagian kepegawaiaan</p>
		</div>
		<hr>

		<?=identitas('footer')?>
	</div>

	<script src="<?=base_url()?>assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
</body>

</html>