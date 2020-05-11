<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

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
		redirect($_SERVER['HTTP_REFERER']);       
		
    }

    function sop($seo){
    	$where=array('id'=>dekrip($seo));
	    $sql=$this->model_app->edit('simpeg_sop',$where);
	      if($sql->num_rows()==0)
	      {
	       redirect($_SERVER['HTTP_REFERER']);
	      }
	      else
	      {
	      $row=$sql->row_array();
	        $where=array('id'=>$row['id']);
	        $up=array('dibaca'=>$row['dibaca']+1);
	        $this->model_app->update('simpeg_sop',$up,$where);
	        $berkas='assets/img/sop/'.$row['berkas'];
	        force_download($berkas, NULL);
	        
	        
	      }
    }

    function peraturan($seo){
    	$where=array('id'=>dekrip($seo));
	    $sql=$this->model_app->edit('simpeg_peraturan',$where);
	      if($sql->num_rows()==0)
	      {
	       redirect($_SERVER['HTTP_REFERER']);
	      }
	      else
	      {
	      $row=$sql->row_array();
	        $where=array('id'=>$row['id']);
	        $up=array('dibaca'=>$row['dibaca']+1);
	        $this->model_app->update('simpeg_peraturan',$up,$where);
	        $berkas='assets/img/peraturan/'.$row['berkas'];
	        force_download($berkas, NULL);
	      }
    }

    

    




} //controller