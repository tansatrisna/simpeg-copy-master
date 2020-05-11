<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->load->library('mathcaptcha');
		if (isset($_POST['login']))
		{
			
			$username = $this->db->escape_str($this->input->post('username'));
			$password = $this->input->post('password');
			$token=$this->input->post('token');
			$captcha=$this->input->post('captcha');
			$token1=$this->session->token;

			$os=getOS();
			$browser=getBrowser();
			$ip=getIP();
			
			if($token==$token1 AND $captcha==$this->mathcaptcha->resultcaptcha())
			{
				$cek = $this->model_app->view_where('simpeg_user',array('username'=>$username, 'status'=>'Y'));
			    $total = $cek->num_rows();
				if ($total > 0)
				{
					$r=$cek->row_array();
					$hash_pass=$r['password'];
					$salt=$r['salt'];
					$check=validateLogin($password, $hash_pass, $salt);
					if($check==true)
						{
					$this->session->set_userdata('upload_image_file_manager',true);
					$this->session->set_userdata(array('username'=>$r['username'],
										'nama_user'=>$r['nama'],
									   'level'=>$r['level'],
									   'fakultas'=>$r['fakultas'],
									   'prodi'=>$r['prodi'],
	                                   'id_user'=>$r['id_user'],
	                                   'login'=>true,
	                                   'foto_user'=>$r['gambar']
										));
					$data=array('login_terakhir'=>date('Y-m-d H:i:s'));
					$history=array('email'=>$username,
								'ip_address'=>$ip,
								'os'=>$os,
								'browser'=>$browser,
								'waktu'=>date('Y-m-d H:i:s'),
								'level'=>viewLevel($r['level']));
					$where=array('id_user'=>$r['id_user']);
					$this->model_app->update('simpeg_user',$data,$where);
					$this->model_app->insert('history_login',$history);
					redirect('dashboard');
						}
						else
						{
					echo"<script type=\"text/javascript\">window.alert(' Password Salah');
							window.location.href = '".base_url()."admin';</script>";
						}
					

					
				}
				else
				{
						
					echo"<script type=\"text/javascript\">window.alert('Username  Salah');
						window.location.href = '".base_url()."admin';</script>";
					
				}
			}
			else
			{
				echo"<script type=\"text/javascript\">window.alert('Captcha Salah');
						window.location.href = '".base_url()."admin';</script>";
			}

		}
		else
		{
			
			$token=token();
 			$this->session->set_userdata(array('token'=>$token));
 			$this->mathcaptcha->generatekode();
			$data['captcha']=$this->mathcaptcha->showcaptcha();
			$data['token']=$token;
			$data['title']='Login Admin';
			$this->load->view('admin/login',$data);
		}
		
	}

	

	
} //controller
