<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuisioner extends CI_Controller {

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

    function nama(){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama'=>posttext('nama'),'target'=>posttext('target'),'keterangan'=>posttext('keterangan'));
                $this->model_app->insert('simpeg_kuisioner',$data);
                $this->session->set_flashdata('sukses',"Data Kuisioner Berhasil Disimpan");
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>$this->input->post('id'));
                $data=array('nama'=>posttext('nama'),'target'=>posttext('target'),'keterangan'=>posttext('keterangan'));
                $this->model_app->update('simpeg_kuisioner',$data,$where);
                $this->session->set_flashdata('sukses',"Data Kuisioner Berhasil Diedit");
                redirect($link);
            }
            else
            {
                $data['title']='Kuisioner';
                $data['record']=$this->model_app->view_ordering('simpeg_kuisioner','id','DESC');
                $this->template->load('admin','admin/kuisioner/nama/data',$data); 
            }
           
        }
        else
        {
            redirect('dashboard');
        }
    }

    function hapuskuisioner($seo){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $hapus=$this->model_app->delete('simpeg_kuisioner',$id);
        if($hapus)
            {
                $this->session->set_flashdata('sukses',"Data Kuisioner Berhasil Dihapus");
            }
            else
            {
                $this->session->set_flashdata('gagal',"Data Kuisioner Gagal Dihapus");
            }
        redirect($link);
        
        }
        else
        {
        redirect($link); 
        }
    }



    function editkuisioner(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_kuisioner',$id)->row_array();
         
        echo'<input type="hidden" name="id" value="'.$sql['id'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama Kuisioner</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Kuisioner" value="'.$sql['nama'].'" required>
                  </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label ">Target</label>
              <div class="col-sm-9">
                <select name="target" class="form-control" required>
                  <option value="">..::Pilih Target::..</option>
                  '.opEnum('simpeg_kuisioner','target',$sql['target']).'
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label ">Keterangan</label>
              <div class="col-sm-9">
                <textarea name="keterangan" class="form-control" rows="4" required>'.$sql['keterangan'].'</textarea>
              </div>
            </div>';
        }
    }

    function lihatkuisioner(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_kuisioner',$id)->row_array();
         
        echo $sql['keterangan'];
        }
    }

    function pengisikuisioner(){
        if(isset($_POST['rowid']))
        {
        $id = $this->input->post('rowid');
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->view_where_ordering('simpeg_kuisioner_sdm',array('kuisioner'=>$id,'selesai'=>1),'idsdm','ASC');
            $nos=0;
            echo'<div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      
                      <th>Nama</th>
                      <th>Unit</th>
                    </tr>
                  </thead>
                  <tbody>';
                  
                foreach ($sql as $key) {
                $nos++;
               echo '<tr>
                        <td>'.$nos.'</td>
                        
                        <td>'.viewSdm($key['idsdm']).'</td>
                        <td>'.viewUnitSdm($key['idsdm']).'</td>
                    </tr>';
            }
            
            echo '</tbody>
            </table>
              </div>';
        }
    }

    function aktif($seo,$value){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $id=dekrip($seo);
        if(bisaUbah($link,$id_level))
        {
        $where = array('id' => $id);
        if($value==0)
        {
            $data=array('aktif'=>1);
            $this->model_app->update('simpeg_kuisioner',$data,$where);
            $this->session->set_flashdata('sukses',"Data Kuisioner Berhasil Diaktifkan");
        }
        else
        {
            $data=array('aktif'=>0);
            $this->model_app->update('simpeg_kuisioner',$data,$where);
            $this->session->set_flashdata('sukses',"Data Kuisioner Berhasil Dinonaktifkan");
        }
        
        redirect($link);
        
        }
        else
        {
        redirect($link); 
        }
    }

    function kategori(){
        $id_level=$this->session->level;
        $link='kuisioner/kategori';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $data=array('nama'=>posttext('nama'));
                $this->model_app->insert('simpeg_kuisioner_kategori',$data);
                $this->session->set_flashdata('sukses',"Data Kategori Kuisioner Berhasil Disimpan");
                redirect($link);
            }
            else if(isset($_POST['edit']))
            {
                $where=array('id'=>$this->input->post('id'));
                $data=array('nama'=>posttext('nama'));
                $this->model_app->update('simpeg_kuisioner_kategori',$data,$where);
                $this->session->set_flashdata('sukses',"Data Kategori Kuisioner Berhasil Diedit");
                redirect($link);
            }
            else
            {
                $data['title']='Kategori Kuisioner';
                $data['record']=$this->model_app->view_ordering('simpeg_kuisioner_kategori','id','ASC');
                $this->template->load('admin','admin/kuisioner/kategori/data',$data); 
            }
           
        }
        else
        {
            redirect('home');
        }
    }

    function hapuskategori($seo){
        $id_level=$this->session->level;
        $link='kuisioner/kategori';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $hapus=$this->model_app->delete('simpeg_kuisioner_kategori',$id);
        if($hapus)
            {
                $this->session->set_flashdata('sukses',"Data Kategori Berhasil Dihapus");
            }
            else
            {
                $this->session->set_flashdata('gagal',"Data Kategori Gagal Dihapus");
            }
        redirect($link);
        
        }
        else
        {
        redirect($link); 
        }
    }

    function editkategori(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_kuisioner_kategori',$id)->row_array();
         
        echo'<input type="hidden" name="id" value="'.$sql['id'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama Kategori Kuisioner</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Kategori Kuisioner" value="'.$sql['nama'].'" required>
                  </div>
            </div>';
        }
    }

    function option($seo){
        $id_level=$this->session->level;
        $link='kuisioner/kuantitatif';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['tambah']))
            {
                $kuisioner=postnumber('kuisioner');
                $data=array('nama'=>posttext('nama'),
                            'skor'=>postnumber('skor'),
                            'kuisioner'=>$kuisioner);
                $this->model_app->insert('simpeg_kuisioner_option',$data);
                $this->session->set_flashdata('sukses',"Data Option Kuisioner Berhasil Disimpan");
                redirect('kuisioner/option/'.enkrip($kuisioner));
            }
            else if(isset($_POST['edit']))
            {
                $kuisioner=postnumber('kuisioner');
                $where=array('id'=>$this->input->post('id'));
                $data=array('nama'=>posttext('nama'),
                            'skor'=>postnumber('skor'));
                $this->model_app->update('simpeg_kuisioner_option',$data,$where);
                $this->session->set_flashdata('sukses',"Data Option Kuisioner Berhasil Diedit");
                redirect('kuisioner/option/'.enkrip($kuisioner));
            }
            else
            {
                $id=dekrip($seo);
                $data['title']='Option Kuisioner';
                $data['rows']=$this->model_app->edit('simpeg_kuisioner_soal',array('id'=>$id))->row_array();
                $data['record']=$this->model_app->view_where_ordering('simpeg_kuisioner_option',array('kuisioner'=>$id),'id','ASC');
                $this->template->load('admin','admin/kuisioner/kuantitatif/option',$data); 
            }
           
        }
        else
        {
            redirect('home');
        }
    }

    function hapusoption($seo){
        $id_level=$this->session->level;
        $link='kuisioner/option';
        $id=dekrip($seo);
        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => $id);
        $row=$this->model_app->edit('simpeg_kuisioner_option',$id);
        $hapus=$this->model_app->delete('simpeg_kuisioner_option',$id);
        if($hapus)
            {
                $this->session->set_flashdata('sukses',"Data Kategori Berhasil Dihapus");
            }
            else
            {
                $this->session->set_flashdata('gagal',"Data Kategori Gagal Dihapus");
            }
        redirect('kuisioner/option/'.enkrip($row['kuisioner']));
        
        }
        else
        {
        redirect($link); 
        }
    }

    function editoption(){
        if(isset($_POST['rowid']))
        {
        $id = array('id'=>$this->input->post('rowid'));
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = $this->model_app->edit('simpeg_kuisioner_option',$id)->row_array();
         
        echo'<input type="hidden" name="id" value="'.$sql['id'].'">
            <input type="hidden" name="kuisioner" value="'.$sql['kuisioner'].'">
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Nama Option Kuisioner</label>
                  <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Kategori Kuisioner" value="'.$sql['nama'].'" required>
                  </div>
            </div>
            <div class="form-group row">
                  <label class="col-sm-3 control-label ">Skor</label>
                  <div class="col-sm-9">
                    <input type="number" name="skor" class="form-control" placeholder="" value="'.$sql['skor'].'" required>
                  </div>
            </div>';
        }
    }

    function kuantitatif(){
        $id_level=$this->session->level;
        $link='kuisioner/kuantitatif';
        
        
        if(bisaBaca($link,$id_level))
        {
            
            
            $data['title']='Kuantitatif Soal';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='kuisioner';
            $data['record']=$this->model_app->view_where_ordering('simpeg_kuisioner_soal',array('jenis'=>'Kuantitatif'),'id','DESC');
            $this->template->load('admin','admin/kuisioner/kuantitatif/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kuantitatiftambah(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='kuisioner/kuantitatif';
        
        
        $data['title']='Kuantitatif Soal';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['tambah']))
          {
            
                          
            $data=array('kategori'=>postnumber('kategori'),
                        'jenis'=>'Kuantitatif',
                        'soal'=>postnumber('soal')
                      );
            
            
            $simpan=$this->model_app->insert('simpeg_kuisioner_soal',$data);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Kuisioner Kuantitatif  Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Kuisioner Kuantitatif Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          {           
            $this->template->load('admin','admin/kuisioner/kuantitatif/tambah',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function kuantitatifedit(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='kuisioner/kuantitatif';
        
        
        $data['title']='Kuantitatif Soal';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['edit']))
          {
            
            $where=array('id'=>postnumber('id')); 

            
               $data=array('kategori'=>postnumber('kategori'),
                        
                        'soal'=>postnumber('soal')
                      );
           
            
            
            
            $simpan=$this->model_app->update('simpeg_kuisioner_soal',$data,$where);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Kuisioner Kuantitatif  Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Kuisioner Kuantitatif Gagal Diedit");
                }
                redirect($link);
             
          }
          else
          { 
            $id=dekrip($this->uri->segment('3'));
            $data['rows']=$this->model_app->edit('simpeg_kuisioner_soal',array('id'=>$id))->row_array();  
            $this->template->load('admin','admin/kuisioner/kuantitatif/edit',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function kuantitatifhapus(){
        $id_level=$this->session->level;
        $link='kuisioner/kuantitatif';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        
        $this->model_app->delete('simpeg_kuisioner_soal',$id);
        $this->session->set_flashdata('sukses',"Data Kuantitatif Soal Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Kuantitatif Soal");
        redirect($link); 
        }
    }

    function kualitatif(){
        $id_level=$this->session->level;
        $link='kuisioner/kualitatif';
        
        
        if(bisaBaca($link,$id_level))
        {
            
            
            $data['title']='Kualitatif Soal';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='kuisioner';
            $data['record']=$this->model_app->view_where_ordering('simpeg_kuisioner_soal',array('jenis'=>'Kualitatif'),'id','DESC');
            $this->template->load('admin','admin/kuisioner/kualitatif/data',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function kualitatiftambah(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='kuisioner/kualitatif';
        
        
        $data['title']='Kualitatif Soal';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['tambah']))
          {
            
                          
            $data=array('kategori'=>postnumber('kategori'),
                        'jenis'=>'Kualitatif',
                        'soal'=>postnumber('soal')
                      );
            
            
            $simpan=$this->model_app->insert('simpeg_kuisioner_soal',$data);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Kuisioner Kualitatif  Berhasil Disimpan");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Kuisioner Kualitatif Gagal Disimpan");
                }
                redirect($link);
             
          }
          else
          {           
            $this->template->load('admin','admin/kuisioner/kualitatif/tambah',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function kualitatifedit(){
        $id_level=$this->session->level;
        $user=$this->session->id_user;
        $link='kuisioner/kualitatif';
        
        
        $data['title']='Kualitatif Soal';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaTulis($link,$id_level))
        {

          if(isset($_POST['edit']))
          {
            
            $where=array('id'=>postnumber('id')); 

            
               $data=array('kategori'=>postnumber('kategori'),
                        
                        'soal'=>postnumber('soal')
                      );
           
            
            
            
            $simpan=$this->model_app->update('simpeg_kuisioner_soal',$data,$where);
            if($simpan)
                {
                    $this->session->set_flashdata('sukses',"Data Soal Kuisioner Kualitatif  Berhasil Diedit");
                }
                else
                {
                    $this->session->set_flashdata('gagal',"Data Soal Kuisioner Kualitatif Gagal Diedit");
                }
                redirect($link);
             
          }
          else
          { 
            $id=dekrip($this->uri->segment('3'));
            $data['rows']=$this->model_app->edit('simpeg_kuisioner_soal',array('id'=>$id))->row_array();  
            $this->template->load('admin','admin/kuisioner/kualitatif/edit',$data);
          }
                
            
            
        }
        else
        {
            redirect($link);
        }
    }

    function kualitatifhapus(){
        $id_level=$this->session->level;
        $link='kuisioner/kualitatif';

        if(bisaHapus($link,$id_level))
        {
        $id = array('id' => dekrip($this->uri->segment(3)));
        
        $this->model_app->delete('simpeg_kuisioner_soal',$id);
        $this->session->set_flashdata('sukses',"Data Kualitatif Soal Berhasil Dihapus");
        redirect($link);
        }
        else
        {
            $this->session->set_flashdata('gagal',"Anda tidak diizinkan menghapus data Kualitatif Soal");
        redirect($link); 
        }
    }


    function soal($seo){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        
        

        if(bisaBaca($link,$id_level))
        {
            $id=dekrip($seo);
            $data['seo']=$seo;
            
            $data['title']='Soal Kuisioner';
            $data['id_level']=$id_level;
            $data['link']=$link;
            $data['ctrl']='kuisioner';
            $data['record']=$this->model_app->view_kuisioner($id);
            $this->template->load('admin','admin/kuisioner/nama/soal',$data);
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function soaltambah($seo){
        $id=dekrip($seo);
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $data['header']=viewKuisioner($id);
        $data['title']='Ambil Soal Kuisioner '.viewKuisioner($id);
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaBaca($link,$id_level))
        {
                if(isset($_POST['ambil']))
                {   
                    
                    $id=$this->input->post('id');
                    
                    $check=$this->input->post('check');
                    foreach ($check as $row) {
                        $data=array('kuisioner'=>$id,
                                    'soal'=>$row,
                                    'jenis'=>viewKuisionerSoal($row,'jenis'),
                                    'kategori'=>viewKuisionerSoal($row,'kategori'));
                        $this->model_app->insert('simpeg_kuisioner_tes',$data);
                        $this->session->set_flashdata('sukses',"Data Soal Kuisioner Berhasil Diambil");
                    }
                    redirect('kuisioner/soal/'.enkrip($id));
                }
                else
                {
                    
                    $data['seo']=$seo;
                    $data['id']=$id;
                             
                    $data['record']=$this->model_app->ambil_soal_kuisioner($id);
               
                    $this->template->load('admin','admin/kuisioner/nama/ambilsoal',$data);
                }
            
        }
        else
        {
            redirect('dashboard');
        }
    }

    function soalhapus($seo,$ids){
           
        $id=dekrip($ids);
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';

        if(bisaHapus($link,$id_level))
        {
                
            $where=array('id'=>$id);
            $hapus=$this->model_app->delete('simpeg_kuisioner_tes',$where);
            if($hapus)
            {
                $this->session->set_flashdata('sukses',"Data Soal Kuisioner Berhasil Dihapus");
            }
            else
            {
                $this->session->set_flashdata('gagal',"Data Soal Kuisioner Gagal Dihapus Karena Kuisioner Ini Sudah Ada yang Kerjakan");
            }
            redirect('kuisioner/soal/'.$seo);
         
        }
        else
        {
            redirect('dashboard');
        }
    }

    function hasil($seo){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';
        $data['seo']=$seo;
        $kuisioner=dekrip($seo);

        if(bisaBaca($link,$id_level))
        {
            if(isset($_POST['cari']))
            {
                $this->session->set_userdata(array('jenis'=>postnumber('jenis'),'unit'=>postnumber('unit')));
            }
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
            
            // $data['kualitatif']=$this->model_app->view_where_ordering('simpeg_kuisioner_hasil',array('kuisioner'=>$kuisioner,'jenis'=>'Kualitatif'),'kategori,id_soal','ASC');
            
            $this->template->load('admin','admin/kuisioner/nama/hasil',$data); 
        }
        else
        {
            redirect('sdm');
        }
    }

    function hasilkualitatif($id,$target,$unit){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';
        $data['seo']=$id;
        $id=dekrip($id);
        $target=dekrip($target);
        $unit=dekrip($unit);
        if(bisaBaca($link,$id_level))
        {
            
            $row=$this->model_app->edit('simpeg_kuisioner_tes',array('id'=>$id))->row_array();
            $kuisioner=$row['kuisioner'];
            $kategori=$row['kategori'];
            $data['target']=$target;
            $data['unit']=$unit;
            $data['kuisioner']=$kuisioner;
            $data['title']='Hasil Kualitatif Kuisioner  '.viewKuisioner($kuisioner);
            $data['rows']=$row;
            $data['record']=$this->model_app->view_hasil_kualitatif($kuisioner,$kategori,$target,$unit);
            
            
            $this->template->load('admin','admin/kuisioner/nama/hasilkualitatif',$data); 
        }
        else
        {
            redirect('home');
        }
    }

    function grafiksoal($seo,$kat,$soal,$resp){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';
        $data['seo']=$seo;
        $data['responden']=dekrip($resp);
        
        if(bisaBaca($link,$id_level))
        {
            $kuisioner=dekrip($seo);
            $kategori=dekrip($kat);
            $soal=dekrip($soal);
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
            $data['kategori']=$kategori;
            $data['soal']=$soal;
            
           $data['record']=array(1,2,3,4,5);
            $this->template->load('admin','admin/kuisioner/grafik/soal',$data); 
        }
        else
        {
            redirect('home');
        }
    }

    function grafikkategori($seo,$kat,$res){
        $id_level=$this->session->level;
        $link='kuisioner/nama';
        $data['id_level']=$id_level;
        $data['link']=$link;
        $data['ctrl']='kuisioner';
        $data['seo']=$seo;
        $data['responden']=dekrip($res);
        if(bisaBaca($link,$id_level))
        {
            $kuisioner=dekrip($seo);
            $kategori=dekrip($kat);
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
            $data['kategori']=$kategori;
           
            
           $data['record']=array(1,2,3,4,5);
            $this->template->load('admin','admin/kuisioner/grafik/kategori',$data); 
        }
        else
        {
            redirect('home');
        }
    }


} //controller