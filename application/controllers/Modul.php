<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends CI_Controller {

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
		if($this->session->level==1 AND $this->session->id_user==1)
        {
        	
      	 $data['modulmenu']='active';
         $data['modul']='active';
         $data['title']='Menu';
         $data['id_level']=$id_level;
         $data['link']=$link;
         $data['ctrl']='modul';
      	 $data['record']=$this->model_app->view_ordering('simpeg_modul','id_modul','ASC');
		 $this->template->load('admin','admin/mod_modul/modul',$data);
			
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
         $data['ctrl']='modul';
        if($this->session->level==1 AND $this->session->id_user==1)
        {
            if(isset($_POST['tambah']))
            {
                
                
                $data=array('nama_modul'=>$this->input->post('nama'),
                            'controller'=>$this->input->post('controller'),
                            'urutan'=>$this->input->post('urutan'),
                            'icon'=>$this->input->post('icon'));
                $simpan=$this->model_app->insert('simpeg_modul',$data);
                $id = $this->db->insert_id();
                $modul_akses=[]; 
                $level=$this->db->query("SELECT * FROM simpeg_level")->result_array();
                foreach ($level as $row1) {
                    $data2=array('id_modul'=>$id,
                                'id_level'=>$row1['id_level']);
                    array_push($modul_akses, $data2);
                }
                $this->model_app->insert_multiple('simpeg_modul_akses',$modul_akses);
                  if($simpan)
                    {
                        $this->session->set_flashdata('sukses',"Data Modul Berhasil Disimpan");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Modul Gagal Disimpan");
                    }
                redirect('modul');
            }
            
            else
            {
         $data['modulmenu']='active';
         $data['modul']='active';
         $data['title']='Modul';
          $this->template->load('admin','admin/mod_modul/tambah',$data);
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
        $data['ctrl']='modul';
        if($this->session->level=='1' AND $this->session->id_user==1)
        {
            if(isset($_POST['edit']))
            {
                $data=array('nama_modul'=>$this->input->post('nama'),
                            'controller'=>$this->input->post('controller'),
                            'urutan'=>$this->input->post('urutan'),
                            'icon'=>$this->input->post('icon'));
                $where=array('id_modul'=>$this->input->post('id'));
                $update=$this->model_app->update('simpeg_modul',$data,$where);
                if($update)
                    {
                        $this->session->set_flashdata('sukses',"Data Modul Berhasil Diedit");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Modul Gagal Diedit");
                    }
                redirect('modul');
            }
            
            else
            {
         $id=dekrip($this->uri->segment('3'));
         $data['modulmenu']='active';
         $data['modul']='active';
         $data['title']='Modul';
         $data['rows']=$this->model_app->edit('simpeg_modul',array('id_modul'=>$id))->row_array();
          $this->template->load('admin','admin/mod_modul/edit',$data);
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
                
                $where=array('id_modul'=>dekrip($this->uri->segment('3')));
                $this->model_app->delete('simpeg_modul',$where);
                $delete=$this->model_app->delete('simpeg_modul_akses',$where);
                if($delete)
                    {
                        $this->session->set_flashdata('sukses',"Data Modul Berhasil Dihapus");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Modul Gagal Dihapus");
                    }
                redirect('modul');
            }
            else
        {
            redirect('dashboard');
        }
    }





} //controller