<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Halerror extends CI_Controller {

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
		$this->output->set_status_header('404'); 
		$data['title']='404 Error Page';
        $this->load->view('halerror',$data);//Diload dah pas error
		
	}

	

	
} //controller
