<div class="profile">
        <div class="profile-header">
          <!-- BEGIN profile-header-cover -->
          <div class="profile-header-cover"></div>
          <!-- END profile-header-cover -->
          <!-- BEGIN profile-header-content -->
          <div class="profile-header-content">
            <!-- BEGIN profile-header-img -->
            <div class="profile-header-img">
              <?php
              if($rows['foto']=='')
              {
                echo '<img src="'.base_url('assets/img/sdm/no-foto.jpg').'" alt="" width="120px" height="150px">';
              }
              else
              {
                echo '<img src="'.base_url('assets/img/sdm/'.$rows['foto']).'" alt="" width="120px" height="150px">';
              }
              ?>
              
            </div>
            <!-- END profile-header-img -->
            <!-- BEGIN profile-header-info -->
            <div class="profile-header-info">
              <h4 class="m-t-10 m-b-5"><?=viewSdm($rows['idsdm'])?></h4>
              <h4 class="m-t-10 m-b-5"><?=$rows['jenis']?></h4>
              <h4 class="m-t-10 m-b-5"><?=$rows['email']?></h4>
              <h4 class="m-t-10 m-b-5"><?=viewUnit($rows['unit'])?></h4>
              </div>
            <!-- END profile-header-info -->
          </div>
          <!-- END profile-header-content -->
          <!-- BEGIN profile-header-tab -->
          <ul class="profile-header-tab nav nav-tabs">
            <?php
            foreach ($tabs as $key => $value) {
              $cl = ($key == $tab) ? 'active' : '';
            echo '<li class="nav-item"><a href="'.base_url('sdm/profil/'.$key).'" class="nav-link '.$cl.'" >'.$value.'</a></li>';
                                    
            }
            
            ?>
            
            
          </ul>
          <!-- END profile-header-tab -->
        </div>
      </div>