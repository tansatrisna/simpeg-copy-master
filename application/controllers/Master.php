<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

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
	public function __construct()
    {
        parent::__construct();
        $this->load->model('model_sdm');
    }
    function index(){
        redirect('dashboard');
    }

    

    function unit(){
        $id_level=$this->session->level;
        $link='master/unit';
        $data['header']='Master Data';
        $data['title']='Unit';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaBaca($link,$id_level))
        {

            
                $data['record']=$this->model_app->view_unit();
                $this->template->load('admin','admin/master/unit/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function unittambah(){
        $id_level=$this->session->level;
        $link='master/unit';
        $data['header']='Master Data';
        $data['title']='Unit';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
               
                     $data=array( 
                               'nama'=>posttext('nama'),
                               'kelompok'=>postnumber('kelompok'),
                               'parent'=>posttext('parent')
                              
                             );
               

                $simpan=$this->model_app->insert('m_unit',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Unit Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Unit Gagal Disimpan");
                }
                redirect($link);
            }
            else
            {
              
                $this->template->load('admin','admin/master/unit/tambah',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function unitedit($seo){
        $id_level=$this->session->level;
        $link='master/unit';
        $data['header']='Master Data';
        $data['title']='Unit';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                

                $where= array('id'=>postnumber('id'));
                $simpan=array( 
                               'nama'=>posttext('nama'),
                               'kelompok'=>postnumber('kelompok'),
                               'parent'=>posttext('parent')
                              
                             );

               $update= $this->model_app->update('m_unit',$simpan,$where);
                

                if($update)
                {
                    $this->session->set_flashdata('sukses',"Data Unit Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Unit Gagal Diedit");
                }
                redirect($link);


            }
            else
            {
                $id=dekrip($seo);
                $data['rows']=$this->model_app->edit('m_unit',array('id'=>$id))->row_array();
                $this->template->load('admin','admin/master/unit/edit',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    

    function unithapus($seo){
        $id_level=$this->session->level;
        $link='master/unit';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($seo));
        $hapus=$this->model_app->delete('m_unit',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Unit Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Unit Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function sdm(){
        $id_level=$this->session->level;
        $link='master/sdm';
        $data['header']='Master Data';
        $data['title']='Sumber Daya Manusia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('unit'=>postnumber('unit'),'jenis'=>postnumber('jenis'),'aktif'=>postnumber('aktif')));
            }
            $unit=$this->session->unit;
            $jenis=$this->session->jenis;
            $aktif=$this->session->aktif;
            $data['unit']=$unit;
            $data['jenis']=$jenis;
            $data['aktif']=$aktif;
            if($aktif=='')
            {
                if($unit=='' AND $jenis=='')
                {
                $data['record']=$this->model_app->view_ordering('m_sdm','idsdm','ASC');
                }
                else if($unit=='' AND $jenis !='')
                {
                $data['record']=$this->model_app->view_where_ordering('m_sdm',array('jenis'=>$jenis),'idsdm','ASC');
                }
                else if($unit!='' AND $jenis =='')
                {
                $data['record']=$this->model_app->view_where_ordering('m_sdm',array('unit'=>$unit),'idsdm','ASC');
                }
                else
                {
                $data['record']=$this->model_app->view_where_ordering('m_sdm',array('unit'=>$unit,'jenis'=>$jenis),'idsdm','ASC');
                }
            }
            else
            {
                if($unit=='' AND $jenis=='')
                {
                $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$aktif),'idsdm','ASC');
                }
                else if($unit=='' AND $jenis !='')
                {
                $data['record']=$this->model_app->view_where_ordering('m_sdm',array('jenis'=>$jenis,'status_aktif'=>$aktif),'idsdm','ASC');
                }
                else if($unit!='' AND $jenis =='')
                {
                $data['record']=$this->model_app->view_where_ordering('m_sdm',array('unit'=>$unit,'status_aktif'=>$aktif),'idsdm','ASC');
                }
                else
                {
                $data['record']=$this->model_app->view_where_ordering('m_sdm',array('unit'=>$unit,'jenis'=>$jenis,'status_aktif'=>$aktif),'idsdm','ASC');
                }
            }
            $this->template->load('admin','admin/master/sdm/data',$data);  
        }
        else
        {
            redirect('dashboard');
        }
    }

    function get_data_sdm()
    {
        $id_level=$this->session->level;
        $link='master/sdm';
        $list = $this->model_alumni->get_datatables();
        $data = array();
        //$no = $_POST['start'];
        foreach ($list as $field) {
          if(bisaUbah($link,$id_level))
          {
            $ubah=aksiEdit('master/sdmedit',enkrip($field->idsdm));
          }
          else
          {
            $ubah='';
          }

          if(bisaHapus($link,$id_level))
          {
            $hapus=aksiHapus('master/sdmhapus',enkrip($field->idsdm));
          }
          else
          {
            $hapus='';
          }
            //$no++;
            
            $row = array();
            $row[] = $field->idsdm;
            $row[] = $field->nip;
            $row[] = $field->nama;
            $row[] = $field->jenis;
            $row[] = $field->status;
            $row[] = $field->email;
            $row[] = aksiDetail('master/alumnisddetail',enkrip($field->idsdm));
            $row[] = $ubah.'&nbsp;'.$hapus;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->model_sdm->count_all(),
            "recordsFiltered" => $this->model_sdm->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function sdmtambah(){
        $id_level=$this->session->level;
        $link='master/sdm';
        $data['header']='Master Data';
        $data['title']='Sumber Daya Manusia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $config['upload_path'] = 'assets/img/sdm/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
                $config['max_size'] = '10000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('gambar');
                $hasil=$this->upload->data();
                $tanggal=postnumber('tanggal');
                $bulan=postnumber('bulan');
                $tahun=postnumber('tahun');
                $tgl_lahir=$tahun.'-'.$bulan.'-'.$tanggal;
                $email=postnumber('email');
                $idsdm=idSdm('SDM');
                $salt=randomSalt();
                $token=token();
                $password=create_hash($email,$salt);
                
                if($hasil['file_name']!='')
                {
                     $data=array('idsdm'=>$idsdm,
                                'jenis'=>postnumber('jenis'),
                                'status'=>postnumber('status'),
                                'nip'=>postnumber('nip'),
                                'nidn'=>postnumber('nidn'),
                                'unit'=>postnumber('unit'),
                                'nama'=>posttext('nama'),
                                'gelar_depan'=>posttext('gelar_depan'),
                                'gelar_belakang'=>posttext('gelar_belakang'),
                                'agama'=>postnumber('agama'),
                                'jk'=>postnumber('jk'),
                                'tempat_lahir'=>posttext('tempat_lahir'),
                                'tgl_lahir'=>$tgl_lahir,
                                'nik'=>postnumber('nik'),
                                'hp'=>postnumber('hp'),
                                'alamat'=>posttext('alamat'),
                                'email'=>postnumber('email'),
                                'email_institusi'=>postnumber('email_institusi'),
                                'npwp'=>postnumber('npwp'),
                                'bank'=>postnumber('bank'),
                                'norek'=>postnumber('norek'),
                                'kodepos'=>postnumber('kodepos'),
                                'no_sk'=>postnumber('no_sk'),
                                'mulai_masuk'=>postnumber('mulai_masuk'),
                                
                                'kode_pendidikan'=>postnumber('kode_pendidikan'),
                                'instansi_induk'=>postnumber('instansi_induk'),
                                
                                'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                'jabatan_struktural'=>postnumber('jabatan_struktural'),
                                'orcid_id'=>postnumber('orcid_id'),
                                'scholar_id'=>postnumber('scholar_id'),
                                'sinta_id'=>postnumber('sinta_id'),
                                'foto'=>$hasil['file_name'],
                                'salt'=>$salt,
                                'token'=>$token,
                                'password'=>$password
                                
                             );
                }
                else
                {
                    $data=array('idsdm'=>$idsdm,
                                'jenis'=>postnumber('jenis'),
                                'status'=>postnumber('status'),
                                'nip'=>postnumber('nip'),
                                'nidn'=>postnumber('nidn'),
                                'unit'=>postnumber('unit'),
                                'nama'=>posttext('nama'),
                                'gelar_depan'=>posttext('gelar_depan'),
                                'gelar_belakang'=>posttext('gelar_belakang'),
                                'agama'=>postnumber('agama'),
                                'jk'=>postnumber('jk'),
                                'tempat_lahir'=>posttext('tempat_lahir'),
                                'tgl_lahir'=>$tgl_lahir,
                                'nik'=>postnumber('nik'),
                                'hp'=>postnumber('hp'),
                                'alamat'=>posttext('alamat'),
                                'email'=>postnumber('email'),
                                'email_institusi'=>postnumber('email_institusi'),
                                'npwp'=>postnumber('npwp'),
                                'bank'=>postnumber('bank'),
                                'norek'=>postnumber('norek'),
                                'kodepos'=>postnumber('kodepos'),
                                'mulai_masuk'=>postnumber('mulai_masuk'),
                                'no_sk'=>postnumber('no_sk'),
                                'kode_pendidikan'=>postnumber('kode_pendidikan'),
                                'instansi_induk'=>posttext('instansi_induk'),
                                
                                'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                'jabatan_struktural'=>postnumber('jabatan_struktural'),
                                'orcid_id'=>postnumber('orcid_id'),
                                'scholar_id'=>postnumber('scholar_id'),
                                'sinta_id'=>postnumber('sinta_id'),
                                'salt'=>$salt,
                                'token'=>$token,
                                'password'=>$password
                                
                             );
                }
               

                $simpan=$this->model_app->insert('m_sdm',$data);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Sumber Daya Manusia Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Sumber Daya Manusia Gagal Disimpan");
                }
                redirect($link);
            }
            else
            {
              
                $this->template->load('admin','admin/master/sdm/tambah',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function sdmedit($seo){
        $id_level=$this->session->level;
        $link='master/sdm';
        $data['header']='Master Data';
        $data['title']='Sumber Daya Manusia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                

                $where= array('idsdm'=>postnumber('idsdm'));
                $config['upload_path'] = 'assets/img/sdm/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
                $config['max_size'] = '10000'; // kb
                $this->load->library('upload', $config);
                $this->upload->do_upload('gambar');
                $hasil=$this->upload->data();
                $tanggal=postnumber('tanggal');
                $bulan=postnumber('bulan');
                $tahun=postnumber('tahun');
                $tgl_lahir=$tahun.'-'.$bulan.'-'.$tanggal;
                $email=postnumber('email');
                
                
                if($hasil['file_name']!='')
                {
                     $simpan=array(
                                'jenis'=>postnumber('jenis'),
                                'status'=>postnumber('status'),
                                'nip'=>postnumber('nip'),
                                'nidn'=>postnumber('nidn'),
                                'unit'=>postnumber('unit'),
                                'nama'=>posttext('nama'),
                                'gelar_depan'=>posttext('gelar_depan'),
                                'gelar_belakang'=>posttext('gelar_belakang'),
                                'agama'=>postnumber('agama'),
                                'jk'=>postnumber('jk'),
                                'status_nikah'=>postnumber('status_nikah'),
                                'tempat_lahir'=>posttext('tempat_lahir'),
                                'tgl_lahir'=>$tgl_lahir,
                                'nik'=>postnumber('nik'),
                                'hp'=>postnumber('hp'),
                                'alamat'=>posttext('alamat'),
                                'email'=>postnumber('email'),
                                'email_institusi'=>postnumber('email_institusi'),
                                'npwp'=>postnumber('npwp'),
                                'bank'=>postnumber('bank'),
                                'norek'=>postnumber('norek'),
                                'kodepos'=>postnumber('kodepos'),
                                'no_sk'=>postnumber('no_sk'),
                                'mulai_masuk'=>postnumber('mulai_masuk'),
                                
                                'kode_pendidikan'=>postnumber('kode_pendidikan'),
                                'instansi_induk'=>postnumber('instansi_induk'),
                                
                                'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                'jabatan_struktural'=>postnumber('jabatan_struktural'),
                                'orcid_id'=>postnumber('orcid_id'),
                                'scholar_id'=>postnumber('scholar_id'),
                                'sinta_id'=>postnumber('sinta_id'),
                                'foto'=>$hasil['file_name']
                                
                             );
                }
                else
                {
                    $simpan=array(
                                'jenis'=>postnumber('jenis'),
                                'status'=>postnumber('status'),
                                'nip'=>postnumber('nip'),
                                'nidn'=>postnumber('nidn'),
                                'unit'=>postnumber('unit'),
                                'nama'=>posttext('nama'),
                                'gelar_depan'=>posttext('gelar_depan'),
                                'gelar_belakang'=>posttext('gelar_belakang'),
                                'agama'=>postnumber('agama'),
                                'jk'=>postnumber('jk'),
                                'status_nikah'=>postnumber('status_nikah'),
                                'tempat_lahir'=>posttext('tempat_lahir'),
                                'tgl_lahir'=>$tgl_lahir,
                                'nik'=>postnumber('nik'),
                                'hp'=>postnumber('hp'),
                                'alamat'=>posttext('alamat'),
                                'email'=>postnumber('email'),
                                'email_institusi'=>postnumber('email_institusi'),
                                'npwp'=>postnumber('npwp'),
                                'bank'=>postnumber('bank'),
                                'norek'=>postnumber('norek'),
                                'kodepos'=>postnumber('kodepos'),
                                'mulai_masuk'=>postnumber('mulai_masuk'),
                                'no_sk'=>postnumber('no_sk'),
                                'kode_pendidikan'=>postnumber('kode_pendidikan'),
                                'instansi_induk'=>posttext('instansi_induk'),
                                
                                'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                'jabatan_struktural'=>postnumber('jabatan_struktural'),
                                'orcid_id'=>postnumber('orcid_id'),
                                'scholar_id'=>postnumber('scholar_id'),
                                'sinta_id'=>postnumber('sinta_id')
                                
                             );
                }

               $update= $this->model_app->update('m_sdm',$simpan,$where);
                

                if($update)
                {
                    $this->session->set_flashdata('sukses',"Data Sumber Daya Manusia Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Sumber Daya Manusia Gagal Diedit");
                }
                redirect($link);


            }
            else
            {
                $id=dekrip($seo);
                $data['rows']=$this->model_app->edit('m_sdm',array('idsdm'=>$id))->row_array();
                $this->template->load('admin','admin/master/sdm/edit',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function sdmdetail($seo,$tab='profil'){
        $id_level=$this->session->level;
        $link='master/sdm';
        $data['header']='Detail Sumber Daya Manusia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        $idsdm=dekrip($seo);
        if(bisaBaca($link,$id_level))
        {
            $row=$this->model_app->edit('m_sdm',array('idsdm'=>$idsdm))->row_array();
            if($row['jenis']=='DOSEN')
            {
            $tabs=array('profil'=>'Profil','pendidikan'=>'Pendidikan','pelatihan'=>'Pelatihan','seminar'=>'Seminar','penghargaan'=>'Penghargaan','penelitian'=>'Penelitian','publikasi'=>'Publikasi','pengabdian'=>'Pengabdian Masyarakat','serdos'=>'Sertifikasi Dosen','kegmhs'=>'Kegiatan Mahasiswa','dokumen'=>'Dokumen','status'=>'Status Aktif');
            }
            else
            {
              $tabs=array('profil'=>'Profil','pendidikan'=>'Pendidikan','pelatihan'=>'Pelatihan','seminar'=>'Seminar','penghargaan'=>'Penghargaan','penelitian'=>'Penelitian','publikasi'=>'Publikasi','pengabdian'=>'Pengabdian Masyarakat','kegmhs'=>'Kegiatan Mahasiswa','dokumen'=>'Dokumen','status'=>'Status Aktif');  
            }
            
            if($tab=='profil')
            {
                $data['title']='PROFIL';
            }
            else if($tab=='status')
            {
                $data['title']='STATUS AKTIF';
            }
            else if($tab=='penelitian')
            {
                $data['title']='PENELITIAN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_penelitian',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='seminar')
            {
                $data['title']='SEMINAR';
                $data['record']=$this->model_app->view_where_ordering('simpeg_seminar',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='publikasi')
            {
                $data['title']='PUBLIKASI';
                $data['record']=$this->model_app->view_where_ordering('simpeg_publikasi',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='pendidikan')
            {
                $data['title']='PENDIDIKAN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_pendidikan',array('idsdm'=>$idsdm),'jenjang','DESC');
            }
            else if($tab=='pelatihan')
            {
                $data['title']='PELATIHAN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_pelatihan',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='penghargaan')
            {
                $data['title']='PENGHARGAAN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_penghargaan',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='pengabdian')
            {
                $data['title']='PENGABDIAN MASYARAKAT';
                $data['record']=$this->model_app->view_where_ordering('simpeg_pengabdian',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='serdos')
            {
                $data['title']='SERTIFIKASI DOSEN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_serdos',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='kegmhs')
            {
                $data['title']='KEGIATAN KEMAHASISWAAN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_kegiatan_kemahasiswaan',array('idsdm'=>$idsdm),'tahun','DESC');
            }
            else if($tab=='dokumen')
            {
                $data['title']='DOKUMEN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_dokumen',array('idsdm'=>$idsdm),'id','DESC');
            }
            $data['tab']=$tab;
            $data['tabs']=$tabs;
            $data['seo']=$seo;
            $data['rows']=$row;
            $this->template->load('admin','admin/master/sdm/detail',$data);  
           
        }
        else
        {
            redirect($link);
        }
    }

    function sdmdetailtambah($seo,$tab='profil'){
        $id_level=$this->session->level;
        $link='master/sdm';
        $data['header']='Detail Sumber Daya Manusia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        $idsdm=dekrip($seo);
        if(bisaTulis($link,$id_level))
        {
            $data['tab']=$tab;
            $data['tabs']=$tabs;
            $data['seo']=$seo;
            $data['idsdm']=$idsdm;
            $data['aksi']='master/sdmdetailtambah/'.$seo.'/'.$tab; 
            $data['kembali']='master/sdmdetail/'.$seo.'/'.$tab;        
            if($tab=='profil')
            {
                redirect('master/sdmdetail/'.$seo);
            }
            else if($tab=='status')
            {
                redirect('master/sdmdetail/'.$seo.'/'.$tab);
            }
            else if($tab=='penelitian')
            {
                if(isset($_POST['tambah']))
                {
                    $judul=posttext('judul_penelitian');
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'sumber_dana'=>postnumber('sumber_dana'),
                                  'biaya_penelitian'=>postnumber('biaya_penelitian'),
                                  'peran_penelitian'=>postnumber('peran_penelitian'),
                                  'judul_penelitian'=>$judul
                                  
                                 );
                    $this->model_app->insert('simpeg_penelitian',$simpan);
                    $this->session->set_flashdata('sukses','Data Penelitian Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH PENELITIAN';
                }
                
                
            }
            else if($tab=='seminar')
            {
                if(isset($_POST['tambah']))
                {
                    $judul=posttext('judul');
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'peran'=>postnumber('peran'),
                                  'jenis'=>postnumber('jenis'),
                                  'penyelenggara'=>posttext('penyelenggara'),
                                  'url'=>posttext('url'),
                                  'judul'=>$judul
                                  
                                 );
                    $this->model_app->insert('simpeg_seminar',$simpan);
                    $this->session->set_flashdata('sukses','Data Seminar Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH SEMINAR';
                }
                
                
            }

            else if($tab=='publikasi')
            {
                if(isset($_POST['tambah']))
                {
                                        
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'judul'=>posttext('judul'),
                                  'tahun'=>postnumber('tahun'),
                                  'jenis'=>postnumber('jenis'),
                                  'url'=>posttext('url')
                                  
                                 );
                    $this->model_app->insert('simpeg_publikasi',$simpan);
                    $this->session->set_flashdata('sukses','Data Publikasi Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH PUBLIKASI';
                }
                
                
            }

            else if($tab=='pendidikan')
            {
                if(isset($_POST['tambah']))
                {
                    $tamatan=postnumber('tamatan');
                    if($tamatan=='DN')
                    {
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'jenjang'=>postnumber('jenjang'),
                                  'nomor_ijazah'=>posttext('nomor_ijazah'),
                                  'tgl_ijazah'=>postnumber('tgl_ijazah'),
                                  'tamatan'=>$tamatan,
                                  'nama_sekolah_pt'=>posttext('nama_sekolah_pt'),
                                  'prop'=>postnumber('prop'),
                                  'kab'=>postnumber('kab'),
                                  'kec'=>postnumber('kec'),
                                  'jurusan'=>posttext('jurusan'),
                                  'pendidikan_terakhir'=>postnumber('pendidikan_terakhir'),
                                  'bidang_keahlian'=>postnumber('bidang_keahlian')
                                  
                                 );
                    }
                    else
                    {
                       $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'jenjang'=>postnumber('jenjang'),
                                  'nomor_ijazah'=>posttext('nomor_ijazah'),
                                  'tgl_ijazah'=>postnumber('tgl_ijazah'),
                                  'tamatan'=>$tamatan,
                                  'nama_sekolah_pt'=>posttext('nama_sekolah_pt'),
                                  'prop'=>NULL,
                                  'kab'=>NULL,
                                  'kec'=>NULL,
                                  'jurusan'=>posttext('jurusan'),
                                  'pendidikan_terakhir'=>postnumber('pendidikan_terakhir'),
                                  'bidang_keahlian'=>postnumber('bidang_keahlian')
                                  
                                 ); 
                    }
                    $this->model_app->insert('simpeg_pendidikan',$simpan);
                    $this->session->set_flashdata('sukses','Data Pendidikan Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH PENDIDIKAN';
                }
                
                
            }

            else if($tab=='pelatihan')
            {
                if(isset($_POST['tambah']))
                {
                    $config['upload_path'] = 'assets/img/sdm/berkas/';
                    $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
                    $config['max_size'] = '10000'; // kb
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('sertifikat');
                    $hasil=$this->upload->data(); 
                    if($hasil['file_name'] != '') 
                    {                 
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'nama_pelatihan'=>posttext('nama_pelatihan'),
                                  'jumlah_jam'=>postnumber('jumlah_jam'),
                                  'sertifikat'=>$hasil['file_name']
                                  
                                 );
                    }
                    else
                    {
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'nama_pelatihan'=>posttext('nama_pelatihan'),
                                  'jumlah_jam'=>postnumber('jumlah_jam')
                                  
                                 );
                    }
                    $this->model_app->insert('simpeg_pelatihan',$simpan);
                    $this->session->set_flashdata('sukses','Data Pelatihan Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH PENELITIAN';
                }
                
                
            }

            else if($tab=='penghargaan')
            {
                if(isset($_POST['tambah']))
                {
                    
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'nama_penghargaan'=>posttext('nama_penghargaan'),
                                  'instansi_pemberi'=>posttext('instansi_pemberi')
                                  
                                 );
                    $this->model_app->insert('simpeg_penghargaan',$simpan);
                    $this->session->set_flashdata('sukses','Data Penghargaan Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH PENGHARGAAN';
                }
                
                
            }

            else if($tab=='pengabdian')
            {
                if(isset($_POST['tambah']))
                {
                    
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'judul'=>posttext('judul'),
                                  'peran'=>postnumber('peran'),
                                  'tempat'=>posttext('tempat'),
                                  'sumber_dana'=>postnumber('sumber_dana'),
                                  'biaya'=>postnumber('biaya')
                                 );
                    $this->model_app->insert('simpeg_pengabdian',$simpan);
                    $this->session->set_flashdata('sukses','Data Pengabdian Masyrakat Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH PENGABDIAN MASYARAKAT';
                }
                
                
            }

            else if($tab=='serdos')
            {
                if(isset($_POST['tambah']))
                {
                    
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'nomor'=>posttext('nomor'),
                                  'tanggal'=>postnumber('tanggal')
                                  
                                 );
                    $this->model_app->insert('simpeg_serdos',$simpan);
                    $this->session->set_flashdata('sukses','Data Sertifikasi Dosen Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH SERTIFIKASI DOSEN';
                }
                
                
            }

            else if($tab=='kegmhs')
            {
                if(isset($_POST['tambah']))
                {
                    
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'judul'=>posttext('judul'),
                                  'peran'=>posttext('peran'),
                                  'tempat'=>posttext('tempat')
                                  
                                 );
                    $this->model_app->insert('simpeg_kegiatan_kemahasiswaan',$simpan);
                    $this->session->set_flashdata('sukses','Data Kegiatan Kemahasiswaan Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH KEGIATAN KEMAHASISWAAN';
                }
                
                
            }

            else if($tab=='dokumen')
            {
                if(isset($_POST['tambah']))
                {
                    $config['upload_path'] = 'assets/img/sdm/berkas/';
                    $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
                    $config['max_size'] = '10000'; // kb
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('berkas');
                    $hasil=$this->upload->data(); 
                    if($hasil['file_name'] != '') 
                    {                 
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  
                                  'nama'=>posttext('nama'),
                                  'berkas'=>$hasil['file_name']
                                  
                                 );
                    }
                    else
                    {
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  
                                  'nama'=>posttext('nama')
                                  
                                 );
                    }
                    $this->model_app->insert('simpeg_dokumen',$simpan);
                    $this->session->set_flashdata('sukses','Data Dokumen Berhasil Disimpan');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM TAMBAH DOKUMEN';
                }
                
                
            }
            
            $this->template->load('admin','admin/master/sdm/detailtambah',$data);  
           
        }
        else
        {
            redirect($link);
        }
    }

    function sdmdetailedit($seo,$tab='profil',$id){
        $id_level=$this->session->level;
        $link='master/sdm';
        $data['header']='Detail Sumber Daya Manusia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        $idsdm=dekrip($seo);
        $idedit=dekrip($id);
        $data['idedit']=$idedit;
        if(bisaUbah($link,$id_level))
        {
            $data['tab']=$tab;
            $data['tabs']=$tabs;
            $data['seo']=$seo;
            $data['idsdm']=$idsdm;
            $data['aksi']='master/sdmdetailedit/'.$seo.'/'.$tab; 
            $data['kembali']='master/sdmdetail/'.$seo.'/'.$tab;        
            if($tab=='profil')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('idsdm'=>$idsdm);
                    $config['upload_path'] = 'assets/img/sdm/';
                    $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
                    $config['max_size'] = '10000'; // kb
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('gambar');
                    $hasil=$this->upload->data();
                    $tanggal=postnumber('tanggal');
                    $bulan=postnumber('bulan');
                    $tahun=postnumber('tahun');
                    $tgl_lahir=$tahun.'-'.$bulan.'-'.$tanggal;
                    $email=postnumber('email');
                
                
                        if($hasil['file_name']!='')
                        {
                             $simpan=array(
                                        'jenis'=>postnumber('jenis'),
                                        'status'=>postnumber('status'),
                                        'nip'=>postnumber('nip'),
                                        'nidn'=>postnumber('nidn'),
                                        'unit'=>postnumber('unit'),
                                        'nama'=>posttext('nama'),
                                        'gelar_depan'=>posttext('gelar_depan'),
                                        'gelar_belakang'=>posttext('gelar_belakang'),
                                        'agama'=>postnumber('agama'),
                                        'jk'=>postnumber('jk'),
                                        'status_nikah'=>postnumber('status_nikah'),
                                        'tempat_lahir'=>posttext('tempat_lahir'),
                                        'tgl_lahir'=>$tgl_lahir,
                                        'nik'=>postnumber('nik'),
                                        'hp'=>postnumber('hp'),
                                        'alamat'=>posttext('alamat'),
                                        'email'=>postnumber('email'),
                                        'email_institusi'=>postnumber('email_institusi'),
                                        'npwp'=>postnumber('npwp'),
                                        'bank'=>postnumber('bank'),
                                        'norek'=>postnumber('norek'),
                                        'kodepos'=>postnumber('kodepos'),
                                        'no_sk'=>postnumber('no_sk'),
                                        'mulai_masuk'=>postnumber('mulai_masuk'),
                                        
                                        'kode_pendidikan'=>postnumber('kode_pendidikan'),
                                        'instansi_induk'=>postnumber('instansi_induk'),
                                        
                                        'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                        'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                        'jabatan_struktural'=>postnumber('jabatan_struktural'),
                                        'orcid_id'=>postnumber('orcid_id'),
                                        'scholar_id'=>postnumber('scholar_id'),
                                        'sinta_id'=>postnumber('sinta_id'),

                                        'foto'=>$hasil['file_name']
                                        
                                     );
                        }
                        else
                        {
                            $simpan=array(
                                        'jenis'=>postnumber('jenis'),
                                        'status'=>postnumber('status'),
                                        'nip'=>postnumber('nip'),
                                        'nidn'=>postnumber('nidn'),
                                        'unit'=>postnumber('unit'),
                                        'nama'=>posttext('nama'),
                                        'gelar_depan'=>posttext('gelar_depan'),
                                        'gelar_belakang'=>posttext('gelar_belakang'),
                                        'agama'=>postnumber('agama'),
                                        'jk'=>postnumber('jk'),
                                        'status_nikah'=>postnumber('status_nikah'),
                                        'tempat_lahir'=>posttext('tempat_lahir'),
                                        'tgl_lahir'=>$tgl_lahir,
                                        'nik'=>postnumber('nik'),
                                        'hp'=>postnumber('hp'),
                                        'alamat'=>posttext('alamat'),
                                        'email'=>postnumber('email'),
                                        'email_institusi'=>postnumber('email_institusi'),
                                        'npwp'=>postnumber('npwp'),
                                        'bank'=>postnumber('bank'),
                                        'norek'=>postnumber('norek'),
                                        'kodepos'=>postnumber('kodepos'),
                                        'mulai_masuk'=>postnumber('mulai_masuk'),
                                        'no_sk'=>postnumber('no_sk'),
                                        'kode_pendidikan'=>postnumber('kode_pendidikan'),
                                        'instansi_induk'=>posttext('instansi_induk'),
                                        
                                        'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                        'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                        'jabatan_struktural'=>postnumber('jabatan_struktural'),
                                        'orcid_id'=>postnumber('orcid_id'),
                                        'scholar_id'=>postnumber('scholar_id'),
                                        'sinta_id'=>postnumber('sinta_id')
                                        
                                     );
                        }

                       $update= $this->model_app->update('m_sdm',$simpan,$where);
                        

                        if($update)
                        {
                            $this->session->set_flashdata('sukses',"Data Sumber Daya Manusia Berhasil Diedit");
                        }
                        else
                        {
                            $this->session->set_flashdata('gagal',"Data Sumber Daya Manusia Gagal Diedit");
                        }
                        redirect($data['kembali']);


                }
                else
                {
                    $data['title']='FORM EDIT PROFIL';
                    $data['rows']=$this->model_app->edit('m_sdm',array('idsdm'=>$idsdm))->row_array();
                }
            }
            else if($tab=='status')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('idsdm'=>$idsdm);
                                    
                
                        
                            $simpan=array(
                                        'status_aktif'=>postnumber('status_aktif'),
                                        'tgl_aktif'=>postnumber('tgl_aktif'),
                                        'ket_aktif'=>postnumber('ket_aktif')
                                        
                                     );
                        
                       $update= $this->model_app->update('m_sdm',$simpan,$where);
                        

                        if($update)
                        {
                            $this->session->set_flashdata('sukses',"Data Status Sumber Daya Manusia Berhasil Diedit");
                        }
                        else
                        {
                            $this->session->set_flashdata('gagal',"Data Status Sumber Daya Manusia Gagal Diedit");
                        }
                        redirect($data['kembali']);


                }
                else
                {
                    $data['title']='FORM EDIT STATUS AKTIF';
                    $data['rows']=$this->model_app->edit('m_sdm',array('idsdm'=>$idsdm))->row_array();
                }
            }
            else if($tab=='penelitian')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    $judul=posttext('judul_penelitian');
                    
                    $simpan=array('tahun'=>postnumber('tahun'),
                                  'sumber_dana'=>postnumber('sumber_dana'),
                                  'biaya_penelitian'=>postnumber('biaya_penelitian'),
                                  'peran_penelitian'=>postnumber('peran_penelitian'),
                                  'judul_penelitian'=>$judul
                                 );
                    $this->model_app->update('simpeg_penelitian',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Penelitian Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT PENELITIAN';
                    $data['rows']=$this->model_app->edit('simpeg_penelitian',array('id'=>$idedit))->row_array();
                }
                
                
            }
            else if($tab=='seminar')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    $judul=posttext('judul');
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'peran'=>postnumber('peran'),
                                  'jenis'=>postnumber('jenis'),
                                  'penyelenggara'=>posttext('penyelenggara'),
                                  'url'=>posttext('url'),
                                  'judul'=>$judul
                                  
                                 );
                    $this->model_app->update('simpeg_seminar',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Seminar Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT SEMINAR';
                    $data['rows']=$this->model_app->edit('simpeg_seminar',array('id'=>$idedit))->row_array();
                }
                
                
            }

            else if($tab=='publikasi')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'judul'=>posttext('judul'),
                                  'tahun'=>postnumber('tahun'),
                                  'jenis'=>postnumber('jenis'),
                                  'url'=>posttext('url')
                                  
                                 );
                    $this->model_app->update('simpeg_publikasi',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Publikasi Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT PUBLIKASI';
                    $data['rows']=$this->model_app->edit('simpeg_publikasi',array('id'=>$idedit))->row_array();
                }
                
                
            }

            else if($tab=='pendidikan')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    
                    $tamatan=postnumber('tamatan');
                    if($tamatan=='DN')
                    {
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'jenjang'=>postnumber('jenjang'),
                                  'nomor_ijazah'=>posttext('nomor_ijazah'),
                                  'tgl_ijazah'=>postnumber('tgl_ijazah'),
                                  'tamatan'=>$tamatan,
                                  'nama_sekolah_pt'=>posttext('nama_sekolah_pt'),
                                  'prop'=>postnumber('prop'),
                                  'kab'=>postnumber('kab'),
                                  'kec'=>postnumber('kec'),
                                  'jurusan'=>posttext('jurusan'),
                                  'pendidikan_terakhir'=>postnumber('pendidikan_terakhir'),
                                  'bidang_keahlian'=>postnumber('bidang_keahlian')
                                  
                                 );
                    }
                    else
                    {
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'jenjang'=>postnumber('jenjang'),
                                  'nomor_ijazah'=>posttext('nomor_ijazah'),
                                  'tgl_ijazah'=>postnumber('tgl_ijazah'),
                                  'tamatan'=>$tamatan,
                                  'nama_sekolah_pt'=>posttext('nama_sekolah_pt'),
                                  'prop'=>NULL,
                                  'kab'=>NULL,
                                  'kec'=>NULL,
                                  'jurusan'=>posttext('jurusan'),
                                  'pendidikan_terakhir'=>postnumber('pendidikan_terakhir'),
                                  'bidang_keahlian'=>postnumber('bidang_keahlian')
                                  
                                 );
                    }
                    $this->model_app->update('simpeg_pendidikan',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Pendidikan Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT PENDIDIKAN';
                    $data['rows']=$this->model_app->edit('simpeg_pendidikan',array('id'=>$idedit))->row_array();
                }
                
                
            }

            else if($tab=='pelatihan')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    $config['upload_path'] = 'assets/img/sdm/berkas/';
                    $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
                    $config['max_size'] = '10000'; // kb
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('sertifikat');
                    $hasil=$this->upload->data(); 
                    if($hasil['file_name'] != '') 
                    {                 
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'nama_pelatihan'=>posttext('nama_pelatihan'),
                                  'jumlah_jam'=>postnumber('jumlah_jam'),
                                  'sertifikat'=>$hasil['file_name']
                                  
                                 );
                    }
                    else
                    {
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'nama_pelatihan'=>posttext('nama_pelatihan'),
                                  'jumlah_jam'=>postnumber('jumlah_jam')
                                  
                                 );
                    }
                    $this->model_app->update('simpeg_pelatihan',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Pelatihan Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT PELATIHAN';
                    $data['rows']=$this->model_app->edit('simpeg_pelatihan',array('id'=>$idedit))->row_array();
                }
                
                
            }

            else if($tab=='penghargaan')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    
                    
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'tahun'=>postnumber('tahun'),
                                  'nama_penghargaan'=>posttext('nama_penghargaan'),
                                  'instansi_pemberi'=>posttext('instansi_pemberi')
                                  
                                 );
                    $this->model_app->update('simpeg_penghargaan',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Seminar Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT PENGHARGAAN';
                    $data['rows']=$this->model_app->edit('simpeg_penghargaan',array('id'=>$idedit))->row_array();
                }
                
                
            }

            else if($tab=='pengabdian')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    
                     $simpan=array(
                                  'tahun'=>postnumber('tahun'),
                                  'judul'=>posttext('judul'),
                                  'peran'=>postnumber('peran'),
                                  'tempat'=>posttext('tempat'),
                                  'sumber_dana'=>postnumber('sumber_dana'),
                                  'biaya'=>postnumber('biaya')
                                  
                                 );
                    
                    $this->model_app->update('simpeg_pengabdian',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Pengabdian Masyarakat Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT PENGABDIAN MASYARAKAT';
                    $data['rows']=$this->model_app->edit('simpeg_pengabdian',array('id'=>$idedit))->row_array();
                }
                
                
            }

            else if($tab=='serdos')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    
                     $simpan=array(
                                  'tahun'=>postnumber('tahun'),
                                  'nomor'=>posttext('nomor'),
                                  'tanggal'=>postnumber('tanggal')
                                  
                                 );
                    
                    $this->model_app->update('simpeg_serdos',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Sertifikasi Dosen Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT SERTIFIKASI DOSEN';
                    $data['rows']=$this->model_app->edit('simpeg_serdos',array('id'=>$idedit))->row_array();
                }
                
                
            }

            else if($tab=='kegmhs')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    
                     $simpan=array(
                                  'tahun'=>postnumber('tahun'),
                                  'judul'=>posttext('judul'),
                                  'peran'=>posttext('peran'),
                                  'tempat'=>posttext('tempat')
                                  
                                 );
                    
                    $this->model_app->update('simpeg_kegiatan_kemahasiswaan',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Kegiatan Kemahasiswaan Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT KEGIATAN KEMAHASISWAAN';
                    $data['rows']=$this->model_app->edit('simpeg_kegiatan_kemahasiswaan',array('id'=>$idedit))->row_array();
                }
            }
            else if($tab=='dokumen')
            {
                if(isset($_POST['edit']))
                {
                    $where=array('id'=>postnumber('id'));
                    $config['upload_path'] = 'assets/img/sdm/berkas/';
                    $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PDF|pdf|jpeg';
                    $config['max_size'] = '10000'; // kb
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('berkas');
                    $hasil=$this->upload->data(); 
                    if($hasil['file_name'] != '') 
                    {                 
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'nama'=>posttext('nama'),
                                  'berkas'=>$hasil['file_name']
                                  
                                 );
                    }
                    else
                    {
                    $simpan=array('idsdm'=>postnumber('idsdm'),
                                  'nama'=>posttext('nama')
                                  
                                 );
                    }
                    $this->model_app->update('simpeg_dokumen',$simpan,$where);
                    $this->session->set_flashdata('sukses','Data Dokumen Berhasil Diedit');
                    redirect($data['kembali']);
                }
                else
                {
                    $data['title']='FORM EDIT DOKUMEN';
                    $data['rows']=$this->model_app->edit('simpeg_dokumen',array('id'=>$idedit))->row_array();
                }
                
                
            }
                
                
            
            
            $this->template->load('admin','admin/master/sdm/detailedit',$data);  
           
        }
        else
        {
            redirect($link);
        }
    }

    

    function sdmhapus($seo){
        $id_level=$this->session->level;
        $link='master/sdm';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($seo));
        $hapus=$this->model_app->delete('m_sdm',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Sumber Daya Manusia Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Sumber Daya Manusia Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    function sdmdetailhapus($seo,$tab='profil',$id){
        $id_level=$this->session->level;
        $link='master/sdm';
        $data['header']='Hapus Detail Sumber Daya Manusia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        $idsdm=dekrip($seo);
        $idedit=dekrip($id);
        $data['idedit']=$idedit;
        if(bisaHapus($link,$id_level))
        {
                        
            if($tab=='profil')
            {
                redirect('master/sdmdetail/'.$seo.'/'.$tab);
            }
            else if($tab=='penelitian')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_penelitian',$where);
            }
            else if($tab=='seminar')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_seminar',$where);
            }
            else if($tab=='publikasi')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_publikasi',$where);
            }
            else if($tab=='pendidikan')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_pendidikan',$where);
            }
            else if($tab=='pelatihan')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_pelatihan',$where);
            }
            else if($tab=='penghargaan')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_penghargaan',$where);
            }
            else if($tab=='pengabdian')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_pengabdian',$where);
            }
            else if($tab=='dokumen')
            {
                $where = array('id' => $idedit);
                $hapus=$this->model_app->delete('simpeg_dokumen',$where);
            }
            else
            {
                redirect('master/sdmdetail/'.$seo.'/'.$tab);
            }

            if($hapus)
            {
                $this->session->set_flashdata('sukses','Data '.$tab.' Berhasil Dihapus');
            }
            else
            {
                $this->session->set_flashdata('gagal','Data '.$tab.' Gagal Dihapus');
            }
            
        
            redirect('master/sdmdetail/'.$seo.'/'.$tab);
             
           
        }
        else
        {
            redirect($link);
        }
    }

    function sertifikat($tab){
        if(isset($_POST['rowid']))
        {
            $id = $this->input->post('rowid');
            if($tab=='pelatihan')
            {
             $sql=$this->model_app->edit('simpeg_pelatihan',array('id'=>$id))->row_array();
             echo '<object width="100%" height="400" data="'.base_url('assets/img/sdm/berkas/'.$sql['sertifikat']).'"></object>';
            }
         
        }
    }

    function dokumen($tab){
        if(isset($_POST['rowid']))
        {
            $id = $this->input->post('rowid');
            if($tab=='dokumen')
            {
             $sql=$this->model_app->edit('simpeg_dokumen',array('id'=>$id))->row_array();
             echo '<object width="100%" height="400" data="'.base_url('assets/img/sdm/berkas/'.$sql['berkas']).'"></object>';
            }
         
        }
    }

    function pejabat(){
        $id_level=$this->session->level;
        $link='master/pejabat';
        $data['header']='Master Data';
        $data['title']='Pejabat';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaBaca($link,$id_level))
        {

            
                $data['record']=$this->model_app->view_ordering('simpeg_pejabat','urutan','ASC');
                $this->template->load('admin','admin/master/pejabat/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function pejabattambah(){
        $id_level=$this->session->level;
        $link='master/pejabat';
        $data['header']='Master Data';
        $data['title']='Pejabat';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
               
                     $simpan=array( 
                               'idsdm'=>posttext('idsdm'),
                               'kelompok'=>postnumber('kelompok'),
                               'jabatan'=>posttext('jabatan'),
                               'urutan'=>posttext('urutan')
                              
                             );
               

                $simpan=$this->model_app->insert('simpeg_pejabat',$simpan);
                if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Pejabat Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pejabat Gagal Disimpan");
                }
                redirect($link);
            }
            else
            {
              
                $this->template->load('admin','admin/master/pejabat/tambah',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function pejabatedit($seo){
        $id_level=$this->session->level;
        $link='master/pejabat';
        $data['header']='Master Data';
        $data['title']='Unit';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                

                $where= array('id'=>postnumber('id'));
                $simpan=array( 
                               'idsdm'=>posttext('idsdm'),
                               'kelompok'=>postnumber('kelompok'),
                               'jabatan'=>posttext('jabatan'),
                               'urutan'=>posttext('urutan')
                              
                             );

               $update= $this->model_app->update('simpeg_pejabat',$simpan,$where);
                

                if($update)
                {
                    $this->session->set_flashdata('sukses',"Data Pejabat Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pejabat Gagal Diedit");
                }
                redirect($link);


            }
            else
            {
                $id=dekrip($seo);
                $data['rows']=$this->model_app->edit('simpeg_pejabat',array('id'=>$id))->row_array();
                $this->template->load('admin','admin/master/pejabat/edit',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    

    function pejabathapus($seo){
        $id_level=$this->session->level;
        $link='master/pejabat';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($seo));
        $hapus=$this->model_app->delete('simpeg_pejabat',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Pejabat Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pejabat Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }


    function pengumuman(){
        $id_level=$this->session->level;
        $link='master/pengumuman';
        $data['header']='Master Data';
        $data['title']='Pengumuman';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaBaca($link,$id_level))
        {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('target'=>postnumber('target')));
                }
                $target=$this->session->target;
                if($target=='')
                {
                    $target='SEMUA';
                }            
                $data['target']=$target;
                $data['record']=$this->model_app->view_pengumuman($target);
                $this->template->load('admin','admin/master/pengumuman/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function lihatpengumuman(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_pengumuman_sdm',$id)->row_array();
         
        echo $sql['isi'];
        }
    }

    function khususpengumuman(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_pengumuman_sdm',$id)->row_array();
        $sdm=explode("|", $sql['sdm']); 
        echo '<div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $no=0;
                    foreach ($sdm as $row) {
                        $no++;
                    echo'<tr>
                            <td>'.$no.'</td>
                            <td>'.viewDetailSdm($row,'nip').'</td>
                            <td>'.viewSdm($row).'</td>
                            <td>'.viewUnitSdm($row).'</td>
                        </tr>';
                    }
                        
                    echo'</tbody>
                </table>
              </div>';
        }
    }

    function pengumumantambah(){
        $id_level=$this->session->level;
        $link='master/pengumuman';
        $data['header']='Master Data';
        $data['title']='Pengumuman';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                 $judul=posttext('judul');
                 $seo=seo_title($judul);
                 $target=postnumber('target');
                 if($target=='KHUSUS')
                 {
                    $sdm=implode("|", postnumber('idsdm'));
                    $data=array( 
                           'judul'=>$judul,
                           'seo'=>$seo,
                           'isi'=>postnumber('isi'),
                           'target'=>$target,
                           'sdm'=>$sdm,
                           'user'=>$this->session->id_user
                         );
                 }
                 else
                 {
                    $data=array( 
                           'judul'=>$judul,
                           'seo'=>$seo,
                           'isi'=>postnumber('isi'),
                           'target'=>$target,
                           'user'=>$this->session->id_user
                         );
                 }


                $simpan=$this->model_app->insert('simpeg_pengumuman_sdm',$data);
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
              
                $this->template->load('admin','admin/master/pengumuman/tambah',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    function pengumumanedit($seo){
        $id_level=$this->session->level;
        $link='master/pengumuman';
        $data['header']='Master Data';
        $data['title']='Pengumuman';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='master';

        if(bisaUbah($link,$id_level))
        {
            if(isset($_POST['edit']))
            {
                

                $where= array('id'=>postnumber('id'));
                $judul=posttext('judul');
                 $seo=seo_title($judul);
                 $target=postnumber('target');
                 if($target=='KHUSUS')
                 {
                    $sdm=implode("|", postnumber('idsdm'));
                    $simpan=array( 
                           'judul'=>$judul,
                           'seo'=>$seo,
                           'isi'=>postnumber('isi'),
                           'target'=>$target,
                           'sdm'=>$sdm
                         );
                 }
                 else
                 {
                    $simpan=array( 
                           'judul'=>$judul,
                           'seo'=>$seo,
                           'isi'=>postnumber('isi'),
                           'target'=>$target
                           
                         );
                 }

               $update= $this->model_app->update('simpeg_pengumuman_sdm',$simpan,$where);
                

                if($update)
                {
                    $this->session->set_flashdata('sukses',"Data Pengumuman Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pengumuman Gagal Diedit");
                }
                redirect($link);


            }
            else
            {
                $id=dekrip($seo);
                $data['rows']=$this->model_app->edit('simpeg_pengumuman_sdm',array('id'=>$id))->row_array();
                $this->template->load('admin','admin/master/pengumuman/edit',$data);  
            }
        }
        else
        {
            redirect($link);
        }
    }

    

    function pengumumanhapus($seo){
        $id_level=$this->session->level;
        $link='master/pengumuman';

        if(bisaHapus($link,$id_level))
        {
        $where = array('id' => dekrip($seo));
        $hapus=$this->model_app->delete('simpeg_pengumuman_sdm',$where);
        if($hapus)
                {
                    $this->session->set_flashdata('sukses',"Data Pengumuman Berhasil Dihapus");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Pengumuman Gagal Dihapus");
                }
        redirect($link);
        }
        else
        {
        redirect($link); 
        }
    }

    
   

    
    


} //controller