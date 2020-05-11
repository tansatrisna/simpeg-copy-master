<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function index(){
		$id_level=$this->session->level;
		if($id_level=='')
		{
			redirect('logout');
		}
		
		if(isset($_POST['cari']))
		{
			$cari=posttext('cari');
			$data['cari']=$cari;
			$data['hasil']=$this->model_app->cari_sdm($cari);
		}
		
    	
        $link='dashboard';
    	$data['title']='Dashboard';
    	$data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='dashboard';
        $data['beranda']='active';
       	$data['record']=$this->model_app->view_ordering('m_unit','id','ASC');

        $this->template->load('admin','admin/mod_dashboard/dashboard',$data);
        
		
    }

    function profil(){
    $id_level=$this->session->level;
        $data['title']='Profil';
        $data['id_level']=$id_level;
        $data['link']='dashboard';
        $data['ctrl']='dashboard';
        $user=$this->session->id_user;
        if(isset($_POST['ganti']))
        {
            $where=array('id_user'=>$user);
                 
                 $config['upload_path'] = 'assets/img/user/';
                 $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG|jpeg';
                 $config['max_size'] = '2000'; // kb
                 $this->load->library('upload', $config);
                 $this->upload->do_upload('gambar');
                 $hasil=$this->upload->data();
                 $gambar=$hasil['file_name'];
                 
                    $upsk=array('gambar'=>$gambar);
                    $this->model_app->update('simpeg_user',$upsk,$where);
                    $this->session->set_userdata(array('foto_user'=>$gambar));
                 


                 redirect('dashboard/profil');
        }
        else
        {
        $data['riwayat']=$this->model_app->view_ordering_limit('history_login','id_history','DESC',0,5);
         $data['rows']=$this->model_app->edit('simpeg_user',array('id_user'=>$user))->row_array();
        $this->template->load('admin','admin/mod_dashboard/profil',$data);
        }
          
    }

    
    function gantipassword(){
        $id_level=$this->session->level;
        $data['title']='Ganti Password';
        $data['id_level']=$id_level;
        $data['link']='dashboard';
        $data['ctrl']='dashboard';
        $user=$this->session->id_user;
        if(isset($_POST['edit']))
        {
            $password=$this->db->escape_str($this->input->post('pass'));
            $pass1=$this->db->escape_str($this->input->post('pass1'));
            $pass2=$this->db->escape_str($this->input->post('pass2'));
            

            $cek = $this->model_app->view_where('simpeg_user',array('id_user'=>$user));
            
                foreach ($cek->result_array() as $r){
                $hash_pass=$r['password'];
                $salt=$r['salt'];
                }
                $check=validateLogin($password, $hash_pass, $salt);
                if($check==true)
                    {
                 
                        if($pass1==$pass2)
                          {
                                            $salt1=randomSalt();
                                            $passbaru=create_hash($pass1,$salt1);
                                             $data = array('password'=>$passbaru,
                                                            'salt'=>$salt1,
                                                            'token'=>token());
                                             $where=array('id_user'=>$user);
                                             
                                             $this->model_app->update('simpeg_user',$data,$where); 
                                            
                                             echo"<script type=\"text/javascript\">window.alert('Password Berhasil di Ganti, Silahkan Login Kembali');window.location.href = '".base_url()."logout';</script>";
                                        
                                        
                       
                          }
                          else
                          {
                            echo"<script type=\"text/javascript\">window.alert('Password Baru Tidak Sama');
            window.location.href = '".base_url()."dashboard/gantipassword';</script>";
                          }
                    }
                    else
                    {
                        echo"<script type=\"text/javascript\">window.alert('Password Lama Salah');
            window.location.href = '".base_url()."dashboard/gantipassword';</script>";
                    }
        
        }
        else
        {
            $data['rows']=$this->model_app->edit('simpeg_user',array('id_user'=>$user))->row_array();
            $this->template->load('admin','admin/mod_dashboard/gantipassword',$data);
        }
          
    }
    




} //controller