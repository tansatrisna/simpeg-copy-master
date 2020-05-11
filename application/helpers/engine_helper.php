<?php 
function identitas($p){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT $p FROM simpeg_identitas WHERE id=1")->row_array();
        return $bg[$p];
    }

function login($p){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT $p FROM login WHERE id=1")->row_array();
        return $bg[$p];
    }

  function kopsurat($p){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT $p FROM kop_surat WHERE id=1")->row_array();
        return $bg[$p];
    }

    function bgLogin(){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT gambar FROM bglogin ORDER BY RAND() ASC LIMIT 0,1 ")->row_array();
        return $fav['gambar'];
    }

function tahunsimpeg(){
    $ci = & get_instance();
    $sql= $ci->db->query("SELECT tahun from simpeg_tahun WHERE aktif='Y'")->row_array();
    return $sql['tahun'];
}

function tahunTerakhir(){
    $ci = & get_instance();
    $sql= $ci->db->query("SELECT tahun_id from m_tahun ORDER BY tahun_id DESC LIMIT 0,1")->row_array();
    return $sql['tahun_id'];
}

function biayaJalur($tahun_id,$jalur){
    $ci = & get_instance();
    $sql= $ci->db->query("SELECT tarif from simpeg_tarif WHERE tahun_id='$tahun_id' AND jalur_masuk='$jalur'")->row_array();
    return $sql['tarif'];
}

function keteranganTarif($tahun_id,$jalur){
    $ci = & get_instance();
    $sql= $ci->db->query("SELECT ket from simpeg_tarif WHERE tahun_id='$tahun_id' AND jalur_masuk='$jalur'")->row_array();
    return $sql['ket'];
}

function subProgram($prog){
    $ci = & get_instance();
    $sql= $ci->db->query("SELECT seo from simpeg_web_subprogram WHERE program='$prog' ORDER BY id ASC LIMIT 0,1")->row_array();
    return $sql['seo'];
}

function opLevel($p) {
    $ci = & get_instance();
    $opsi .= '<option value="" >..::Pilih Level::..</option>';
    $query = $ci->db->query("SELECT * FROM simpeg_level ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_level'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_level'].'" '.$cl.'>'.$r['nama_level'].'</option>';
    }
    return $opsi;

    }

function viewLevel($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama_level FROM simpeg_level WHERE id_level='$p'")->row_array();
        return $fav['nama_level'];
    }

function opEnum($table,$field,$value='') {
$ci = & get_instance();
$ss = $ci->db->query("SHOW FIELDS FROM $table")->result_array();
foreach ($ss as $as) {
    # code...

    $arrs = $as['Type'];
    if (substr($arrs,0,4) == 'enum' && $as['Field'] == $field) break;
}

$arrs = ''.substr ($arrs,4);
$arr = eval( '$arr5 = array'.$arrs.';' );
foreach ($arr5 as $k=>$v){
    if ($v == $value){
    $opsi .= '<option value="'.$v.'" selected>'.$v.'</option>';
    }else {
    $opsi .= '<option value="'.$v.'">'.$v.'</option>';  
    }
}
    return $opsi;
}

function bisaBaca($link,$id_level){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT baca FROM view_simpeg_menu WHERE link='$link' AND id_level='$id_level'")->row_array();
        return $fav['baca'];
    }

function bisaTulis($link,$id_level){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT tulis FROM view_simpeg_menu WHERE link='$link' AND id_level='$id_level'")->row_array();
        return $fav['tulis'];
    }

function bisaUbah($link,$id_level){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT ubah FROM view_simpeg_menu WHERE link='$link' AND id_level='$id_level'")->row_array();
        return $fav['ubah'];
    }

function bisaHapus($link,$id_level){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT hapus FROM view_simpeg_menu WHERE link='$link' AND id_level='$id_level'")->row_array();
        return $fav['hapus'];
    }

function cekMenu($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id_menu FROM view_simpeg_menu WHERE id_modul='$p' AND id_level='$q' AND baca=1 ")->num_rows();
        return $fav;
    }

function cekSubMenu($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id_menu FROM view_simpeg_menu WHERE id_parent='$p' AND id_level='$q' AND baca=1 ")->num_rows();
        return $fav;
    }

function aksesMenu($modul,$level){
    $ci = & get_instance();
    $query = $ci->db->query("SELECT id_menu FROM simpeg_menu WHERE id_modul='$modul'")->num_rows();
    if($query > 0)
    {
  $aksi='<a title="Akses Menu" href="'.base_url('akses/menu/'.$modul.'/'.$level).'" class="btn btn-sm btn-primary" ><i class="fa fa-info"></i></a>';
    }
    else
    {
        $aksi='';
    }
  return $aksi;
}

function aksiAmbilSoal($link,$id,$kata=''){
  $aksi='<a title="Ambil Soal" href="'.base_url($link.'/'.$id).'" class="btn btn-xs btn-success" ><i class="fa fa-hand-grab-o"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiHapus($link,$id){
  $aksi='<a title="Hapus Data" href="'.base_url($link.'/'.$id).'" class="btn btn-xs btn-danger" onclick="return confirm(\'Anda Yakin Akan Menghapus Data Ini ?\');"><i class="fa fa-trash"></i></a>';
  return $aksi;
}

function aksiReset($link,$id,$kata=''){
  $aksi='<a title="Hapus Data" href="'.base_url($link.'/'.$id).'" class="btn btn-xs btn-danger" onclick="return confirm(\'Anda Yakin Akan Mereset Kelulusan Peserta Ini ?\');"><i class="fa fa-sync"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiEdit($link,$id,$kata=''){
  $aksi='<a title="Edit Data" href="'.base_url($link.'/'.$id).'" class="btn btn-xs btn-warning" ><i class="fa fa-edit"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiDetail($link,$id,$kata=''){
  $aksi='<a title="Detail Data" href="'.base_url($link.'/'.$id).'" class="btn btn-xs btn-info"><i class="fa fa-info-circle"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiDetailBlank($link,$id,$kata=''){
  $aksi='<a title="Detail Data" href="'.base_url($link.'/'.$id).'" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-info-circle"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiUrl($link,$kata=''){
  $aksi='<a title="Detail Data" href="'.$link.'" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-folder-open"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiKembali($link){
  $aksi='<a title="Kembali" href="'.base_url($link).'" class="btn btn-xs btn-success" ><i class="fa fa-backward"></i> Kembali</a>';
  return $aksi;
}

function aksiTambah($link,$kata='Tambah'){
  $aksi='<a title="Tambah Data" href="'.base_url($link).'" class="btn btn-xs btn-info" ><i class="fa fa-plus"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiCetak($link,$id,$kata){
  $aksi='<a title="Cetak Data" href="'.base_url($link.'/'.$id).'" class="btn btn-xs btn-info" onclick="window.open(this.href, \'popupwindow\',\'width=800,height=600,left=200, top=50, scrollbars=yes,resizable=yes\'); return false;"><i class="fa fa-print"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiAktif($link,$id,$aktif=0){
    if($aktif==0)
    {
        $aksi='<a title="Aktifkan Data" href="'.base_url($link.'/'.$id.'/'.$aktif).'" class="btn btn-xs btn-danger" onclick="return confirm(\'Anda Yakin Akan Mengaktifkan Kuisioner Ini ?\');"><i class="fa fa-times"></i></a>';
    }
    else
    {
        $aksi='<a title="Validasi Data" href="'.base_url($link.'/'.$id.'/'.$aktif).'" href="" class="btn btn-xs btn-success" onclick="return confirm(\'Anda Yakin Akan Menonaktifkan Kuisioner Ini ?\');"><i class="fa fa-check"></i></a>';
    }
  
  return $aksi;
}

function aksiDownload($link,$id,$kata=''){
  $aksi='<a title="Tambah Data" href="'.base_url($link.'/'.$id).'" class="btn btn-sm btn-primary" ><i class="fa fa-download"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalImport($target,$kata=''){
  $aksi='<a title="Tambah Data" href="" data-toggle="modal" data-target="'.$target.'" class="btn btn-xs btn-info" ><i class="fa fa-upload"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalUpload($target,$kata=''){
  $aksi='<a title="Tambah Data" href="" data-toggle="modal" data-target="'.$target.'" class="btn btn-lg btn-info" ><i class="fa fa-upload"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalLihatBukti($target,$kata=''){
  $aksi='<a title="Tambah Data" href="" data-toggle="modal" data-target="'.$target.'" class="btn btn-lg btn-success" ><i class="fa fa-eye"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalValidasi($target,$kata=''){
  $aksi='<a title="Tambah Data" href="" data-toggle="modal" data-target="'.$target.'" class="btn btn-xs btn-info" ><i class="fa fa-check"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalTambah($target,$kata=''){
  $aksi='<a title="Tambah Data" href="" data-toggle="modal" data-target="'.$target.'" class="btn btn-xs btn-info" ><i class="fa fa-plus"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalEdit($target,$id,$kata=''){
  $aksi='<a title="Tambah Data" href="" data-toggle="modal" data-target="'.$target.'" data-id="'.$id.'" class="btn btn-xs btn-warning" ><i class="fa fa-edit"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalLihat($target,$id,$kata=''){
  $aksi='<a title="Lihat Data" href="" data-toggle="modal" data-target="'.$target.'" data-id="'.$id.'" class="btn btn-xs btn-info" ><i class="fa fa-eye"></i> '.$kata.'</a>';
  return $aksi;
}

function aksiModalBiasa($target,$id,$kata=''){
  $aksi='<a title="Lihat Data" href="" data-toggle="modal" data-target="'.$target.'" data-id="'.$id.'" >'.$kata.'</a>';
  return $aksi;
}

function opModul($p) {
    $ci = & get_instance();
    $opsi .= '<option value="" >..::Pilih Modul::..</option>';
    $query = $ci->db->query("SELECT * FROM simpeg_modul order by urutan ASC");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_modul'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_modul'].'" '.$cl.'>'.$r['nama_modul'].'</option>';
    }
    return $opsi;

    }

function opParentMenu($p,$q) {
    $ci = & get_instance();
    $opsi .= '<option value="" >..::Root::..</option>';
    $query = $ci->db->query("SELECT * FROM simpeg_menu WHERE id_modul='$p' AND id_parent=0 ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id_menu'] == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id_menu'].'" '.$cl.'>'.$r['nama_menu'].'</option>';
    }
    return $opsi;

    }

function getMenu($postData){
    $ci = & get_instance();
    $response = array();
 
    // Select record
    $ci->db->select('id_menu,nama_menu');
    $ci->db->where('id_modul', $postData['modul']);
    $ci->db->where('id_parent', 0);
    $q = $ci->db->get('simpeg_menu');
    $response = $q->result_array();

    return $response;
  }



function getModul($postData){
    $ci = & get_instance();
    //$response = array();
 
    // Select record
    $ci->db->select('controller');
    $ci->db->where('id_modul', $postData['modul']);
    $q = $ci->db->get('simpeg_modul');
    $response = $q->row_array();

    return $response['controller'];
  }

function viewModul($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama_modul FROM simpeg_modul WHERE id_modul='$p'")->row_array();
        return $fav['nama_modul'];
    }

function idParent($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id_parent FROM simpeg_menu WHERE link='$p'")->row_array();
        return $fav['id_parent'];
    }



function opTahunPimpinan($p) {
    $ci = & get_instance();
    $pimpinan=$ci->db->query("SELECT tahun_id FROM m_pimpinan");
        if($pimpinan->num_rows()==0)
        {
            $query = $ci->db->query("SELECT tahun_id,nama_tahun FROM m_tahun WHERE tahun_id ORDER BY tahun_id ");
            foreach( $query->result_array() as $r) 
            {
            $cl = ($r['tahun_id'] == $p) ? 'selected' : '';
            $opsi .= '<option value="'.$r['tahun_id'].'" '.$cl.'>'.$r['nama_tahun'].'</option>';
            }
        return $opsi;
        }
        else
        {
            $pim=array();
            foreach ($pimpinan->result_array() as $row) {
               array_push($pim, $row['tahun_id']);
            }
            $where=implode(",",$pim);
            $query = $ci->db->query("SELECT tahun_id,nama_tahun FROM m_tahun WHERE tahun_id NOT IN($where) ORDER BY tahun_id ");
            foreach( $query->result_array() as $r) 
            {
            $cl = ($r['tahun_id'] == $p) ? 'selected' : '';
            $opsi .= '<option value="'.$r['tahun_id'].'" '.$cl.'>'.$r['nama_tahun'].'</option>';
            }
        return $opsi;

        }
    }



function opTahunId($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT tahun_id,nama_tahun FROM m_tahun  ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['tahun_id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['tahun_id'].'" '.$cl.'>'.$r['nama_tahun'].'</option>';
    }
    return $opsi;

    }

function viewTahunId($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama_tahun FROM m_tahun WHERE tahun_id='$p'")->row_array();
        return $fav['nama_tahun'];
    }

function opKelompokUnit($p) {
    $ci = & get_instance();
    
    $query = $ci->db->query("SELECT * FROM m_kelompok_unit order by urutan ASC");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['kelompok'].'</option>';
    }
    return $opsi;

    }

function opParentUnit($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT * FROM m_unit WHERE parent=0 ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

function opUnit($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT * FROM m_unit order by parent,kelompok ASC ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }


function opFakultas($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT kode_fakultas,nama_fakultas FROM m_fakultas  ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kode_fakultas'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kode_fakultas'].'" '.$cl.'>'.$r['nama_fakultas'].'</option>';
    }
    return $opsi;

    }

function opProdi($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT kode_prodi,nama_prodi FROM m_program_studi  ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kode_prodi'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kode_prodi'].'" '.$cl.'>'.$r['nama_prodi'].'</option>';
    }
    return $opsi;

    }


function viewStatusSdm($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama FROM m_status_sdm WHERE id='$p'")->row_array();
        return $fav['nama'];
    }

function viewFakultas($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama_fakutas FROM m_fakultas WHERE kode_fakultas='$p'")->row_array();
        return $fav['nama_fakultas'];
    }

function viewUnit($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama FROM m_unit WHERE id='$p'")->row_array();
        return $fav['nama'];
    }

function viewUnitSdm($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT a.nama FROM m_unit as a join m_sdm as b on a.id=b.unit WHERE b.idsdm='$p'")->row_array();
        return $fav['nama'];
    }

function viewKelompokUnit($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT kelompok FROM m_kelompok_unit WHERE id='$p'")->row_array();
        return $fav['kelompok'];
    }

function seoKelompok($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM m_kelompok_unit WHERE seo='$p'")->row_array();
        return $fav['id'];
    }


function viewProgram($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT program FROM simpeg_web_program WHERE id='$p'")->row_array();
        return $fav['program'];
    }

function viewSubProgram($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama FROM simpeg_web_subprogram WHERE id='$p'")->row_array();
        return $fav['nama'];
    }

function viewProdi($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama_prodi FROM m_program_studi WHERE kode_prodi='$p'")->row_array();
        return $fav['nama_prodi'];
    }

function opSdm($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT idsdm FROM m_sdm ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['idsdm'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['idsdm'].'" '.$cl.'>'.viewSdm($r['idsdm']).'</option>';
    }
    return $opsi;

    }

function opSdmMultiple($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT idsdm FROM m_sdm ");
    foreach( $query->result_array() as $r) 
    {

        if(in_array($r['idsdm'], $p))
        {
            $cl='selected';
        }
        else
        {
            $cl='';
        }
    $opsi .= '<option value="'.$r['idsdm'].'" '.$cl.'>'.viewSdm($r['idsdm']).'</option>';
    }
    return $opsi;

    }

function opSdmJenis($jenis,$p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT idsdm FROM m_sdm WHERE jenis='$jenis'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['idsdm'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['idsdm'].'" '.$cl.'>'.viewSdm($r['idsdm']).'</option>';
    }
    return $opsi;

    }

function viewSdm($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nama,gelar_depan,gelar_belakang FROM m_sdm WHERE idsdm='$p'")->row_array();
        if($fav['gelar_depan']=='' AND $fav['gelar_belakang']=='')
        {
            return $fav['nama'];
        }
        else if($fav['gelar_depan']!='' AND $fav['gelar_belakang']=='')
        {
            return $fav['gelar_depan'].' '.$fav['nama'];
        }
        else if($fav['gelar_depan']=='' AND $fav['gelar_belakang']!='')
        {
            return $fav['nama'].', '.$fav['gelar_belakang'];
        }
        else
        {
            return $fav['gelar_depan'].' '.$fav['nama'].', '.$fav['gelar_belakang'];
        }
        
    }

function viewDetailSdm($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $q FROM m_sdm WHERE idsdm='$p'")->row_array();
        return $fav[$q];
    }

function opBadanHukum($p) {
    $ci = & get_instance();
    $opsi ='<option value="" '.$cl.'>..::Pilih Badan Hukum::..</option>';
    $query = $ci->db->query("SELECT kode_badan_hukum, nama_badan_hukum FROM m_badan_hukum  ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kode_badan_hukum'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kode_badan_hukum'].'" '.$cl.'>'.$r['nama_badan_hukum'].'</option>';
    }
    return $opsi;

    }

function opDosen($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT idd FROM m_dosen  ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['idd'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['idd'].'" '.$cl.'>'.viewDosen($r['idd']).'</option>';
    }
    return $opsi;

    }



function opProp($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT * FROM r_propinsi ");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['KDEPRO'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['KDEPRO'].'" '.$cl.'>'.$r['NMAPRO'].'</option>';
    }
    return $opsi;

    }

function viewProp($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT NMAPRO FROM r_propinsi WHERE KDEPRO='$p'")->row_array();
        return $fav['NMAPRO'];
    }


 function getKab($postData){
    $ci = & get_instance();
    $response = array();
 
    // Select record
    $ci->db->select('KDEKKB,NMAKKB');
    $ci->db->where('KDEPRO', $postData['prop']);
    $q = $ci->db->get('r_kabupaten');
    $response = $q->result_array();

    return $response;
  }

function opKab($p,$q) {
    $ci = & get_instance();
   
    $query = $ci->db->query("SELECT * FROM r_kabupaten WHERE KDEPRO='$p'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['KDEKKB'] == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$r['KDEKKB'].'" '.$cl.'>'.$r['NMAKKB'].'</option>';
    }
    return $opsi;

    }
function viewKab($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT NMAKKB FROM r_kabupaten WHERE KDEKKB='$p'")->row_array();
        return $fav['NMAKKB'];
    }

function getKec($postData){
    $ci = & get_instance();
    $response = array();
 
    // Select record
    $ci->db->select('KDEKEC,NMAKEC');
    $ci->db->where('KDEKKB', $postData['kab']);
    $q = $ci->db->get('r_kecamatan');
    $response = $q->result_array();

    return $response;
  }

function opKec($p,$q) {
    $ci = & get_instance();
   
    $query = $ci->db->query("SELECT * FROM r_kecamatan WHERE KDEKKB='$p'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['KDEKEC'] == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$r['KDEKEC'].'" '.$cl.'>'.$r['NMAKEC'].'</option>';
    }
    return $opsi;

    }
function viewKec($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT NMAKEC FROM r_kecamatan WHERE KDEKEC='$p'")->row_array();
        return $fav['NMAKEC'];
    }

function getSekolah($postData){
    $ci = & get_instance();
    $response = array();
 
    // Select record
    $ci->db->select('KDESLTA,NMASLTA');
    $ci->db->where('KDEKKB', $postData['kab']);
    $q = $ci->db->get('r_slta');
    $response = $q->result_array();

    return $response;
  }

function opSekolah($p,$q) {
    $ci = & get_instance();
   
    $query = $ci->db->query("SELECT * FROM r_slta WHERE KDEKKB='$p'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['KDESLTA'] == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$r['KDESLTA'].'" '.$cl.'>'.$r['NMASLTA'].'</option>';
    }
    return $opsi;

    }
function viewSekolah($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT NMASLTA FROM r_slta WHERE KDESLTA='$p'")->row_array();
        return $fav['NMASLTA'];
    }

function opKabupaten($p) {
    $ci = & get_instance();
   
    $query = $ci->db->query("SELECT * FROM r_kabupaten");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['KDEKKB'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['KDEKKB'].'" '.$cl.'>'.$r['NMAKKB'].'</option>';
    }
    return $opsi;

    }


function viewAplikasi($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT referensi FROM tbrefa WHERE idxref='$p'")->row_array();
        return $fav['referensi'];
    }

function viewKodeApp($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nmaref1 FROM tbrefb WHERE idxref='$p' AND kderef='$q'")->row_array();
        return $fav['nmaref1'];
    }

function viewKodeApp1($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT nmaref2 FROM tbrefb WHERE idxref='$p' AND kderef='$q'")->row_array();
        return $fav['nmaref2'];
    }

function opKodeApp($p,$q) {
    $ci = & get_instance();
    $opsi .= '<option value="" >..::Pilih '.viewAplikasi($p).'::..</option>';
    $query = $ci->db->query("SELECT * FROM tbrefb WHERE idxref='$p'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['kderef'] == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$r['kderef'].'" '.$cl.'>'.$r['nmaref1'].'</option>';
    }
    return $opsi;

    }

function idSdm($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT idsdm FROM m_sdm ORDER BY idsdm DESC LIMIT 0,1");
    if($query->num_rows()==0)
    {
        return $p.'000001';
    }
    else
    {
        $row=$query->row_array();
        $id=$row['idsdm'];
        $nomor=substr($id,3,6);
        $idd=$nomor+1;
        $dd=sprintf("%06d", $idd);
        return $p.$dd;
    }
    

    }

function jlhSdm($p){
        $ci = & get_instance();
        if($p=='SEMUA')
        {
          $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm ")->row_array();  
        }
        else
        {
            $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jenis='$p' ")->row_array();  
        }
        
        return $fav['jlh'];
    }


function jlhProdi($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT kode_prodi FROM m_program_studi WHERE kode_fak='$p' ")->num_rows();
        return $fav;
    }

function jlhProdiAll($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT kode_prodi FROM m_program_studi ")->num_rows();
        return $fav;
    }

function cekKuisionerSdm($jenis,$idsdm){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT count(id) as jlh FROM simpeg_kuisioner WHERE (target='SEMUA' OR target='$jenis') AND aktif=1 ")->row_array();
        $jlh=$fav['jlh'];
        if($jlh==0)
        {
           return 0; 
        }
        else
        {
            $query=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_kuisioner_sdm as a join simpeg_kuisioner as b on a.kuisioner=b.id WHERE a.idsdm='$idsdm' AND selesai='1' ")->row_array();
            $siap=$query['jlh'];
            $sisa=$jlh-$siap;
            return $sisa;
        }
        
    }

function cekSdmKuisioner($idsdm,$kuisioner){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM  simpeg_kuisioner_sdm  WHERE idsdm='$idsdm' AND kuisioner='$kuisioner'  ")->num_rows();
        return $fav;
    }

function cekSelesai($kuisioner,$idsdm){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT selesai FROM  simpeg_kuisioner_sdm  WHERE idsdm='$idsdm' AND kuisioner='$kuisioner'  ")->row_array();
        return $fav['selesai'];
    }

function viewUser($p,$q='nama'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $q FROM simpeg_user WHERE id_user='$p'")->row_array();
        return $fav[$q];
    }

function gelombang($tahun_id,$jalur){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_periode_daftar WHERE tahun_id='$tahun_id' AND jalur_masuk='$jalur' ORDER BY id DESC LIMIT 0,1 ")->row_array();
        return $fav['id'];
    }

function opPaketSoal($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT id,nama FROM simpeg_paketsoal");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

function viewPaketSoal($p,$q='nama'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $q FROM simpeg_paketsoal WHERE id='$p'")->row_array();
        return $fav[$q];
    }


function opKategoriSoal($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT id,nama FROM simpeg_kategorisoal");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

function viewKategoriSoal($p,$q='nama'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $q FROM simpeg_kategorisoal WHERE id='$p'")->row_array();
        return $fav[$q];
    }

function opMateriSoal($p,$q) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT id,nama FROM simpeg_materisoal WHERE kategori='$p'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

function viewMateriSoal($p,$q='nama'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $q FROM simpeg_materisoal WHERE id='$p'")->row_array();
        return $fav[$q];
    }

function viewKategoriMateri($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT kategori FROM simpeg_materisoal WHERE id='$p'")->row_array();
        return $fav['kategori'];
    }

function viewUjian($p,$q='nama'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $q FROM simpeg_ujian WHERE id='$p'")->row_array();
        return $fav[$q];
    }

function urutSoal($jenis){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT urut FROM simpeg_soal WHERE kategori='$jenis' order by urut DESC limit 1")->row_array();
        $opsi=$fav['urut']+1;
        return sprintf("%07d", $opsi);
    }

function jlhSoalUjian($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_soal_ujian WHERE id_ujian='$p' ")->num_rows();
        return $fav;
    }

function jlhSoalMateriUjian($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_soal_ujian WHERE id_ujian='$p' AND materi='$q' ")->num_rows();
        return $fav;
    }

function opPakaiSoal($p,$q) {
    $ci = & get_instance();
    $opsi .= '<option value="" >..::Soal Di Pakai::..</option>';
    $query = $ci->db->query("SELECT COUNT(id) as jumlah FROM `simpeg_soal_ujian` WHERE kategori='$p' GROUP BY id_soal order by jumlah DESC LIMIT 0,1 ")->row_array();
    for($i=0; $i<=$query['jumlah']; $i++) 
    {
    $cl = ($i == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$i.'" '.$cl.'>'.$i.' Kali</option>';
    }
    return $opsi;

    }

    function cekHasilUjian($user,$ujian){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT skor FROM simpeg_peserta_ujian WHERE id_pendaftaran='$user' AND id_ujian='$ujian'")->row_array();
        return $fav['skor'];
    }

    function cekPesertaUjian($user,$ujian){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_peserta_ujian WHERE id_pendaftaran='$user' AND id_ujian='$ujian'")->num_rows();
        return $fav;
    }

    function viewPesertaUjian($user,$ujian,$kolom){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $kolom FROM simpeg_peserta_ujian WHERE id_pendaftaran='$user' AND id_ujian='$ujian'")->row_array();
        return $fav[$kolom];
    }

    function cekSoalUjian($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_kerjakan WHERE id_pendaftaran='$p' AND id_ujian='$q'")->num_rows();
        return $fav;
    }

    function cekSoalKuisioner($p,$q){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_kuisioner_kerjakan WHERE idsdm='$p' AND kuisioner='$q'")->num_rows();
        return $fav;
    }

    function viewKuisioner($id,$kolom='nama'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $kolom FROM simpeg_kuisioner WHERE id='$id'")->row_array();
        return $fav[$kolom];
    }

    function viewKuisionerSoal($id,$kolom='soal'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $kolom FROM simpeg_kuisioner_soal WHERE id='$id'")->row_array();
        return $fav[$kolom];
    }

    function tambahWaktu($p,$q)
    {

    $time1_unix = strtotime(date('Y-m-d').' '.$p);
    $time2_unix = strtotime(date('Y-m-d').' '.$q);

    $begin_day_unix = strtotime(date('Y-m-d').' 00:00:00');

    $jumlah_time = date('H:i:s', ($time1_unix + ($time2_unix - $begin_day_unix)));

    return $jumlah_time;
    }

    function menitKetime($p) {
    $jam = floor($p/60);
    $menit = $p % 60;
    $waktu=  $jam.':'.$menit.':00';
    return $waktu;
    }

    function buatSoalUjian($user,$ujian){
        $ci = & get_instance();
        $no=0;
                
        $sql=$ci->db->query("SELECT * FROM simpeg_soal_ujian where id_ujian='$ujian' order by kategori,materi,  RAND()");
        foreach ($sql->result_array() as $hasil) {
            $no++;
            $data[]=array('nomor'=>$no,
                        'id_pendaftaran'=>$user,
                        'id_ujian'=>$ujian,
                        'id_soal'=>$hasil['id_soal'],
                        'kategori'=>$hasil['kategori'],
                        'materi'=>$hasil['materi']
                    );
            
        }
        return $data;
    }

    function buatSoalKuisioner($idsdm,$kuisioner){
        $ci = & get_instance();
        $no=0;
                
        $sql=$ci->db->query("SELECT * FROM simpeg_kuisioner_tes where kuisioner='$kuisioner' order by kategori,jenis");
        foreach ($sql->result_array() as $hasil) {
            $no++;
            $data[]=array('nomor'=>$no,
                        'idsdm'=>$idsdm,
                        'kuisioner'=>$kuisioner,
                        'id_soal'=>$hasil['soal'],
                        'kategori'=>$hasil['kategori'],
                        'jenis'=>$hasil['jenis']
                    );
            
        }
        return $data;
    }

    function beda_waktu($date1, $date2, $format = false) 
    {
        $diff = date_diff( date_create($date1), date_create($date2) );
        if ($format)
            return $diff->format($format);
        
        return array('y' => $diff->y,
                    'm' => $diff->m,
                    'd' => $diff->d,
                    'h' => $diff->h,
                    'i' => $diff->i,
                    's' => $diff->s
                );
    }

    function nilaiJawaban($soal,$jawab){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT jawaban FROM simpeg_soal WHERE id='$soal'")->row_array();
        
            if($fav['jawaban']==$jawab)
            {
                $nilai=1;
            }
            else
            {
                $nilai=0;
            }
        
        return $nilai;
    }

    function cekMulaiUjian($user,$ujian) {
    $ci = & get_instance();
    $query  = $ci->db->query ("SELECT login FROM simpeg_peserta_ujian WHERE id_pendaftaran='$user' AND id_ujian='$ujian'")->row_array();
   
    return $query['login'];
    }

    function jlhSelesaiUjian($user,$ujian){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_kerjakan WHERE id_pendaftaran='$user' AND id_ujian='$ujian' AND jawaban is NOT NULL")->num_rows();
        return $fav;
    }

    function jlhRaguUjian($user,$ujian){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_kerjakan WHERE id_pendaftaran='$user' AND id_ujian='$ujian' AND ragu = 1")->num_rows();
        return $fav;
    }

    function nomorAwalUjian($id_ujian,$kategori,$user) {
    
   $ci = & get_instance();
    $row  = $ci->db->query("SELECT nomor FROM simpeg_kerjakan WHERE id_pendaftaran='$user' AND id_ujian='$id_ujian' AND kategori='$kategori' ORDER BY nomor ASC LIMIT 0,1")->row_array();
  
    $jawab= $row['nomor'];
        
     return $jawab;
    }
    function nomorAkhirUjian($id_ujian,$kategori,$user) {
        
       $ci = & get_instance();
        $row  = $ci->db->query("SELECT nomor FROM simpeg_kerjakan WHERE id_pendaftaran='$user' AND id_ujian='$id_ujian' AND kategori='$kategori' ORDER BY nomor DESC LIMIT 0,1")->row_array();
      
        $jawab= $row['nomor'];
            
         return $jawab;
    }

    function jawabanUjian($user,$id_ujian,$nomor,$no) {
    if($no==$nomor)
    {
        $opsi='btn-primary';
    }
    else
    {
   $ci = & get_instance();
    $row  = $ci->db->query("SELECT jawaban,ragu FROM simpeg_kerjakan WHERE id_pendaftaran='$user' AND id_ujian='$id_ujian' AND nomor='$nomor'")->row_array();
  
    $jawab= $row['jawaban'];
    $ragu=$row['ragu'];
        if($jawab==NULL)
        {
            $opsi='btn-danger';
        }
        else 
        {
            if($ragu==0)
            {
                $opsi='btn-success';
            }
            else
            {
                $opsi='btn-warning';
            }
        }
    }
    
    return $opsi;
}

function pilihanJawabanUjian($user,$id_ujian,$nomor) {
    
   $ci = & get_instance();
    $row  = $ci->db->query("SELECT jawaban FROM simpeg_kerjakan WHERE id_pendaftaran='$user' AND id_ujian='$id_ujian' AND nomor='$nomor'")->row_array();
  
    $jawab= $row['jawaban'];
        
     return $jawab;
}

function skorUjian($user,$ujian){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT COUNT(id) as soal, SUM(nilai) as skor FROM simpeg_kerjakan WHERE id_pendaftaran='$user' AND id_ujian='$ujian'")->row_array();
        $soal=$fav['soal'];
        $nilai=$fav['skor'];

        $opsi=$nilai/$soal*100;

        return $opsi;
    }

function hasilUjian($user){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT a.skor,b.nama FROM simpeg_peserta_ujian as a join simpeg_ujian as b on a.id_ujian=b.id WHERE a.id_pendaftaran='$user' ");
        if($fav->num_rows()==0)
        {
            return 'Belum Ujian';
        }
        else
        {
            $opsi=[];
            foreach ($fav->result_array() as $row) {
                $opsi[]=$row['nama'].' = '.$row['skor'];
            }
            $hasil=implode('<br>', $opsi);
            return $hasil;
        }
    }

function waktuUjian($ujian){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT waktu,model FROM simpeg_ujian WHERE id='$ujian'")->row_array();
        $model=$fav['model'];
        if($model=='Simultan')
        {
            return $fav['waktu'];
        }
        else
        {
            $waktu=0;
            $kategori=$ci->db->query("SELECT DISTINCT(kategori) as kat FROM simpeg_soal_ujian WHERE id_ujian='$ujian' ")->result_array();
            foreach ($kategori as $row) {
                $jam=viewKategoriSoal($row['kat'],'waktu');
                $waktu=$waktu+$jam;
            }
            return $waktu;
        }
        
        
    }

function jlhSoalUjianKategori($p,$q,$kat){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_kerjakan WHERE id_pendaftaran='$p' AND id_ujian='$q' AND kategori='$kat'")->num_rows();
        return $fav;
    }

    function kategoriNoSoalUjian($p,$q,$nomor){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT kategori FROM simpeg_kerjakan WHERE id_pendaftaran='$p' AND id_ujian='$q' AND nomor='$nomor'")->row_array();
        return $fav['kategori'];
    }

function jlhSoalKuisionerKategori($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_kuisioner_soal WHERE kategori='$p' ")->num_rows();
        return $fav;
    }

function jlhSoalKuisioner($p){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT id FROM simpeg_kuisioner_tes WHERE kuisioner='$p' ")->num_rows();
        return $fav;
    }

function opKategoriKuisioner($p) {
    $ci = & get_instance();
    $query = $ci->db->query("SELECT id,nama FROM simpeg_kuisioner_kategori");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

function viewKategoriKuisioner($p,$q='nama'){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT $q FROM simpeg_kuisioner_kategori WHERE id='$p'")->row_array();
        return $fav[$q];
    }

function viewOptionKuisioner($p){
        $ci = & get_instance();
        $opsi='';
        $fav = $ci->db->query("SELECT * FROM simpeg_kuisioner_option WHERE kuisioner='$p'")->result_array();
        foreach ($fav as $row) {
          $opsi .= $row['nama'].'('.$row['skor'].')<br>';  
        }
        return $opsi;
    }

function nilaiKuisioner($p){
        $ci = & get_instance();
        $opsi='';
        $fav = $ci->db->query("SELECT skor FROM simpeg_kuisioner_option WHERE id='$p'")->row_array();
        
        return $fav['skor'];
    }

function viewJawabanKuisioner($p){
        $ci = & get_instance();
        $opsi='';
        $fav = $ci->db->query("SELECT nama FROM simpeg_kuisioner_option WHERE id='$p'")->row_array();
        
        return $fav['nama'];
    }

function viewPengisiKuisioner($p,$q){
        $ci = & get_instance();
        $opsi='';
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM simpeg_kuisioner_sdm WHERE kuisioner='$p' AND selesai='1' ")->row_array();
        
        return $fav['jlh'];
    }

function viewSkorHasil($kuisioner,$id_soal,$nilai,$target,$unit){
        $ci = & get_instance();
        if($target=='SEMUA' AND $unit=='')
        {
        $fav = $ci->db->query("SELECT count(id) as jlh FROM simpeg_kuisioner_hasil WHERE kuisioner='$kuisioner' AND id_soal='$id_soal' AND nilai='$nilai' ")->row_array();
        }
        else if($target!='SEMUA' AND $unit=='')
        {
        $fav = $ci->db->query("SELECT count(a.id) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.id_soal='$id_soal' AND a.nilai='$nilai' AND b.jenis='$target' ")->row_array();
        }
        else if($target=='SEMUA' AND $unit!='')
        {
        $fav = $ci->db->query("SELECT count(a.id) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.id_soal='$id_soal' AND a.nilai='$nilai' AND b.unit='$unit' ")->row_array();
        }
        else if($target!='SEMUA' AND $unit!='')
        {
        $fav = $ci->db->query("SELECT count(a.id) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.id_soal='$id_soal' AND a.nilai='$nilai' AND b.jenis='$target' AND b.unit='$unit' ")->row_array();
        }
        return $fav['jlh'];
    }



function viewSkorKategori($kuisioner,$kategori,$nilai,$target,$unit){
        $ci = & get_instance();
        if($target=='SEMUA' AND $unit=='')
        {
        $fav = $ci->db->query("SELECT count(id) as jlh FROM simpeg_kuisioner_hasil WHERE kuisioner='$kuisioner' AND kategori='$kategori' AND nilai='$nilai' ")->row_array();
        }
        else if($target!='SEMUA' AND $unit=='')
        {
        $fav = $ci->db->query("SELECT count(a.id) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.kategori='$kategori' AND a.nilai='$nilai' AND b.jenis='$target' ")->row_array();
        }
        else if($target=='SEMUA' AND $unit!='')
        {
        $fav = $ci->db->query("SELECT count(a.id) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.kategori='$kategori' AND a.nilai='$nilai' AND b.unit='$unit' ")->row_array();
        }
        else if($target!='SEMUA' AND $unit!='')
        {
        $fav = $ci->db->query("SELECT count(a.id) as jlh FROM simpeg_kuisioner_hasil as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.kuisioner='$kuisioner' AND a.kategori='$kategori' AND a.nilai='$nilai' AND b.jenis='$target' AND b.unit='$unit' ")->row_array();
        }
        return $fav['jlh'];
    }

function viewSkorTertinggiKuisioner($p){
        $ci = & get_instance();
        
        $fav = $ci->db->query("SELECT skor FROM simpeg_kuisioner_option WHERE kuisioner='$p' ORDER BY skor DESC LIMIT 0,1")->row_array();
        
        return $fav['skor'];
    }

function opStatusSdm($p,$q) {
    $ci = & get_instance();
   
    $query = $ci->db->query("SELECT * FROM m_status_sdm WHERE jenis='$p'");
    foreach( $query->result_array() as $r) 
    {
    $cl = ($r['id'] == $q) ? 'selected' : '';
    $opsi .= '<option value="'.$r['id'].'" '.$cl.'>'.$r['nama'].'</option>';
    }
    return $opsi;

    }

function getStatusSdm($postData){
    $ci = & get_instance();
    $response = array();
 
    // Select record
    $ci->db->select('id,nama');
    $ci->db->where('jenis', $postData['jenis']);
    $q = $ci->db->get('m_status_sdm');
    $response = $q->result_array();

    return $response;
  }

function getSdmJenis($postData){
    $ci = & get_instance();
    $response = array();
 
    // Select record
    $ci->db->select('idsdm,gelar_depan,nama,gelar_belakang');
    $ci->db->where('jenis', $postData['jenis']);
    $q = $ci->db->get('m_sdm');
    $response = $q->result_array();

    return $response;
  }

  function viewJkPend($jk,$pend,$jenis,$unit){  
        $ci = & get_instance();
        if($jenis=='' AND $unit=='')
        {
        $fav=$ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND kode_pendidikan='$pend' AND status_aktif='A'")->row_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND kode_pendidikan='$pend' AND jenis='$jenis' AND status_aktif='A' ")->row_array();
        }
        else if($jenis!='' AND $unit!='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND kode_pendidikan='$pend' AND jenis='$jenis' AND unit='$unit' AND status_aktif='A'")->row_array(); 
        }
        else if($jenis=='' AND $unit!='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND kode_pendidikan='$pend' AND  unit='$unit' AND status_aktif='A' ")->row_array();
        }
        return $fav['jlh'];
    }

function viewJkStatus($jk,$status,$jenis,$unit){  
        $ci = & get_instance();
        if($jenis=='' AND $unit=='')
        {
        $fav=$ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND status_aktif='$status' ")->row_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND status_aktif='$status' AND jenis='$jenis' ")->row_array();
        }
        else if($jenis!='' AND $unit!='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND status_aktif='$status' AND jenis='$jenis' AND unit='$unit' ")->row_array(); 
        }
        else if($jenis=='' AND $unit!='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND status_aktif='$status' AND  unit='$unit' ")->row_array();
        }
        return $fav['jlh'];
    }

function viewJkAgama($jk,$agama,$jenis,$unit){  
        $ci = & get_instance();
        if($jenis=='' AND $unit=='')
        {
        $fav=$ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND agama='$agama' AND status_aktif='A' ")->row_array();  
        }
        else if($jenis!='' AND $unit=='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND agama='$agama' AND jenis='$jenis' AND status_aktif='A' ")->row_array();
        }
        else if($jenis!='' AND $unit!='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND agama='$agama' AND jenis='$jenis' AND unit='$unit' AND status_aktif='A' ")->row_array(); 
        }
        else if($jenis=='' AND $unit!='')
        {
        $fav= $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE jk='$jk' AND agama='$agama' AND  unit='$unit' AND status_aktif='A' ")->row_array();
        }
        return $fav['jlh'];
    }

function jlhJkUnit($unit,$sdm,$jk){
        $ci = & get_instance();
        $temp = $unit;
        $querytemp = $ci->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
        $hasiltemp = $querytemp->row();
        if($hasiltemp->ids != "")
        {
            $temp .=",". $hasiltemp->ids;
        }
        
        $fav=$ci->db->query("SELECT count(a.idsdm) as jlh FROM m_sdm as a JOIN m_unit as c ON a.unit=c.id WHERE a.unit IN ($temp) AND a.jenis='$sdm' AND a.jk='$jk' AND a.status_aktif='A'")->row_array();
        //$fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE unit='$unit' AND jenis='$sdm' AND jk='$jk' AND status_aktif='A' ")->row_array();
        return $fav['jlh'];
    }

function jlhJkGol($gol,$sdm,$jk,$unit){
        $ci = & get_instance();
        if($unit=='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE pangkat_golongan='$gol' AND jenis='$sdm' AND jk='$jk' AND status_aktif='A' ")->row_array();
        }
        else
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE pangkat_golongan='$gol' AND jenis='$sdm' AND jk='$jk' AND unit='$unit' AND status_aktif='A' ")->row_array();   
        }
        return $fav['jlh'];
    }

function jlhJkPend($pend,$sdm,$jk,$unit){
        $ci = & get_instance();
        if($unit=='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE kode_pendidikan='$pend' AND jenis='$sdm' AND jk='$jk' AND status_aktif='A' ")->row_array();
        }
        else
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE kode_pendidikan='$pend' AND jenis='$sdm' AND jk='$jk' AND unit='$unit' AND status_aktif='A' ")->row_array();   
        }
        return $fav['jlh'];
    }

function jlhJkAgama($agama,$sdm,$jk,$unit){
        $ci = & get_instance();
        if($unit=='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE agama='$agama' AND jenis='$sdm' AND jk='$jk' AND status_aktif='A' ")->row_array();
        }
        else
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE agama='$agama' AND jenis='$sdm' AND jk='$jk' AND unit='$unit' AND status_aktif='A' ")->row_array();   
        }
        return $fav['jlh'];
    }

function jlhPenerimaanSdm($tahun,$jenis){
        $ci = & get_instance();
        
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE YEAR(mulai_masuk)='$tahun' AND jenis='$jenis' ")->row_array();
        
        return $fav['jlh'];
    }

function jlhJkStatus($status,$sdm,$jk,$unit){
        $ci = & get_instance();
        if($unit=='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE   jenis='$sdm' AND jk='$jk' AND status_aktif='$status' ")->row_array();
        }
        else
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM m_sdm WHERE  jenis='$sdm' AND jk='$jk' AND unit='$unit' AND status_aktif='$status' ")->row_array();   
        }
        return $fav['jlh'];
    }


function jlhJkUsia($usia,$sdm='',$jk,$unit=''){
        $ci = & get_instance();
        $pecah=explode("-", $usia);
        $umur="usia >= '$pecah[0]' AND usia <= '$pecah[1]'";
        if($unit=='' AND $sdm =='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM view_simpeg_usia WHERE $umur  AND jk='$jk' AND status_aktif='A' ")->row_array();
        }
        else if($unit!='' AND $sdm =='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM view_simpeg_usia WHERE $umur  AND jk='$jk' AND unit='$unit' AND status_aktif='A' ")->row_array();   
        }
        else if($unit=='' AND $sdm !='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM view_simpeg_usia WHERE $umur AND jenis='$sdm' AND jk='$jk'  AND status_aktif='A' ")->row_array();   
        }
        else if($unit!='' AND $sdm !='')
        {
        $fav = $ci->db->query("SELECT count(idsdm) as jlh FROM view_simpeg_usia WHERE $umur AND jenis='$sdm' AND jk='$jk' AND unit='$unit' AND status_aktif='A' ")->row_array();   
        }
        return $fav['jlh'];
    }

function jlhJkPub($jk,$pub,$jenis,$unit){  
        $ci = & get_instance();
        log_message('debug', print_r($jk, TRUE));
        if ($jenis=='' and $unit== '') {
            $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.jenis='$pub' AND b.jk='$jk' AND b.status_aktif='A'")->row_array();  

        }
        elseif($jenis!='' AND $unit=='') {
            $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE  a.jenis='$pub' AND b.jk='$jk' AND b.jenis='$jenis'  AND b.status_aktif='A'")->row_array();
        } 
        elseif ($jenis=='' and $unit != '') {
            $temp = $unit;
            $querytemp = $ci->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();
            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }
            
            $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit as c ON c.id=b.unit WHERE c.id IN ($temp) AND a.jenis='$pub' AND b.jk='$jk' AND b.status_aktif='A'")->row_array();
            log_message('debug', print_r(fav, TRUE));
        } elseif ($jenis != '' and $unit != '') {
            $temp = $unit;
            $querytemp = $ci->db->query("SELECT GROUP_CONCAT(id) AS ids FROM m_unit WHERE parent=$temp");
            $hasiltemp = $querytemp->row();

            if($hasiltemp->ids != "")
            {
                $temp .=",". $hasiltemp->ids;
            }
            
            $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm INNER JOIN m_unit as c ON c.id=b.unit WHERE c.id IN ($temp) AND a.jenis='$pub' AND b.jk='$jk' AND b.jenis='$jenis' AND b.status_aktif='A'")->row_array(); 
        }     
        return $fav['jlh'];
    }

function jlhPubTahun($pub='',$tahun,$unit){  
        $ci = & get_instance();
        if($pub!='' AND $unit=='')
        {
        $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.jenis='$pub' AND a.tahun='$tahun' AND  b.status_aktif='A' ")->row_array();  
        }
        
        else if($pub!='' AND $unit!='')
        {
        $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE a.jenis='$pub' AND a.tahun='$tahun' AND  b.status_aktif='A' AND b.unit='$unit' ")->row_array(); 
        }
        else if($pub=='' AND $unit!='')
        {
        $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE  a.tahun='$tahun' AND  b.status_aktif='A' AND b.unit='$unit' ")->row_array(); 
        }
        else if($pub=='' AND $unit=='')
        {
        $fav=$ci->db->query("SELECT count(a.id) as jlh FROM simpeg_publikasi as a join m_sdm as b on a.idsdm=b.idsdm WHERE  a.tahun='$tahun' AND  b.status_aktif='A'  ")->row_array(); 
        }
        return $fav['jlh'];
    }