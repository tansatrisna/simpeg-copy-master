<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {

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

    function jk(){
        $id_level=$this->session->level;
        $link='statistik/jk';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Jenis Kelamin';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_jk($jenis,$unit);   
            $this->template->load('admin','admin/statistik/jk',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function agama(){
        $id_level=$this->session->level;
        $link='statistik/agama';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Agama';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_agama($jenis,$unit);   
            $this->template->load('admin','admin/statistik/agama',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function golongan(){
        $id_level=$this->session->level;
        $link='statistik/golongan';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Golongan';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_golongan($jenis,$unit);   
            $this->template->load('admin','admin/statistik/golongan',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function pendidikan(){
        $id_level=$this->session->level;
        $link='statistik/pendidikan';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Jenjang Pendidikan';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_pendidikan($jenis,$unit);   
            $this->template->load('admin','admin/statistik/pendidikan',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function status(){
        $id_level=$this->session->level;
        $link='statistik/status';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Status SDM';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_status($jenis,$unit);   
            $this->template->load('admin','admin/statistik/status',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function ulangtahun(){
        $id_level=$this->session->level;
        $link='statistik/ulangtahun';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Ulang Tahun';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit'),'tanggal'=>postnumber('tanggal')));
            }
            $jenis=$this->session->jenis;
            $tanggal=$this->session->tanggal;
            $unit=$this->session->unit;
            if($tanggal=='')
            {
                $tanggal=date('Y-m-d');
            }
            $data['tanggal']=$tanggal;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_ulangtahun($jenis,$unit,$tanggal);   
            $this->template->load('admin','admin/statistik/ulangtahun',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function usia(){
        $id_level=$this->session->level;
        $link='statistik/usia';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Rentang Usia';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=rentangusia();  
            $this->template->load('admin','admin/statistik/usia',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function publikasi(){
        $id_level=$this->session->level;
        $link='statistik/publikasi';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Publikasi Karya Ilmiah';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_publikasi($jenis,$unit);   
            $this->template->load('admin','admin/statistik/publikasi',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function penelitian(){
        $id_level=$this->session->level;
        $link='statistik/penelitian';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Penelitian';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit'),'tahun'=>postnumber('tahun')));
            }
            $tahun=$this->session->tahun;
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            /*if($tahun=='')
            {
                $tahun=date('Y');
            }*/
            $data['tahun']=$tahun;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_penelitian($tahun,$jenis,$unit);   
            $this->template->load('admin','admin/statistik/penelitian',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function pengabdian(){
        $id_level=$this->session->level;
        $link='statistik/pengabdian';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Pengabdian Masyarakat';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit'),'tahun'=>postnumber('tahun')));
            }
            $tahun=$this->session->tahun;
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            /*if($tahun=='')
            {
                $tahun=date('Y');
            }*/
            $data['tahun']=$tahun;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['record']=$this->model_app->statistik_pengabdian($tahun,$jenis,$unit);   
            $this->template->load('admin','admin/statistik/pengabdian',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kinerja(){
        $id_level=$this->session->level;
        $link='statistik/kinerja';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['title']='Kinerja';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit'),'tahun'=>postnumber('tahun')));
            }
            $tahun=$this->session->tahun;
            $jenis=$this->session->jenis;
            $unit=$this->session->unit;
            //if($tahun=='')
            //{
            //    $tahun=date('Y');
            //}
            $data['tahun']=$tahun;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            //$record = $this->model_app->statistik_kinerja($jenis,$unit);
            //$data = array('record' => $record);
            $data['record']=$this->model_app->statistik_kinerja($jenis,$unit,$tahun);   
            $this->template->load('admin','admin/statistik/kinerja',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }
    
    function detail($seo){
        $id_level=$this->session->level;
        $link='statistik/'.$seo;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['seo']=$seo;
        $data['post']='statistik/detail/'.$seo;
        if(bisaBaca($link,$id_level))
        {
            if($seo=='jk')
            {
                $data['title']='Rekap SDM Berdasarkan Jenis Kelamin';
                $data['record']=$this->model_app->view_ordering('m_unit','id','ASC');
            }
            else if($seo=='golongan')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('unit'=>postnumber('unit')));
                }
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Golongan';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'GOLPNS'),'id','ASC');
            }

            else if($seo=='pendidikan')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('unit'=>postnumber('unit')));
                }
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Pendidikan';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'JENJPEND'),'id','ASC');
            }

            else if($seo=='agama')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('unit'=>postnumber('unit')));
                }
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Agama';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'AGAMA'),'id','ASC');
            }

            else if($seo=='status')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('unit'=>postnumber('unit')));
                }
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Status';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'STSPEGAWAI'),'id','ASC');
            }
            else if($seo=='usia')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('unit'=>postnumber('unit')));
                }
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Rentang Usia';
                $data['record']=rentangusia();
            }

            else if($seo=='publikasi')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('unit'=>postnumber('unit'),'tahun1'=>postnumber('tahun1'),'tahun2'=>postnumber('tahun2')));
                }
                $unit=$this->session->unit;
                $tahun1=$this->session->tahun1;
                $tahun2=$this->session->tahun2;
                if($tahun1=='')
                {
                    $tahun1=date('Y')-4;
                }

                if($tahun2=='')
                {
                    $tahun2=date('Y');
                }
                $data['tahun2']=$tahun2;
                $data['tahun1']=$tahun1;
                $data['col']=$tahun2-$tahun1+1;
                $data['unit']=$unit;
                $data['title']='Rekap Publikasi SDM';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'MEDIAPUB'),'id','ASC');
            }

            else if($seo=='penelitian')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit'),'tahun'=>postnumber('tahun')));
                }
                $unit=$this->session->unit;
                $tahun=$this->session->tahun;
                $jenis=$this->session->jenis;
                

                if($tahun=='')
                {
                    $tahun=date('Y');
                }
                $data['tahun']=$tahun;
                $data['unit']=$unit;
                $data['jenis']=$jenis;
                $data['title']='Daftar Penelitian Tahun '.$tahun;
                $data['record']=$this->model_app->view_penelitian($tahun,$jenis,$unit);
            }
            else if($seo=='pengabdian')
            {
                if(isset($_POST['cari']))
                {
                    $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit'),'tahun'=>postnumber('tahun')));
                }
                $unit=$this->session->unit;
                $tahun=$this->session->tahun;
                $jenis=$this->session->jenis;
                

                if($tahun=='')
                {
                    $tahun=date('Y');
                }
                $data['tahun']=$tahun;
                $data['unit']=$unit;
                $data['jenis']=$jenis;
                $data['title']='Daftar Pengabdian Tahun '.$tahun;
                $data['record']=$this->model_app->view_pengabdian($tahun,$jenis,$unit);
            }
               
            $this->template->load('admin','admin/statistik/detail',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    

    function sdmdetail($seo,$jk,$jenis,$unit,$ids){
        $id_level=$this->session->level;
        $link='statistik/'.$seo;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['seo']=$seo;
        $data['kembali']='statistik/detail/'.$seo;
        if(bisaBaca($link,$id_level))
        {
            if($seo=='jk')
            {
                if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A'),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','unit'=>$unit),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis,'unit'=>$unit),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'unit'=>$unit),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'unit'=>$unit),'idsdm','ASC');
                }
                
                
            }
            else if($seo=='golongan')
            {
                if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Golongan '.viewKodeApp('GOLPNS',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Golongan '.viewKodeApp('GOLPNS',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','unit'=>$unit,'pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Golongan '.viewKodeApp('GOLPNS',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis,'pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Golongan '.viewKodeApp('GOLPNS',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis,'unit'=>$unit,'pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Golongan '.viewKodeApp('GOLPNS',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Golongan '.viewKodeApp('GOLPNS',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'unit'=>$unit,'pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Golongan '.viewKodeApp('GOLPNS',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Golongan '.viewKodeApp('GOLPNS',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'unit'=>$unit,'pangkat_golongan'=>$ids),'idsdm','ASC');
                }
                
                
            }
            else if($seo=='pendidikan')
            {
                if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','unit'=>$unit,'kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis,'kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis,'unit'=>$unit,'kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'unit'=>$unit,'kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berpendidikan '.viewKodeApp('JENJPEND',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'unit'=>$unit,'kode_pendidikan'=>$ids),'idsdm','ASC');
                }
                
                
            }
            else if($seo=='agama')
            {
                if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Beragama '.viewKodeApp('AGAMA',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','agama'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Beragama '.viewKodeApp('AGAMA',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','unit'=>$unit,'agama'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Beragama '.viewKodeApp('AGAMA',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis,'agama'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Beragama '.viewKodeApp('AGAMA',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jenis'=>$jenis,'unit'=>$unit,'agama'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Beragama '.viewKodeApp('AGAMA',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'agama'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Beragama '.viewKodeApp('AGAMA',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'unit'=>$unit,'agama'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Beragama '.viewKodeApp('AGAMA',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'agama'=>$ids),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Beragama '.viewKodeApp('AGAMA',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'unit'=>$unit,'agama'=>$ids),'idsdm','ASC');
                }
                
                
            }
            else if($seo=='status')
            {
                if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM  '.viewKodeApp('STSPEGAWAI',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM '.viewKodeApp('STSPEGAWAI',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids,'unit'=>$unit),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' '.viewKodeApp('STSPEGAWAI',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids,'jenis'=>$jenis),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' '.viewKodeApp('STSPEGAWAI',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids,'jenis'=>$jenis,'unit'=>$unit),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' '.viewKodeApp('STSPEGAWAI',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids,'jk'=>$jk),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' '.viewKodeApp('STSPEGAWAI',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids,'jk'=>$jk,'unit'=>$unit),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' '.viewKodeApp('STSPEGAWAI',$ids).' di Semua Unit';
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids,'jk'=>$jk,'jenis'=>$jenis),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' '.viewKodeApp('STSPEGAWAI',$ids).' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_where_ordering('m_sdm',array('status_aktif'=>$ids,'jk'=>$jk,'jenis'=>$jenis,'unit'=>$unit),'idsdm','ASC');
                }
                
                
            }
            else if($seo=='usia')
            {
                if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berusia '.$ids.' di Semua Unit';
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A'),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berusia '.$ids.' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A','unit'=>$unit),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berusia '.$ids.' di Semua Unit';
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A','jenis'=>$jenis),'idsdm','ASC');
                }
                else if($jk=='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berusia '.$ids.' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A','jenis'=>$jenis,'unit'=>$unit),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berusia '.$ids.' di Semua Unit';
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A','jk'=>$jk),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis=='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar SDM Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berusia '.$ids.' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A','jk'=>$jk,'unit'=>$unit),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit=='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berusia '.$ids.' di Semua Unit';
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis),'idsdm','ASC');
                }
                else if($jk!='SEMUA' AND $jenis!='SEMUA' AND $unit!='SEMUA')
                {
                    $data['title']='Daftar '.$jenis.' Berjenis Kelamin '.viewKodeApp('KELAMIN',$jk).' Berusia '.$ids.' di '.viewUnit($unit);
                    $data['record']=$this->model_app->view_sdm_usia($ids,array('status_aktif'=>'A','jk'=>$jk,'jenis'=>$jenis,'unit'=>$unit),'idsdm','ASC');
                }
                
                
            }
            $this->template->load('admin','admin/statistik/sdmdetail',$data);
        }
    }

     function pubdetail($seo,$tahun1,$tahun2,$unit,$ids){
        $id_level=$this->session->level;
        $link='statistik/'.$seo;
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='statistik';
        $data['header']='Statistik';
        $data['seo']=$seo;
        $data['kembali']='statistik/detail/'.$seo;
        if(bisaBaca($link,$id_level))
        {
           
                if($unit=='SEMUA')
                {
                    if($tahun1==$tahun2)
                    {
                    $data['title']='Daftar Publikasi pada '.viewKodeApp('MEDIAPUB',$ids).' Tahun '.$tahun1.' di Semua Unit';
                    }
                    else
                    {
                      $data['title']='Daftar Publikasi pada '.viewKodeApp('MEDIAPUB',$ids).' dari Tahun '.$tahun1.' s/d '.$tahun2.' di Semua Unit';  
                    }
                    
                }
                else if($unit!='SEMUA')
                {
                    if($tahun1==$tahun2)
                    {
                    $data['title']='Daftar Publikasi pada '.viewKodeApp('MEDIAPUB',$ids).' Tahun '.$tahun1.' di '.viewUnit($unit);
                    }
                    else
                    {
                      $data['title']='Daftar Publikasi pada '.viewKodeApp('MEDIAPUB',$ids).' dari Tahun '.$tahun1.' s/d '.$tahun2.' di '.viewUnit($unit);  
                    }
                    
                }
                
                $data['record']=$this->model_app->view_publikasi($tahun1,$tahun2,$unit,$ids);
                
            
                
                
            
            $this->template->load('admin','admin/statistik/pubdetail',$data);
        }
    }

} //controller