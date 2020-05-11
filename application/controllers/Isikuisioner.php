<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isikuisioner extends CI_Controller {

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
		$idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        if($jenis=='')
        {
        	redirect('logout');
        }
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['record']=$this->model_app->kuisioner_jenis($jenis);
        if(count($data['record']) > 0)
        {
        $this->template->load('kuisioner','kuisioner/data',$data);
    	}
    	else
    	{
    		redirect('sdm');
    	}
        
    }

    function mulai($seo)
      {
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['seo']=$seo;
        $kuis=dekrip($seo);
        $data['kuis']=$kuis;
         
        if(cekSdmKuisioner($idsdm,$kuis) > 0)
	      {
	        
	          $data['rows']=$this->model_app->edit('simpeg_kuisioner_sdm',array('idsdm'=>$idsdm,'kuisioner'=>$kuis))->row_array();
	          $this->template->load('kuisioner','kuisioner/mulai',$data);
	      }
         else
         {
          $data=array('kuisioner'=>$kuis,'idsdm'=>$idsdm);
          $this->model_app->insert('simpeg_kuisioner_sdm',$data);
          redirect('isikuisioner/mulai/'.enkrip($kuis));
         }
          
      }

      function kerjakan($seo){
        $idsdm=$this->session->idsdm;
        $jenis=$this->session->jenis;
        $data['idsdm']=$idsdm;
        $data['jenis']=$jenis;
        $data['seo']=$seo;
        $kuis=dekrip($seo);
        $data['kuis']=$kuis;
        
        if(cekSdmKuisioner($idsdm,$kuis) > 0)
        {
        	$row=$this->model_app->edit('simpeg_kuisioner_sdm',array('idsdm'=>$idsdm,'kuisioner'=>$kuis))->row_array();
            if($peserta['selesai']==0)
             {
                $soal=cekSoalKuisioner($idsdm,$kuis);
                if($soal > 0)
                {
                    
                    if($row['nomor'] > $soal)
                        {

                            $column=array('kuisioner','idsdm','id_soal','nomor','jenis','kategori','jawaban','nilai');
                            $jika=array('kuisioner'=>$kuis,'idsdm'=>$idsdm);
                            $jawaban=$this->model_app->view_column_where('simpeg_kuisioner_kerjakan',$column,$jika);
                            $pindah=array();
                            foreach ($jawaban as $key) {
                            	$pindah[]=array('kuisioner'=>$key['kuisioner'],'idsdm'=>$key['idsdm'],'id_soal'=>$key['id_soal'],'nomor'=>$key['nomor'],'jenis'=>$key['jenis'],'kategori'=>$key['kategori'],'jawaban'=>$key['jawaban'],'nilai'=>$key['nilai']);
                            }
                            $salin=$this->model_app->insert_multiple_update('simpeg_kuisioner_hasil',$pindah);
                            $hapus=$this->model_app->delete('simpeg_kuisioner_kerjakan',$jika);
                            $simpan=array('selesai'=>1);
                            $update=$this->model_app->update('simpeg_kuisioner_sdm',$simpan,$jika);
                            if($update)
                            {
                                
                                $this->session->set_flashdata('sukses','Terima Kasih!!, Anda telah mengisi Kuisioner '.viewKuisioner($kuis));
                                redirect('isikuisioner');
                            }
                            else
                            {
                                $this->session->set_flashdata('gagal','Maaf ada masalah penyimpanan ke Database.. silahkan Ulangi..');
                                redirect('isikuisioner/kerjakan'.enkrip($kuis));
                            }
                            
                        }
                        else
                        {
                    $ns=$row['nomor'];
                    $where=array('idsdm'=>$idsdm,
                                'kuisioner'=>$kuis,
                                'nomor'=>$ns);
                    $nosoal=$this->model_app->edit('simpeg_kuisioner_kerjakan',$where)->row_array();
                    $ids=$nosoal['id_soal'];
                    
                    $data['title']=viewKuisioner($kuis);
                    
                    $data['nomor']=$ns;
                    $data['soal']=$soal;
                   
                    $data['kategori']=$nosoal['kategori'];
                    $data['jenis']=$nosoal['jenis'];
                   
                    $data['jawab']=$nosoal;
                    $data['rows']=$this->model_app->edit('simpeg_kuisioner_soal',array('id'=>$ids))->row_array();
                    
                    $this->load->view('kuisioner/kerjakan',$data);
                    }
                    

                }
                else
                {
                  
                    $whe=array('kuisioner'=>$kuis,'idsdm'=>$idsdm);
                    
                    $data=buatSoalKuisioner($idsdm,$kuis);
                    $update=array('login'=>1);
                    $this->model_app->update('simpeg_kuisioner_sdm',$update,$whe);
                    $this->model_app->insert_multiple('simpeg_kuisioner_kerjakan',$data);
                                  
                  
                                     
                   redirect('isikuisioner/kerjakan/'.enkrip($kuis));
                }
            }
            else
            {
                redirect('isikuisioner');
            }
        }
        else
        {
            redirect('isikuisioner');
        }
        
    }


    function simpan()
    {
        if(isset($_POST['simpan']))
        {
            $idsdm=$this->session->idsdm;
            $kuis=$this->input->post('kuisioner');
            $id=$this->input->post('id');
            $jawaban=posttext('jawaban');
           
            $no_soal=$this->input->post('no_soal');
            $id_soal=$this->input->post('id_soal');
            
            $jenis=$this->input->post('jenis');
            $nomor=$no_soal+1;

            
            
            $where=array('id'=>$id);
            if($jenis=='Kuantitatif')
            {
             $data=array('jawaban'=>$jawaban,
                         'nilai'=>nilaiKuisioner($jawaban)); 
            }
            else
            {
              $data=array('jawaban'=>$jawaban);
            }
            
            
            $whe=array('idsdm'=>$idsdm,'kuisioner'=>$kuis);
            $update=array('nomor'=>$nomor);

            // echo json_encode($data);
            // echo '<br>';
            // echo json_encode($update);
            $this->model_app->update('simpeg_kuisioner_kerjakan',$data,$where);
            $this->model_app->update('simpeg_kuisioner_sdm',$update,$whe);
            
               redirect('isikuisioner/kerjakan/'.enkrip($kuis)); 
            
            

            

        }
        else
        {
            redirect('isikuisioner');
        }
    }

	

	
} //controller
