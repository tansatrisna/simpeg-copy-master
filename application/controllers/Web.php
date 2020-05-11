<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

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
    public function __construct(){
        parent::__construct();
        $this->load->library('mathcaptcha');
      }

    function index(){
        $token=token();
        $this->session->set_userdata(array('token'=>$token));
        $data['token']=$token;
        $this->mathcaptcha->generatekode();
        $data['captcha']=$this->mathcaptcha->showcaptcha();
        $data['title']='Halaman Utama';
        $this->template->load('front','front/home',$data);
        }

    


    function pejabat($hal='rektorat'){   
        $token=token();
        $this->session->set_userdata(array('token'=>$token));
        $data['token']=$token;
        $this->mathcaptcha->generatekode();
        $data['captcha']=$this->mathcaptcha->showcaptcha();  
        $id=seoKelompok($hal);
        $data['hal']=$hal;
        $data['tabs']=$this->model_app->view_ordering('m_kelompok_unit','urutan','ASC');
        $data['title']='Data Pejabat';
        $data['record']=$this->model_app->view_pejabat($id);
        
        
        
        $this->template->load('front','front/pejabat',$data);
        }


    public function pengumuman(){
        $token=token();
        $this->mathcaptcha->generatekode();
        $data['captcha']=$this->mathcaptcha->showcaptcha();
        $this->session->set_userdata(array('token'=>$token));
        $data['token']=$token;
     
     $query=$this->model_app->view_ordering('simpeg_pengumuman','id','DESC');
     $jumlah=count($query);
      $config['base_url'] = base_url().'web/pengumuman';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $jumlah;
      $config['per_page'] = 12;  

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
        $data['record'] = $this->model_app->view_ordering_limit('simpeg_pengumuman','id','DESC',$dari,$config['per_page']);
      }else{
        redirect();
      }
      $this->pagination->initialize($config);
      $this->template->load('front','front/pengumuman',$data);
      
           
    }

    public function pengumumandetail($seo){
    $token=token();
    $this->mathcaptcha->generatekode();
    $data['captcha']=$this->mathcaptcha->showcaptcha();
    $this->session->set_userdata(array('token'=>$token));
    $data['token']=$token;
    $query = $this->model_app->edit('simpeg_pengumuman',array('seo' => $seo));
    if ($query->num_rows()<=0){
      redirect('web/pengumuman');
    }else{
      $row = $query->row_array();
      $data['title'] = cetak($row['judul']);
      $data['rows'] = $row;

      $dataa = array('dibaca'=>$row['dibaca']+1);
      $where = array('id' => $row['id']);
      $this->model_app->update('simpeg_pengumuman', $dataa, $where);
      $this->template->load('front','front/pengumumandetail',$data);
    }
  }

    public function sop(){
    $token=token();
    $this->mathcaptcha->generatekode();
    $data['captcha']=$this->mathcaptcha->showcaptcha();
    $this->session->set_userdata(array('token'=>$token));
    $data['token']=$token;
    $data['title']='Standar Operasional Prosedur';
    $data['record'] = $this->model_app->view_ordering('simpeg_sop','id','DESC');
    $this->template->load('front','front/sop',$data);
      
           
    }

    public function peraturan(){
    $token=token();
    $this->mathcaptcha->generatekode();
    $data['captcha']=$this->mathcaptcha->showcaptcha();
    $this->session->set_userdata(array('token'=>$token));
    $data['token']=$token;
    $data['title']='Peraturan';
    $data['record'] = $this->model_app->view_ordering('simpeg_peraturan','id','DESC');
    $this->template->load('front','front/peraturan',$data);
      
           
    }

    public function dosen(){
     $data['title']='Data Dosen';
     $token=token();
     $this->mathcaptcha->generatekode();
      $data['captcha']=$this->mathcaptcha->showcaptcha();
      $this->session->set_userdata(array('token'=>$token));
      $data['token']=$token;
      if(isset($_POST['cari']))
      {
        $this->session->set_userdata(array('cari'=>posttext('cari')));
      }
      $cari=$this->session->cari;
      $data['cari']=$cari;
     $query=$this->model_app->view_sdm('DOSEN',$cari);
     $jumlah=count($query);
      $config['base_url'] = base_url().'web/dosen';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $jumlah;
      $config['per_page'] = 20;  

      if ($this->uri->segment('3')==''){
        $dari = 0;
      }else{
        $hal=$this->uri->segment('3');
        $dari = ($hal-1) * $config['per_page'];
      }
      $data['judul'] = "Data Dosen";
      
     
      $data['total'] = $jumlah;
      $data['sisa'] = $config['per_page'];
      $data['dari'] = $dari;

      if (is_numeric($dari)) {
        $data['record'] = $this->model_app->view_sdm_limit('DOSEN',$cari,$dari,$config['per_page']);
      }else{
        redirect();
      }
      $this->pagination->initialize($config);
      $this->template->load('front','front/dosen',$data);
      
           
    }

    public function pegawai(){
      $token=token();
      $this->mathcaptcha->generatekode();
        $data['captcha']=$this->mathcaptcha->showcaptcha();
        $this->session->set_userdata(array('token'=>$token));
        $data['token']=$token;
     $data['title']='Data Pegawai';
     
    if(isset($_POST['cari']))
      {
        $this->session->set_userdata(array('cari'=>posttext('cari')));
      }
      $cari=$this->session->cari;
      $data['cari']=$cari;
     $query=$this->model_app->view_sdm('PEGAWAI',$cari);
     $jumlah=count($query);
      $config['base_url'] = base_url().'web/pegawai';
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $jumlah;
      $config['per_page'] = 20;  

      if ($this->uri->segment('3')==''){
        $dari = 0;
      }else{
        $hal=$this->uri->segment('3');
        $dari = ($hal-1) * $config['per_page'];
      }
      $data['judul'] = "Data Pegawai";
      
     
      $data['total'] = $jumlah;
      $data['sisa'] = $config['per_page'];
      $data['dari'] = $dari;

      if (is_numeric($dari)) {
        $data['record'] = $this->model_app->view_sdm_limit('PEGAWAI',$cari,$dari,$config['per_page']);
      }else{
        redirect();
      }
      $this->pagination->initialize($config);
      $this->template->load('front','front/pegawai',$data);
      
           
    }

    public function dosendetail($seo){
      $token=token();
      $this->mathcaptcha->generatekode();
        $data['captcha']=$this->mathcaptcha->showcaptcha();
        $this->session->set_userdata(array('token'=>$token));
        $data['token']=$token;
    $data['title']='Detail Data Dosen';
    $idsdm=dekrip($seo);
    $data['idsdm']=$idsdm;
    $data['rows'] = $this->model_app->edit('m_sdm',array('idsdm'=>$idsdm))->row_array();
    $data['pendidikan']=$this->model_app->view_where_ordering('simpeg_pendidikan',array('idsdm'=>$idsdm),'jenjang','DESC');
    $data['pelatihan']=$this->model_app->view_where_ordering('simpeg_pelatihan',array('idsdm'=>$idsdm),'tahun','DESC');
    $data['penelitian']=$this->model_app->view_where_ordering('simpeg_penelitian',array('idsdm'=>$idsdm),'tahun','DESC');
    $data['seminar']=$this->model_app->view_where_ordering('simpeg_seminar',array('idsdm'=>$idsdm),'tahun','DESC');
    $data['publikasi']=$this->model_app->view_where_ordering('simpeg_publikasi',array('idsdm'=>$idsdm),'tahun','DESC');
    $data['penghargaan']=$this->model_app->view_where_ordering('simpeg_penghargaan',array('idsdm'=>$idsdm),'tahun','DESC');
    $data['pengabdian']=$this->model_app->view_where_ordering('simpeg_pengabdian',array('idsdm'=>$idsdm),'tahun','DESC');
    $data['serdos']=$this->model_app->view_where_ordering('simpeg_serdos',array('idsdm'=>$idsdm),'tahun','DESC');
    $data['kegmhs']=$this->model_app->view_where_ordering('simpeg_kegiatan_kemahasiswaan',array('idsdm'=>$idsdm),'tahun','DESC');
    $this->template->load('front','front/dosendetail',$data);
      
           
    }

    function kinerja($tab='publikasi'){   
        $token=token();
        $this->session->set_userdata(array('token'=>$token));
        $data['token']=$token;
        $this->mathcaptcha->generatekode();
        $data['captcha']=$this->mathcaptcha->showcaptcha();  
        
        $data['tab']=$tab;
        $data['tabs']=array('publikasi'=>'Publikasi','penelitian'=>'Penelitian','pengabdian'=>'Pengabdian Masyarakat');
        
        if(isset($_POST['cari']))
        {
        $this->session->set_userdata(array('cari'=>posttext('cari')));
        }
        $cari=$this->session->cari;
        $data['cari']=$cari;
        if($tab=='publikasi')
        {
          $data['title']='Data Publikasi';
        }
        else if($tab=='penelitian')
        {
          $data['title']='Data Penelitian';
        }
        else if($tab=='pengabdian')
        {
          $data['title']='Data Pengabdian Masyarakat';
        }
        
        
      
     $query=$this->model_app->view_kinerja($tab,$cari);
     $jumlah=count($query);
      $config['base_url'] = base_url().'web/kinerja/'.$tab;
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $jumlah;
      $config['per_page'] = 10;  

      if ($this->uri->segment('4')==''){
        $dari = 0;
      }else{
        $hal=$this->uri->segment('4');
        $dari = ($hal-1) * $config['per_page'];
      }
      $data['judul'] = $data['title'];
      
     
      $data['total'] = $jumlah;
      $data['sisa'] = $config['per_page'];
      $data['dari'] = $dari;

      if (is_numeric($dari)) {
        $data['record'] = $this->model_app->view_kinerja_limit($tab,$cari,$dari,$config['per_page']);
      }else{
        redirect();
      }
      $this->pagination->initialize($config);
        
        
        
        $this->template->load('front','front/kinerja',$data);
        }



    

    

} //controller


