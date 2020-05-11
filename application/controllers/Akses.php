<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {

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
        
		if($this->session->level==1)
        {
        if(isset($_POST['id_level']))
        {
          $id_level=$this->input->post('id_level');
        }
        else
        {
          $id_level=0;
        }

         $data['id_level']=$id_level;
      	 $data['akseslevel']='active';
         $data['modulakses']='active';
         $data['title']='Level User';
         $data['record']=$this->model_app->view_where_ordering('view_simpeg_modul',array('id_level'=>$id_level),'urutan','ASC');
		  $this->template->load('admin','admin/mod_akses/akses',$data);
			
		}
		else
		{
			redirect('dashboard');
		}
    }

    function menu($id_modul,$id_level){
      
    if($this->session->level==1)
        {
          $data['id_modul']=$id_modul;
         $data['id_level']=$id_level;
         $data['akseslevel']='active';
         $data['modulakses']='active';
         $data['title']='Level User';
         $data['record']=$this->model_app->view_where_ordering('view_simpeg_menu',array('id_level'=>$id_level,'id_modul'=>$id_modul),'urutan','ASC');
      $this->template->load('admin','admin/mod_akses/menu',$data);
      
    }
    else
    {
      redirect('dashboard');
    }
    }

  



    public function aksibaca() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $id=$postData['id'];
    $value=$postData['value'];
    
    $data=array('baca'=>$value);
    $where=array('id'=>$id);
    $this->model_app->update('simpeg_modul_akses',$data,$where);

   
      
   }

   public function menubaca() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $id=$postData['id'];
    $value=$postData['value'];
    $data=array('baca'=>$value);
    $where=array('id'=>$id);
    $this->model_app->update('simpeg_menu_akses',$data,$where);

      
      
   }

   public function menutulis() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $id=$postData['id'];
    $value=$postData['value'];
    $data=array('tulis'=>$value);
    $where=array('id'=>$id);
    $this->model_app->update('simpeg_menu_akses',$data,$where);

      
      
   }

   public function menuubah() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $id=$postData['id'];
    $value=$postData['value'];
    $data=array('ubah'=>$value);
    $where=array('id'=>$id);
    $this->model_app->update('simpeg_menu_akses',$data,$where);

      
      
   }

   public function menuhapus() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $id=$postData['id'];
    $value=$postData['value'];
    $data=array('hapus'=>$value);
    $where=array('id'=>$id);
    $this->model_app->update('simpeg_menu_akses',$data,$where);

      
      
   }





} //controller