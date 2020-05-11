<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
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

    

    function pengumuman(){
        $id_level=$this->session->level;
        $link='website/pengumuman';
        
        
        if(bisaBaca($link,$id_level))
        {
            
            
            $data['title']='Pengumuman';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='website';
            $data['record']=$this->model_app->view_ordering('simpeg_pengumuman','id','DESC');
            $this->template->load('admin','admin/website/pengumuman/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function pengumumantambah(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='website/pengumuman';
        
        
        $data['title']='Pengumuman';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='website';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['tambah']))
          {
            $judul=posttext('judul');
            $seo=seo_title($judul);                      
            $data=array('judul'=>$judul,
                        'seo'=>$seo,
                        'isi'=>postnumber('isi'),
                        'user'=>$user
                      );
            
            
            $simpan=$this->model_app->insert('simpeg_pengumuman',$data);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Pengumuman Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pengumuman Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          {           
            $this->template->load('admin','admin/website/pengumuman/tambah',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function pengumumanedit(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='website/pengumuman';
        
        
        $data['title']='Pengumuman';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='website';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['edit']))
          {
           
            $where=array('id'=>postnumber('id')); 
            $judul=posttext('judul');
            $seo=seo_title($judul);                      
            $data=array('judul'=>$judul,
                        'seo'=>$seo,
                        'isi'=>postnumber('isi')
                      );
            
            
            
            $simpan=$this->model_app->update('simpeg_pengumuman',$data,$where);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Pengumuman Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pengumuman Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          { 
            $id=dekrip($this->uri->segment('3'));
            $data['rows']=$this->model_app->edit('simpeg_pengumuman',array('id'=>$id))->row_array();  
            $this->template->load('admin','admin/website/pengumuman/edit',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function pengumumanhapus(){
        $id_level=$this->session->level;
        $link='website/pengumuman';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        $this->model_app->delete('simpeg_pengumuman',$id);
        $this->session->set_flashdata('sukses',"Data Pengumuman Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Pengumuman");
        redirect($link); 
        }
    }

    function pengumumanlihat(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $rows=$this->model_app->edit('simpeg_pengumuman',array('id'=>$id))->row_array();
         
        echo $rows['isi'];
        }
    }

    function sop(){
        $id_level=$this->session->level;
        $link='website/sop';
        
        
        if(bisaBaca($link,$id_level))
        {
            
            
            $data['title']='Standar Operasional Prosedur (SOP)';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='website';
            $data['record']=$this->model_app->view_ordering('simpeg_sop','id','DESC');
            $this->template->load('admin','admin/website/sop/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }


    function soptambah(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='website/sop';
        
        
        $data['title']='Standar Operasional Prosedur (SOP)';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='website';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['tambah']))
          {
            $config['upload_path'] = 'assets/img/sop/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('berkas');
            $hasil=$this->upload->data();
            $judul=posttext('judul');
            $seo=seo_title($judul);                      
            $data=array('judul'=>$judul,
                        'seo'=>$seo,
                        'berkas'=>$hasil['file_name'],
                        'user'=>$user
                      );
            
            
            $simpan=$this->model_app->insert('simpeg_sop',$data);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Standar Operasional Prosedur (SOP) Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Standar Operasional Prosedur (SOP) Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          {           
            $this->template->load('admin','admin/website/sop/tambah',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function sopedit(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='website/sop';
        
        
        $data['title']='Standar Operasional Prosedur (SOP)';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='website';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['edit']))
          {
            $config['upload_path'] = 'assets/img/sop/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('berkas');
            $hasil=$this->upload->data();
            $where=array('id'=>postnumber('id')); 
            $judul=posttext('judul');
            $seo=seo_title($judul); 
            if($hasil=='') 
            {
              $data=array('judul'=>$judul,
                        'seo'=>$seo
                      );  
            } 
            else
            {
                $data=array('judul'=>$judul,
                        'seo'=>$seo,
                        'berkas'=>$hasil['file_name']
                        
                      );
            }                   
            
            
            
            
            $simpan=$this->model_app->update('simpeg_sop',$data,$where);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Standar Operasional Prosedur (SOP) Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Standar Operasional Prosedur (SOP) Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          { 
            $id=dekrip($this->uri->segment('3'));
            $data['rows']=$this->model_app->edit('simpeg_sop',array('id'=>$id))->row_array();  
            $this->template->load('admin','admin/website/sop/edit',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function sophapus(){
        $id_level=$this->session->level;
        $link='website/sop';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        $this->model_app->delete('simpeg_sop',$id);
        $this->session->set_flashdata('sukses',"Data Standar Operasional Prosedur (SOP) Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Standar Operasional Prosedur (SOP)");
        redirect($link); 
        }
    }

    function soplihat(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $rows=$this->model_app->edit('simpeg_sop',array('id'=>$id))->row_array();
         
        echo '<object width="100%" height="400" data="'.base_url('assets/img/sop/'.$rows['berkas']).'"></object>';
        }
    }

    
function peraturan(){
        $id_level=$this->session->level;
        $link='website/peraturan';
        
        
        if(bisaBaca($link,$id_level))
        {
            
            
            $data['title']='Peraturan';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='website';
            $data['record']=$this->model_app->view_ordering('simpeg_peraturan','id','DESC');
            $this->template->load('admin','admin/website/peraturan/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }


    function peraturantambah(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='website/peraturan';
        
        
        $data['title']='Peraturan';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='website';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['tambah']))
          {
            $config['upload_path'] = 'assets/img/peraturan/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('berkas');
            $hasil=$this->upload->data();
            $judul=posttext('judul');
            $seo=seo_title($judul);                      
            $data=array('judul'=>$judul,
                        'seo'=>$seo,
                        'berkas'=>$hasil['file_name'],
                        'user'=>$user
                      );
            
            
            $simpan=$this->model_app->insert('simpeg_peraturan',$data);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Peraturan Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Peraturan Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          {           
            $this->template->load('admin','admin/website/peraturan/tambah',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function peraturanedit(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='website/peraturan';
        
        
        $data['title']='Peraturan';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='website';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['edit']))
          {
            $config['upload_path'] = 'assets/img/peraturan/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
            $config['max_size'] = '10000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('berkas');
            $hasil=$this->upload->data();
            $where=array('id'=>postnumber('id')); 
            $judul=posttext('judul');
            $seo=seo_title($judul); 
            if($hasil=='') 
            {
              $data=array('judul'=>$judul,
                        'seo'=>$seo
                      );  
            } 
            else
            {
                $data=array('judul'=>$judul,
                        'seo'=>$seo,
                        'berkas'=>$hasil['file_name']
                        
                      );
            }                   
            
            
            
            
            $simpan=$this->model_app->update('simpeg_peraturan',$data,$where);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Peraturan Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Peraturan Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          { 
            $id=dekrip($this->uri->segment('3'));
            $data['rows']=$this->model_app->edit('simpeg_peraturan',array('id'=>$id))->row_array();  
            $this->template->load('admin','admin/website/peraturan/edit',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function peraturanhapus(){
        $id_level=$this->session->level;
        $link='website/peraturan';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        $this->model_app->delete('simpeg_peraturan',$id);
        $this->session->set_flashdata('sukses',"Data Peraturan Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Peraturan");
        redirect($link); 
        }
    }

    function peraturanlihat(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $rows=$this->model_app->edit('simpeg_peraturan',array('id'=>$id))->row_array();
         
        echo '<object width="100%" height="400" data="'.base_url('assets/img/peraturan/'.$rows['berkas']).'"></object>';
        }
    }

    function tautan(){
        $id_level=$this->session->level;
        $link='website/tautan';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='website';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama'=>posttext('nama'),'url'=>posttext('url'));
                $this->model_app->insert('simpeg_tautan',$data);
                $this->session->set_flashdata('sukses',"Data Link Terkait Berhasil Disimpan");
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>$this->input->post('id'));
                $data=array('nama'=>posttext('nama'),'url'=>posttext('url'));
                $this->model_app->update('simpeg_tautan',$data,$where);
                $this->session->set_flashdata('sukses',"Data Link Terkait Berhasil Diedit");
                redirect($link);
            }
            else
            {
                $data['title']='Link Terkait';
                $data['record']=$this->model_app->view_ordering('simpeg_tautan','id','ASC');
                $this->template->load('admin','admin/website/tautan/data',$data); 
            }
           
        }
        else
        {
            redirect('home');
        }
    }

    function hapustautan($seo){
        $id_level=$this->session->level;
        $link='website/tautan';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $hapus=$this->model_app->delete('simpeg_tautan',$id);
        if($hapus)
            {
                $this->session->set_flashdata('sukses',"Data Link Terkait Berhasil Dihapus");
            }
            else
            {
                $this->session->set_flashdata('gagal',"Data Link Terkait Gagal Dihapus");
            }
        redirect($link);
        
        }
        else
        {
        redirect($link); 
        }
    }

    function edittautan(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_tautan',$id)->row_array();
         
        echo'<input type="hidden" name="id" value="'.$sql['id'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama </label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Link Terkait" value="'.$sql['nama'].'" required>
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Url</label>
                  <div class="col-sm-9">
                    <input type="text" name="url" class="form-control" placeholder="Url Link Terkait" value="'.$sql['url'].'" required>
                  </div>
            </div>';
        }
    }

} //controller