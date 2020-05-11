<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referensi extends CI_Controller {

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
        redirect('dashboard');
    }

    function kode(){
        $id_level=$this->session->level;
        $link='referensi/kode';
        $data['title']='Kode Aplikasi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='referensi';

        if(bisaBaca($link,$id_level))
        {
            if (isset($_POST['submit']))
            {
                            
                $data = array('idxref'=>$this->input->post('kd'),
                              'referensi'=>$this->input->post('ket')
                            );
                
                $this->model_app->insert('tbrefa',$data);  
                redirect($link);
            }
            else
            {
                $data['record']=$this->model_app->view_kode();
                $this->template->load('admin','admin/referensi/kode/data',$data);
            }
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kodedetail(){
        $id_level=$this->session->level;
        $link='referensi/kode';
        $data['title']='Kode Aplikasi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='referensi';

        if(bisaBaca($link,$id_level))
        {
            if (isset($_POST['submit']))
            {
                            
                $data = array('idxref'=>$this->input->post('kd'),
                              'kderef'=>$this->input->post('kode'),
                              'nmaref1'=>$this->input->post('nmaref1'),
                              'nmaref2'=>$this->input->post('nmaref2'),
                              'nmaref3'=>$this->input->post('nmaref3'),
                              'kdedikti'=>$this->input->post('kdedikti')
                             );
                
                $this->model_app->insert('tbrefb',$data);  
                redirect('referensi/kodedetail/'.$this->input->post('kd'));
            }
            else if (isset($_POST['edit'])) 
            {
                
                $data = array('kderef'=>$this->input->post('kode'),
                              'nmaref1'=>$this->input->post('nmaref1'),
                              'nmaref2'=>$this->input->post('nmaref2'),
                              'nmaref3'=>$this->input->post('nmaref3'),
                              'kdedikti'=>$this->input->post('kdedikti'));
                $where = array('id' => $this->input->post('id'));
                $edit=$this->model_app->update('tbrefb', $data, $where);
                if($edit)
                    {
                        $this->session->set_flashdata('sukses',"Data Kode Aplikasi Berhasil Diedit");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Kode Aplikasi Gagal Diedit");
                    }
                redirect('referensi/kodedetail/'.$this->input->post('kd'));
            }
            else
            {
                $aplikasi=$this->uri->segment('3');
                $data['aplikasi']=$aplikasi;
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>$aplikasi),'id','ASC');
                $this->template->load('admin','admin/referensi/kode/detail',$data);
            }
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kodehapus(){
        $id_level=$this->session->level;
        $link='referensi/kode';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(4)));
        $hapus=$this->model_app->delete('tbrefb',$id);
        if($hapus)
            {
                $this->session->set_flashdata('sukses',"Data Kode Aplikasi Berhasil Dihapus");
            }
            else
            {
                $this->session->set_flashdata('gagal',"Data Kode Aplikasi Gagal Dihapus");
            }
        redirect('referensi/kodedetail/'.$this->uri->segment('3'));
        }
        else
        {
        redirect('referensi/kode'); 
        }
    }

    function kelompokunit(){
        $id_level=$this->session->level;
        $data['tahun']=$tahun;
        $link='referensi/kelompokunit';
        $data['header']='Referensi';
        $data['title']='Kelompok Unit';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='referensi';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $kelompok=posttext('kelompok');
                $seo=seo_title($kelompok);
                $data=array('kelompok'=>posttext('kelompok'),
                            'seo'=>$seo,
                            'urutan'=>postnumber('urutan'));
                $simpan=$this->model_app->insert('m_kelompok_unit',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Kelompok Unit Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Kelompok Unit Gagal Disimpan");  
                }
                
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));
                $kelompok=posttext('kelompok');
                $seo=seo_title($kelompok);
                $data=array('kelompok'=>posttext('kelompok'),
                            'seo'=>$seo,
                            'urutan'=>postnumber('urutan'));
                $simpan=$this->model_app->update('m_kelompok_unit',$data,$where);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Kelompok Unit Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Kelompok Unit Gagal Diedit");  
                }
                redirect($link);
            }
            else
            {
                
                    $data['record']=$this->model_app->view_ordering('m_kelompok_unit','urutan','ASC');
               
                $this->template->load('admin','admin/referensi/kelompokunit/data',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kelompokunitedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('m_kelompok_unit',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
              <label class="control-label col-sm-3">Nama Kelompok Unit</label>
              <div class="col-sm-9">
              <input type="text" class="form-control" name="kelompok" value="'.$sql['kelompok'].'" placeholder="" required>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="control-label col-sm-3">Urutan</label>
              <div class="col-sm-9">
              <input type="number"  class="form-control" name="urutan" value="'.$sql['urutan'].'" placeholder="" required>
              </div>
            </div>
                ';
        }
    }

    function kelompokunithapus(){
        $id_level=$this->session->level;
        $link='referensi/kelompokunit';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('m_kelompok_unit',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Kelompok Unit Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Kelompok Unit Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function statussdm(){
        $id_level=$this->session->level;
        $data['tahun']=$tahun;
        $link='referensi/statussdm';
        $data['header']='Referensi';
        $data['title']='Status SDM';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='referensi';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama'=>posttext('nama'),
                            'jenis'=>postnumber('jenis'));
                $simpan=$this->model_app->insert('m_status_sdm',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Status SDM Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Status SDM Gagal Disimpan");  
                }
                
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));
                $data=array('nama'=>posttext('nama'),
                            'jenis'=>postnumber('jenis'));
                $simpan=$this->model_app->update('m_status_sdm',$data,$where);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Status SDM Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Status SDM Gagal Diedit");  
                }
                redirect($link);
            }
            else
            {
                
                    $data['record']=$this->model_app->view_ordering('m_status_sdm','jenis,id','ASC');
               
                $this->template->load('admin','admin/referensi/statussdm/data',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function statussdmedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('m_status_sdm',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                                      <label class="control-label col-sm-3">Jenis SDM</label>
                                      <div class="col-sm-9">
                                      <select name="jenis" class="form-control" required="">
                                        <option value="">..::Pilih Jenis SDM</option>
                                        '.opEnum('m_status_sdm','jenis',$sql['jenis']).'
                                      </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="control-label col-sm-3">Nama Status SDM</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control" name="nama" value="'.$sql['nama'].'" placeholder="" required>
                                      </div>
                                    </div>
                ';
        }
    }

    function statussdmhapus(){
        $id_level=$this->session->level;
        $link='referensi/statussdm';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('m_status_sdm',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Status SDM Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Status SDM Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }
    

    public function getKab() { 
      $postData = $this->input->post();
      // load model 
       
    // get data 
    $data = getKab($postData);
    echo json_encode($data);
    }

    public function getKec(){ 
    // POST data 
    $postData = $this->input->post();

    // load model 
      
    // get data 
    $data = getKec($postData);
    echo json_encode($data); 
    }

    public function getStatusSdm(){ 
    // POST data 
    $postData = $this->input->post();

    // load model 
      
    // get data 
    $data = getStatusSdm($postData);
    echo json_encode($data); 
    }

    public function getSdmJenis(){ 
    // POST data 
    $postData = $this->input->post();

    // load model 
      
    // get data 
    $data = getSdmJenis($postData);
    echo json_encode($data); 
    }
    
   
    
    
    


} //controller