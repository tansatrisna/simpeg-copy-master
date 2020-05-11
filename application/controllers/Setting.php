<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

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
	function identitas(){
    
    $id_level=$this->session->level;
    $tahun=$this->session->tahun;
        $cabang=$this->session->cabang;
        $data['cabang']=$cabang;
        $data['tahun']=$tahun;
        $link='setting/identitas';
        $data['header']='Setting';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';

  if(bisaBaca($link,$id_level))
      {
          
		if (isset($_POST['submit'])){
            $config['upload_path'] = 'assets/img/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG';
                $config['max_size'] = '1000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('gambar');
                $hasil=$this->upload->data();
                if ($hasil['file_name']==''){
                    $data = array('kode'=>$this->input->post('kode'),
                      'instansi'=>$this->db->escape_str($this->input->post('instansi')),
                                  'nama'=>$this->db->escape_str($this->input->post('nama')),
                                  'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                                  'kota'=>$this->db->escape_str($this->input->post('kota')),
                                  'telp'=>$this->db->escape_str($this->input->post('telp')),
                                  'fax'=>$this->db->escape_str($this->input->post('fax')),
                                  'web'=>$this->db->escape_str($this->input->post('web')),
                                  'email'=>$this->db->escape_str($this->input->post('email')),
                                  'fb'=>$this->db->escape_str($this->input->post('fb')),
                                  'tw'=>$this->db->escape_str($this->input->post('tw')),
                                  'ig'=>$this->db->escape_str($this->input->post('ig')),
                                  
                                  'yt'=>$this->db->escape_str($this->input->post('yt')),
                                  'footer'=>$this->input->post('footer'),
                                  'deskripsi'=>$this->input->post('deskripsi'),
                                  'keyword'=>$this->input->post('keyword'));
                }else{
                    $data = array('kode'=>$this->input->post('kode'),
                      'instansi'=>$this->db->escape_str($this->input->post('instansi')),
                                  'nama'=>$this->db->escape_str($this->input->post('nama')),
                                  'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                                  'kota'=>$this->db->escape_str($this->input->post('kota')),
                                  'telp'=>$this->db->escape_str($this->input->post('telp')),
                                  'fax'=>$this->db->escape_str($this->input->post('fax')),
                                  'web'=>$this->db->escape_str($this->input->post('web')),
                                  'email'=>$this->db->escape_str($this->input->post('email')),
                                  'fb'=>$this->db->escape_str($this->input->post('fb')),
                                  'tw'=>$this->db->escape_str($this->input->post('tw')),
                                  'ig'=>$this->db->escape_str($this->input->post('ig')),
                                  
                                  'yt'=>$this->db->escape_str($this->input->post('yt')),
                                  'footer'=>$this->input->post('footer'),
                                  'deskripsi'=>$this->input->post('deskripsi'),
                                  'keyword'=>$this->input->post('keyword'),
                                    'logo'=>$hasil['file_name']);
                                    
                                   
                }
            $where = array('id' => $this->input->post('id'));
            $this->model_app->update('simpeg_identitas', $data, $where);
            redirect($link);
      }
      else
      {
        $data['title']='Identitas';
        $data['rows'] = $this->model_app->edit('simpeg_identitas', array('id' => 1))->row_array();
        
          $this->template->load('admin','admin/setting/identitas/data',$data);

        }
      }
    else
    {
      $this->session->set_flashdata('gagal',"Maaf, Anda Tidak Berhak Mengakses Menu Ini!!!");
      redirect('home');
    }
	}



  function user(){
     $id_level=$this->session->level;
     $tahun=$this->session->tahun;
        $cabang=$this->session->cabang;
        $data['cabang']=$cabang;
        $data['tahun']=$tahun;
        $link='setting/user';
        $data['header']='Setting';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';

  if(bisaBaca($link,$id_level))
      {
        $data['title']='Data User';
     $data['record'] = $this->model_app->view_where_ordering('simpeg_user',array('id_user !='=>1),'id_user','ASC');
     $this->template->load('admin','admin/setting/user/view_user',$data);
     }
    else
    {
      $this->session->set_flashdata('gagal',"Maaf, Anda Tidak Berhak Mengakses Menu Ini!!!");
      redirect('home');
    }
 }

 function usertambah(){

  $id_level=$this->session->level;
  $tahun=$this->session->tahun;
        $cabang=$this->session->cabang;
        $data['cabang']=$cabang;
        $data['tahun']=$tahun;
        $link='setting/user';
        $data['header']='Setting';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';

  if(bisaTulis($link,$id_level))
      {
  if (isset($_POST['submit'])){
    $salt=randomSalt();
    $pass=create_hash($this->input->post('password'),$salt);
    $config['upload_path'] = 'assets/img/user/';
    $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                    'email'=>$this->input->post('email'),
                    'hp'=>$this->input->post('hp'),
                    'level'=>$this->input->post('level'),
                    'status'=>$this->input->post('status'),
                    
                    'username'=>$this->input->post('username'),
                    'password'=>$pass,
                    'salt'=>$salt);
            }else{
                $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                    'email'=>$this->input->post('email'),
                    'hp'=>$this->input->post('hp'),
                    'level'=>$this->input->post('level'),
                    'status'=>$this->input->post('status'),
                    
                    'username'=>$this->input->post('username'),
                    'password'=>$pass,
                    'salt'=>$salt,
                    'gambar'=>$hasil['file_name']);


            }
            
            $this->model_app->insert('simpeg_user', $data);
            redirect($link);
        }
        else
        {
            $data['title']='Form Tambah User';
            $this->template->load('admin','admin/setting/user/tambah_user',$data);

        }
      }
    else
    {
      $this->session->set_flashdata('gagal',"Maaf, Anda Tidak Berhak Menambah Data!!!");
      redirect('home');
    }
  }

    function useredit(){
      
       $id_level=$this->session->level;
       $tahun=$this->session->tahun;
        $cabang=$this->session->cabang;
        $data['cabang']=$cabang;
        $data['tahun']=$tahun;
        $link='setting/user';
        $data['header']='Setting';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';

    if(bisaTulis($link,$id_level))
        {
      if (isset($_POST['submit'])){
        $salt=randomSalt();
        $pass=create_hash($this->input->post('password'),$salt);
        $config['upload_path'] = 'img/user/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
           if ($hasil['file_name']==''){
                if($this->input->post('password')=='')
                {
                $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                    'email'=>$this->input->post('email'),
                    'hp'=>$this->input->post('hp'),
                    'level'=>$this->input->post('level'),
                    'status'=>$this->input->post('status')
                    
                    
                    );
                }
                else
                {
                     $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                    'email'=>$this->input->post('email'),
                    'hp'=>$this->input->post('hp'),
                    'level'=>$this->input->post('level'),
                    'status'=>$this->input->post('status'),
                   
                   
                    'password'=>$pass,
                    'salt'=>$salt);
                }
            }else{
            if($this->input->post('password')=='')
                {
                $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                    'email'=>$this->input->post('email'),
                    'hp'=>$this->input->post('hp'),
                    'level'=>$this->input->post('level'),
                    'status'=>$this->input->post('status'),
                    
                    
                    'gambar'=>$hasil['file_name']);
            }
            else
            {
                $data = array('nama'=>$this->db->escape_str($this->input->post('nama')),
                    'email'=>$this->input->post('email'),
                    'hp'=>$this->input->post('hp'),
                    'level'=>$this->input->post('level'),
                    'status'=>$this->input->post('status'),
                    
                    
                    'password'=>$pass,
                    'salt'=>$salt,
                    'gambar'=>$hasil['file_name']);
            }


            }
            $where = array('id_user' => $this->input->post('id'));
            $this->model_app->update('simpeg_user', $data, $where);
            redirect($link);
        }
        else
        {
          $id = dekrip($this->uri->segment(3));
         $data['rows'] = $this->model_app->edit('simpeg_user', array('id_user' => $id))->row_array();
         $data['title'] = 'Form Edit User';
         $this->template->load('admin','admin/setting/user/edit_user',$data);

     }

      }
    else
    {
      $this->session->set_flashdata('gagal',"Maaf, Anda Tidak Berhak Mengedit Data!!!");
      redirect('home');
    }
 }

 function userhapus(){
        $id_level=$this->session->level;
        $link='setting/user';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id_user' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_user',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data User Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data User Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function login(){
        
      $id_level=$this->session->level;
      $tahun=$this->session->tahun;
        $cabang=$this->session->cabang;
        $data['cabang']=$cabang;
        $data['tahun']=$tahun;
      $link='setting/login';
      $data['header']='Setting';
      $data['id_level']=$id_level;
      $data['link']=$link;
      $data['ctrl']='setting';

      if(bisaBaca($link,$id_level))
      {

        
        if (isset($_POST['submit'])){
              if(bisaUbah($link,$id_level))
              {
                $config['upload_path'] = 'assets/img/bg/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG';
                $config['max_size'] = '2000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('gambar');
                $hasil=$this->upload->data();
                if ($hasil['file_name']==''){
                    $data = array('isi'=>$this->input->post('isi'),
                                  'judul'=>$this->db->escape_str($this->input->post('judul'))
                                );
                }else{
                    $data = array('isi'=>$this->input->post('isi'),
                                  'judul'=>$this->db->escape_str($this->input->post('judul')),
                                    'gambar'=>$hasil['file_name']);
                                    
                                   
                }
                $where = array('id' => $this->input->post('id'));
                $this->model_app->update('login', $data, $where);
                redirect($link);
              }
              else
              {
                redirect($link);
              }
          }

          else
          {
            $data['title']='Halaman Login';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='setting';
            $data['rows'] = $this->model_app->edit('login', array('id' => 1))->row_array();
             
              $this->template->load('admin','admin/setting/login/data',$data);

            }
   
       }
 
}

function surat(){
        
  $id_level=$this->session->level;
  $link='setting/surat';
  $data['title']='Identitas Kop Surat';
  $data['id_level']=$id_level;
  $data['link']=$link;
  $data['ctrl']='setting';

  if(bisaBaca($link,$id_level))
  {

    
    if (isset($_POST['submit'])){
          if(bisaUbah($link,$id_level))
          {
            $config['upload_path'] = 'assets/img/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG';
            $config['max_size'] = '1000'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                $data = array('header'=>$this->db->escape_str($this->input->post('header')),
                              'subheader'=>$this->db->escape_str($this->input->post('subheader')),
                              'kampus1'=>$this->db->escape_str($this->input->post('kampus1')),
                              'kampus2'=>$this->db->escape_str($this->input->post('kampus2')),
                              'kabprop'=>$this->db->escape_str($this->input->post('kabprop')),
                              'email'=>$this->db->escape_str($this->input->post('email')),
                              'website'=>$this->db->escape_str($this->input->post('website'))
                            );
            }else{
                $data = array('header'=>$this->db->escape_str($this->input->post('header')),
                'subheader'=>$this->db->escape_str($this->input->post('subheader')),
                'kampus1'=>$this->db->escape_str($this->input->post('kampus1')),
                              'kampus2'=>$this->db->escape_str($this->input->post('kampus2')),
                              'kabprop'=>$this->db->escape_str($this->input->post('kabprop')),
                'email'=>$this->db->escape_str($this->input->post('email')),
                'website'=>$this->db->escape_str($this->input->post('website')),
                'logo'=>$hasil['file_name']);
                                
                               
            }
            $where = array('id' => $this->input->post('id'));
            $this->model_app->update('kop_surat', $data, $where);
            redirect($link);
          }
          else
          {
            redirect($link);
          }
      }

      else
      {
        $data['title']='Identitas Kop Surat';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';
        $data['rows'] = $this->model_app->edit('kop_surat', array('id' => 1))->row_array();
         
          $this->template->load('admin','admin/setting/surat/data',$data);

        }

   }


}	

function tahun(){
        $id_level=$this->session->level;
        $link='setting/tahun';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
              {
                                        
                $data=array('tahun'=>postnumber('tahun'));
                
                
                $simpan=$this->model_app->insert('simpeg_tahun',$data);
                if($simpan)
                    {
                        $this->session->set_flashdata('sukses',"Data Tahun PMB Berhasil Disimpan");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Tahun PMB Gagal Disimpan");
                    }
                    redirect($link);
                 
              }
              else if(isset($_POST['edit']))
              {
               
                $where=array('id'=>postnumber('id')); 
                $data=array('tahun'=>postnumber('tahun'));
               
                
                
                
                $simpan=$this->model_app->update('simpeg_tahun',$data,$where);
                if($simpan)
                    {
                        $this->session->set_flashdata('sukses',"Data Tahun PMB Berhasil Diedit");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Tahun PMB Gagal Diedit");
                    }
                    redirect($link);
                 
              }
              else
              {
            
            $data['title']='Tahun PMB';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='setting';
            $data['record']=$this->model_app->view_ordering('simpeg_tahun','id','ASC');
            $this->template->load('admin','admin/setting/tahun/data',$data);
            }
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function tahunedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_web_tahun',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Tahun</label>
                  <div class="col-sm-9">
                    <input type="year" name="tahun"  class="form-control"  required>
                  </div>
                </div><!-- row -->
                ';
        }
    }

    function tahunhapus(){
        $id_level=$this->session->level;
        $link='setting/tahun';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        
        $this->model_app->delete('simpeg_tahun',$id);
        $this->session->set_flashdata('sukses',"Data Tahun PMB Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Tahun PMB");
        redirect($link); 
        }
    }

    function aktiftahun(){
        $data  = array('aktif' => 'Y' );
        $data1  = array('aktif' => 'T' );
        $where = array('id' => $this->uri->segment(3));
        $this->model_app->update('simpeg_tahun',$data1);
        $this->model_app->update('simpeg_tahun',$data,$where);
        redirect('setting/tahun');
    }


function email(){
     $id_level=$this->session->level;
     $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='setting/email';
        $data['header']='Setting';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';

  if(bisaBaca($link,$id_level))
      {
        $data['title']='Data Email SMTP';
     $data['record'] = $this->model_app->view_ordering('simpeg_email','id','ASC');
     $this->template->load('admin','admin/setting/email/data',$data);
     }
    else
    {
      $this->session->set_flashdata('gagal',"Maaf, Anda Tidak Berhak Mengakses Menu Ini!!!");
      redirect('home');
    }
 }

 function emailtambah(){

  $id_level=$this->session->level;
  $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='setting/email';
        $data['header']='Setting';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';

  if(bisaTulis($link,$id_level))
      {
  if (isset($_POST['submit'])){
    
                $data = array('nama'=>posttext('nama'),
                    'email'=>posttext('email'),
                    'password'=>$this->input->post('password'),
                    'subjek'=>$this->input->post('subjek'),
                    'isi'=>postnumber('isi'));
            
            
            $this->model_app->insert('simpeg_email', $data);
            redirect($link);
        }
        else
        {
            $data['title']='Form Tambah Email SMTP';
            $this->template->load('admin','admin/setting/email/tambah',$data);

        }
      }
    else
    {
      $this->session->set_flashdata('gagal',"Maaf, Anda Tidak Berhak Menambah Data!!!");
      redirect('home');
    }
  }

    function emailedit(){
      
       $id_level=$this->session->level;
       $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='setting/email';
        $data['header']='Setting';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='setting';

    if(bisaUbah($link,$id_level))
        {
      if (isset($_POST['submit'])){
        
                $data = array('nama'=>posttext('nama'),
                    'email'=>posttext('email'),
                    'password'=>$this->input->post('password'),
                    'subjek'=>$this->input->post('subjek'),
                    'isi'=>postnumber('isi'));
            

            
            $where = array('id' => $this->input->post('id'));
            $this->model_app->update('simpeg_email', $data, $where);
            redirect($link);
        }
        else
        {
          $id = dekrip($this->uri->segment(3));
         $data['rows'] = $this->model_app->edit('simpeg_email', array('id' => $id))->row_array();
         $data['title'] = 'Form Edit Email SMTP';
         $this->template->load('admin','admin/setting/email/edit',$data);

      }

      }
    else
    {
      $this->session->set_flashdata('gagal',"Maaf, Anda Tidak Berhak Mengedit Data!!!");
      redirect('home');
    }
 }

 function emailisi(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_email',array('id'=>$id))->row_array();
         
        echo $sql['isi'];
        }
    }

 function emailhapus(){
        $id_level=$this->session->level;
        $link='setting/email';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id_email' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_email',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data User Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data User Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function notifikasi(){
        $id_level=$this->session->level;
        $link='setting/notifikasi';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
              {
                                        
                $data=array('nama'=>posttext('nama'),
                            'email'=>postnumber('email'));
                
                
                $simpan=$this->model_app->insert('simpeg_notifikasi_email',$data);
                if($simpan)
                    {
                        $this->session->set_flashdata('sukses',"Data Notifikasi Email Berhasil Disimpan");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Notifikasi Email Gagal Disimpan");
                    }
                    redirect($link);
                 
              }
              else if(isset($_POST['edit']))
              {
               
                $where=array('id'=>postnumber('id')); 
               $data=array('nama'=>posttext('nama'),
                            'email'=>postnumber('email'));
               
                
                
                
                $simpan=$this->model_app->update('simpeg_notifikasi_email',$data,$where);
                if($simpan)
                    {
                        $this->session->set_flashdata('sukses',"Data Notifikasi Email Berhasil Diedit");
                    }
                    else
                    {
                        $this->session->set_flashdata('gagal',"Data Notifikasi Email Gagal Diedit");
                    }
                    redirect($link);
                 
              }
              else
              {
            
            $data['title']='Notifikasi Email';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='setting';
            $data['record']=$this->model_app->view_ordering('simpeg_notifikasi_email','id','ASC');
            $this->template->load('admin','admin/setting/notifikasi/data',$data);
            }
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function notifikasiedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_notifikasi_email',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" value="'.$sql['nama'].'" class="form-control"  required>
                  </div>
                </div>
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Email</label>
                  <div class="col-sm-9">
                    <input type="email" name="eamil" value="'.$sql['email'].'"  class="form-control"  required>
                  </div>
                </div><!-- row -->
                ';
        }
    }

    function notifikasihapus(){
        $id_level=$this->session->level;
        $link='setting/notifikasi';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        
        $this->model_app->delete('simpeg_notifikasi_email',$id);
        $this->session->set_flashdata('sukses',"Data Notifikasi Email Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Notifikasi Email");
        redirect($link); 
        }
    }

} //controller