<style>
.sidebar, .sidebar-bg {
    background: #008B8B;
}
.sidebar .nav > li > a:focus, .sidebar .nav > li > a {
    color: #000000;
}
.sidebar .sub-menu > li > a {
    color: #000000;
}
.sidebar .nav > li.nav-header {
    color: #000000;
}
</style>

<?php 
       $level_id=$this->session->level;
       $menu=$this->model_app->view_modul($level_id);
       foreach ($menu as $row) 
       {
            $id=$row['id_modul'];
            $ceksub=cekMenu($id,$level_id);
            if($ctrl==$row['controller'])
                {
                    $active='active';
                }
                else
                {
                    $active='';
                }
        
                if($ceksub==0)
                {
                    
                    echo'<li class="'.$active.'"><a href="'.base_url().''.$row['controller'].'">
                    <i class="fa fa-'.$row['icon'].'"></i>
                    <span>'.$row['nama_modul'].'</span>
                  </a></li>';
                 
                }
                else
                {
                	
                echo' <li class="has-sub '.$active.'">
                         <a href="javascript:;">
                            <b class="caret pull-right"></b>
                                <i class="fa fa-'.$row['icon'].'"></i> 
                                    <span>'.$row['nama_modul'].'</span>
                        </a>
                        <ul class="sub-menu">';
                        $submenu=$this->model_app->view_menu($id,$level_id);
                        foreach ($submenu as $rows) {
                            

                                $id_menu=$rows['id_menu'];
                                    if(cekSubMenu($id_menu,$level_id)==0)
                                    {
                                        if($link==$rows['link'])
                                        {
                                            $aktif='active';
                                        }
                                        else
                                        {
                                        $aktif='';
                                        }
                                     echo'<li class="'.$aktif.'" ><a  href="'.base_url().''.$rows['link'].'">'.$rows['nama_menu'].'</a></li>';
                                    }
                                    else
                                    {
                                        if($id_menu==idParent($link))
                                        {
                                            $aktif='active';
                                        }
                                        else
                                        {
                                            $aktif='';
                                        }
                                    echo' <li class="has-sub '.$aktif.'">
                                     <a href="javascript:;">
                                        <b class="caret pull-right"></b>
                                         <span>'.$rows['nama_menu'].'</span>
                                        </a>
                                        <ul class="sub-menu"> ';

                                        $submenu2=$this->model_app->view_submenu($id_menu,$level_id);
                                        foreach ($submenu2 as $rows2) {
                                            if($link==$rows2['link'])
                                            {
                                            $aktif2='active';
                                            }
                                             else
                                            {
                                            $aktif2='';
                                            }
                                            echo'<li class="'.$aktif2.'" ><a  href="'.base_url().''.$rows2['link'].'">'.$rows2['nama_menu'].'</a></li>';
                                        }
                                    echo '</ul>
                                    </li>';
                            }
                        }
                   echo' </ul>
                    </li>';
                }
        }

        if($this->session->level=='1' AND $this->session->id_user==1)
        {
        echo'<li class="has-sub '.$modulmenu.'">
                <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="fa fa-list"></i> 
                <span>Modul & Menu</span>
                </a>
               
                <ul class="sub-menu">
                <li class="'.$modul.'"><a  href="'.base_url().'modul"> Modul</a>
                </li>
                <li class="'.$menuu.'"><a href="'.base_url().'menu">Menu</a>
                </li>
                </ul>
            </li>';
        }
        if($this->session->level=='1')
        {
        echo'<li class="has-sub '.$akseslevel.'">
                <a href="javascript:;">
              <b class="caret pull-right"></b>
              <i class="fa fa-list"></i> 
              <span>Level & Akses</span>
            </a>
                <ul class="sub-menu">
                <li class="'.$lev.'"><a  href="'.base_url().'level">Level</a>
                </li>
                <li class="'.$modulakses.'"><a href="'.base_url().'akses">Akses Modul</a>
                </li>
                </ul>
            </li>';
        }		