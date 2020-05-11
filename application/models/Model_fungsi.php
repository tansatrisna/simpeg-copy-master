<?php 
class Model_fungsi extends CI_model{
   /* public function kategori($id){
    return $this->db->get("SELECT * FROM kategori WHERE id_kategori='$id'");
    } */
    function opLokasi($p) {
    
    $opsi .= '<option value="" >..::Pilih Lokasi::..</option>';
    $query = $this->db->query("SELECT * FROM k_lokasi");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kode_lokasi'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kode_lokasi'].'" '.$cl.'>'.$r['nama_lokasi'].'</option>';
    }
    return $opsi;

    }

    function viewLokasi($p) {
    
    $query = $this->db->query("SELECT * FROM k_lokasi WHERE kode_lokasi='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_lokasi'];
    }
    return $opsi;

    }

    function opKategori($p) {
    
    $opsi .= '<option value="" >..::Pilih Kategori::..</option>';
    $query = $this->db->query("SELECT * FROM r_kategori");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_kategori'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_kategori'].'" '.$cl.'>'.$r['nama_kategori'].'</option>';
    }
    return $opsi;

    }

    function viewKategori($p) {
    
    $query = $this->db->query("SELECT * FROM r_kategori WHERE id_kategori='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_kategori'];
    }
    return $opsi;

    }


    function opGedung($p,$q) {
    
    $opsi .= '<option value="" >..::Pilih Gedung::..</option>';
    $query = $this->db->query("SELECT * FROM r_gedung WHERE kode_lokasi='$q'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_gedung'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_gedung'].'" '.$cl.'>'.$r['nama_gedung'].'</option>';
    }
    return $opsi;

    }

    function opGedungPakai($p) {
    
    $opsi .= '<option value="" >..::Pilih Gedung::..</option>';
    $query = $this->db->query("SELECT * FROM sewa_gedung ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

    function opKendaraanPakai($p) {
    
    $opsi .= '<option value="" >..::Pilih Kendaraan::..</option>';
    $query = $this->db->query("SELECT * FROM sewa_kendaraan ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].' - '.$r['no_plat'].'</option>';
    }
    return $opsi;

    }

    function opSopir($p) {
    
    $opsi .= '<option value="" >..::Pilih Sopir::..</option>';
    $query = $this->db->query("SELECT * FROM sopir ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

    function viewSopir($p) {
    
    $query = $this->db->query("SELECT * FROM sopir WHERE id='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama'];
    }
    return $opsi;

    }    

    function viewGedung($p) {
    
    $query = $this->db->query("SELECT * FROM r_gedung WHERE id_gedung='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_gedung'];
    }
    return $opsi;

    }

    function viewGedungPakai($p) {
    
    $query = $this->db->query("SELECT * FROM sewa_gedung WHERE id='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama'];
    }
    return $opsi;

    }

     function viewKendaraanPakai($p) {
    
    $query = $this->db->query("SELECT * FROM sewa_kendaraan WHERE id='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama'].' - '.$r['no_plat'];
    }
    return $opsi;

    }

    function getGedung($postData){
    $response = array();
 
    // Select record
    $this->db->select('id_gedung,nama_gedung');
    $this->db->where('kode_lokasi', $postData['lokasi']);
    $q = $this->db->get('r_gedung');
    $response = $q->result_array();

    return $response;
  }

  function opRuangan($p,$q) {
    
    $opsi .= '<option value="" >..::Pilih Ruangan::..</option>';
    $query = $this->db->query("SELECT * FROM r_ruangan WHERE id_gedung='$q'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_ruangan'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_ruangan'].'" '.$cl.'>'.$r['nama_ruangan'].'</option>';
    }
    return $opsi;

    }

   function opRuanganUnit($p,$q) {
    
    $opsi .= '<option value="" >..::Pilih Ruangan::..</option>';
    $query = $this->db->query("SELECT * FROM r_ruangan WHERE kode_unit='$q'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kode_ruangan'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kode_ruangan'].'" '.$cl.'>'.$r['nama_ruangan'].'</option>';
    }
    return $opsi;

    }

    function viewRuangan($p) {
    
    $query = $this->db->query("SELECT * FROM r_ruangan WHERE id_ruangan='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_ruangan'];
    }
    return $opsi;

    }

     function viewRuanganUnit($p) {
    
    $query = $this->db->query("SELECT * FROM r_ruangan WHERE kode_ruangan='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_ruangan'];
    }
    return $opsi;

    }

    function getRuangan($postData){
    $response = array();
 
    // Select record
    $this->db->select('id_ruangan,nama_ruangan');
    $this->db->where('id_gedung', $postData['gedung']);
    $q = $this->db->get('r_ruangan');
    $response = $q->result_array();

    return $response;
  }

   function getRuanganUnit($postData){
    $response = array();
 
    // Select record
    $this->db->select('kode_ruangan,nama_ruangan');
    $this->db->where('kode_unit', $postData['unit']);
    $q = $this->db->get('r_ruangan');
    $response = $q->result_array();

    return $response;
  }

   function opMerek($p,$q) {
    
    $opsi .= '<option value="" >..::Pilih Sub Jenis::..</option>';
    $query = $this->db->query("SELECT * FROM r_merek WHERE id_jenis='$q'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_merek'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_merek'].'" '.$cl.'>'.$r['nama_merek'].'</option>';
    }
    return $opsi;

    }

    function viewMerek($p) {
    
    $query = $this->db->query("SELECT * FROM r_merek WHERE id_merek='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_merek'];
    }
    return $opsi;

    }

    function getMerek($postData){
    $response = array();
 
    // Select record
    $this->db->select('id_merek,nama_merek');
    $this->db->where('id_jenis', $postData['jenis']);
    $q = $this->db->get('r_merek');
    $response = $q->result_array();

    return $response;
  }

  function opBarang($p,$q) {
    
    $opsi .= '<option value="" >..::Pilih Nama Barang::..</option>';
    $query = $this->db->query("SELECT * FROM m_barang WHERE id_merek='$q'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_barang'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_barang'].'" '.$cl.'>'.$r['nama_barang'].'</option>';
    }
    return $opsi;

    }

    function viewBarang($p) {
    
    $query = $this->db->query("SELECT * FROM m_barang WHERE id_barang='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_barang'];
    }
    return $opsi;

    }

    function getBarang($postData){
    $response = array();
 
    // Select record
    $this->db->select('id_barang,nama_barang');
    $this->db->where('id_merek', $postData['merek']);
    $q = $this->db->get('m_barang');
    $response = $q->result_array();

    return $response;
  }

   function opJenis($p,$q) {
    
    $opsi .= '<option value="" >..::Pilih Jenis::..</option>';
    $query = $this->db->query("SELECT * FROM r_jenis WHERE id_kategori='$q'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_jenis'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_jenis'].'" '.$cl.'>'.$r['nama_jenis'].'</option>';
    }
    return $opsi;

    }

    function viewJenis($p) {
    
    $query = $this->db->query("SELECT * FROM r_jenis WHERE id_jenis='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_jenis'];
    }
    return $opsi;

    }

    function getJenis($postData){
    $response = array();
 
    // Select record
    $this->db->select('id_jenis,nama_jenis');
    $this->db->where('id_kategori', $postData['kategori']);
    $q = $this->db->get('r_jenis');
    $response = $q->result_array();

    return $response;
  }

  function opStatusBarang($p) {
$query = $this->db->query("SHOW FIELDS FROM m_pengadaan");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'status') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

 function opSumberBiaya($p) {
$query = $this->db->query("SHOW FIELDS FROM m_pencatatan");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'sumber_biaya') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

function opKondisiInventaris($p) {
$query = $this->db->query("SHOW FIELDS FROM m_pencatatan");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'kondisi') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

function opKondisiBarang($p) {
$query = $this->db->query("SHOW FIELDS FROM m_pengadaan");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'kondisi') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}
   

    function opPengadaan($p) {
$query = $this->db->query("SHOW FIELDS FROM m_pengadaan");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'pengadaan') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

 function opLevel($p) {
$query = $this->db->query("SHOW FIELDS FROM user");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'level') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

 function opStatusAktif($p) {
$query = $this->db->query("SHOW FIELDS FROM user");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'status') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

function opStatusGedung($p) {
$query = $this->db->query("SHOW FIELDS FROM r_gedung");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'status_gedung') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

function opKondisiGedung($p) {
$query = $this->db->query("SHOW FIELDS FROM r_gedung");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'kondisi') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}


function opStatusRenovasi($p) {
$query = $this->db->query("SHOW FIELDS FROM renovasi");
foreach ($query->result_array() as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == 'status') break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $p){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}
    function kunjungan(){
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time(); 
        $cekk = $this->db->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if($cekk->num_rows() == 0){
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>'1', 'online'=>$waktu);
            $this->db->insert('statistik',$datadb);
        }else{
            $hitss = $rowh['hits'] + 1;
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>$hitss, 'online'=>$waktu);
            $array = array('ip' => $ip, 'tanggal' => $tanggal);
            $this->db->where($array);
            $this->db->update('statistik',$datadb);
        }
    }

function opPenerimaBarang($p) {
    
    $opsi .= '<option value="" >..::Pilih Penerima Barang::..</option>';
    $query = $this->db->query("SELECT * FROM p_penerimabarang");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_penerimabarang'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_penerimabarang'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

function viewPenerimaBarang($p) {
    
    $query = $this->db->query("SELECT * FROM p_penerimabarang WHERE id_penerimabarang='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama'];
    }
    return $opsi;

    }

function getIdGedung($p) {
    
    $query = $this->db->query("SELECT * FROM r_ruangan WHERE kode_ruangan='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['id_gedung'];
    }
    return $opsi;

    }



function opSatuan($p) {
    
    $opsi .= '<option value="" >..::Pilih Satuan Barang::..</option>';
    $query = $this->db->query("SELECT * FROM r_satuan");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_satuan'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_satuan'].'" '.$cl.'>'.$r['nama_satuan'].'</option>';
    }
    return $opsi;

    }

    function opBendahara($p) {
    
    $opsi .= '<option value="" >..::Pilih Bendahara::..</option>';
    $query = $this->db->query("SELECT * FROM p_bendahara");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_bendahara'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_bendahara'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

    function opToko($p) {
    
    $opsi .= '<option value="" >..::Pilih Toko::..</option>';
    $query = $this->db->query("SELECT * FROM r_toko");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_toko'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_toko'].'" '.$cl.'>'.$r['nama_toko'].'</option>';
    }
    return $opsi;

    }


function zerofill ($num, $zerofill = 4)
{
    return str_pad($num, $zerofill, '0', STR_PAD_LEFT);
}

function opJenisInventaris($p) {
    
    $opsi .= '<option value="" >..::Pilih Jenis Inventaris::..</option>';
    $query = $this->db->query("SELECT * FROM k_jenis_inventaris");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kode_jenis'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kode_jenis'].'" '.$cl.'>'.$r['nama_jenis'].'</option>';
    }
    return $opsi;

    }

function viewJenisInventaris($p) {
    
    $query = $this->db->query("SELECT * FROM k_jenis_inventaris WHERE kode_jenis='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_jenis'];
    }
    return $opsi;

    }

function viewSatuan($p) {
    
    $query = $this->db->query("SELECT * FROM r_satuan WHERE id_satuan='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_satuan'];
    }
    return $opsi;

    }

function viewToko($p) {
    
    $query = $this->db->query("SELECT * FROM r_toko WHERE id_toko='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_toko'];
    }
    return $opsi;

    }

function viewBendahara($p) {
    
    $query = $this->db->query("SELECT * FROM p_bendahara WHERE id_bendahara='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama'];
    }
    return $opsi;

    }

function viewKelompokInventaris($p) {
    
    $query = $this->db->query("SELECT * FROM k_kelompok_inventaris WHERE kode_kelompok='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_kelompok'];
    }
    return $opsi;

    }

function viewInventariss($p) {
    
    $query = $this->db->query("SELECT * FROM k_inventaris WHERE kode_inventaris='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_inventaris'];
    }
    return $opsi;

    }

function viewSubiventaris($p) {
    
    $query = $this->db->query("SELECT * FROM k_subinventaris WHERE kode_subinventaris='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_subinventaris'];
    }
    return $opsi;

    }

    function opUnit($p) {
    
    $opsi .= '<option value="" >..::Pilih Unit::..</option>';
    $query = $this->db->query("SELECT * FROM unit ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kode_unit'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kode_unit'].'" '.$cl.'>'.$r['nama_unit'].'</option>';
    }
    return $opsi;

    }

    function viewUnit($p) {
    
    $query = $this->db->query("SELECT * FROM unit WHERE kode_unit='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_unit'];
    }
    return $opsi;

    }

    function opPenggunaan($p) {
    
    $opsi .= '<option value="" >..::Pilih Penggunaan::..</option>';
    $query = $this->db->query("SELECT * FROM penggunaan ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_penggunaan'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_penggunaan'].'" '.$cl.'>'.$r['nama_penggunaan'].'</option>';
    }
    return $opsi;

    }

    function viewPenggunaan($p) {
    
    $query = $this->db->query("SELECT * FROM penggunaan WHERE id_penggunaan='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['nama_penggunaan'];
    }
    return $opsi;

    }

    function jlhRuang($p) {
    
    $query = $this->db->query("SELECT Count(*) as jumlah FROM r_ruangan WHERE id_gedung='$p'");
    foreach( $query->result_array() as $r) 
    {
       $opsi .= $r['jumlah'];
    }
    return $opsi;

    }


    
}