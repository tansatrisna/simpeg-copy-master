<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends CI_Controller {

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
         $data['ctrl']='level';
		if($this->session->level==1)
        {
        
      	 $data['akseslevel']='active';
         $data['lev']='active';
         $data['title']='Level User';
      	 $data['record']=$this->model_app->view_ordering('simpeg_level','id_level','ASC');
		  $this->template->load('admin','admin/mod_level/level',$data);
			
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
         $data['ctrl']='level';
        if($this->session->level==1)
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama_level'=>$this->input->post('level'));

                $simpan=$this->model_app->insert('simpeg_level',$data);
                $id = $this->db->insert_id();
                $modul_akses=[];
                $modul=$this->db->query("SELECT * FROM simpeg_modul")->result_array();
                foreach ($modul as $row) {
                    $data1=array('id_modul'=>$row['id_modul'],
                                'id_level'=>$id);
                    array_push($modul_akses, $data1);
                }
                
               $this->model_app->insert_multiple('simpeg_modul_akses',$modul_akses);

               $menu_akses=[]; 
               $menu=$this->db->query("SELECT * FROM simpeg_menu")->result_array();
               foreach ($menu as $row1) {
                    $data2=array('id_menu'=>$row1['id_menu'],
                                'id_level'=>$id);
                    array_push($menu_akses, $data2);
                }
                $this->model_app->insert_multiple('simpeg_menu_akses',$menu_akses);
                if($simpan)
                    {
                        $this->session->set_flashdata('sukses',"Data Level Berhasil Disimpan");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Level Gagal Disimpan");
                    }
              redirect('level');
            }
            
            else
            {
        $data['akseslevel']='active';
         $data['lev']='active';
         $data['title']='Level User';
          $this->template->load('admin','admin/mod_level/tambah',$data);
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
         $data['ctrl']='level';
        if($this->session->level==1)
        {
            if(isset($_POST['edit']))
            {
                $data=array('nama_level'=>$this->input->post('level'));
                $where=array('id_level'=>$this->input->post('id'));
                $edit=$this->model_app->update('simpeg_level',$data,$where);
                if($edit)
                    {
                        $this->session->set_flashdata('sukses',"Data Level Berhasil Diedit");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Level Gagal Diedit");
                    }
                redirect('level');
            }
            
            else
            {
        $id=dekrip($this->uri->segment('3'));
         $data['akseslevel']='active';
         $data['lev']='active';
         $data['title']='Level User';
         $data['row']=$this->model_app->edit('simpeg_level',array('id_level'=>$id))->row_array();
         $this->template->load('admin','admin/mod_level/edit',$data);
            }
        }
        else
        {
            redirect('dashboard');
        }
    }


     function hapus(){
       if($this->session->level==1)
            {
                
                $where=array('id_level'=>dekrip($this->uri->segment('3')));
                $hapus=$this->model_app->delete('simpeg_level',$where);
                if($hapus)
                    {
                        $this->session->set_flashdata('sukses',"Data Level Berhasil Dihapus");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Level Gagal Dihapus");
                    }
                redirect('level');
            }
            else
        {
            redirect('dashboard');
        }
    }




} //controller