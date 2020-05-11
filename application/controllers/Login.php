<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function __construct(){
        parent::__construct();
        $this->load->library('mathcaptcha');
      }

	function index(){
		
		if (isset($_POST['login']))
		{
			
			$email = $this->db->escape_str($this->input->post('email'));
			$password = $this->input->post('password');
			$token=$this->input->post('token');
			$captcha=$this->input->post('captcha');
			$token1=$this->session->token;

			$os=getOS();
			$browser=getBrowser();
			$ip=getIP();
			
			if($token==$token1 AND $captcha==$this->mathcaptcha->resultcaptcha())
			{
				$cek = $this->model_app->view_where('m_sdm',array('email'=>$email,'status_aktif'=>'A'));
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
					$this->session->set_userdata(array('email'=>$r['email'],
										'nama_user'=>viewSdm($r['idsdm']),
									    'idsdm'=>$r['idsdm'],
	                                    'login'=>true,
	                                    'jenis'=>$r['jenis'],
	                                    'unit'=>$r['unit'],
	                                    'foto_user'=>$r['foto']
										));
					$data=array('login_terakhir'=>date('Y-m-d H:i:s'));
					$history=array('email'=>$email,
								'ip_address'=>$ip,
								'os'=>$os,
								'browser'=>$browser,
								'waktu'=>date('Y-m-d H:i:s'),
								'level'=>$r['jenis']);
					$where=array('idsdm'=>$r['idsdm']);
					$this->model_app->update('m_sdm',$data,$where);
					$this->model_app->insert('history_login',$history);
					redirect('sdm');
						}
						else
						{
							$this->session->set_flashdata('gagal'," Password salah!");
							redirect();
						}
					

					
				}
				else
				{
						
					$this->session->set_flashdata('gagal',"Username salah!");
					redirect();
				}
			}
			else
			{
				$this->session->set_flashdata('gagal',"Captcha salah!");
					redirect();
			}

		}
		else
		{
			
			redirect();
		}
		
	}

	      
	
} //controller
