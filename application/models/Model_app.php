<?php 
class Model_app extends CI_model{
    public function view($table){
        return $this->db->get($table);
    }

    public function insert($table,$data){
        return $this->db->insert($table, $data);
    }

    public function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    public function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    public function delete($table, $where){
        return $this->db->delete($table, $where);
    }

    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }
    
    public function view_ordering($table,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_where_ordering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function view_where_ordering_limit($table,$data,$order,$ordering,$baris,$dari){
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_column_where($table,$data,$where){
        $this->db->select($data);
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function view_join_one($table1,$table2,$field,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1,$table2,$field,$where,$order,$ordering){
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1.'.'.$field.'='.$table2.'.'.$field);
        $this->db->where($where);
        $this->db->order_by($order,$ordering);
        return $this->db->get()->result_array();
    }

    
    public function insert_multiple($table,$data){
    $this->db->insert_batch($table, $data);
    }

    public function insert_multiple_update($table,$data){
    $this->db->insert_on_duplicate_update_batch($table,$data);
    }

    public function view_modul($id){
        return $this->db->query("SELECT * FROM view_simpeg_modul WHERE id_level='$id' AND baca = 1 order by urutan ASC")->result_array();
    }

    public function riwayat_login($id){
        return $this->db->query("SELECT * FROM history_login WHERE email='$id'  order by id_history DESC LIMIT 0,10");
    }

    public function view_menu($id,$id_level){
        return $this->db->query("SELECT * FROM view_simpeg_menu WHERE id_modul='$id' AND id_level = '$id_level' AND id_parent = '0' AND baca='1' order by urutan ASC")->result_array();
    }

    public function view_submenu($id_menu,$id_level){
        return $this->db->query("SELECT * FROM view_simpeg_menu WHERE id_parent='$id_menu' AND id_level = '$id_level'  AND baca='1' order by urutan ASC")->result_array();
    }

    public function view_kode(){
        return $this->db->query("SELECT * FROM tbrefa  ORDER BY id ASC");
    }

    public function view_unit(){
        return $this->db->query("SELECT a.* FROM m_unit as a join m_kelompok_unit as b on a.kelompok=b.id  order by b.urutan,parent ASC")->result_array();
    }

    public function data_menu(){
        return $this->db->query("SELECT a.* FROM simpeg_menu as a join simpeg_modul as b on a.id_modul=b.id_modul  order by b.urutan ASC, a.urutan ASC")->result_array();
    }

    public function view_pejabat($id){
        return $this->db->query("SELECT a.jabatan,a.idsdm, b.nip, b.pangkat_golongan, b.jabatan_fungsional, b.foto FROM simpeg_pejabat as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kelompok='$id'  order by a.urutan ASC")->result_array();
    }

    function view_kuisioner($id){  
        return $this->db->query("SELECT a.id,a.kuisioner,b.soal,b.jenis,c.nama as kategori  FROM simpeg_kuisioner_tes as a join simpeg_kuisioner_soal as b on a.soal=b.id join simpeg_kuisioner_kategori as c on a.kategori=c.id WHERE  a.kuisioner='$id' ORDER BY a.kategori ASC")->result_array();  
    }

    function ambil_soal_kuisioner($id){
        
           return $this->db->query("SELECT * FROM simpeg_kuisioner_soal  WHERE   id NOT IN(SELECT soal FROM simpeg_kuisioner_tes WHERE kuisioner='$id') ORDER BY kategori,jenis ASC ")->result_array();   
             
    }

    function kuisioner_jenis($jenis){  
        return $this->db->query("SELECT a.* FROM simpeg_kuisioner as a  WHERE  (a.target='SEMUA' OR a.target='$jenis') AND a.aktif=1 ORDER BY a.id ASC")->result_array();  
    }

    function view_hasil_kuantitatif($kuisioner,$target,$unit){  
        if($target=='SEMUA' AND $unit=='')
        {
        return $this->db->query("SELECT a.kategori,SUM(a.nilai) as jlh, count(DISTINCT(a.idsdm)) as responden FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' GROUP BY a.kategori ORDER BY a.kategori ASC")->result_array();  
        }
        else if($target!='SEMUA' AND $unit=='')
        {
        return $this->db->query("SELECT a.kategori,SUM(a.nilai) as jlh, count(DISTINCT(a.idsdm)) as responden FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' AND b.jenis='$target' GROUP BY a.kategori ORDER BY a.kategori ASC")->result_array();  
        }
        else if($target=='SEMUA' AND $unit!='')
        {
        return $this->db->query("SELECT a.kategori,SUM(a.nilai) as jlh, count(DISTINCT(a.idsdm)) as responden FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' AND b.unit='$unit' GROUP BY a.kategori ORDER BY a.kategori ASC")->result_array();   
        }
        else if($target!='SEMUA' AND $unit!='')
        {
        return $this->db->query("SELECT a.kategori,SUM(a.nilai) as jlh, count(DISTINCT(a.idsdm)) as responden FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' AND b.unit='$unit' AND b.jenis='$target' GROUP BY a.kategori ORDER BY a.kategori ASC")->result_array();   
        }
    }

    function view_hasil_kualitatif($kuisioner,$kategori,$target,$unit){  
        if($target=='SEMUA' AND $unit=='')
        {
        return $this->db->query("SELECT a.jawaban FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.kategori='$kategori' AND a.jenis='Kualitatif' ORDER BY a.id_soal ASC")->result_array();  
        }
        else if($target!='SEMUA' AND $unit=='')
        {
        return $this->db->query("SELECT a.jawaban FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.kategori='$kategori' AND a.jenis='Kualitatif' AND b.jenis='$target' ORDER BY a.id_soal ASC")->result_array();  
        }
        else if($target=='SEMUA' AND $unit!='')
        {
        return $this->db->query("SELECT a.jawaban FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.kategori='$kategori' AND a.jenis='Kualitatif' AND b.unit='$unit' ORDER BY a.id_soal ASC")->result_array();    
        }
        else if($target!='SEMUA' AND $unit!='')
        {
        return $this->db->query("SELECT a.jawaban FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.kategori='$kategori' AND a.jenis='Kualitatif' AND b.jenis='$target' AND b.unit='$unit' ORDER BY a.id_soal ASC")->result_array();    
        }
    }

    function view_hasil_kategori($kuisioner,$kategori,$target,$unit){ 
        if($target=='SEMUA' AND $unit=='')
        {
        return $this->db->query("SELECT a.id_soal,SUM(a.nilai) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' AND a.kategori='$kategori' GROUP BY a.id_soal ORDER BY a.id_soal ASC")->result_array(); 
        } 
        else if($target!='SEMUA' AND $unit=='')
        {
        return $this->db->query("SELECT a.id_soal,SUM(a.nilai) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' AND a.kategori='$kategori' AND b.jenis='$target' GROUP BY a.id_soal ORDER BY a.id_soal ASC")->result_array(); 
        } 
        else if($target=='SEMUA' AND $unit!='')
        {
        return $this->db->query("SELECT a.id_soal,SUM(a.nilai) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' AND a.kategori='$kategori' AND b.unit='$unit' GROUP BY a.id_soal ORDER BY a.id_soal ASC")->result_array(); 
        } 
        else if($target!='SEMUA' AND $unit!='')
        {
        return $this->db->query("SELECT a.id_soal,SUM(a.nilai) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.jenis='Kuantitatif' AND a.kategori='$kategori' AND b.jenis='$target' AND b.unit='$unit' GROUP BY a.id_soal ORDER BY a.id_soal ASC")->result_array(); 
        } 
    }

    function cari_sdm($cari){  
        
        return $this->db->query("SELECT * FROM m_sdm WHERE nama LIKE '%$cari%' OR nip LIKE '%$cari%'  ORDER BY idsdm ASC")->result_array();  
        
    }

    function view_pengumuman($target){  
        if($target=='SEMUA')
        {
        return $this->db->query("SELECT * FROM simpeg_pengumuman_sdm  ORDER BY id DESC")->result_array();  
        }
        else
        {
        return $this->db->query("SELECT * FROM simpeg_pengumuman_sdm WHERE target='SEMUA' OR target='$target'  ORDER BY id DESC")->result_array();  
        }
    }


    function view_pengumuman_khusus($target, $idsdm,$cari){  
       
        return $this->db->query("SELECT * FROM simpeg_pengumuman_sdm WHERE (target='SEMUA' OR target='$target' OR (target='KHUSUS' AND sdm LIKE '%$idsdm%')) AND (judul LIKE '%$cari%' OR isi LIKE '%$cari%')  ORDER BY id DESC")->result_array();  
        
    }

     function view_pengumuman_khusus_limit($target, $idsdm,$cari,$dari, $baris){  
       
        return $this->db->query("SELECT * FROM simpeg_pengumuman_sdm WHERE (target='SEMUA' OR target='$target' OR (target='KHUSUS' AND sdm LIKE '%$idsdm%')) AND (judul LIKE '%$cari%' OR isi LIKE '%$cari%') ORDER BY id DESC LIMIT $dari,$baris")->result_array();  
        
    }

    function statistik_jk($jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT jk, count(idsdm) as jlh FROM m_sdm WHERE status_aktif='A' GROUP BY jk ORDER BY jk ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT jk, count(idsdm) as jlh FROM m_sdm WHERE jenis='$jenis' AND status_aktif='A' GROUP BY jk ORDER BY jk ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT jk, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND jenis='$jenis' AND status_aktif='A' GROUP BY jk ORDER BY jk ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }
        return $this->db->query("SELECT jk, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND status_aktif='A' GROUP BY jk ORDER BY jk ASC")->result_array();  
        }
    }

    function statistik_agama($jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT agama, count(idsdm) as jlh FROM m_sdm WHERE status_aktif='A'GROUP BY agama ORDER BY agama ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT agama, count(idsdm) as jlh FROM m_sdm WHERE jenis='$jenis' AND status_aktif='A' GROUP BY agama ORDER BY agama ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT agama, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND jenis='$jenis' AND status_aktif='A' GROUP BY agama ORDER BY agama ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT agama, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND status_aktif='A' GROUP BY agama ORDER BY agama ASC")->result_array();  
        }
    }

    function statistik_golongan($jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT pangkat_golongan, count(idsdm) as jlh FROM m_sdm WHERE status_aktif='A' GROUP BY pangkat_golongan ORDER BY pangkat_golongan ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT pangkat_golongan, count(idsdm) as jlh FROM m_sdm WHERE jenis='$jenis' AND status_aktif='A' GROUP BY pangkat_golongan ORDER BY pangkat_golongan ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT pangkat_golongan, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND jenis='$jenis' AND status_aktif='A' GROUP BY pangkat_golongan ORDER BY pangkat_golongan ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT pangkat_golongan, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND status_aktif='A' GROUP BY pangkat_golongan ORDER BY pangkat_golongan ASC")->result_array();  
        }
    }

    function statistik_pendidikan($jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT kode_pendidikan, count(idsdm) as jlh FROM m_sdm WHERE status_aktif='A' GROUP BY kode_pendidikan ORDER BY kode_pendidikan ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT kode_pendidikan, count(idsdm) as jlh FROM m_sdm  WHERE jenis='$jenis' AND status_aktif='A' GROUP BY kode_pendidikan ORDER BY kode_pendidikan ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT kode_pendidikan, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND jenis='$jenis' AND status_aktif='A' GROUP BY kode_pendidikan ORDER BY kode_pendidikan ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT kode_pendidikan, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND status_aktif='A' GROUP BY kode_pendidikan ORDER BY kode_pendidikan ASC")->result_array();  
        }
    }

    function statistik_publikasi($jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT a.jenis, count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE b.status_aktif='A' GROUP BY a.jenis ORDER BY a.jenis ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT a.jenis, count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.jenis ORDER BY a.jenis ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.jenis, count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.jenis ORDER BY a.jenis ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }
            return $this->db->query("SELECT a.jenis, count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' GROUP BY a.jenis ORDER BY a.jenis ASC")->result_array();  
        }
    }

    function statistik_status($jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT status_aktif, count(idsdm) as jlh FROM m_sdm  GROUP BY status_aktif ORDER BY status_aktif ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT status_aktif, count(idsdm) as jlh FROM m_sdm  WHERE jenis='$jenis'  GROUP BY status_aktif ORDER BY status_aktif ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT status_aktif, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) AND jenis='$jenis' GROUP BY status_aktif ORDER BY status_aktif ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT status_aktif, count(idsdm) as jlh FROM m_sdm JOIN m_unit ON m_unit.id = m_sdm.unit WHERE m_unit.id IN ($temp) GROUP BY status_aktif ORDER BY status_aktif ASC")->result_array();  
        }
    }

    function statistik_ulangtahun($jenis,$unit,$tanggal){  
        $tgl=explode("-", $tanggal);
        $day=$tgl[2];
        $bulan=$tgl[1];
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT * FROM m_sdm WHERE MONTH(tgl_lahir)='$bulan' AND DAY(tgl_lahir)='$day' AND status_aktif='A'  ORDER BY tgl_lahir DESC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT * FROM m_sdm WHERE MONTH(tgl_lahir)='$bulan' AND DAY(tgl_lahir)='$day' AND jenis='$jenis' AND status_aktif='A' ORDER BY tgl_lahir DESC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT * FROM m_sdm WHERE MONTH(tgl_lahir)='$bulan' AND DAY(tgl_lahir)='$day'AND jenis='$jenis' AND unit='$unit' AND status_aktif='A' ORDER BY tgl_lahir DESC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

        return $this->db->query("SELECT * FROM m_sdm WHERE MONTH(tgl_lahir)='$bulan' AND DAY(tgl_lahir)='$day' AND unit='$unit' AND status_aktif='A' ORDER BY tgl_lahir DESC")->result_array();    
        }
    }

    function statistik_penelitian($tahun,$jenis,$unit){  
        if($jenis=='' AND $unit=='' AND $tahun=='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE b.status_aktif='A' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='' AND $tahun=='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='' AND $tahun!='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='' AND $tahun=='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a JOIN m_sdm as b ON a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();

        //return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' AND b.jenis='$jenis' AND b.unit='$unit' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='' AND $tahun!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a JOIN m_sdm as b ON a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' AND a.tahun='$tahun' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();
        }
        else if($jenis=='' AND $unit!='' AND $tahun!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a JOIN m_sdm as b ON a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND a.tahun='$tahun' AND b.status_aktif='A' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array(); 
        }
        else if($jenis=='' AND $unit!='' AND $tahun=='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a JOIN m_sdm as b ON a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();
        }
        else if($jenis=='' AND $unit=='' AND $tahun!='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya_penelitian) as total FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array(); 
        }
    }

    function statistik_pengabdian($tahun,$jenis,$unit){  
        if($jenis=='' AND $unit=='' AND $tahun=='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE b.status_aktif='A' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='' AND $tahun=='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='' AND $tahun!='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='' AND $tahun=='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  

        }
        else if($jenis!='' AND $unit!='' AND $tahun!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' AND b.jenis='$jenis' AND a.tahun='$tahun' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='' AND $tahun!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' AND a.tahun='$tahun' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array(); 
        }
        else if($jenis=='' AND $unit!='' AND $tahun=='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.status_aktif='A' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array(); 
        }
        else if($jenis=='' AND $unit=='' AND $tahun!='')
        {
            return $this->db->query("SELECT a.sumber_dana, count(a.id) as jlh, SUM(a.biaya) as total FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
    }

    function statistik_kinerja($jenis,$unit,$tahun){  
        if($jenis=='' AND $unit!='' AND $tahun=='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            $querypub = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_publikasi a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp)");
            $publikasi = $querypub->row();

            $querypen = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_penelitian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp)");
            $penelitian = $querypen->row();

            $querypeng = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_pengabdian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp)");
            $pengabdian = $querypeng->row();

            //$query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm");
            //$publikasi = $query->num_rows();

            //$query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm");
            //$pengabdian = $query2->num_rows();

            //$query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm");
            //$penelitian = $query3->num_rows();

            return array('publikasi' => $publikasi->count, 'penelitian' => $penelitian->count, 'pengabdian' => $pengabdian->count);  
        }
        else if($jenis=='' AND $unit=='' AND $tahun=='')
        {
            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm");
            $penelitian = $query3->num_rows();
            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian);
        }
        else if($jenis=='' AND $unit=='' AND $tahun!='')
        {
            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm WHERE simpeg_publikasi.tahun='$tahun'");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm WHERE simpeg_pengabdian.tahun='$tahun'");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm WHERE simpeg_penelitian.tahun='$tahun'");
            $penelitian = $query3->num_rows();
            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian);
        }
        else if($jenis=='' AND $unit!='' AND $tahun!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            $querypub = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_publikasi a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND a.tahun='$tahun'");
            $publikasi = $querypub->row();

            $querypen = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_penelitian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND a.tahun='$tahun'");
            $penelitian = $querypen->row();

            $querypeng = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_pengabdian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND a.tahun='$tahun'");
            $pengabdian = $querypeng->row();
            return array('publikasi' => $publikasi->count, 'penelitian' => $penelitian->count, 'pengabdian' => $pengabdian->count);
        }
        else if($jenis!='' AND $unit=='' AND $tahun=='')
        {
            $que = $this->db->query("SELECT nama FROM m_sdm WHERE nip='$jenis' OR nidn='$jenis'");
            $identitas = $que->result_array();

            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm WHERE m_sdm.nip='$jenis' OR m_sdm.nidn='$jenis'");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm WHERE m_sdm.nip='$jenis' OR m_sdm.nidn='$jenis'");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm WHERE m_sdm.nip='$jenis' OR m_sdm.nidn='$jenis'");
            $penelitian = $query3->num_rows();
            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian, 'identitas' => $identitas);
        }
        else if($jenis!='' AND $unit=='' AND $tahun!='')
        {
            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm WHERE simpeg_publikasi.tahun='$tahun' AND m_sdm.nip='$jenis' OR m_sdm.nidn='$jenis'");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm WHERE simpeg_pengabdian.tahun='$tahun' AND m_sdm.nip='$jenis' OR m_sdm.nidn='$jenis'");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm WHERE simpeg_penelitian.tahun='$tahun' AND m_sdm.nip='$jenis' OR m_sdm.nidn='$jenis'");
            $penelitian = $query3->num_rows();
            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian);
        }
        else if($jenis!='' AND $unit!='' AND $tahun=='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            $querypub = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_publikasi a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.nip='$jenis' OR b.nidn='$jenis'");
            $publikasi = $querypub->row();

            $querypen = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_penelitian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.nip='$jenis' OR b.nidn='$jenis'");
            $penelitian = $querypen->row();

            $querypeng = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_pengabdian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND b.nip='$jenis' OR b.nidn='$jenis'");
        }
        else if($jenis!='' AND $unit!='' AND $tahun!='')
        {
            $temp = $unit;
            $querytemp = $this->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }

            $querypub = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_publikasi a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND a.tahun='$tahun' AND b.nip='$jenis' OR b.nidn='$jenis'");
            $publikasi = $querypub->row();

            $querypen = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_penelitian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND a.tahun='$tahun' AND b.nip='$jenis' OR b.nidn='$jenis'");
            $penelitian = $querypen->row();

            $querypeng = $this->db->query("SELECT COUNT(*) AS count FROM simpeg_pengabdian a INNER JOIN m_sdm b ON b.idsdm=a.idsdm INNER JOIN m_unit c ON c.id = b.unit WHERE c.id IN ($temp) AND a.tahun='$tahun' AND b.nip='$jenis' OR b.nidn='$jenis'");
        }
        /*
        else if($jenis=='' AND $unit=='' AND $tahun!='')
        {
            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm WHERE simpeg_publikasi.tahun='$tahun'");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm WHERE simpeg_pengabdian.tahun='$tahun'");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm WHERE simpeg_penelitian.tahun='$tahun'");
            $penelitian = $query3->num_rows();

            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian);
        }
        else if($jenis!='' AND $unit=='' AND $tahun!='')
        {
            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm WHERE simpeg_publikasi.tahun='$tahun'");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm WHERE simpeg_pengabdian.tahun='$tahun'");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm WHERE simpeg_penelitian.tahun='$tahun'");
            $penelitian = $query3->num_rows();

            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian); 
        }
        else if($jenis!='' AND $unit!='' AND $tahun!='')
        {
            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm WHERE m_sdm.unit='$unit' AND simpeg_publikasi.tahun='$tahun'");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm WHERE m_sdm.unit='$unit' AND simpeg_pengabdian.tahun='$tahun'");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm WHERE m_sdm.unit='$unit' AND simpeg_penelitian.tahun='$tahun'");
            $penelitian = $query3->num_rows();

            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian); 
        }
        else if($jenis=='' AND $unit!='')
        {
            $query = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_publikasi ON m_sdm.idsdm = simpeg_publikasi.idsdm WHERE m_sdm.unit='$unit' AND simpeg_publikasi.tahun='$tahun'");
            $publikasi = $query->num_rows();

            $query2 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_pengabdian ON m_sdm.idsdm = simpeg_pengabdian.idsdm WHERE m_sdm.unit='$unit' AND simpeg_pengabdian.tahun='$tahun'");
            $pengabdian = $query2->num_rows();

            $query3 = $this->db->query("SELECT m_sdm.idsdm FROM m_sdm INNER JOIN simpeg_penelitian ON m_sdm.idsdm = simpeg_penelitian.idsdm WHERE m_sdm.unit='$unit' AND simpeg_penelitian.tahun='$tahun'");
            $penelitian = $query3->num_rows();

            return array('penelitian' => $penelitian, 'publikasi' => $publikasi, 'pengabdian' => $pengabdian); 
        }*/
    }

    public function view_sdm($jenis,$cari=''){
        return $this->db->query("SELECT * FROM m_sdm WHERE jenis='$jenis' AND nama LIKE '%$cari%'")->result_array();
    }

    public function view_sdm_limit($jenis,$cari='',$dari,$baris){
        return $this->db->query("SELECT * FROM m_sdm WHERE jenis='$jenis' AND nama LIKE '%$cari%' ORDER BY nama ASC LIMIT $dari, $baris");
    }

    public function view_sdm_usia($usia,$data,$order,$ordering){
        $pecah=explode("-", $usia);
        $umur="usia >= '$pecah[0]' AND usia <= '$pecah[1]'";
        $this->db->select('*');
        $this->db->where($umur);
        $this->db->where($data);
        
        $this->db->order_by($order,$ordering);
        $query = $this->db->get('view_simpeg_usia');
        return $query->result_array();
    }

    function view_penelitian($tahun,$jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT a.*,b.unit FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND  b.status_aktif='A' ORDER BY a.idsdm ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT a.*,b.unit FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
        return $this->db->query("SELECT a.*,b.unit FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' AND b.jenis='$jenis' AND b.unit='$unit' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
        return $this->db->query("SELECT a.*, b.unit FROM simpeg_penelitian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A'  AND b.unit='$unit' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
    }

    function view_pengabdian($tahun,$jenis,$unit){  
        if($jenis=='' AND $unit=='')
        {
        return $this->db->query("SELECT a.*,b.unit FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND  b.status_aktif='A' ORDER BY a.idsdm ASC")->result_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        return $this->db->query("SELECT a.*,b.unit FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' AND b.jenis='$jenis' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis!='' AND $unit!='')
        {
        return $this->db->query("SELECT a.*,b.unit FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A' AND b.jenis='$jenis' AND b.unit='$unit' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
        else if($jenis=='' AND $unit!='')
        {
        return $this->db->query("SELECT a.*, b.unit FROM simpeg_pengabdian as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.tahun='$tahun' AND b.status_aktif='A'  AND b.unit='$unit' GROUP BY a.sumber_dana ORDER BY a.sumber_dana ASC")->result_array();  
        }
    }

    function view_publikasi($tahun1,$tahun2,$unit,$ids){  
        if($unit=='SEMUA')
        {
        return $this->db->query("SELECT a.* FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.jenis='$ids' AND a.tahun>='$tahun1' AND a.tahun <= '$tahun2' AND  b.status_aktif='A' ORDER BY a.tahun,a.idsdm ASC")->result_array();  
        }
        else 
        {
        return $this->db->query("SELECT a.* FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.jenis='$ids' AND a.tahun>='$tahun' AND a.tahun <= '$tahun2' AND  b.status_aktif='A' AND b.unit='$unit' ORDER BY a.tahun,a.idsdm ASC")->result_array();  
        }
        
    }

    function view_kinerja($hal,$cari){  
        if($hal=='publikasi')
        {
        return $this->db->query("SELECT * FROM simpeg_publikasi  WHERE judul LIKE '%$cari%' ORDER BY tahun DESC, judul ASC")->result_array();  
        }
        else if($hal=='penelitian')
        {
        return $this->db->query("SELECT * FROM simpeg_penelitian  WHERE judul_penelitian LIKE '%$cari%' ORDER BY tahun DESC, judul_penelitian ASC")->result_array();  
        }
        else if($hal=='pengabdian')
        {
        return $this->db->query("SELECT * FROM simpeg_pengabdian  WHERE judul LIKE '%$cari%' ORDER BY tahun DESC, judul ASC")->result_array();  
        }
        
    }

    function view_kinerja_limit($hal,$cari,$dari,$baris){  
        if($hal=='publikasi')
        {
        return $this->db->query("SELECT * FROM simpeg_publikasi  WHERE judul LIKE '%$cari%' ORDER BY tahun DESC, judul ASC LIMIT $dari,$baris")->result_array();  
        }
        else if($hal=='penelitian')
        {
        return $this->db->query("SELECT * FROM simpeg_penelitian  WHERE judul_penelitian LIKE '%$cari%' ORDER BY tahun DESC, judul_penelitian ASC LIMIT $dari,$baris")->result_array();  
        }
        else if($hal=='pengabdian')
        {
        return $this->db->query("SELECT * FROM simpeg_pengabdian  WHERE judul LIKE '%$cari%' ORDER BY tahun DESC, judul ASC LIMIT $dari,$baris")->result_array();  
        }
        
    }

    


    
    

    

    

  
}