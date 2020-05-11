<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

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
        $data['id_level']=$id_level;
         $data['link']=$link;
         $data['ctrl']='menu';
		if($this->session->level==1 AND $this->session->id_user==1)
        {
        	
      	 $data['modulmenu']='active';
         $data['menuu']='active';
         $data['title']='Menu';
      	 $data['record']=$this->model_app->data_menu();
		 $this->template->load('admin','admin/mod_menu/menu',$data);
			
		}
		else
		{
			redirect('dashboard');
		}
    }

    function tambah(){
        $id_level=$this->session->level;
        $data['id_level']=$id_level;
         $data['link']=$link;
         $data['ctrl']='menu';
        if($this->session->level==1 AND $this->session->id_user==1)
        {
            if(isset($_POST['tambah']))
            {
                
                $link=$this->input->post('controller').'/'.$this->input->post('link');
                $data=array('id_modul'=>$this->input->post('modul'),
                            'id_parent'=>$this->input->post('parent'),
                            'nama_menu'=>$this->input->post('nama'),
                            'link'=>$link,
                            'urutan'=>$this->input->post('urutan'));
                $simpan=$this->model_app->insert('simpeg_menu',$data);
                $id = $this->db->insert_id();
                $menu_akses=[]; 
                $level=$this->db->query("SELECT * FROM simpeg_level")->result_array();
                foreach ($level as $row1) {
                    $data2=array('id_menu'=>$id,
                                'id_level'=>$row1['id_level']);
                    array_push($menu_akses, $data2);
                }
                $this->model_app->insert_multiple('simpeg_menu_akses',$menu_akses);
                if($simpan)
                    {
                        $this->session->set_flashdata('sukses',"Data Menu Berhasil Disimpan");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Menu Gagal Disimpan");
                    }
                redirect('menu');
            }
            
            else
            {
         $data['modulmenu']='active';
         $data['menuu']='active';
         $data['title']='Menu';
          $this->template->load('admin','admin/mod_menu/tambah',$data);
            }
        }
        else
        {
            redirect('dashboard');
        }
    }

    function edit(){
        $id_level=$this->session->level;
        $data['id_level']=$id_level;
         $data['link']=$link;
         $data['ctrl']='menu';
        if($this->session->level==1 AND $this->session->id_user==1)
        {
            if(isset($_POST['edit']))
            {
                $link=$this->input->post('controller').'/'.$this->input->post('link');
                $data=array('id_modul'=>$this->input->post('modul'),
                            'id_parent'=>$this->input->post('parent'),
                            'nama_menu'=>$this->input->post('nama'),
                            'link'=>$link,
                            'urutan'=>$this->input->post('urutan'));
                $where=array('id_menu'=>$this->input->post('id'));
                $update=$this->model_app->update('simpeg_menu',$data,$where);
                if($update)
                    {
                        $this->session->set_flashdata('sukses',"Data Menu Berhasil Diedit");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Menu Gagal Diedit");
                    }
                redirect('menu');
            }
            
            else
            {
        $id=dekrip($this->uri->segment('3'));
         $data['modulmenu']='has-active';
         $data['menuu']='has-active';
         $data['title']='Menu';
         $data['row']=$this->model_app->edit('simpeg_menu',array('id_menu'=>$id))->row_array();
          $this->template->load('admin','admin/mod_menu/edit',$data);
            }
        }
        else
        {
            redirect('dashboard');
        }
    }


    function hapus(){
       if($this->session->level==1 AND $this->session->id_user==1)
            {
                
                $where=array('id_menu'=>dekrip($this->uri->segment('3')));
                $this->model_app->delete('simpeg_menu',$where);
                $hapus=$this->model_app->delete('simpeg_menu_akses',$where);
                if($hapus)
                  {
                      $this->session->set_flashdata('sukses',"Data Menu Berhasil Dihapus");
                  }
                  else
                  {
                      $this->session->set_flashdata('gagal',"Data Menu Gagal Dihapus");
                  }
                redirect('menu');
            }
            else
        {
            redirect('dashboard');
        }
    }


public function getmodul() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $data = getModul($postData);
    echo json_encode($data);

      
      
   }

public function getMenu() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $data = getMenu($postData);
    echo json_encode($data);
    }


} //controller