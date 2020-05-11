<?php
Class Cetak extends CI_Controller{
    
    function __construct() {
        parent::__construct();

        $this->load->library('pdf');

        
    }
    
    function index(){
        
         }
        //cetak detail pengadaan
    function sdm(){
      $this->pdf->sdm();
      $unit=$this->session->unit;
      $jenis=$this->session->jenis;
      $data['unit']=$unit;
      $data['jenis']=$jenis;
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

      $this->load->view('admin/cetak/sdm',$data);
    }


    function cetakbukti(){
      $this->pdf->kartu();
      $user=dekrip($this->uri->segment('3'));
      $tahun=tahunsimpeg();
      
      $data['tahun']=$tahun;
      $row=$this->db->query("SELECT * FROM simpeg_biodata  WHERE id_pendaftaran='$user'")->row_array();
     
      
      $data['rows']=$row;
                
      $this->load->view('admin/simpeg/pendaftar/cetak',$data);
    }

    function kuantitatif($seo){
      $this->pdf->kuantitatif();
      $kuisioner=dekrip($seo);
      $jenis=$this->session->jenis;
      $unit=$this->session->unit;
      $target=viewKuisioner($kuisioner,'target');
            if($target!='SEMUA' AND $jenis!='')
            {
                $jenis=$target;
            }
            else if($target!='SEMUA' AND $jenis=='')
            {
                $jenis=$target;
            }
            else if($target=='SEMUA' AND $jenis=='')
            {
                $jenis='SEMUA';
            }
            else
            {
                $jenis=$jenis;
            }

            $data['target']=$target;
            $data['jenis']=$jenis;
            $data['unit']=$unit;
            $data['kuisioner']=$kuisioner;
            $data['title']='Hasil Kuisioner '.viewKuisioner($kuisioner);
            
            $data['record']=$this->model_app->view_hasil_kuantitatif($kuisioner,$jenis,$unit);
               
            $this->load->view('admin/kuisioner/cetak/kuantitatif',$data);
    }

    function kualitatif($seo){
      $this->pdf->kualitatif();
      $id=dekrip($seo);
      $jenis=$this->session->jenis;
      $unit=$this->session->unit;
      
      $row=$this->model_app->edit('simpeg_kuisioner_tes',array('id'=>$id))->row_array();
            $kuisioner=$row['kuisioner'];
            $kategori=$row['kategori'];
            $target=viewKuisioner($kuisioner,'target');
            if($target!='SEMUA' AND $jenis!='')
            {
                $jenis=$target;
            }
            else if($target!='SEMUA' AND $jenis=='')
            {
                $jenis=$target;
            }
            else if($target=='SEMUA' AND $jenis=='')
            {
                $jenis='SEMUA';
            }
            else
            {
                $jenis=$jenis;
            }
            $data['title']='Hasil Kualitatif Kuisioner  '.viewKuisioner($kuisioner);
            $data['rows']=$row;
            $data['record']=$this->model_app->view_hasil_kualitatif($kuisioner,$kategori,$jenis,$unit);
            
           
               
            $this->load->view('admin/kuisioner/cetak/kualitatif',$data);
    }

    function statistik($seo,$unit){
      
      
      if($seo=='jk')
            {
              $this->pdf->statistik();
                $data['title']='Rekap SDM Berdasarkan Jenis Kelamin';
                $data['record']=$this->model_app->view_ordering('m_unit','id','ASC');
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }
            else if($seo=='golongan')
            {
                $this->pdf->statistik();
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Golongan';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'GOLPNS'),'id','ASC');
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }

            else if($seo=='pendidikan')
            {
                $this->pdf->statistik();
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Pendidikan';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'JENJPEND'),'id','ASC');
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }

            else if($seo=='agama')
            {
                $this->pdf->statistik();
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Agama';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'AGAMA'),'id','ASC');
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }

            else if($seo=='usia')
            {
                $this->pdf->statistik();
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Rentang Usia';
                $data['record']=rentangusia();
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }

            else if($seo=='status')
            {
                $this->pdf->statistik();
                $unit=$this->session->unit;
                $data['unit']=$unit;
                $data['title']='Rekap SDM Berdasarkan Status';
                $data['record']=$this->model_app->view_where_ordering('tbrefb',array('idxref'=>'STSPEGAWAI'),'id','ASC');
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }
            else if($seo=='publikasi')
            {
                $this->pdf->publikasi();
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
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }

            else if($seo=='penelitian')
            {
                $this->pdf->penelitian();
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
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }

            else if($seo=='pengabdian')
            {
                $this->pdf->pengabdian();
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
                $data['title']='Daftar Pengabdian Masyarakat Tahun '.$tahun;
                $data['record']=$this->model_app->view_pengabdian($tahun,$jenis,$unit);
                $this->load->view('admin/statistik/cetak/'.$seo,$data);
            }
               
            
    }
    
    
}//controller