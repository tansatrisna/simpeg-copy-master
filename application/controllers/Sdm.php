<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdm extends CI_Controller {

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

	function index()
  {
    redirect('sdm/pengumuman');
  }

  function profil($tab='profil'){
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['aprofil']='active';
        $data['title']='Beranda';

        $row=$this->model_app->edit('m_sdm',array('idsdm'=>$idsdm))->row_array();
        if($row['jenis']=='DOSEN')
        {
        $tabs=array('profil'=>'Biodata','pendidikan'=>'Pendidikan','pelatihan'=>'Pelatihan','seminar'=>'Seminar','penghargaan'=>'Penghargaan','penelitian'=>'Penelitian','publikasi'=>'Publikasi','pengabdian'=>'Pengabdian Masyarakat','serdos'=>'Sertifkasi Dosen','kegmhs'=>'Kegiatan Mahasiswa','dokumen'=>'Dokumen');
        }
        else
        {
          $tabs=array('profil'=>'Biodata','pendidikan'=>'Pendidikan','pelatihan'=>'Pelatihan','seminar'=>'Seminar','penghargaan'=>'Penghargaan','penelitian'=>'Penelitian','publikasi'=>'Publikasi','pengabdian'=>'Pengabdian Masyarakat','kegmhs'=>'Kegiatan Mahasiswa','dokumen'=>'Dokumen');
        }
            
            if($tab=='profil')
            {
                $data['title']='PROFIL';
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
                $data['title']='PELATIHAN';
                $data['record']=$this->model_app->view_where_ordering('simpeg_dokumen',array('idsdm'=>$idsdm),'id','DESC');
            }
            $data['tab']=$tab;
            $data['tabs']=$tabs;
            $data['seo']=$seo;
            $data['rows']=$row;
        
          $this->template->load('sdm','sdm/home',$data);
        
        
    }

    function tambah($tab='profil'){
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['ahome']='active';
        $data['title']='Beranda';

        
            $data['tab']=$tab;
            $data['tabs']=$tabs;
            $data['seo']=$seo;
            $data['idsdm']=$idsdm;
            $data['aksi']='sdm/tambah/'.$tab; 
            $data['kembali']='sdm/profil/'.$tab;        
            if($tab=='profil')
            {
                redirect('sdm/home');
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
                                  'tempat'=>posttext('tempat')
                                  
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
            
            $this->template->load('sdm','sdm/tambah',$data);  
           
        
    }


    function edit($tab='profil',$id){
      $link='sdm/profil';
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['ahome']='active';
        $data['title']='Beranda';
        $idedit=dekrip($id);
        $data['idedit']=$idedit;
            $data['tab']=$tab;
            $data['tabs']=$tabs;
            $data['seo']=$seo;
            $data['idsdm']=$idsdm;
            $data['aksi']='sdm/edit/'.$tab; 
            $data['kembali']='sdm/profil/'.$tab;        
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
                                        'status_nikah'=>postnumber('status_nikah'),
                                        'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                        'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                        'jabatan_struktural'=>postnumber('jabatan_struktural'),
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
                                        'status_nikah'=>postnumber('status_nikah'),
                                        'pangkat_golongan'=>postnumber('pangkat_golongan'),
                                        'jabatan_fungsional'=>postnumber('jabatan_fungsional'),
                                        'jabatan_struktural'=>postnumber('jabatan_struktural')
                                        
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
                    $data['title']='FORM EDIT PROFIL';
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
                                  'tempat'=>posttext('tempat')
                                  
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
                    $data['title']='FORM EDIT PELATIHAN';
                    $data['rows']=$this->model_app->edit('simpeg_dokumen',array('id'=>$idedit))->row_array();
                }
                
                
            }
            
            $this->template->load('sdm','sdm/edit',$data);  
        
    }

    


    function hapus($tab='profil',$id){
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['ahome']='active';
        $data['title']='Beranda';
        $idedit=dekrip($id);
        $data['idedit']=$idedit;
        if(bisaHapus($link,$id_level))
        {
                        
            if($tab=='profil')
            {
                redirect('sdm/profil/'.$tab);
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
        
            redirect('sdm/profil/'.$tab);
             
           
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

    function pengumuman($tab){
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['apengumuman']='active';
        $data['header']='Pengumuman';
        $data['rows']=$this->model_app->edit('m_sdm',array('idsdm'=>$idsdm))->row_array();
        if(isset($_POST['cari']))
        {
          $this->session->set_userdata(array('cari'=>postnumber('cari')));
        }

        $cari=$this->session->cari;
        $data['cari']=$cari;
       $query=$this->model_app->view_pengumuman_khusus($jenis,$idsdm,$cari);
     $jumlah=count($query);
      $config['base_url'] = base_url().'sdm/pengumuman';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $jumlah;
      $config['per_page'] = 10;  

      if ($this->uri->segment('3')==''){
        $dari = 0;
      }else{
        $hal=$this->uri->segment('3');
        $dari = ($hal-1) * $config['per_page'];
      }
      $data['title'] = "Pengumuman Terbaru";
      
     
      $data['total'] = $jumlah;
      $data['sisa'] = $config['per_page'];
      $data['dari'] = $dari;

      if (is_numeric($dari)) {
        $data['record'] = $this->model_app->view_pengumuman_khusus_limit($jenis,$idsdm,$cari,$dari,$config['per_page']);
        $data['tautan']=$this->model_app->view_ordering('simpeg_tautan','id','ASC');
      }else{
        redirect();
      }
      $this->pagination->initialize($config);
        
        
        $this->template->load('sdm','sdm/pengumuman',$data);
    }

    function pengumumandetail($seo){
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['apengumuman']='active';
        $data['header']='Pengumuman';
        $id=dekrip($seo);
        $where=array('id'=>$id);
        $row=$this->model_app->edit('simpeg_pengumuman_sdm',$where)->row_array();
        $dibaca=$row['dibaca']+1;
        $update=array('dibaca'=>$dibaca);
        $this->model_app->update('simpeg_pengumuman_sdm',$update,$where);
        $data['rows']=$row;
        $this->template->load('sdm','sdm/pengumumandetail',$data);
    }


    function gantipassword(){
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['apengumuman']='active';
        $data['header']='Ganti Password';
        if(isset($_POST['edit']))
        {
            $password=$this->db->escape_str($this->input->post('pass'));
            $pass1=$this->db->escape_str($this->input->post('pass1'));
            $pass2=$this->db->escape_str($this->input->post('pass2'));
            

            $cek = $this->model_app->view_where('m_sdm',array('idsdm'=>$idsdm));
            
                foreach ($cek->result_array() as $r){
                $hash_pass=$r['password'];
                $salt=$r['salt'];
                }
                $check=validateLogin($password, $hash_pass, $salt);
                if($check==true)
                    {
                 
                        if($pass1==$pass2)
                          {
                                            $salt1=randomSalt();
                                            $passbaru=create_hash($pass1,$salt1);
                                             $data = array('password'=>$passbaru,
                                                            'salt'=>$salt1,
                                                            'token'=>token());
                                             $where=array('idsdm'=>$idsdm);
                                             
                                             $this->model_app->update('m_sdm',$data,$where); 
                                            
                                             echo"<script type=\"text/javascript\">window.alert('Password Berhasil di Ganti, Silahkan Login Kembali');window.location.href = '".base_url()."logout';</script>";
                                        
                                        
                       
                          }
                          else
                          {
                            echo"<script type=\"text/javascript\">window.alert('Password Baru Tidak Sama');
            window.location.href = '".base_url()."sdm/gantipassword';</script>";
                          }
                    }
                    else
                    {
                        echo"<script type=\"text/javascript\">window.alert('Password Lama Salah');
            window.location.href = '".base_url()."sdm/gantipassword';</script>";
                    }
          
        }
        else
        {
            $data['rows']=$this->model_app->edit('m_sdm',array('idsdm'=>$idsdm))->row_array();
            $this->template->load('sdm','sdm/gantipassword',$data);
        }
          
    }

} //controller
