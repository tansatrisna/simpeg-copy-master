<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pmb extends CI_Controller {

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

    function periode(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/periode';
        $data['title']='Tahun Akademik';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            $data['record']=$this->model_app->view_ordering('m_tahun','tahun_id','DESC');
            $this->template->load('admin','admin/simpeg/periode/data',$data);  
        }
        else
        {
            redirect('dashboard');
        }
    }

    
    

    function periodedetail(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/periode';
        $data['title']='Tahun Akademik';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            
            $id=dekrip($this->uri->segment('3'));
            $data['rows']=$this->model_app->edit('m_tahun',array('tahun_id'=>$id))->row_array();
            $this->template->load('admin','admin/simpeg/periode/detail',$data);
                        
        }
        else
        {
            redirect('dashboard');
        }
    }

    function jalur(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/jalur';
        $data['title']='Jalur Pendaftaran';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if (isset($_POST['tambah']))
            {
                            
                $data = array('idxref'=>'JALMASUK',
                              'kderef'=>$this->input->post('kode'),
                              'nmaref1'=>$this->input->post('nmaref1')
                             );
                
                $simpan=$this->model_app->insert('tbrefb',$data); 
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Jalur Pendaftaran Berhasil Disimpan"); 
                } 
                else
                {
                    $this->session->set_flashdata('gagal',"Data Jalur Pendaftaran Gagal Disimpan"); 
                }
                redirect($link);
            }
            else if (isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));         
                $data = array('kderef'=>$this->input->post('kode'),
                              'nmaref1'=>$this->input->post('nmaref1')
                             );
                
                $simpan=$this->model_app->update('tbrefb',$data,$where); 
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Jalur Pendaftaran Berhasil Diedit"); 
                } 
                else
                {
                    $this->session->set_flashdata('gagal',"Data Jalur Pendaftaran Gagal Diedit"); 
                } 
                redirect($link);
            }
            else
            {
            $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'JALMASUK'),'kderef','ASC');
            $this->template->load('admin','admin/simpeg/jalur/data',$data);  
            }
        }
        else
        {
            redirect('dashboard');
        }
    }


    function jaluredit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('tbrefb',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
                
                    <div class="form-group row">
                      <label class="control-label col-sm-3">Kode</label>
                      <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode" value="'.$sql['kderef'].'" placeholder="" >
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label col-sm-3">Nama</label>
                      <div class="col-sm-9">
                      <input type="text"  class="form-control" name="nmaref1" value="'.$sql['nmaref1'].'" placeholder="" >
                      </div>
                    </div>
                ';
        }
    }

    function jalurhapus(){
        $id_level=$this->session->level;
        $link='simpeg/jalur';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        
        $hapus=$this->model_app->delete('tbrefb',$id);
            if($hapus)
            {
            $this->session->set_flashdata('sukses',"Data Jalur Pendaftaran Berhasil Dihapus");
            }
            else
            {
            $this->session->set_flashdata('sukses',"Data Jalur Pendaftaran Berhasil Dihapus"); 
            }
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Pagu Penerimaan Prodi ");
        redirect($link); 
        }
    }

    function paguprodi(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/paguprodi';
        $data['title']='Pagu Penerimaan per Prodi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('prodi'=>postnumber('prodi'),
                            'daya_tampung'=>postnumber('dayatampung'),
                            'tahun_id'=>$this->session->tahun_id,
                            'gelombang'=>$this->session->gelombang,
                            'jalur_masuk'=>$this->session->jalur,
                            'sistem_kuliah'=>$this->session->sistem_kuliah);
                $this->model_app->insert('simpeg_pagu_prodi',$data);
                $this->session->set_flashdata('sukses',"Selamat Data Pagu Penerimaan Prodi Berhasil Disimpan");
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));
                $data=array('prodi'=>postnumber('prodi'),
                            'daya_tampung'=>postnumber('dayatampung'));
                $this->model_app->update('simpeg_pagu_prodi',$data,$where);
                $this->session->set_flashdata('sukses',"Selamat Data Pagu Penerimaan Prodi Berhasil Diedit");
                redirect($link);
            }
            else
            {
                if(isset($_POST['filter']))
                {
                    $this->session->set_userdata(array('tahun_id'=>postnumber('tahun_id'),'gelombang'=>postnumber('gelombang'),'jalur'=>postnumber('jalur'),'sistem_kuliah'=>postnumber('sistem_kuliah')));
                }
                $tahun_id=$this->session->tahun_id;
                if($tahun_id=='')
                {
                    $tahun_id=tahunTerakhir();
                }
                $gelombang=$this->session->gelombang;
                $jalur=$this->session->jalur;
                $sistem_kuliah=$this->session->sistem_kuliah;
                $data['tahun_id']=$tahun_id;
                $data['gelombang']=$gelombang;
                $data['jalur']=$jalur;
                $data['sistem_kuliah']=$sistem_kuliah;
                $data['record']=$this->model_app->view_where_ordering('simpeg_pagu_prodi',array('tahun_id'=>$tahun_id,'gelombang'=>$gelombang,'jalur_masuk'=>$jalur,'sistem_kuliah'=>$sistem_kuliah),'tahun_id','DESC');
                $this->template->load('admin','admin/simpeg/pagu/data',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function paguprodiedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_pagu_prodi',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Program Studi</label>
                  <div class="col-sm-9">
                    <select name="prodi" class="form-control" required>
                      '.opPaguProdi($tahun_id,$gelombang,$jalur,$sistem_kuliah,$sql['prodi']).'
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Daya Tampung</label>
                  <div class="col-sm-9">
                    <input type="number" name="dayatampung" value="'.$sql['daya_tampung'].'" class="form-control"  required>
                  </div>
                </div>
                ';
        }
    }

    function paguprodihapus(){
        $id_level=$this->session->level;
        $link='simpeg/paguprodi';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        
        $this->model_app->delete('simpeg_pagu_prodi',$id);
        $this->session->set_flashdata('sukses',"Data Pagu Penerimaan Prodi Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Pagu Penerimaan Prodi ");
        redirect($link); 
        }
    }


    function fakultas(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/fakultas';
        $data['title']='Fakultas';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {

            
                $data['record']=$this->model_app->view_ordering('m_fakultas','kode_fakultas','ASC');
                $this->template->load('admin','admin/simpeg/fakultas/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function fakultastambah(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/fakultas';
        $data['title']='Fakultas';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $config['upload_path'] = 'assets/img/fakultas/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG|jpeg';
                $config['max_size'] = '3000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('logo');
                $hasil=$this->upload->data();

                if($hasil['file_name']!='')
                {
                     $data=array( 'kode_fakultas'=>$this->input->post('kode'),
                               'nama_fakultas'=>$this->db->escape_str($this->input->post('nama')),
                              'nama_en'=>$this->db->escape_str($this->input->post('nama_en')),
                              'singkatan'=>$this->db->escape_str($this->input->post('singkatan')),
                              'dekan'=>$this->input->post('dekan'),
                              'wd1'=>$this->input->post('wd1'),
                              'wd2'=>$this->input->post('wd2'),
                              'wd3'=>$this->input->post('wd3'),
                              'website'=>$this->input->post('website'),
                              'email'=>$this->input->post('email'),
                              'telp'=>$this->input->post('telp'),
                              'logo'=>$hasil['file_name']
                             );
                }
                else
                {
                     $data=array( 'kode_fakultas'=>$this->input->post('kode'),
                               'nama_fakultas'=>$this->db->escape_str($this->input->post('nama')),
                              'nama_en'=>$this->db->escape_str($this->input->post('nama_en')),
                              'singkatan'=>$this->db->escape_str($this->input->post('singkatan')),
                              'dekan'=>$this->input->post('dekan'),
                              'wd1'=>$this->input->post('wd1'),
                              'wd2'=>$this->input->post('wd2'),
                              'wd3'=>$this->input->post('wd3'),
                              'website'=>$this->input->post('website'),
                              'email'=>$this->input->post('email'),
                              'telp'=>$this->input->post('telp')
                             );
                }
                

                $simpan=$this->model_app->insert('m_fakultas',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Fakultas Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Fakultas Gagal Disimpan");
                }
                redirect($link);
            }
            else
            {
              //  $data['row']=$this->model_app->edit('m_fakultas',array('kode_fakultas'=>$this->uri->segment('3')))->row_array();
                $this->template->load('admin','admin/simpeg/fakultas/tambah',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function fakultasedit(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/fakultas';
        $data['title']='Fakultas';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                $config['upload_path'] = 'assets/img/fakultas/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|swf|PNG|jpeg';
                $config['max_size'] = '3000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('logo');
                $hasil=$this->upload->data();

                $where= array('kode_fakultas'=>$this->input->post('kode'));
                $simpan=array( 'nama_fakultas'=>$this->db->escape_str($this->input->post('nama')),
                              'nama_en'=>$this->db->escape_str($this->input->post('nama_en')),
                              'singkatan'=>$this->db->escape_str($this->input->post('singkatan')),
                              'dekan'=>$this->input->post('dekan'),
                              'wd1'=>$this->input->post('wd1'),
                              'wd2'=>$this->input->post('wd2'),
                              'wd3'=>$this->input->post('wd3'),
                              'website'=>$this->input->post('website'),
                              'email'=>$this->input->post('email'),
                              'telp'=>$this->input->post('telp')
                             );

               $update= $this->model_app->update('m_fakultas',$simpan,$where);
                if($hasil['file_name']!='')
                {
                    $logo=array('logo'=>$hasil['file_name']);
                    $this->model_app->update('m_fakultas',$logo,$where);
                }

                if($update)
                {
                    $this->session->set_flashdata('sukses',"Data Fakultas Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Fakultas Gagal Diedit");
                }
                redirect($link);


            }
            else
            {
                $kode=dekrip($this->uri->segment('3'));
                $data['row']=$this->model_app->edit('m_fakultas',array('kode_fakultas'=>$kode))->row_array();
                $this->template->load('admin','admin/simpeg/fakultas/edit',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function fakultasdetail(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/fakultas';
        $data['title']='Fakultas';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaUbah($link,$id_level))
        {
        
            $kode=dekrip($this->uri->segment('3'));
            $data['row']=$this->model_app->edit('m_fakultas',array('kode_fakultas'=>$kode))->row_array();
            $this->template->load('admin','admin/simpeg/fakultas/detail',$data);  
           
        }
        else
        {
            redirect($link);
        }
    }

    function fakultashapus(){
        $id_level=$this->session->level;
        $link='simpeg/fakultas';

        if(bisaHapus($link,$id_level))
        {
        $where = array('kode_fakultas' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('m_fakultas',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Fakultas Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Fakultas Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function fakultasprodi(){
        if(isset($_POST['rowid']))
        {
        $fak = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $rows=$this->model_app->view_where_ordering('m_program_studi',array('kode_fak'=>$fak),'kode_prodi','ASC');
         
        echo'<div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered width-full">
                                 <thead>
                                  <tr>
                                    
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Jenjang</th>
                                    <th>Ketua</th>
                                    <th>Akr</th>
                                    <th>Gelar</th>
                                    
                                    
                                   
                                  </tr>
                                </thead>
                                <tbody>';
                                  
                                 
                                  foreach ($rows as $row) {
                                    $no++;
                                   echo '<tr>
                                         
                                          <td>'.$row['kode_prodi'].'</td>
                                          <td>'.$row['nama_prodi'].'</td>
                                          <td>'.viewKodeApp('JENJPEND',$row['kode_jenjang']).'</td>
                                          <td>'.viewDosen($row['ketua_prodi']).'</td>
                                          <td>'.viewKodeApp('AKREDITASI',$row['kode_akreditasi']).'</td>
                                          <td>'.$row['gelar'].'</td>
                                          
                                          
                                          
                                          </tr>';
                                  }
                                 
                                  
                             echo'   </tbody>
                                 
                                </table>
                            </div>';
        }
    }



    function prodi(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/prodi';
        $data['title']='Program Studi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
                if(isset($_POST['fak']))
                {
                    $this->session->set_userdata(array('fak'=>$this->input->post('fak')));
                }

                $fak=$this->session->fak;
                $data['fak']=$fak;
            
                $data['record']=$this->model_app->view_where_ordering('m_program_studi',array('kode_fak'=>$fak),'kode_prodi','ASC');
                $this->template->load('admin','admin/simpeg/prodi/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function proditambah(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/prodi';
        $data['title']='Program Studi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaTulis($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                
                
                $data = array('kode_prodi'=>$this->input->post('kode_prodi'),
                              'kode_fak'=>$this->input->post('kode_fak'),
                              'kode_jenjang'=>$this->db->escape_str($this->input->post('kode_jenjang')),
                              'nama_prodi'=>$this->db->escape_str($this->input->post('nama_prodi')),
                              'nama_en'=>$this->db->escape_str($this->input->post('nama_en')),
                              'singkatan'=>$this->db->escape_str($this->input->post('singkatan')),
                              'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                              'kode_kabupaten'=>$this->db->escape_str($this->input->post('kode_kabupaten')),
                              'kode_pos'=>$this->db->escape_str($this->input->post('kode_pos')),
                              'telepon'=>$this->db->escape_str($this->input->post('telepon')),
                              'fax'=>$this->db->escape_str($this->input->post('fax')),
                              'email'=>$this->db->escape_str($this->input->post('email')),
                              'website'=>$this->db->escape_str($this->input->post('website')),
                              'status_prodi'=>$this->db->escape_str($this->input->post('status_prodi')),
                              'tgl_awal_berdiri'=>$this->db->escape_str($this->input->post('tgl_awal_berdiri')),
                              'no_sk_dikti'=>$this->db->escape_str($this->input->post('no_sk_dikti')),
                              'tgl_sk_dikti'=>$this->db->escape_str($this->input->post('tgl_sk_dikti')),
                              'tgl_akhir_sk_dikti'=>$this->db->escape_str($this->input->post('tgl_akhir_sk_dikti')),
                              'no_sk_ban'=>$this->db->escape_str($this->input->post('no_sk_ban')),
                              'tgl_sk_ban'=>$this->db->escape_str($this->input->post('tgl_sk_ban')),
                              'tgl_akhir_sk_ban'=>$this->db->escape_str($this->input->post('tgl_akhir_sk_ban')),
                              'kode_akreditasi'=>$this->db->escape_str($this->input->post('kode_akreditasi')),
                              'ketua_prodi'=>$this->db->escape_str($this->input->post('ketua_prodi')),
                              'sekpro'=>$this->db->escape_str($this->input->post('sekpro')),
                              'gelar'=>$this->db->escape_str($this->input->post('gelar')),
                              'gelar_panjang'=>$this->db->escape_str($this->input->post('gelar_panjang')),
                              'kode_nim'=>$this->db->escape_str($this->input->post('kode_nim')),
                              'h2h'=>$this->db->escape_str($this->input->post('h2h'))
                             );

                $update=$this->model_app->insert('m_program_studi',$data);

                if($update)
                {
                    $this->session->set_flashdata('sukses',"Data Program Studi Berhasil Ditambah");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Program Studi Gagal Ditambah");
                }
                redirect($link);
                


            }
            else
            {
                //$prodi=dekrip($this->uri->segment('3'));
              //  $data['rows']=$this->model_app->edit('m_program_studi',array('kode_prodi'=>$prodi))->row_array();
                $this->template->load('admin','admin/simpeg/prodi/tambah',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function prodiedit(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/prodi';
        $data['title']='Program Studi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                
                $where= array('kode_prodi'=>$this->input->post('kode_prodi'));
                $data = array('kode_jenjang'=>$this->db->escape_str($this->input->post('kode_jenjang')),
                              'nama_prodi'=>$this->db->escape_str($this->input->post('nama_prodi')),
                              'nama_en'=>$this->db->escape_str($this->input->post('nama_en')),
                              'singkatan'=>$this->db->escape_str($this->input->post('singkatan')),
                              'alamat'=>$this->db->escape_str($this->input->post('alamat')),
                              'kode_kabupaten'=>$this->db->escape_str($this->input->post('kode_kabupaten')),
                              'kode_pos'=>$this->db->escape_str($this->input->post('kode_pos')),
                              'telepon'=>$this->db->escape_str($this->input->post('telepon')),
                              'fax'=>$this->db->escape_str($this->input->post('fax')),
                              'email'=>$this->db->escape_str($this->input->post('email')),
                              'website'=>$this->db->escape_str($this->input->post('website')),
                              'status_prodi'=>$this->db->escape_str($this->input->post('status_prodi')),
                              'tgl_awal_berdiri'=>$this->db->escape_str($this->input->post('tgl_awal_berdiri')),
                              'no_sk_dikti'=>$this->db->escape_str($this->input->post('no_sk_dikti')),
                              'tgl_sk_dikti'=>$this->db->escape_str($this->input->post('tgl_sk_dikti')),
                              'tgl_akhir_sk_dikti'=>$this->db->escape_str($this->input->post('tgl_akhir_sk_dikti')),
                              'no_sk_ban'=>$this->db->escape_str($this->input->post('no_sk_ban')),
                              'tgl_sk_ban'=>$this->db->escape_str($this->input->post('tgl_sk_ban')),
                              'tgl_akhir_sk_ban'=>$this->db->escape_str($this->input->post('tgl_akhir_sk_ban')),
                              'kode_akreditasi'=>$this->db->escape_str($this->input->post('kode_akreditasi')),
                              'ketua_prodi'=>$this->db->escape_str($this->input->post('ketua_prodi')),
                              'sekpro'=>$this->db->escape_str($this->input->post('sekpro')),
                              'gelar'=>$this->db->escape_str($this->input->post('gelar')),
                              'gelar_panjang'=>$this->db->escape_str($this->input->post('gelar_panjang')),
                              'kode_nim'=>$this->db->escape_str($this->input->post('kode_nim')),
                              'h2h'=>$this->db->escape_str($this->input->post('h2h'))
                             );

                $update=$this->model_app->update('m_program_studi',$data,$where);

                if($update)
                {
                    $this->session->set_flashdata('sukses',"Data Program Studi Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Program Studi Gagal Diedit");
                }
                redirect($link);
                
                redirect($link);


            }
            else
            {
                $prodi=dekrip($this->uri->segment('3'));
                $data['rows']=$this->model_app->edit('m_program_studi',array('kode_prodi'=>$prodi))->row_array();
                $this->template->load('admin','admin/simpeg/prodi/edit',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }


    function prodidetail(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/prodi';
        $data['title']='Program Studi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            
                $prodi=dekrip($this->uri->segment('3'));
                $data['rows']=$this->model_app->edit('m_program_studi',array('kode_prodi'=>$prodi))->row_array();
                $this->template->load('admin','admin/simpeg/prodi/detail',$data);  
           
        }
        else
        {
            redirect($link);
        }
    }

    function prodihapus(){
        $id_level=$this->session->level;
        $link='simpeg/prodi';

        if(bisaHapus($link,$id_level))
        {
        $where = array('kode_prodi' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('m_program_studi',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Prodi Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Prodi Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function gelombang(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/gelombang';
        $data['title']='Periode/ Gelombang Pendaftaran';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('gelombang'=>postnumber('gelombang'),
                            'tahun_id'=>$this->session->tahun_id,
                            'jalur_masuk'=>$this->session->jalur,
                            'sistem_kuliah'=>$this->session->sistem_kuliah,
                            'tgl_awal_daftar'=>postnumber('tgl_awal_daftar'),
                            'tgl_akhir_daftar'=>postnumber('tgl_akhir_daftar'),
                            'tgl_awal_ujian'=>postnumber('tgl_awal_ujian'),
                            'tgl_akhir_ujian'=>postnumber('tgl_akhir_ujian'),
                            'sistem_ujian'=>postnumber('sistem_ujian'),
                            'lokasi'=>posttext('lokasi'));
                $simpan=$this->model_app->insert('simpeg_periode_daftar',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Gelombang/ Periode Pendaftaran Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Gelombang/ Periode Pendaftaran Gagal Disimpan");  
                }
                
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));
                $data=array('gelombang'=>postnumber('gelombang'),
                            'tgl_awal_daftar'=>postnumber('tgl_awal_daftar'),
                            'tgl_akhir_daftar'=>postnumber('tgl_akhir_daftar'),
                            'tgl_awal_ujian'=>postnumber('tgl_awal_ujian'),
                            'tgl_akhir_ujian'=>postnumber('tgl_akhir_ujian'),
                            'sistem_ujian'=>postnumber('sistem_ujian'),
                            'lokasi'=>posttext('lokasi'));
                $simpan=$this->model_app->update('simpeg_periode_daftar',$data,$where);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Gelombang/ Periode Pendaftaran Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Gelombang/ Periode Pendaftaran Gagal Diedit");  
                }
                redirect($link);
            }
            else
            {
                if(isset($_POST['filter']))
                {
                    $this->session->set_userdata(array('tahun_id'=>postnumber('tahun_id'),'jalur'=>postnumber('jalur'),'sistem_kuliah'=>postnumber('sistem_kuliah')));
                }
                $tahun_id=$this->session->tahun_id;
                if($tahun_id=='')
                {
                    $tahun_id=tahunTerakhir();
                }
                $jalur=$this->session->jalur;
                $sistem_kuliah=$this->session->sistem_kuliah;
                $data['tahun_id']=$tahun_id;
                $data['jalur']=$jalur;
                $data['sistem_kuliah']=$sistem_kuliah;
                if($jalur=='' AND $sistem_kuliah=='')
                {
                $data['record']=$this->model_app->view_where_ordering('simpeg_periode_daftar',array('tahun_id'=>$tahun_id),'tahun_id','DESC');
                }
                else if($jalur!='' AND $sistem_kuliah=='')
                {
                    $data['record']=$this->model_app->view_where_ordering('simpeg_periode_daftar',array('tahun_id'=>$tahun_id,'jalur_masuk'=>$jalur),'tahun_id','DESC');
                }
                else if($jalur=='' AND $sistem_kuliah!='')
                {
                    $data['record']=$this->model_app->view_where_ordering('simpeg_periode_daftar',array('tahun_id'=>$tahun_id,'sistem_kuliah'=>$sistem_kuliah),'tahun_id','DESC');
                }
                else
                {
                    $data['record']=$this->model_app->view_where_ordering('simpeg_periode_daftar',array('tahun_id'=>$tahun_id,'jalur_masuk'=>$jalur,'sistem_kuliah'=>$sistem_kuliah),'tahun_id','DESC');
                }
                $this->template->load('admin','admin/simpeg/gelombang/data',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function gelombangedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_periode_daftar',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label">Gelombang</label>
                  <div class="col-sm-9">
                    <select name="gelombang" class="form-control" required>
                      '.opGelombangPeriode($sql['tahun_id'],$sql['jalur'],$sql['sistem_kuliah'],$sql['gelombang']).'
                    </select>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Tanggal Awal Pendaftaran</label>
                  <div class="col-sm-9">
                    <input type="date" name="tgl_awal_daftar"  class="form-control" value="'.$sql['tgl_awal_daftar'].'"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Tanggal Akhir Pendaftaran</label>
                  <div class="col-sm-9">
                    <input type="date" name="tgl_akhir_daftar" class="form-control" value="'.$sql['tgl_akhir_daftar'].'"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Tanggal Awal Ujian</label>
                  <div class="col-sm-9">
                    <input type="date" name="tgl_awal_ujian" class="form-control" value="'.$sql['tgl_awal_ujian'].'"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Tanggal Akhir Ujian</label>
                  <div class="col-sm-9">
                    <input type="date" name="tgl_akhir_ujian" class="form-control" value="'.$sql['tgl_akhir_ujian'].'"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Sistem Ujian</label>
                  <div class="col-sm-9">
                    <select name="sistem_ujian" class="form-control" required>
                      '.opEnum('simpeg_periode_daftar','sistem_ujian',$sql['sistem_ujian']).'
                    </select>
                  </div>
                </div><!-- row -->
                 <div class="form-group row">
                  <label class="col-sm-3 control-label ">Lokasi Ujian</label>
                  <div class="col-sm-9">
                    <input type="text" name="lokasi" class="form-control" value="'.$sql['lokasi'].'"  required>
                  </div>
                </div><!-- row -->
                ';
        }
    }

    function gelombanghapus(){
        $id_level=$this->session->level;
        $link='simpeg/gelombang';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_periode_daftar',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Gelombang/ Periode Pendaftaran Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Gelombang/ Periode Pendaftaran Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function jadwal(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/gelombang';
        $data['title']='Jadwal Ujian';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $id=postnumber('id');
                $data=array('id_periode'=>$id,
                            'tanggal'=>postnumber('tanggal'),
                            'waktu'=>posttext('waktu'),
                            'kegiatan'=>posttext('kegiatan'));
                $this->model_app->insert('simpeg_jadwal_ujian',$data);
                redirect('simpeg/jadwal/'.enkrip($id));
            }
            else if(isset($_POST['edit']))
            {
                $id=postnumber('id_periode');
                $where=array('id'=>postnumber('id'));
                $data=array('tanggal'=>postnumber('tanggal'),
                            'waktu'=>posttext('waktu'),
                            'kegiatan'=>posttext('kegiatan'));
                $this->model_app->update('simpeg_jadwal_ujian',$data,$where);
                redirect('simpeg/jadwal/'.enkrip($id));
            }
            else if(isset($_POST['tambahper']))
            {
                $id=postnumber('id');
                $data=array('id_periode'=>$id,
                            'perhatian'=>posttext('perhatian'));
                $this->model_app->insert('simpeg_jadwal_perhatian',$data);
                redirect('simpeg/jadwal/'.enkrip($id));
            }
            else if(isset($_POST['editper']))
            {
                $id=postnumber('id_periode');
                $where=array('id'=>postnumber('id'));
                $data=array('perhatian'=>postnumber('perhatian'));
                $this->model_app->update('simpeg_jadwal_perhatian',$data,$where);
                redirect('simpeg/jadwal/'.enkrip($id));
            }
            else
            {
            $id_periode=dekrip($this->uri->segment('3'));
            $data['rows']=$this->model_app->edit('simpeg_periode_daftar',array('id'=>$id_periode))->row_array();
            $data['jadwal']=$this->model_app->view_where_ordering('simpeg_jadwal_ujian',array('id_periode'=>$id_periode),'id','ASC');
            $data['perhatian']=$this->model_app->view_where_ordering('simpeg_jadwal_perhatian',array('id_periode'=>$id_periode),'id','ASC');
            $this->template->load('admin','admin/simpeg/gelombang/jadwal',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function jadwaledit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_jadwal_ujian',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="id_periode" value="'.$sql['id_periode'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Tanggal</label>
                  <div class="col-sm-9">
                    <input type="date" name="tanggal" value="'.$sql['tanggal'].'" class="form-control"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Waktu</label>
                  <div class="col-sm-9">
                    <input type="text" name="waktu" value="'.$sql['waktu'].'" class="form-control"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Kegiatan</label>
                  <div class="col-sm-9">
                    <input type="text" name="kegiatan" value="'.$sql['kegiatan'].'" class="form-control"  required>
                  </div>
                </div><!-- row -->
                ';
        }
    }

    function perhatianedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_jadwal_perhatian',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <input type="hidden" name="id_periode" value="'.$sql['id_periode'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Perhatian</label>
                  <div class="col-sm-9">
                    <textarea name="perhatian" class="form-control" required>'.$sql['perhatian'].'</textarea>
                  </div>
                </div><!-- row -->

                
                ';
        }
    }

    function jadwalhapus(){
        $id_level=$this->session->level;
        $link='simpeg/gelombang';

        if(bisaHapus($link,$id_level))
        {
        $row=$this->model_app->edit('simpeg_jadwal_ujian',$where)->row_array();
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_jadwal_ujian',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Jadwal Ujian Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Jadwal Ujian Gagal Dihapus");
                }

        redirect('simpeg/jadwal/'.enkrip($row['id_periode']));
        }
        else
        {
        redirect($link); 
        }
    }

    function perhatianhapus(){
        $id_level=$this->session->level;
        $link='simpeg/gelombang';

        if(bisaHapus($link,$id_level))
        {
        $row=$this->model_app->edit('simpeg_jadwal_perhatian',$where)->row_array();
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_jadwal_perhatian',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Perhatian Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Perhatian Gagal Dihapus");
                }

        redirect('simpeg/jadwal/'.enkrip($row['id_periode']));
        }
        else
        {
        redirect($link); 
        }
    }

    function sekolah(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/sekolah';
        $data['title']='Data Sekolah';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            
                if(isset($_POST['filter']))
                {
                    $this->session->set_userdata(array('prop'=>postnumber('prop'),'kab'=>postnumber('kab'),'kec'=>postnumber('kec')));
                }
                $prop=$this->session->prop;
                if($prop=='')
                {
                    $prop='07';
                }
                $kab=$this->session->kab;
                $kec=$this->session->kec;
                $data['kab']=$kab;
                $data['kec']=$kec;
                $data['prop']=$prop;
                if($kec=='')
                {
                    $data['record']=$this->model_app->view_where_ordering('r_slta',array('KDEPRO'=>$prop,'KDEKKB'=>$kab),'NMASLTA','ASC');
                }
                else
                {
                    $data['record']=$this->model_app->view_where_ordering('r_slta',array('KDEPRO'=>$prop,'KDEKKB'=>$kab,'KDEKEC'=>$kec),'NMASLTA','ASC'); 
                }
                
                $this->template->load('admin','admin/simpeg/sekolah/data',$data); 
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function syarat(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/syarat';
        $data['title']='Syarat Administrasi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('syarat'=>postnumber('syarat'),
                            'jalur'=>postnumber('jalur'),
                            'tahun_id'=>$this->session->tahun_id);
                $simpan=$this->model_app->insert('simpeg_syarat_administrasi',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Syarat Administrasi Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Syarat Administrasi Gagal Disimpan");  
                }
                
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));
                $data=array('syarat'=>postnumber('syarat'),
                            'jalur'=>postnumber('jalur'));
                $simpan=$this->model_app->update('simpeg_syarat_administrasi',$data,$where);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Syarat Administrasi Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Syarat Administrasi Gagal Diedit");  
                }
                redirect($link);
            }
            else
            {
                if(isset($_POST['filter']))
                {
                    $this->session->set_userdata(array('tahun_id'=>postnumber('tahun_id')));
                }
                $tahun_id=$this->session->tahun_id;
                if($tahun_id=='')
                {
                    $tahun_id=tahunTerakhir();
                }
                $data['tahun_id']=$tahun_id;
                
                $data['record']=$this->model_app->view_where_ordering('simpeg_syarat_administrasi',array('tahun_id'=>$tahun_id),'jalur','ASC');
                $this->template->load('admin','admin/simpeg/syarat/administrasi',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function syaratedit(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/syarat';
        $data['title']='Syarat Administrasi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaUbah($link,$id_level))
        {
            $id=dekrip($this->uri->segment('3'));
                
                $data['rows']=$this->model_app->edit('simpeg_syarat_administrasi',array('id'=>$id))->row_array();
                $this->template->load('admin','admin/simpeg/syarat/edit',$data); 
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function syaratlihat(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_syarat_administrasi',array('id'=>$id))->row_array();
         
        echo $sql['syarat'];
        }
    }

    function syarathapus(){
        $id_level=$this->session->level;
        $link='simpeg/syarat';

        if(bisaHapus($link,$id_level))
        {
        
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_syarat_administrasi',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Perhatian Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Perhatian Gagal Dihapus");
                }

            redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function pendaftar(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pendaftar';
        $data['title']='Daftar Calon Mahasiswa Baru';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
             if(isset($_POST['edit']))
            {
                $kodetrx=postnumber('kodetrx');
                $where=array('id_pendaftaran'=>postnumber('id'));
                $data=array('kodetrx'=>$kodetrx,
                            'status'=>'Y',
                            'user'=>$this->session->id_user);
                $cek=cekKodetrx($kodetrx);
                
                    if($cek==0)
                    {
                                $simpan=$this->model_app->update('simpeg_biodata',$data,$where);
                                if($simpan)
                          {
                            $bio=$this->model_app->edit('simpeg_biodata',$where)->row_array();
                            $smtp=$this->model_app->edit('simpeg_email', array('id'=>4))->row_array();
                            $terima=$bio['email'];
                              $pesan='<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
                              <tr>
                                <td style="padding: 10px 0 30px 0;">
                                  <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                                    <tr>
                                      <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                        <img src="'.base_url('assets/img/'.identitas('logo')).'" alt="Logo IAKN"  height="80" style="display: block;" /><br>PENERIMAAN MAHASISWA BARU<br>IAKN TARUTUNG
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="center" bgcolor="#EA2027" style="padding: 40px 0 30px 0; color: #FFFFFF; font-size: 36px; font-weight: bold; font-family: Arial, sans-serif;">
                                        BUKTI BAYAR ANDA<br>TELAH KAMI VERIFIKASI
                                      </td>
                                    </tr>
                                    <tr>
                                      <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                            <td  style="color: #000000; font-family: Arial, sans-serif; font-size: 24px; text-align: center;">
                                              <b>Kpd Yth.<span style="color: #EA2027;">'.$bio['nama'].'</span><br>JALUR PENDAFTARAN : <span style="color: #EA2027;">'.strtoupper(viewKodeApp('JALMASUK',$bio['jalur_masuk'])).'</span><br>TERIMAKASIH SUDAH MENDAFTAR SEBAGAI <br>MAHASISWA BARU <br><span style="color: #EA2027;" >DI IAKN TARUTUNG</span><br>EMAIL : <span style="color: ##0652DD;">'.$bio['email'].'</span></b>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td bgcolor="#ED4C67" style="padding: 20px 0 30px 0; color: #ffffff; font-family: Arial, sans-serif; font-size: 22px; line-height: 26px; text-align: center;">
                                                KAMI SUDAH VERIFIKASI BUKTI PEMBAYARAN ANDA ! SEKARANG , SILAHKAN LOGIN KEMBALI KE PMB.IAKNTARUTUNG.AC.ID UNTUK PENGISIAN BIODATA SAMPAI DENGAN  PENCETAKAN KARTU UJIAN<br>
                                                    Untuk login klik <a href="'.base_url('login').'"> DISINI</a>


                              </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              
                                </table>';

                          //$this->load->library('email');

                          
                              //$to_email = $email;
                              //Load email library
                              $config = Array(
                              'protocol' => 'smtp',
                              'smtp_host' => 'ssl://smtp.googlemail.com',
                              'smtp_port' => 465,
                              'smtp_user' => $smtp['email'],
                              'smtp_pass' => $smtp['password'],
                              'mailtype'  => 'html', 
                              'charset'   => 'utf-8'
                            );
                          $this->load->library('email');
                          $this->email->initialize($config);
                          $this->email->set_newline("\r\n");
                              $this->email->from($smtp['email'], $smtp['nama']);
                              $this->email->to($terima);
                              $this->email->subject($smtp['subjek']);
                              $this->email->message($pesan);
                              //Send mail
                                  if($this->email->send())
                                  {
                                      $this->session->set_flashdata('sukses',"Selamat Peserta Berhasil di Validasi");
                                  }
              
                                }

                    
                }
                else
                {
                    $iddaftar=idDaftar($kodetrx);
                    $this->session->set_flashdata('gagal',"Maaf Kode Transaksi Ini Sudah ada di Database dengan ID Pendaftaran $iddaftar");

                }
                redirect($link);
            }
            else if(isset($_POST['ganti']))
            {
                $where=array('id_pendaftaran'=>postnumber('id'));
                $data=array('jalur_masuk'=>postnumber('jalurbaru'));
                $this->model_app->update('simpeg_biodata',$data,$where);
                $this->session->set_flashdata('sukses',"Selamat Jalur Masuk Peserta Berhasil di Ganti");
                redirect($link);
            }
            else
            {
                if(isset($_POST['filter']))
                {
                    $this->session->set_userdata(array('tahun_id'=>postnumber('tahun_id'),'jalur'=>postnumber('jalur'),'status'=>postnumber('status')));
                }
                $tahun_id=$this->session->tahun_id;
                if($tahun_id=='')
                {
                    $tahun_id=tahunTerakhir();
                }
                $jalur=$this->session->jalur;
                $status=$this->session->status;
                $data['tahun_id']=$tahun_id;
                $data['jalur']=$jalur;
                $data['status']=$status;
                if($status=='' AND $jalur=='')
                {
                    $data['record']=$this->model_app->view_where_ordering('simpeg_biodata',array('tahun'=>$tahun,'tahun_id'=>$tahun_id),'status,bukti,id_pendaftaran','DESC');
                }
                else if($status=='' AND $jalur!='')
                {
                    $data['record']=$this->model_app->view_where_ordering('simpeg_biodata',array('tahun'=>$tahun,'tahun_id'=>$tahun_id,'jalur_masuk'=>$jalur),'status,bukti,id_pendaftaran','DESC');
                }

                else if($status!='' AND $jalur=='')
                {
                    $data['record']=$this->model_app->view_where_ordering('simpeg_biodata',array('tahun'=>$tahun,'tahun_id'=>$tahun_id,'status'=>$status),'status,bukti,id_pendaftaran','DESC');
                }
                else 
                {
                    $data['record']=$this->model_app->view_where_ordering('simpeg_biodata',array('tahun'=>$tahun,'tahun_id'=>$tahun_id,'jalur_masuk'=>$jalur,'status'=>$status),'status,bukti,id_pendaftaran','DESC');
                }
               
                $this->template->load('admin','admin/simpeg/pendaftar/data',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function pendaftartambah(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pendaftar';
        $data['title']='Tambah Calon Mahasiswa Baru';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaTulis($link,$id_level))
        {
             if(isset($_POST['tambah']))
            {
            
            $nisn=postnumber('nisn');
            if($nisn=='')
            {
                $nisn=randomPass(10);
            }
            $jenjang=postnumber('jenjang');
            $nama=posttext('nama');
            $email=postnumber('email');
            $hp=postnumber('hp');
            $pass=randomPass();
            $salt=randomSalt();
            $token=token();
            $password=create_hash($pass,$salt);
            $tahun_id=postnumber('tahun_id');
            $jalur=postnumber('jalur');
            $biaya=biayaJalur($tahun_id,$jalur);
            $tahun=tahunsimpeg();
            $id=gelombang($tahun_id,$jalur);
            $id_pendaftaran=idPendaftaran($tahun);
            $cek=cekPendaftar($nisn,$email);
        
                if($cek==0)
                {
                $smtp=$this->model_app->edit('simpeg_email', array('id'=>1))->row_array();
                $pesan='

          <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
            <tr>
              <td style="padding: 10px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                  <tr>
                    <td align="center" bgcolor="#ffffff" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                      <img src="'.base_url('assets/img/'.identitas('logo')).'" alt="Logo IAKN"  height="80" style="display: block;" /><br>PENERIMAAN MAHASISWA BARU<br>IAKN TARUTUNG
                    </td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#EA2027" style="padding: 40px 0 30px 0; color: #FFFFFF; font-size: 36px; font-weight: bold; font-family: Arial, sans-serif;">
                      INFORMASI TAGIHAN
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                          <td  style="color: #000000; font-family: Arial, sans-serif; font-size: 24px; text-align: center;">
                            <b>Kepada Yth. <span style="color: #EA2027;">'.$nama.'</span><br>JALUR PENDAFTARAN : <span style="color: #EA2027;">'.strtoupper(viewKodeApp('JALMASUK',$jalur)).'</span><br>BERIKUT TAGIHAN ANDA<BR><span style="color: #EA2027;" >DI IAKN TARUTUNG</span><br>EMAIL : <span style="color: ##0652DD;">'.$email.'</span></b>
                          </td>
                        </tr>
                        <tr>
                          <td bgcolor="#ED4C67" style="padding: 20px 0 30px 0; color: #ffffff; font-family: Arial, sans-serif; font-size: 22px; line-height: 20px; text-align: center;">
                            Untuk LOGIN ke Aplikasi PENDAFTARAN<br>PERGUNAKAN USER DAN PASSWORD DI BAWAH INI:<br><span style="font-size: 26px;" font-weight: bold;>USER: '.$id_pendaftaran.'<br>PASSWORD: '.$pass.'</span><br><br>Nominal Yang Harus Dibayar:<br> 
                                <span style="font-size: 26px;" font-weight: bold;>'.gantiEnter(keteranganTarif($tahun_id,$jalur)).'</span><br>
                                Rekening Tujuan:<br>
                                BANK BRI : 0099-01-000778-30-1<br>
                                An. BPn STAKPN Tarutung<br>
                                Untuk login klik <a href="'.base_url('login').'"> DISINI</a>


                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
            <td>'.$smtp['isi'].'</td>
            </tr>
          </table>
          

        ';

                //$this->load->library('email');

                
                //$to_email = $email;
                //Load email library
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => $smtp['email'],
                    'smtp_pass' => $smtp['password'],
                    'mailtype'  => 'html', 
                    'charset'   => 'utf-8'
                    );
                $this->load->library('email');
                $this->email->initialize($config);
                $this->email->set_newline("\r\n");
                $this->email->from($smtp['email'], $smtp['nama']);
                $this->email->to($email);
                $this->email->subject($smtp['subjek']);
                $this->email->message($pesan);
                //Send mail
                if($this->email->send())
                {
                    $this->session->set_flashdata("sukses","Pendaftaran Sukses, Password  sudah di Kirim ke Email ".$email);
                    
                        $data=array('id_pendaftaran'=>$id_pendaftaran,'jenjang'=>$jenjang,'tahun'=>$tahun, 'tahun_id'=>$tahun_id, 'jalur_masuk'=>$jalur, 'id_periode'=>$id, 'nisn'=>$nisn, 'nama'=>$nama, 'email'=>$email, 'hp'=>$hp, 'salt'=>$salt, 'token'=>$token, 'password'=>$password, 'cara_daftar'=>'Manual', 'status'=>'Y','kode_akses'=>$pass);
                      
                    $this->model_app->insert('simpeg_biodata',$data);
                   // $this->model_app->insert('simpeg_password',$datapassword);
                    redirect($link);
                }
                else
                {
                    $this->session->set_flashdata("gagal","Pendaftaran Anda Gagal, Silahkan masukkan email yang aktif.");
                    redirect($_SERVER['HTTP_REFERER']); 
                }
        
    
        
        
        }
        else
        {
            $this->session->set_flashdata("gagal","Maaf Pendaftaran Anda Gagal, NISN dan Email yang anda Masukkan Sudah Terdaftar, Silahkan Login di Halaman Login");
                redirect('login');
        }
            }
            else
            {
                
                $tahun_id=$this->session->tahun_id;
                if($tahun_id=='')
                {
                    $tahun_id=tahunTerakhir();
                }
                $jalur=$this->session->jalur;
                $status=$this->session->status;
                $data['tahun_id']=$tahun_id;
                $data['jalur']=$jalur;
                $data['status']=$status;
                
               
                $this->template->load('admin','admin/simpeg/pendaftar/tambah',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function gantijalur(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_biodata',array('id_pendaftaran'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label">Jalur Lama</label>
                  <div class="col-sm-9">
                    <input type="text" name="jalurlama" class="form-control" value="'.viewKodeApp('JALMASUK',$sql['jalur_masuk']).'" placeholder="" readonly>
                  </div>
                </div><!-- row -->
             <div class="form-group row">
                  <label class="col-sm-3 control-label">Jalur Baru</label>
                  <div class="col-sm-9">
                   <select name="jalurbaru" class="form-control" required>
                      '.opKodeApp('JALMASUK').'
                       
                   </select>
                  </div>
                </div><!-- row -->
                
                ';
        }
    }

    function validasibukti(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_biodata',array('id_pendaftaran'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label">Kode Transaksi</label>
                  <div class="col-sm-9">
                    <input type="text" name="kodetrx" class="form-control" value="" placeholder="">
                  </div>
                </div><!-- row -->

                
                ';
        }
    }

    function lihatbukti(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_biodata',array('id_pendaftaran'=>$id))->row_array();
         
        echo'<img class="width-full" src="'.base_url('assets/img/bukti/'.$sql['bukti']).'">';
        }
    }

    function pendaftardetail($kode,$tab='biodata'){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pendaftar';
        $data['title']='Daftar Calon Mahasiswa Baru';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';
        $data['tab']=$tab;

        if(bisaBaca($link,$id_level))
        {
             $id=dekrip($kode);
             $row=$this->model_app->edit('simpeg_biodata',array('id_pendaftaran'=>$id))->row_array();
             if($row['jalur_masuk']=='A' OR $row['jalur_masuk']=='C')
             {
                $data['tabs']=array('Biodata'=>'biodata','Data Pendidikan'=>'pendidikan','Data Keluarga'=>'keluarga','Data Pilihan'=>'prodi');
                if($tab=='biodata')
                {
                    $data['rows']=$row;
                    $this->template->load('admin','admin/simpeg/pendaftar/biodata',$data);
                }
                else if($tab=='pendidikan')
                {
                    $data['rows']=$row;
                    $data['pendidikan']=$this->model_app->edit('simpeg_akademik',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/pendidikan',$data);
                }
                else if($tab=='keluarga')
                {
                    $data['rows']=$row;
                    $data['keluarga']=$this->model_app->edit('simpeg_keluarga',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/keluarga',$data);
                }
                else if($tab=='prodi')
                {
                    $data['rows']=$row;
                    $data['prodi']=$this->model_app->edit('simpeg_pilihan_prodi',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/prodi',$data);
                }

             }
             else if($row['jalur_masuk']=='B')
             {
                 $data['tabs']=array('Biodata'=>'biodata','Pendidikan'=>'pendidikan','Kondisi Ekonomi'=>'ekonomi','Data Keluarga'=>'keluarga','Data Prestasi'=>'prestasi','Kondisi Rumah'=>'kondisirumah','Aset Keluarga'=>'asetkeluarga','Rencana Hidup'=>'rencanahidup','Data Pilihan'=>'prodi');
                if($tab=='biodata')
                {
                    $data['rows']=$row;
                    $this->template->load('admin','admin/simpeg/pendaftar/biodata',$data);
                }
                else if($tab=='pendidikan')
                {
                    $data['rows']=$row;
                    $data['pendidikan']=$this->model_app->edit('simpeg_akademik',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/pendidikan',$data);
                }
                else if($tab=='ekonomi')
                {
                    $data['rows']=$row;
                    $data['ekonomi']=$this->model_app->edit('simpeg_ekonomi',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/ekonomi',$data);
                }
                else if($tab=='keluarga')
                {
                    $data['rows']=$row;
                    $data['keluarga']=$this->model_app->edit('simpeg_keluarga',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/keluarga',$data);
                }
                else if($tab=='prestasi')
                {
                    $data['rows']=$row;
                    $data['record']=$this->model_app->view_where_ordering('simpeg_prestasi',array('id_pendaftaran'=>$id),'id','ASC');
                     $this->template->load('admin','admin/simpeg/pendaftar/prestasi',$data);
                }
                else if($tab=='kondisirumah')
                {
                    $data['rows']=$row;
                    $data['kondisi']=$this->model_app->edit('simpeg_kondisi_rumah',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/kondisirumah',$data);
                }
                else if($tab=='asetkeluarga')
                {
                    $data['rows']=$row;
                    $data['record']=$this->model_app->view_where_ordering('simpeg_aset_keluarga',array('id_pendaftaran'=>$id),'id','ASC');
                     $this->template->load('admin','admin/simpeg/pendaftar/asetkeluarga',$data);
                }
                else if($tab=='rencanahidup')
                {
                    $data['rows']=$row;
                    $data['rencana']=$this->model_app->edit('simpeg_rencana_hidup',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/rencanahidup',$data);
                }
                else if($tab=='prodi')
                {
                    $data['rows']=$row;
                    $data['prodi']=$this->model_app->edit('simpeg_pilihan_prodi',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/prodi',$data);
                }
             }
             else if($row['jalur_masuk']=='D' OR $row['jalur_masuk']=='E')
             {
                $data['tabs']=array('Biodata'=>'biodata','Data Pendidikan'=>'pendidikan','Data Keluarga'=>'keluarga','Data Pilihan'=>'prodi');
                if($tab=='biodata')
                {
                    $data['rows']=$row;
                    $this->template->load('admin','admin/simpeg/pendaftar/biodata',$data);
                }
                else if($tab=='pendidikan')
                {
                    $data['rows']=$row;
                    $data['pendidikan']=$this->model_app->edit('simpeg_akademik',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/pendidikan',$data);
                }
                else if($tab=='keluarga')
                {
                    $data['rows']=$row;
                    $data['keluarga']=$this->model_app->edit('simpeg_keluarga',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/pasca',$data);
                }
                else if($tab=='prodi')
                {
                    $data['rows']=$row;
                    $data['prodi']=$this->model_app->edit('simpeg_pilihan_prodi',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/prodi',$data);
                }

             }
             
        }
        else
        {
            redirect('dashboard');
        }
    }

    function pendaftaredit($tab,$kode){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pendaftar';
        $data['title']='Daftar Calon Mahasiswa Baru';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';
        

        if(bisaUbah($link,$id_level))
        {

             $id=dekrip($kode);
             
             $row=$this->model_app->edit('simpeg_biodata',array('id_pendaftaran'=>$id))->row_array();
             
             if($row['jalur_masuk']=='A'  OR $row['jalur_masuk']=='C')
             {
                
                if($tab=='biodata')
                {
                    $data['rows']=$row;
                    $this->template->load('admin','admin/simpeg/pendaftar/biodataedit',$data);
                }
                else if($tab=='pendidikan')
                {
                    
                    $data['rows']=$this->model_app->edit('simpeg_akademik',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/pendidikanedit',$data);
                }
                else if($tab=='keluarga')
                {
                    $data['rows']=$this->model_app->edit('simpeg_keluarga',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/keluargaedit',$data);
                }
                else if($tab=='prodi')
                {
                    $data['rows']=$row;
                    $data['baris']=$this->model_app->edit('simpeg_pilihan_prodi',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/prodiedit',$data);
                }

             }
             else if($row['jalur_masuk']=='B')
             {
                if($tab=='biodata')
                {
                    $data['rows']=$row;
                    $this->template->load('admin','admin/simpeg/pendaftar/biodataedit',$data);
                }
                else if($tab=='pendidikan')
                {
                    
                    $data['rows']=$this->model_app->edit('simpeg_akademik',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/pendidikanedit',$data);
                }
                else if($tab=='ekonomi')
                {
                    
                    $data['rows']=$this->model_app->edit('simpeg_ekonomi',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/ekonomiedit',$data);
                }
                else if($tab=='keluarga')
                {
                    $data['rows']=$this->model_app->edit('simpeg_keluarga',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/keluargaedit',$data);
                }
                else if($tab=='kondisirumah')
                {
                    
                    $data['rows']=$this->model_app->edit('simpeg_kondisi_rumah',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/kondisirumahedit',$data);
                }
                else if($tab=='rencanahidup')
                {
                    $data['title']='Edit Data Rencana Hidup/ Tinggal Pendaftar di Perguruan Tinggi Tujuan';
                    $data['rows']=$this->model_app->edit('simpeg_rencana_hidup',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/rencanahidupedit',$data);
                }
                else if($tab=='prodi')
                {
                    $data['rows']=$row;
                    $data['baris']=$this->model_app->edit('simpeg_pilihan_prodi',array('id_pendaftaran'=>$id))->row_array();
                     $this->template->load('admin','admin/simpeg/pendaftar/prodiedit',$data);
                }
             }
             
        }
        else
        {
            redirect('dashboard');
        }
    }

    function pendaftarsimpan(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pendaftar';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';
        

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['biodata']))
            {
              $id_pendaftaran=postnumber('id');
              $where=array('id_pendaftaran'=>$id_pendaftaran);
              $data=array('nama'=>posttext('nama'),
                          'nik'=>postnumber('nik'),
                          'tempat_lahir'=>posttext('tempat_lahir'),
                          'tgl_lahir'=>postnumber('tgl_lahir'),
                          'jk'=>postnumber('jk'),
                          'agama'=>postnumber('agama'),
                          'kewarganegaraan'=>postnumber('kewarganegaraan'),
                          'alamat'=>posttext('alamat'),
                          'prop'=>postnumber('prop'),
                          'kab'=>postnumber('kab'),
                          'kodepos'=>postnumber('kodepos'),
                          'telp'=>postnumber('telp'),
                          'hp'=>postnumber('hp'),
                          'hobi'=>postnumber('hobi'));
              $this->model_app->update('simpeg_biodata',$data,$where);
              $this->session->set_flashdata('sukses',"Data Biodata Berhasil Disimpan");
              redirect('simpeg/pendaftardetail/'.enkrip($id_pendaftaran).'/biodata');
            }
            else if(isset($_POST['pendidikan']))
            {
              $id_pendaftaran=postnumber('id');
              $where=array('id_pendaftaran'=>$id_pendaftaran);
              $data=array(
                        'prop'=>postnumber('prop'),
                        'kab'=>postnumber('kab'),
                        'sekolah'=>postnumber('sekolah'),
                        'jurusan'=>postnumber('jurusan'),
                        'tahun_lulus'=>postnumber('tahun_lulus'),
                        'telepon'=>postnumber('telepon'),
                        'alamat'=>posttext('alamat'),
                        'mapel_un'=>postnumber('mapel_un'),
                        'nilai_un'=>postnumber('nilai_un'),
                        'rata_un'=>postnumber('rata_un'),
                        'mapel'=>postnumber('mapel'),
                        'ranking'=>postnumber('ranking'),
                        'mapel2'=>postnumber('mapel2'),
                        'ranking2'=>postnumber('ranking2'),
                        'mapel3'=>postnumber('mapel3'),
                        'ranking3'=>postnumber('ranking3'),
                        'mapel4'=>postnumber('mapel4'),
                        'ranking4'=>postnumber('ranking4'),
                        'mapel5'=>postnumber('mapel5'),
                        'ranking5'=>postnumber('ranking5')
                      );
            $this->model_app->update('simpeg_akademik',$data,$where);
            $this->session->set_flashdata('sukses',"Data Pendidikan Berhasil Diedit");
              redirect('simpeg/pendaftardetail/'.enkrip($id_pendaftaran).'/pendidikan');
            } 
            else if(isset($_POST['keluarga']))
            {
                $id_pendaftaran=postnumber('id');
                $where=array('id_pendaftaran'=>$id_pendaftaran);
                $data=array(
                        'nama_ayah'=>posttext('nama_ayah'),
                        'status_ayah'=>postnumber('status_ayah'),
                        'status_hubungan'=>postnumber('status_hubungan'),
                        'nama_ibu'=>posttext('nama_ibu'),
                        'status_ibu'=>postnumber('status_ibu'),
                        'pendidikan_ayah'=>postnumber('pendidikan_ayah'),
                        'pekerjaan_ayah'=>postnumber('pekerjaan_ayah'),
                        'detail_ayah'=>posttext('detail_ayah'),
                        'pendidikan_ibu'=>postnumber('pendidikan_ibu'),
                        'pekerjaan_ibu'=>postnumber('pekerjaan_ibu'),
                        'detail_ibu'=>posttext('detail_ibu'),
                        'jlh_tanggungan'=>postnumber('jlh_tanggungan'),
                        'telepon_ortu'=>postnumber('telepon_ortu'),
                        'alamat'=>posttext('alamat'),
                        'kel'=>posttext('kel'),
                        'kec'=>postnumber('kec'),
                        'kab'=>posttext('kab'),
                        'prop'=>posttext('prop'),
                        'kodepos'=>posttext('kodepos')
                      );
            $this->model_app->update('simpeg_keluarga',$data,$where);
            $this->session->set_flashdata('sukses',"Data Keluarga Berhasil Diedit");
            redirect('simpeg/pendaftardetail/'.enkrip($id_pendaftaran).'/keluarga');
            }
            else if(isset($_POST['ekonomi']))
            {
                $kode_bantuan=postnumber('kode_bantuan');
                $id_pendaftaran=postnumber('id');
                $where=array('id_pendaftaran'=>$id_pendaftaran);
                if($kode_bantuan=='')
                {
                 
                $data=array('pekerjaan_ayah'=>postnumber('pekerjaan_ayah'),
                            'penghasilan_ayah'=>postnumber('penghasilan_ayah'),
                            'pekerjaan_ibu'=>postnumber('pekerjaan_ibu'),
                            'penghasilan_ibu'=>postnumber('penghasilan_ibu'),
                            'tot_hutang_lain'=>postnumber('tot_hutang_lain'),
                            'cicilan_hutang_bulan'=>postnumber('cicilan_hutang_bulan'),
                            'tot_piutang_lain'=>postnumber('tot_piutang_lain'),
                            'cicilan_piutang_bulan'=>postnumber('cicilan_piutang_bulan'),
                            'tabungan_keluarga'=>postnumber('tabungan_keluarga')
                          );
                }
                else
                {
                  $data=array(
                            'pekerjaan_ayah'=>postnumber('pekerjaan_ayah'),
                            'penghasilan_ayah'=>postnumber('penghasilan_ayah'),
                            'pekerjaan_ibu'=>postnumber('pekerjaan_ibu'),
                            'penghasilan_ibu'=>postnumber('penghasilan_ibu'),
                            'tot_hutang_lain'=>postnumber('tot_hutang_lain'),
                            'cicilan_hutang_bulan'=>postnumber('cicilan_hutang_bulan'),
                            'tot_piutang_lain'=>postnumber('tot_piutang_lain'),
                            'cicilan_piutang_bulan'=>postnumber('cicilan_piutang_bulan'),
                            'tabungan_keluarga'=>postnumber('tabungan_keluarga'),
                            'kode_bantuan'=>$kode_bantuan,
                            'nomor_kartu'=>postnumber('nomor_kartu'),
                            'tahun_mulai'=>postnumber('tahun_mulai'),
                            'masih_menerima'=>postnumber('masih_menerima')
                          );
                }
                $this->model_app->update('simpeg_ekonomi',$data,$where);
                $this->session->set_flashdata('sukses',"Data Ekonomi Keluarga Berhasil Diedit");
                redirect('simpeg/pendaftardetail/'.enkrip($id_pendaftaran).'/ekonomi');
            }
            else if(isset($_POST['kondisirumah']))
            {
                $id_pendaftaran=postnumber('id');
                $where=array('id_pendaftaran'=>$id_pendaftaran);
                $data=array(
                        'kepemilikan'=>postnumber('kepemilikan'),
                        'tahun_perolehan'=>postnumber('tahun_perolehan'),
                        'bahan_lantai'=>postnumber('bahan_lantai'),
                        'bahan_tembok'=>postnumber('bahan_tembok'),
                        'mandi_cuci'=>postnumber('mandi_cuci'),
                        'sumber_air'=>postnumber('sumber_air'),
                        'jarak_dari_kota'=>postnumber('jarak_dari_kota'),
                        'jlh_org_tinggal'=>posttext('jlh_org_tinggal'),
                        'sumber_listrik'=>postnumber('sumber_listrik'),
                        'daya_listrik'=>postnumber('daya_listrik'),
                        'njop_meter'=>postnumber('njop_meter'),
                        'luas_tanah'=>postnumber('luas_tanah'),
                        'luas_bangunan'=>postnumber('luas_bangunan'),
                        'bahan_atap'=>postnumber('bahan_atap')
                      );
            $this->model_app->update('simpeg_kondisi_rumah',$data,$where);
            $this->session->set_flashdata('sukses',"Data Kondisi Rumah Berhasil Diedit");
            redirect('simpeg/pendaftardetail/'.enkrip($id_pendaftaran).'/kondisirumah');
            }
            else if(isset($_POST['rencanahidup']))
            {
                $id_pendaftaran=postnumber('id');
                $where=array('id_pendaftaran'=>$id_pendaftaran);
                $data=array(
                        'rencana_tinggal'=>postnumber('rencana_tinggal'),
                        'dukungan_keluarga'=>postnumber('dukungan_keluarga'),
                        'transportasi_asal'=>postnumber('transportasi_asal'),
                        'transportasi_harian'=>postnumber('transportasi_harian'),
                        'biaya_transportasi'=>postnumber('biaya_transportasi')
                      );
            $this->model_app->update('simpeg_rencana_hidup',$data,$where);
            $this->session->set_flashdata('sukses',"Data Rencana Hidup/ Tinggal Pendaftar di Perguruan Tinggi Tujuan Berhasil Diedit");
            redirect('simpeg/pendaftardetail/'.enkrip($id_pendaftaran).'/rencanahidup');
            }
            else if(isset($_POST['prodi']))
            {
                $id_pendaftaran=postnumber('id');
                $where=array('id_pendaftaran'=>$id_pendaftaran);
                $data=array(
                      'pilihan1'=>postnumber('pilihan1'),
                      'pilihan2'=>postnumber('pilihan2'));
            $this->model_app->update('simpeg_pilihan_prodi',$data,$where);
            $this->session->set_flashdata('sukses',"Data Pilihan Prodi Berhasil Diedit");
            redirect('simpeg/pendaftardetail/'.enkrip($id_pendaftaran).'/prodi');
            }


        } 
        else
        {
            redirect($link);
        }   
            
    }

    function pendaftarhapus(){
        $id_level=$this->session->level;
        $link='simpeg/pendaftar';
        if(bisaHapus($link,$id_level))
        {
        $id = array('id_pendaftaran' => dekrip($this->uri->segment(3)));
        $this->model_app->delete('simpeg_biodata',$id);
        $this->session->set_flashdata('sukses',"Data Pendaftar Berhasil Dihapus");
       redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda Tidak Berhak Menghapus Data Pendaftar");
            redirect($link);
        }
        
    }

    function prestasiedit(){
        $user=$this->session->id_user;
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pendaftar';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';
      
        if(isset($_POST['edit']))     
        {
            $config['upload_path'] = 'assets/img/prestasi/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PNG';
            $config['max_size'] = '512'; // kb
            $this->load->library('upload', $config);
          
            if(! $this->upload->do_upload('gambar') AND $this->input->post('gambar') !='')
            {
              $this->session->set_flashdata('gagal',"Data Sertifikat Prestasi Gagal DiUpload, Ukuran yang di izinkan Maksimal 500 KB");
              redirect('simpeg/prestasiedit/'.enkrip(postnumber('id')));
            }
            else
            {
              $where=array('id'=>postnumber('id'));
              $hasil=$this->upload->data();
              if($hasil['file_name']=='')
              {          
              $data=array(
                          'nama_prestasi'=>posttext('nama_prestasi'),
                          'tingkat'=>postnumber('tingkat'),
                          'juara'=>postnumber('juara'));
              }
              else
              {
                $foto=$this->model_app->edit('simpeg_prestasi',$where)->row_array();
                unlink('assets/img/prestasi/'.$foto['sertifikat']);
                $data=array(
                          'nama_prestasi'=>posttext('nama_prestasi'),
                          'tingkat'=>postnumber('tingkat'),
                          'juara'=>postnumber('juara'),
                          'sertifikat'=>$hasil['file_name']);
              }
              
              
              $simpan=$this->model_app->update('simpeg_prestasi',$data,$where);
              if($simpan)
                  {
                      $this->session->set_flashdata('sukses',"Data Prestasi Berhasil Diedit");
                  }
                  else
                  {
                      $this->session->set_flashdata('gagal',"Data Prestasi Gagal Diedit");
                  }
                  redirect('simpeg/pendaftardetail/'.enkrip(postnumber('id_pendaftaran')).'/prestasi');
            }
          }
          else
          {
            $id=dekrip($this->uri->segment('3'));
            $row=$this->model_app->edit('simpeg_prestasi',array('id'=>$id))->row_array();

            $data['rows']=$row;
            $data['post']='simpeg/prestasiedit';
            $data['back']='simpeg/pendaftardetail/'.enkrip($row['id_pendaftaran']).'/prestasi';
          $this->template->load('admin','mahasiswa/prestasi/edit',$data);
          }
    }

    function prestasihapus(){
        
        $id = array('id' => dekrip($this->uri->segment(3)));
        $foto=$this->model_app->edit('simpeg_prestasi',$id)->row_array();
        unlink('assets/img/prestasi/'.$foto['sertifikat']);
        $this->model_app->delete('simpeg_prestasi',$id);
        $this->session->set_flashdata('sukses',"Data Prestasi Berhasil Dihapus");
       redirect($_SERVER['HTTP_REFERER']);
        
    }

    

    function asetkeluargaedit(){
        $user=$this->session->id_user;
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pendaftar';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        $data['title']='Data Aset Keluarga';
        
        if(isset($_POST['edit']))     
        {
          $where=array('id'=>postnumber('id'));
            $data=array(
                          'nama_barang'=>posttext('nama_barang'),
                          'merek_type'=>posttext('merek_type'),
                          'jenis_barang'=>postnumber('jenis_barang'),
                          'tahun_perolehan'=>postnumber('tahun_perolehan'),
                          'perolehan'=>postnumber('perolehan'),
                          'kondisi'=>postnumber('kondisi'),
                          'harga_beli'=>postnumber('harga_beli'),
                          'estimasi_nilai_sekarang'=>postnumber('estimasi_nilai_sekarang')
                      );
              
              
              $simpan=$this->model_app->update('simpeg_aset_keluarga',$data,$where);
              if($simpan)
                  {
                      $this->session->set_flashdata('sukses',"Data Aset Keluarga Berhasil Diedit");
                  }
                  else
                  {
                      $this->session->set_flashdata('gagal',"Data Aset Keluarga Gagal Diedit");
                  }
                  redirect('simpeg/pendaftardetail/'.enkrip(postnumber('id_pendaftaran')).'/asetkeluarga');
            
          }
          else
          {
            $id=dekrip($this->uri->segment('3'));
            $row=$this->model_app->edit('simpeg_aset_keluarga',array('id'=>$id))->row_array();
            $data['rows']=$row;
            $data['post']='simpeg/asetkeluargaedit';
            $data['back']='simpeg/pendaftardetail/'.enkrip($row['id_pendaftaran']).'/asetkeluarga';
          $this->template->load('admin','mahasiswa/asetkeluarga/edit',$data);
          }
    }

    function asetkeluargahapus(){
        
        $id = array('id' => dekrip($this->uri->segment(3)));
        $this->model_app->delete('simpeg_aset_keluarga',$id);
        $this->session->set_flashdata('sukses',"Data Aset Keluarga Berhasil Dihapus");
        redirect($_SERVER['HTTP_REFERER']);
        
    }



    function tarif(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/tarif';
        $data['title']='Tarif Pendaftaran';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('tahun_id'=>$this->session->tahun_id,
                            'jalur_masuk'=>postnumber('jalur'),
                            'tarif'=>postnumber('tarif'),
                            'ket'=>posttext('ket'));
                $simpan=$this->model_app->insert('simpeg_tarif',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Tarif Pendaftaran Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Tarif Pendaftaran Gagal Disimpan");  
                }
                
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));
                $data=array('jalur_masuk'=>postnumber('jalur'),
                            'tarif'=>postnumber('tarif'),
                            'ket'=>posttext('ket'));
                $simpan=$this->model_app->update('simpeg_tarif',$data,$where);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Tarif Pendaftaran Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Tarif Pendaftaran Gagal Diedit");  
                }
                redirect($link);
            }
            else
            {
                if(isset($_POST['filter']))
                {
                    $this->session->set_userdata(array('tahun_id'=>postnumber('tahun_id')));
                }
                $tahun_id=$this->session->tahun_id;
                if($tahun_id=='')
                {
                    $tahun_id=tahunTerakhir();
                }
                                
                $data['tahun_id']=$tahun_id;
                
                
                    $data['record']=$this->model_app->view_where_ordering('simpeg_tarif',array('tahun_id'=>$tahun_id),'jalur_masuk','ASC');
                
                $this->template->load('admin','admin/simpeg/tarif/data',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function tarifedit(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_tarif',array('id'=>$id))->row_array();
         
        echo'<input type="hidden" name="id" value="'.$id.'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label">Jalur Pendaftaran</label>
                  <div class="col-sm-9">
                    <select name="jalur" class="form-control" required>
                      '.opJalurTarif($sql['tahun_id'],$sql['jalur_masuk']).'
                    </select>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Tarif</label>
                  <div class="col-sm-9">
                    <input type="number" name="tarif"  class="form-control" value="'.$sql['tarif'].'"  required>
                  </div>
                </div><!-- row -->

                <div class="form-group row">
                  <label class="col-sm-3 control-label ">Keterangan</label>
                  <div class="col-sm-9">
                    <textarea name="ket" class="form-control" rows="3">'.$sql['ket'].'</textarea>
                  </div>
                </div><!-- row -->

                
                ';
        }
    }

    function tarifhapus(){
        $id_level=$this->session->level;
        $link='simpeg/tarif';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_tarif',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Data Tarif Pendaftaran Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Data Tarif Pendaftaran Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function pakta(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pakta';
        $data['title']='Pakta Integritas';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
               
                $data['record']=$this->model_app->view_ordering('simpeg_pakta_integritas','kode','ASC');
                $this->template->load('admin','admin/simpeg/pakta/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

     function paktatambah(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pakta';
        $data['title']='Pakta Integritas';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaTulis($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('kode'=>postnumber('kode'),
                            'syarat1'=>posttext('syarat1'),
                            'syarat2'=>posttext('syarat2'),
                            'syarat3'=>posttext('syarat3')
                        );
                $this->model_app->insert('simpeg_pakta_integritas',$data);
                $this->session->set_flashdata('sukses',"Data Pakta Integritas Berhasil Disimpan");
                redirect($link);
            }
            else
            {
            $this->template->load('admin','admin/simpeg/pakta/tambah',$data);
            }
        }
        else
        {
            redirect('dashboard');
        }
    }

    function paktaedit(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/pakta';
        $data['title']='Pakta Integritas';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                $where=array('kode'=>postnumber('kode'));
                $data=array(
                            'syarat1'=>posttext('syarat1'),
                            'syarat2'=>posttext('syarat2'),
                            'syarat3'=>posttext('syarat3')
                        );
                $this->model_app->update('simpeg_pakta_integritas',$data,$where);
                $this->session->set_flashdata('sukses',"Data Pakta Integritas Berhasil Diedit");
                redirect($link);
            }
            else
            {
                $kode=dekrip($this->uri->segment('3'));
                $data['rows']=$this->model_app->edit('simpeg_pakta_integritas',array('kode'=>$kode))->row_array();
            $this->template->load('admin','admin/simpeg/pakta/edit',$data);
            }
        }
        else
        {
            redirect('dashboard');
        }
    }

    function paktahapus(){
        $id_level=$this->session->level;
        $link='simpeg/pakta';

        if(bisaHapus($link,$id_level))
        {
        $where = array('kode' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_pakta_integritas',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Pakta Integritas Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pakta Integritas Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function beranda(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/beranda';
        $data['title']='Informasi Beranda';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('keterangan'=>postnumber('keterangan'),
                            'jalur'=>postnumber('jalur'),
                            'tahun_id'=>$this->session->tahun_id);
                $simpan=$this->model_app->insert('simpeg_beranda',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Informasi Beranda Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Informasi Beranda Gagal Disimpan");  
                }
                
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>postnumber('id'));
                $data=array('keterangan'=>postnumber('keterangan'),
                            'jalur'=>postnumber('jalur'));
                $simpan=$this->model_app->update('simpeg_beranda',$data,$where);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Selamat Data Informasi Beranda Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Maaf Data Informasi Beranda Gagal Diedit");  
                }
                redirect($link);
            }
            else
            {
                if(isset($_POST['filter']))
                {
                    $this->session->set_userdata(array('tahun_id'=>postnumber('tahun_id')));
                }
                $tahun_id=$this->session->tahun_id;
                if($tahun_id=='')
                {
                    $tahun_id=tahunTerakhir();
                }
                $data['tahun_id']=$tahun_id;
                
                $data['record']=$this->model_app->view_where_ordering('simpeg_beranda',array('tahun_id'=>$tahun_id),'jalur','ASC');
                $this->template->load('admin','admin/simpeg/beranda/data',$data); 
            } 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function berandaedit(){
        $id_level=$this->session->level;
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $link='simpeg/beranda';
        $data['title']='Informasi Beranda';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';
        if(bisaUbah($link,$id_level))
        {
            
                $id=dekrip($this->uri->segment('3'));
                $data['rows']=$this->model_app->edit('simpeg_beranda',array('id'=>$id))->row_array();
                $this->template->load('admin','admin/simpeg/beranda/edit',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function berandalihat(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
       $sql=$this->model_app->edit('simpeg_beranda',array('id'=>$id))->row_array();
         
        echo $sql['keterangan'];
        }
    }

    function berandahapus(){
        $id_level=$this->session->level;
        $link='simpeg/beranda';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($this->uri->segment(3)));
        $hapus=$this->model_app->delete('simpeg_beranda',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Informasi Beranda Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Informasi Beranda Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function pendaftarperiode(){
        $id_level=$this->session->level;
        $link='simpeg/pendaftarperiode';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        { 
            $data['title']='Laporan Pendaftar Mahasiswa Baru IAKN Tarutung';
            $data['record']=$this->model_app->statistik_periode();
            $this->template->load('admin','admin/simpeg/laporan/periode',$data); 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function rekappendaftar(){
        $id_level=$this->session->level;
        $link='simpeg/rekappendaftar';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        { 
            $data['title']='Laporan Pendaftar Mahasiswa Baru IAKN Tarutung';
            $data['record']=$this->model_app->statistik_pendaftar($tahun);
            $this->template->load('admin','admin/simpeg/laporan/jalur',$data); 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function penerimaanprodi(){
        $id_level=$this->session->level;
        $link='simpeg/penerimaanprodi';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        { 
            $data['title']='Laporan Pendaftar Mahasiswa Baru IAKN Tarutung';
            $data['record']=$this->model_app->statistik_perprodi($tahun);
            $data['jalur']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'JALMASUK'),'kderef','ASC');
            $this->template->load('admin','admin/simpeg/laporan/prodi',$data); 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function registrasipendaftar(){
        $id_level=$this->session->level;
        $link='simpeg/registrasipendaftar';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        { 
            $data['title']='Laporan Pendaftar Mahasiswa Baru IAKN Tarutung';
            $data['record']=$this->model_app->statistik_lulus($tahun);
            $data['jalur']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'JALMASUK'),'kderef','ASC');
            $this->template->load('admin','admin/simpeg/laporan/lulus',$data); 
        }
        else
        {
            redirect('dashboard');
        }
    }

    function soal(){
        $id_level=$this->session->level;
        $link='simpeg/soal';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('paket'=>postnumber('paket'),'kategori'=>postnumber('kategori')));
            }
            $data['paket']=$this->session->paket;
            $data['kategori']=$this->session->kategori;
            $data['title']='Bank Soal';
            
            $this->template->load('admin','admin/simpeg/soal/data',$data); 
           
        }
        else
        {
            redirect('home');
        }
    }

    function soaltambah(){
        $id_level=$this->session->level;
        $link='simpeg/soal';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['title']='Data Soal';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaTulis($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $kategori=postnumber('kategori');
                $urut=urutSoal($kategori);
                $kode=$kategori.$urut;
                $data=array('materi'=>postnumber('materi'),
                            'soal'=>postnumber('soal'),
                            'opsi_a'=>postnumber('opsia'),
                            'opsi_b'=>postnumber('opsib'),
                            'opsi_c'=>postnumber('opsic'),
                            'opsi_d'=>postnumber('opsid'),
                            'opsi_e'=>postnumber('opsie'),
                            'jawaban'=>postnumber('jawaban'),
                            'pembahasan'=>postnumber('pembahasan'),
                            'user'=>$this->session->id_user,
                            'modify_user'=>$this->session->id_user,
                            'kategori'=>$kategori,
                            'urut'=>$urut,
                            'kode'=>$kode,
                            'paket'=>postnumber('paket')
                        );
                $tambah=$this->model_app->insert('simpeg_soal',$data);
                $id=$this->db->insert_id();
                if($tambah)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Berhasil Ditambah");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Gagal Ditambah");
                }
                redirect('simpeg/soaldetail/'.enkrip($id));
            }
      
            else
            {
            $data['paket']=$this->session->paket;
            $data['kategori']=$this->session->kategori;
            $this->template->load('admin','admin/simpeg/soal/tambah',$data);
            }
            
        }
        else
        {
            redirect($link);
        }
    }

    function soaledit($seo){
        $id_level=$this->session->level;
        $link='simpeg/soal';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['title']='Data Soal';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaTulis($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                $id=postnumber('id');
                $where=array('id'=>$id);
                $data=array('materi'=>postnumber('materi'),
                            'soal'=>postnumber('soal'),
                            'opsi_a'=>postnumber('opsia'),
                            'opsi_b'=>postnumber('opsib'),
                            'opsi_c'=>postnumber('opsic'),
                            'opsi_d'=>postnumber('opsid'),
                            'opsi_e'=>postnumber('opsie'),
                            'jawaban'=>postnumber('jawaban'),
                            'pembahasan'=>postnumber('pembahasan'),
                            'modify_user'=>$this->session->id_user,
                            'tgl_modifikasi'=>date('Y-m-d H:i:s')
                        );
                $tambah=$this->model_app->update('simpeg_soal',$data,$where);
                if($tambah)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Gagal Diedit");
                }
                redirect('simpeg/soaldetail/'.enkrip($id));
            }
      
            else
            {
            $data['paket']=$this->session->paket;
            $data['kategori']=$this->session->kategori;
            $id=dekrip($seo);
            $data['rows']=$this->model_app->edit('simpeg_soal',array('id'=>$id))->row_array();
            $this->template->load('admin','admin/simpeg/soal/edit',$data);
            }
            
        }
        else
        {
            redirect($link);
        }
    }


    function soaldetail($seo){
        $id_level=$this->session->level;
        $link='simpeg/soal';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['title']='Data Soal';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            $id=dekrip($seo);
            $data['paket']=$this->session->paket;
            $data['kategori']=$this->session->kategori;
            $data['rows']=$this->model_app->edit('simpeg_soal',array('id'=>$id))->row_array();
            $this->template->load('admin','admin/simpeg/soal/detail',$data);
           
            
        }
        else
        {
            redirect($link);
        }
    }

    function soalhapus($seo){
        $id_level=$this->session->level;
        $link='simpeg/soal';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $tambah=$this->model_app->delete('simpeg_soal',$id);
        if($tambah)
        {
            $this->session->set_flashdata('sukses',"Data Soal Berhasil Dihapus");
        }
        else
        {
            $this->session->set_flashdata('gagal',"Data Soal Gagal Dihapus");
        }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    public function soalLoad (){

        $id_level=$this->session->level;
        $link='simpeg/soal';
        $paket=$this->session->paket;
        $kategori=$this->session->kategori;
        
        $columns = array('id',
                         'materi',
                         'soal',
                         'jawaban',
                         'user',
                         'kode');

        $sql = "SELECT ".implode(',', $columns)." FROM simpeg_soal WHERE kategori='$kategori' AND paket='$paket'";

        // search
        if (isset($_GET['search']['value']) && $_GET['search']['value'] != '') {
            $search = $_GET['search']['value'];
            $where  = '';
            // create parameter pencarian kesemua kolom yang tertulis
            // di $columns
            for ($i=0; $i < count($columns); $i++) {
                $where .= $columns[$i] . ' LIKE "%'.$search.'%"';

                // agar tidak menambahkan 'OR' diakhir Looping
                if ($i < count($columns)-1) {
                    $where .= ' OR ';
                }
            }

            $sql .= " AND ($where) ";
        }




        //SORT Kolom
        $sortColumn = isset($_GET['order'][0]['column']) ? $_GET['order'][0]['column'] : 0;
        $sortDir    = isset($_GET['order'][0]['dir']) ? $_GET['order'][0]['dir'] : 'asc';

        $sortColumn = $columns[$sortColumn];

        $sql .= " ORDER BY $sortColumn $sortDir";

        // var_dump($sql);
        $totaldata = $this->db->query($sql)->num_rows();
        // hitung semua data




        // memberi Limit
        $start  = isset($_GET['start']) ? $_GET['start'] : 0;
        $length = isset($_GET['length']) ? $_GET['length'] : 10;


        $sql .= " LIMIT $start,$length";

        $data  = $this->db->query($sql);

        // create json format
        $datatable['draw']            = isset($_GET['draw']) ? $_GET['draw'] : 1;
        $datatable['recordsTotal']    = $totaldata;
        $datatable['recordsFiltered'] = $totaldata;
        $datatable['data']            = array();
        $no=$start;
        foreach ($data->result_array() as $row) {
        $detail=aksiDetail('simpeg/soaldetail/'.enkrip($row['id']));
        if(bisaUbah($link,$id_level)==1)
          {
            $ubah=aksiEdit('simpeg/soaledit',enkrip($row['id']));
           
          }
             
          if(bisaHapus($link,$id_level)==1)
          {
            $hapus=aksiHapus('simpeg/soalhapus',enkrip($row['id']));
          }
          $no++;
         
            $fields = array($no, 
                            viewMateriSoal($row['materi']),
                            $row['soal'],
                            $row['jawaban'],
                            viewUser($row['user']),
                            $ubah.' '.$hapus.' '.$detail
                          );
            
            

            $datatable['data'][] = $fields;
        }

        //$data->close();
        echo json_encode($datatable);
            
       
  }


    function paketsoal(){
        $id_level=$this->session->level;
        $link='simpeg/paketsoal';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama'=>$this->db->escape_str($this->input->post('nama')));
                $tambah=$this->model_app->insert('simpeg_paketsoal',$data);
                if($tambah)
                {
                    $this->session->set_flashdata('sukses',"Data Paket Soal Berhasil Ditambah");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Paket Soal Gagal Ditambah");
                }
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>$this->input->post('id'));
                $data=array('nama'=>$this->db->escape_str($this->input->post('nama')));
                $tambah=$this->model_app->update('simpeg_paketsoal',$data,$where);
                if($tambah)
                {
                    $this->session->set_flashdata('sukses',"Data Paket Soal Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Paket Soal Gagal Diedit");
                }
                redirect($link);
            }
            else
            {
                $data['title']='Paket Soal';
                $data['record']=$this->model_app->view_ordering('simpeg_paketsoal','id','ASC');
                $this->template->load('admin','admin/simpeg/soal/paketsoal/data',$data); 
            }
           
        }
        else
        {
            redirect('home');
        }
    }

    function hapuspaketsoal($seo){
        $id_level=$this->session->level;
        $link='simpeg/paketsoal';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $tambah=$this->model_app->delete('simpeg_paketsoal',$id);
        if($tambah)
        {
            $this->session->set_flashdata('sukses',"Data Paket Soal Berhasil Dihapus");
        }
        else
        {
            $this->session->set_flashdata('gagal',"Data Paket Soal Gagal Dihapus");
        }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function editpaketsoal(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_paketsoal',$id)->row_array();
         
        echo'<input type="hidden" name="id" value="'.$sql['id'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama Paket Soal</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Paket Soal" value="'.$sql['nama'].'" required>
                  </div>
            </div>';
        }
    }


    function kategorisoal(){
        $id_level=$this->session->level;
        $link='simpeg/kategorisoal';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama'=>posttext('nama'),'waktu'=>postnumber('waktu'));
                $this->model_app->insert('simpeg_kategorisoal',$data);
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>$this->input->post('id'));
                $data=array('nama'=>posttext('nama'),'waktu'=>postnumber('waktu'));
                $this->model_app->update('simpeg_kategorisoal',$data,$where);
                redirect($link);
            }
            else
            {
                $data['title']='Kategori Soal';
                $data['record']=$this->model_app->view_ordering('simpeg_kategorisoal','id','ASC');
                $this->template->load('admin','admin/simpeg/soal/kategorisoal/data',$data); 
            }
           
        }
        else
        {
            redirect('home');
        }
    }

    function hapuskategorisoal($seo){
        $id_level=$this->session->level;
        $link='simpeg/kategorisoal';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $this->model_app->delete('simpeg_kategorisoal',$id);
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function editkategorisoal(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_kategorisoal',$id)->row_array();
         
        echo'<input type="hidden" name="id" value="'.$sql['id'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama Kategori Soal</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Kategori Soal" value="'.$sql['nama'].'" required>
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Waktu Ujian</label>
                  <div class="col-sm-9">
                    <input type="number" name="waktu" class="form-control" placeholder="Waktu Ujian" value="'.$sql['waktu'].'" required>
                  </div>
            </div>';
        }
    }


    function materisoal(){
        $id_level=$this->session->level;
        $link='simpeg/materisoal';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama'=>posttext('nama'),
                            'kategori'=>postnumber('kategori'));
                $this->model_app->insert('simpeg_materisoal',$data);
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>$this->input->post('id'));
                $data=array('nama'=>posttext('nama'),
                            'kategori'=>postnumber('kategori'));
                $this->model_app->update('simpeg_materisoal',$data,$where);
                redirect($link);
            }
            else
            {
                $data['title']='Materi Soal';
                $data['record']=$this->model_app->view_ordering('simpeg_materisoal','id','ASC');
                $this->template->load('admin','admin/simpeg/soal/materisoal/data',$data); 
            }
           
        }
        else
        {
            redirect('home');
        }
    }

    function hapusmaterisoal($seo){
        $id_level=$this->session->level;
        $link='simpeg/materisoal';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $this->model_app->delete('simpeg_materisoal',$id);
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function editmaterisoal(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_materisoal',$id)->row_array();
         
        echo'<input type="hidden" name="id" value="'.$sql['id'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Kategori Soal</label>
                  <div class="col-sm-9">
                    <select name="kategori" class="form-control" required>
                      <option value="">..::Pilih Kategori Soal::..</option>
                      '.opKategoriSoal($sql['kategori']).'
                    </select>
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama Materi Soal</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Materi Soal" value="'.$sql['nama'].'" required>
                  </div>
            </div>';
        }
    }


     function jenistes(){
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            
            $data['title']='Daftar Ujian';
            $data['record']=$this->model_app->view_where_ordering('simpeg_ujian',array('tahun'=>$tahun),'id','DESC');
            $this->template->load('admin','admin/simpeg/tes/data',$data); 
           
        }
        else
        {
            redirect('home');
        }
    }

    function jenistestambah(){
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['title']='Daftar Ujian';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaTulis($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $tgl_mulai=postnumber('tgl_mulai');
                $tgl_selesai=postnumber('tgl_selesai');
                $waktu_mulai=postnumber('waktu_mulai');
                $waktu_selesai=postnumber('waktu_selesai');
                $mulai=$tgl_mulai.' '.$waktu_mulai;
                $selesai=$tgl_selesai.' '.$waktu_selesai;
                $data=array('jalur_masuk'=>postnumber('jalur'),
                            'gelombang'=>postnumber('gelombang'),
                            'nama'=>posttext('nama'),
                            'model'=>postnumber('model'),
                            'waktu'=>postnumber('waktu'),
                            'waktu_mulai'=>$mulai,
                            'waktu_selesai'=>$selesai,
                            'tahun'=>$tahun, 
                            'kuisioner'=>postnumber('kuisioner'),                       
                            'user'=>$this->session->id_user
                        );
                $tambah=$this->model_app->insert('simpeg_ujian',$data);
                
                if($tambah)
                {
                    $this->session->set_flashdata('sukses',"Data Ujian Berhasil Ditambah");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Ujian Gagal Ditambah");
                }
                redirect($link);
            }
      
            else
            {
            $this->template->load('admin','admin/simpeg/tes/tambah',$data);
            }
            
        }
        else
        {
            redirect($link);
        }
    }


    function jenistesedit($seo){
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['title']='Daftar Ujian';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                $tgl_mulai=postnumber('tgl_mulai');
                $tgl_selesai=postnumber('tgl_selesai');
                $waktu_mulai=postnumber('waktu_mulai');
                $waktu_selesai=postnumber('waktu_selesai');
                $mulai=$tgl_mulai.' '.$waktu_mulai;
                $selesai=$tgl_selesai.' '.$waktu_selesai;
                $where=array('id'=>postnumber('id'));
                $data=array('jalur_masuk'=>postnumber('jalur'),
                            'gelombang'=>postnumber('gelombang'),
                            'nama'=>posttext('nama'),
                            'model'=>postnumber('model'),
                            'waktu'=>postnumber('waktu'),
                            'waktu_mulai'=>$mulai,
                            'waktu_selesai'=>$selesai,
                            'tahun'=>$tahun,
                            'kuisioner'=>postnumber('kuisioner'),               
                            'user'=>$this->session->id_user
                        );
                $tambah=$this->model_app->update('simpeg_ujian',$data,$where);
                
                if($tambah)
                {
                    $this->session->set_flashdata('sukses',"Data Ujian Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Ujian Gagal Diedit");
                }
                redirect($link);
            }
      
            else
            {
            $id=dekrip($seo);
            $data['rows']=$this->model_app->edit('simpeg_ujian',array('id'=>$id))->row_array();
            $this->template->load('admin','admin/simpeg/tes/edit',$data);
            }
            
        }
        else
        {
            redirect($link);
        }
    }    

    function jenisteshapus($seo){
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $tambah=$this->model_app->delete('simpeg_ujian',$id);
        if($tambah)
        {
            $this->session->set_flashdata('sukses',"Data Ujian Berhasil Dihapus");
        }
        else
        {
            $this->session->set_flashdata('gagal',"Data Ujian Gagal Dihapus");
        }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function lihatsoal($seo){
        $id_ujian=dekrip($seo);
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $data['title']='Daftar Soal Ujian '.viewUjian($id_ujian);
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {   
            $data['id_ujian']=$id_ujian;            
            $data['kategori']=$this->model_app->view_ordering('simpeg_kategorisoal','id','ASC');
                    
            $this->template->load('admin','admin/simpeg/tes/soal',$data);
        }
        else
        {
            redirect('dashboard');
        }
    }

    function ambilsoal($seo,$mat){
        $id_ujian=dekrip($seo);
        $materi=dekrip($mat);
        $kategori=viewKategoriMateri($materi);
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $data['header']=viewUjian($id_ujian);
        $data['title']='Ambil Soal Ujian '.viewMateriSoal($materi).' -'.viewKategoriSoal($kategori);
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
                if(isset($_POST['ambil']))
                {   
                    $kategori=$this->input->post('kategori');
                    $id_ujian=$this->input->post('id_ujian');
                    $materi=$this->input->post('materi');
                    $check=$this->input->post('check');
                    foreach ($check as $row) {
                        $data=array('id_ujian'=>$id_ujian,
                                    'kategori'=>$kategori,
                                    'materi'=>$materi,
                                    'id_soal'=>$row);
                        $this->model_app->insert('simpeg_soal_ujian',$data);
                        $this->session->set_flashdata('sukses',"Data Soal Berhasil Diambil");
                    }
                    redirect('simpeg/lihatsoal/'.enkrip($id_ujian));
                }
                else
                {
                    if(isset($_POST['cari']))
                    {
                    $this->session->set_userdata(array('pakai'=>postnumber('pakai'),'paket'=>postnumber('paket')));
                    }
                    $pakai=$this->session->pakai;
                    $paket=$this->session->paket;
                    $data['id_ujian']=$id_ujian;
                    $data['kategori']=$kategori;
                    $data['materi']=$materi;
                    $data['pakai']=$pakai;
                    $data['paket']=$paket;
                
                    $data['record']=$this->model_app->ambil_soal($id_ujian,$kategori,$materi,$pakai,$buku)->result_array();
               
                    $this->template->load('admin','admin/simpeg/tes/ambilsoal',$data);
                }
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function lihatsoalmateri($seo,$mat){
        $id_ujian=dekrip($seo);
        $materi=dekrip($mat);
        $kategori=viewKategoriMateri($materi);
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $data['header']=viewUjian($id_ujian);
        $data['title']='Lihat Soal '.viewMateriSoal($materi).' -'.viewKategoriSoal($kategori);
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
                
                $data['id_ujian']=$id_ujian;
                $data['materi']=$materi;
                $data['kategori']=$kategori;
                
                $data['record']=$this->model_app->lihat_soal($id_ujian,$materi)->result_array();
               
                $this->template->load('admin','admin/simpeg/tes/lihatsoal',$data);
                
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function hapussoalmateri(){
        $id_ujian=dekrip($this->uri->segment('3'));
        $materi=dekrip($this->uri->segment('4'));
        $id=dekrip($this->uri->segment('5'));

        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaHapus($link,$id_level))
        {
                
                $where=array('id'=>$id);
                $hapus=$this->model_app->delete('simpeg_soal_ujian',$where);
                if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Ujian Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Ujian Gagal Dihapus");
                }
                redirect('simpeg/lihatsoalmateri/'.enkrip($id_ujian).'/'.enkrip($materi));
         
        }
        else
        {
            redirect('dashboard');
        }
    }

    function hasilujian(){
        $id_level=$this->session->level;
        $link='simpeg/hasilujian';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('prodi'=>postnumber('prodi'),'jalur'=>postnumber('jalur'),'gelombang'=>postnumber('gelombang')));
            }
            $prodi=$this->session->prodi;
            $jalur=$this->session->jalur;
            $gelombang=$this->session->gelombang;
            $data['jalur']=$jalur;
            $data['gelombang']=$gelombang;
            $data['prodi']=$prodi;
            $data['title']='Hasil Ujian';
            $data['gel']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'GELOMBANG'),'kderef','ASC');
            $data['record']=$this->model_app->hasil_ujian($tahun,$prodi,$jalur,$gelombang);
            $this->template->load('admin','admin/simpeg/tes/hasil',$data); 
           
        }
        else
        {
            redirect('home');
        }
    }

    function lulus(){
        $id_level=$this->session->level;
        $link='simpeg/hasilujian';
        
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
                if(isset($_POST['lulus']))
                {   
                    $prodi=postnumber('prodi');
                    $data=array('lulus'=>'Lulus','prodi'=>$prodi);
                    $check=postnumber('check');
                    foreach ($check as $row) {
                        $where=array('id_pendaftaran'=>$row);
                       $this->model_app->update('simpeg_biodata',$data,$where);
                        
                    }
                    $this->session->set_flashdata('sukses','Data Peserta Berhasil DiLuluskan Pada Prodi '.viewProdi($prodi));
                    redirect($link);
                }
                else if(isset($_POST['tidak']))
                {
                    $prodi=postnumber('prodi');
                    $data=array('lulus'=>'Tidak Lulus','prodi'=>$prodi);
                    $check=postnumber('check');
                    foreach ($check as $row) {
                        $where=array('id_pendaftaran'=>$row);
                        $this->model_app->update('simpeg_biodata',$data,$where);
                        
                    }
                    $this->session->set_flashdata('sukses',"Data Soal Berhasil Diambil");
                    redirect($link);
                }
            
        }
        else
        {
            redirect('dashboard');
        }
    }


    function kelulusan($seo='lulus'){
        $id_level=$this->session->level;
        $link='simpeg/kelulusan';
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('prodi'=>postnumber('prodi')));
            }
            $prodi=$this->session->prodi;
            $data['prodi']=$prodi;
            if($seo=='lulus')
            {
            $data['title']='Daftar Lulus';
            if($prodi=='')
            {
            $data['record']=$this->model_app->view_where_ordering('simpeg_biodata',array('tahun'=>$tahun,'lulus'=>'Lulus'),'nama','ASC');
            }
            else
            {
               $data['record']=$this->model_app->view_where_ordering('simpeg_biodata',array('prodi'=>$prodi,'tahun'=>$tahun,'lulus'=>'Lulus'),'nama','ASC'); 
            }
            $this->template->load('admin','admin/simpeg/tes/lulus',$data); 
            }
            else
            {
            $data['title']='Daftar Tidak Lulus';
            $data['record']=$this->model_app->view_tidak_lulus($tahun);
            $this->template->load('admin','admin/simpeg/tes/tidaklulus',$data);   
            }
           
        }
        else
        {
            redirect('home');
        }
    }

    function resetlulus($seo){
        $id_level=$this->session->level;
        $link='simpeg/kelulusan';
        $id=dekrip($seo);
        if(bisaUbah($link,$id_level))
        {
        $where = array('id_pendaftaran' => $id);
        $data=array('lulus'=>'Proses','prodi'=>NULL);
        $tambah=$this->model_app->update('simpeg_biodata',$data,$where);
        if($tambah)
        {
            $this->session->set_flashdata('sukses',"Data Kelulusan Berhasil Direset");
        }
        else
        {
            $this->session->set_flashdata('gagal',"Data Kelulusan Gagal Dihapus");
        }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function kuisioner($seo){
        $id_ujian=dekrip($seo);
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $data['title']='Daftar Soal Kuisioner '.viewUjian($id_ujian);
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {   
            $data['id_ujian']=$id_ujian;            
            $data['record']=$this->model_app->view_kuisioner_ujian($id_ujian);
                    
            $this->template->load('admin','admin/simpeg/tes/kuisioner',$data);
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kuisionersoal($seo){
        $id_ujian=dekrip($seo);
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        $data['header']=viewUjian($id_ujian);
        $data['title']='Ambil Soal Kuisioner '.viewUjian($id_ujian);
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaBaca($link,$id_level))
        {
                if(isset($_POST['ambil']))
                {   
                    
                    $id_ujian=$this->input->post('id_ujian');
                    
                    $check=$this->input->post('check');
                    foreach ($check as $row) {
                        $data=array('id_ujian'=>$id_ujian,
                                    'kuisioner'=>$row,
                                    'jenis'=>viewKuisioner($row,'jenis'),
                                    'kategori'=>viewKuisioner($row,'kategori'));
                        $this->model_app->insert('simpeg_kuisioner_ujian',$data);
                        $this->session->set_flashdata('sukses',"Data Soal Kuisioner Berhasil Diambil");
                    }
                    redirect('simpeg/kuisioner/'.enkrip($id_ujian));
                }
                else
                {
                    
                    
                    $data['id_ujian']=$id_ujian;
                             
                    $data['record']=$this->model_app->ambil_soal_kuisioner($id_ujian);
               
                    $this->template->load('admin','admin/simpeg/tes/kuisionersoal',$data);
                }
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kuisionersoalhapus(){
        $id_ujian=dekrip($this->uri->segment('3'));    
        $id=dekrip($this->uri->segment('4'));
        $id_level=$this->session->level;
        $link='simpeg/jenistes';
        
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';

        if(bisaHapus($link,$id_level))
        {
                
                $where=array('id'=>$id);
                //echo $id;

                $hapus=$this->model_app->delete('simpeg_kuisioner_ujian',$where);
                if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Kuisioner Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Kuisioner Gagal Dihapus Karena Kuisioner Ini Sudah Ada yang Kerjakan");
                }
                redirect('simpeg/kuisioner/'.enkrip($id_ujian));
         
        }
        else
        {
            redirect('dashboard');
        }
    }


    function kuisionerhasil($tiga,$empat){
        $id_level=$this->session->level;
        $link='simpeg/hasilujian';
        $id_ujian=dekrip($tiga);
        $id_pendaftaran=dekrip($empat);
        $tahun=tahunsimpeg();
        $data['tahun']=$tahun;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='simpeg';
        $data['id_ujian']=$id_ujian;
        $data['id_pendaftaran']=$id_pendaftaran;

        if(bisaBaca($link,$id_level))
        {
            $data['title']='Hasil Kuisioner';
            $data['kuantitatif']=$this->model_app->view_where_ordering('simpeg_kuisioner_kerjakan',array('id_ujian'=>$id_ujian,'id_pendaftaran'=>$id_pendaftaran,'jenis'=>'Kuantitatif'),'kategori,id_soal','ASC');
            $data['kualitatif']=$this->model_app->view_where_ordering('simpeg_kuisioner_kerjakan',array('id_ujian'=>$id_ujian,'id_pendaftaran'=>$id_pendaftaran,'jenis'=>'Kualitatif'),'kategori,id_soal','ASC');
            
            $this->template->load('admin','admin/simpeg/tes/kuisionerhasil',$data); 
        }
        else
        {
            redirect('home');
        }
    }

} //controller