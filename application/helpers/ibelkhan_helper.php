<?php 
    function cetak($str){
        return strip_tags(htmlentities($str, ENT_QUOTES, 'UTF-8'));
    }
    function rupiah($angka){
      $rupiah=number_format($angka,0,',','.');
      return $rupiah;
    }
    function angka($angka){
      $rupiah=number_format($angka,2,',','.');
      return $rupiah;
    }

    function usia($date1, $date2='')
    {
    if($date2=='')
    {
        $date2=date('Y-m-d');
    }
    $awal  = date_create($date1);
    $akhir = date_create($date2); // waktu sekarang
    $diff  = date_diff( $awal, $akhir );
    return $diff->y.' Tahun '.$diff->m.' Bulan '.$diff->d.' Hari';
    }

    function ultah($date1, $date2='')
    {
    if($date2=='')
    {
        $date2=date('Y-m-d');
    }
    $awal  = date_create($date1);
    $akhir = date_create($date2); // waktu sekarang
    $diff  = date_diff( $awal, $akhir );
    return $diff->y.' Tahun ';
    }

    function gambar($path,$gambar){

        if($gambar == '')
        {
            return base_url('assets/img/'.$path.'/noimage.png');
        }
        else
        {
            return base_url('assets/img/'.$path.'/'.$gambar);
        }

    }

      

    function namahari($tanggal){
    
     
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);

    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
    
    switch($info){
        case '0': return "Minggu"; break;
        case '1': return "Senin"; break;
        case '2': return "Selasa"; break;
        case '3': return "Rabu"; break;
        case '4': return "Kamis"; break;
        case '5': return "Jumat"; break;
        case '6': return "Sabtu"; break;
    };

   
}

function tglAkhirBulan($thn,$bln){
$bulan[1]=31;
$bulan[2]=28;
$bulan[3]=31;
$bulan[4]=30;
$bulan[5]=31;
$bulan[6]=30;
$bulan[7]=31;
$bulan[8]=31;
$bulan[9]=30;
$bulan[10]=31;
$bulan[11]=30;
$bulan[12]=31;

if ($thn%4==0){
$bulan[2]=29;
}
return $bulan[$bln];
}

function GenerateCode() {
    $possible ='123456789';
    $operator ='+'; 
    $a = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    $b = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    $opr = substr($operator, mt_rand(0, strlen($operator)-1), 1);
    if($opr=='+'){
        $res = $a + $b;
    }
    
    $code['res']  = $res;
    $code['text'] = $a.' '.$opr.' '.$b.' = ?';
    return $code ;
}

function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
 
function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

    function cetak_meta($str,$mulai,$selesai){
        return strip_tags(html_entity_decode(substr(str_replace('"','',$str),$mulai,$selesai), ENT_COMPAT, 'UTF-8'));
    }

    function sensor($teks){
        $ci = & get_instance();
        $query = $ci->db->query("SELECT * FROM katajelek");
        foreach ($query->result_array() as $r) {
            $teks = str_replace($r['kata'], $r['ganti'], $teks);       
        }
        return $teks;
    }  

    function getSearchTermToBold($text, $words){
        preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
        if (!$m)
            return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<b style="color:red">$0</b>', $text);
    }

    function tgl_indo($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = get_bulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.' '.$bulan.' '.$tahun;       
    } 

    function tgl_indo_dua($tgl1,$tgl2){
            $tanggal1 = substr($tgl1,8,2);
            $bulan1 = get_bulan(substr($tgl1,5,2));
            $tahun1 = substr($tgl1,0,4);

            $tanggal2 = substr($tgl2,8,2);
            $bulan2 = get_bulan(substr($tgl2,5,2));
            $tahun2 = substr($tgl2,0,4);

            if($tgl1==$tgl2)
            {
               return $tanggal1.' '.$bulan1.' '.$tahun1;
            }
            else
            {
              if($tahun1==$tahun2)
              {
                if($bulan1==$bulan2)
                {
                  return $tanggal1.' &mdash; '.$tanggal2.' '.$bulan1.' '.$tahun1;
                }
                else
                {
                  return $tanggal1.' '.$bulan1.' &mdash; '.$tanggal2.' '.$bulan2.' '.$tahun1;
                }
              }
              else
              {
                return $tanggal1.' '.$bulan1.' '.$tahun2.' &mdash; '.$tanggal2.' '.$bulan2.' '.$tahun2;
              }
            }
                  
    } 

    function getTahun($tgl){
           
            $tahun = substr($tgl,0,4);
            return $tahun;       
    } 

    function tgl_simpan($tgl){
            $tanggal = substr($tgl,0,2);
            $bulan = substr($tgl,3,2);
            $tahun = substr($tgl,6,4);
            return $tahun.'-'.$bulan.'-'.$tanggal;       
    }

    function ganti_tgl($tgl){
           $tanggal=str_replace('-', '/', $tgl);
            return $tanggal;       
    }

    function tgl_view($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = substr($tgl,5,2);
            $tahun = substr($tgl,0,4);
            return $tanggal.'-'.$bulan.'-'.$tahun;       
    }

    function tgl_grafik($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.'_'.$bulan;       
    }   


    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    } 

    function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

    function hari_ini($w){
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $hari_ini = $seminggu[$w];
        return $hari_ini;
    }

    function get_bulan($bln){
                switch ($bln){
                    case 1: 
                        return "Januari";
                        break;
                    case 2:
                        return "Februari";
                        break;
                    case 3:
                        return "Maret";
                        break;
                    case 4:
                        return "April";
                        break;
                    case 5:
                        return "Mei";
                        break;
                    case 6:
                        return "Juni";
                        break;
                    case 7:
                        return "Juli";
                        break;
                    case 8:
                        return "Agustus";
                        break;
                    case 9:
                        return "September";
                        break;
                    case 10:
                        return "Oktober";
                        break;
                    case 11:
                        return "November";
                        break;
                    case 12:
                        return "Desember";
                        break;
                }
            } 
    

    function getBulan($bln){
                switch ($bln){
                    case 1: 
                        return "Jan";
                        break;
                    case 2:
                        return "Feb";
                        break;
                    case 3:
                        return "Mar";
                        break;
                    case 4:
                        return "Apr";
                        break;
                    case 5:
                        return "Mei";
                        break;
                    case 6:
                        return "Jun";
                        break;
                    case 7:
                        return "Jul";
                        break;
                    case 8:
                        return "Agu";
                        break;
                    case 9:
                        return "Sep";
                        break;
                    case 10:
                        return "Okt";
                        break;
                    case 11:
                        return "Nov";
                        break;
                    case 12:
                        return "Des";
                        break;
                }
            } 

function cek_terakhir($datetime, $full = false) {
	 $today = time();    
     $createdday= strtotime($datetime); 
     $datediff = abs($today - $createdday);  
     $difftext="";  
     $years = floor($datediff / (365*60*60*24));  
     $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
     $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
     $hours= floor($datediff/3600);  
     $minutes= floor($datediff/60);  
     $seconds= floor($datediff);  
     //year checker  
     if($difftext=="")  
     {  
       if($years>1)  
        $difftext=$years." Tahun";  
       elseif($years==1)  
        $difftext=$years." Tahun";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($months>1)  
        $difftext=$months." Bulan";  
        elseif($months==1)  
        $difftext=$months." Bulan";  
     }  
     //month checker  
     if($difftext=="")  
     {  
        if($days>1)  
        $difftext=$days." Hari";  
        elseif($days==1)  
        $difftext=$days." Hari";  
     }  
     //hour checker  
     if($difftext=="")  
     {  
        if($hours>1)  
        $difftext=$hours." Jam";  
        elseif($hours==1)  
        $difftext=$hours." Jam";  
     }  
     //minutes checker  
     if($difftext=="")  
     {  
        if($minutes>1)  
        $difftext=$minutes." Menit";  
        elseif($minutes==1)  
        $difftext=$minutes." Menit";  
     }  
     //seconds checker  
     if($difftext=="")  
     {  
        if($seconds>1)  
        $difftext=$seconds." Detik";  
        elseif($seconds==1)  
        $difftext=$seconds." Detik";  
     }  
     return $difftext;  
	}



function selisihBulan(\DateTime $date1, \DateTime $date2)
{
$diff =  $date1->diff($date2);

$months = $diff->y * 12 + $diff->m + $diff->d / 30;

return (int) round($months);
}


function selisihHari($date1, $date2)
{
$awal  = date_create($date1);
$akhir = date_create($date2); // waktu sekarang
$diff  = date_diff( $awal, $akhir );
return $diff->days;
}

function masaKerja($date1, $date2='')
{
    if($date2=='')
    {
    $date2=date('Y-m-d');
    }
    $awal  = date_create($date1);
    $akhir = date_create($date2); // waktu sekarang
    $diff  = date_diff( $awal, $akhir );
    return $diff->y . " Tahun, " . $diff->m." Bulan, ".$diff->d." Hari ";
}

 
 function opTahun($p) {
    
    $opsi .= '<option value="" >..::Pilih Tahun::..</option>';
    $awal=date('Y')-100;
    $akhir=date('Y');
    for( $i=$akhir; $i>=$awal; $i--) 
    {
    $cl = ($i == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$i.'" '.$cl.'>'.$i.'</option>';
    }
    return $opsi;

    }

function opTahunCustom($awali,$akhiri,$p) {
    
    $opsi .= '<option value="" >..::Pilih Tahun::..</option>';
    $aa=(int)$awali;
    $bb=(int)$akhiri;
    $awal=date('Y')-$aa;
    $akhir=date('Y')-$bb;
    for( $i=$akhir; $i>=$awal; $i--) 
    {
    $cl = ($i == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$i.'" '.$cl.'>'.$i.'</option>';
    }
    return $opsi;

    }

   


    function opBulan($p) {
    
    $opsi .= '<option value="" >..::Pilih Bulan::..</option>';
    for( $i=1; $i<=12; $i++) 
    {
    $cl = ($i == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$i.'" '.$cl.'>'.get_bulan($i).'</option>';
    }
    return $opsi;

    }

    function opTanggal($p) {
    
    $opsi .= '<option value="" >..::Pilih Tanggal::..</option>';
    for( $i=1; $i<=31; $i++) 
    {
    $cl = ($i == $p) ? 'selected' : '';
    $opsi .= '<option value="'.$i.'" '.$cl.'>'.$i.'</option>';
    }
    return $opsi;

    }


    function getIP()
  {
    if ( !empty( $_SERVER['HTTP_CLIENT_IP'] ) )
    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
    //to check ip passed from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }



function getOS() { 

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function getBrowserX() {
  $u_agent = $_SERVER['HTTP_USER_AGENT'];
  $bname = 'Unknown';
  $platform = 'Unknown';
  $version= "";

  // First get the platform?
  if (preg_match('/linux/i', $u_agent)) {
    $platform = 'linux';
  } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
    $platform = 'mac';
  } elseif (preg_match('/windows|win32/i', $u_agent)) {
    $platform = 'windows';
  }

  // Next get the name of the useragent yes seperately and for good reason
  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) {
    $bname = 'Internet Explorer';
    $ub = "MSIE";
  } elseif(preg_match('/Firefox/i',$u_agent)) {
    $bname = 'Mozilla Firefox';
    $ub = "Firefox";
  } elseif(preg_match('/Chrome/i',$u_agent)) {
    $bname = 'Google Chrome';
    $ub = "Chrome";
  } elseif(preg_match('/Safari/i',$u_agent)) {
    $bname = 'Apple Safari';
    $ub = "Safari";
  } elseif(preg_match('/Opera/i',$u_agent)) {
    $bname = 'Opera';
    $ub = "Opera";
  } elseif(preg_match('/Netscape/i',$u_agent)) {
    $bname = 'Netscape';
    $ub = "Netscape";
  }

  // finally get the correct version number
  $known = array('Version', $ub, 'other');
  $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
  if (!preg_match_all($pattern, $u_agent, $matches)) {
    // we have no matching number just continue
  }

  // see how many we have
  $i = count($matches['browser']);
  if ($i != 1) {
    //we will have two since we are not using 'other' argument yet
    //see if version is before or after the name
    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
      $version= $matches['version'][0];
    } else {
      $version= $matches['version'][1];
    }
  } else {
    $version= $matches['version'][0];
  }

  // check if we have a number
  if ($version==null || $version=="") {$version="?";}

return $bname;
}

function tgl_waktu($waktu){
            $pecah=explode(" ", $waktu);
            $waktu=$pecah[1];
            $tgl=$pecah[0]; 
            $tanggal = substr($tgl,8,2);
            $bulan = substr($tgl,5,2);
            $tahun = substr($tgl,0,4);
            return $tanggal.'/'.$bulan.'/'.$tahun.' '.$waktu;       
    } 

function tgl_waktu_full($waktu){
            $pecah=explode(" ", $waktu);
            $waktu=$pecah[1];
            $tgl=$pecah[0]; 
            return tgl_indo($tgl).' '.$waktu.' WIB';       
    }

function tgl_waktu_indo($waktu){
            $pecah=explode(" ", $waktu);
            $waktu=$pecah[1];
            $tgl=$pecah[0]; 
            $tanggal=tgl_indo($tgl);
            return $tanggal;       
    } 

function hari_tanggal($waktu)
{
  $pecah=explode(" ", $waktu);
  $waktu=$pecah[1];
  $tgl=$pecah[0]; 
  
  $hari=namahari($tgl);
  $tanggal=tgl_indo($tgl);


  return $hari.', '.$tanggal.' '.$waktu;

}

function ubahTanggal($tgl)
{
  $tanggal=strtotime($tgl);
  $tgl1=date('Y-m-d H:i:s', $tanggal);
  return $tgl1;
}

function ambilWaktu($tgl)
{
  $tanggal=strtotime($tgl);
  $tgl1=date('H:i', $tanggal);
  return $tgl1;
}

function ubahTanggalExcel($tgl)
{
 var_dump($tgl);

// create DateTime object from timestamp
$dt = new DateTime();
$dt->setTimestamp($tgl);

// print datetime formatted
var_dump($dt->format('Y-m-d H:i:s'));
return $dt;
}

function bulan($bln){
      switch ($bln){
          case January: 
            return 1;
            break;
          case February:
            return 2;
            break;
          case March:
            return 3;
            break;
          case April:
            return 4;
            break;
          case May:
            return 5;
            break;
          case June:
            return 6;
            break;
          case July:
            return 7;
            break;
          case August:
            return 8;
            break;
          case September:
            return 9;
            break;
          case October:
            return 10;
            break;
          case November:
            return 11;
            break;
          case December:
            return 12;
            break;
      }
  }

function enkrip($string) {
    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */        
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];
    // hash
    $key    = hash("sha256", $secret_key);
    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);
    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}
function dekrip($string) {
    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];
    // hash
    $key    = hash("sha256", $secret_key);
    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);
    //do the decryption given text/string/number
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function posttext($p){
        $ci = & get_instance();
        $fav = $ci->db->escape_str($ci->input->post($p));
        return $fav;
    }

function postnumber($p){
        $ci = & get_instance();
        $fav = $ci->input->post($p);
        return $fav;
    }

function waktuSekarang()
{
  $waktu=date('H:i:s');
  
  if($waktu >= '00:00:00' AND $waktu < '10:00:00')
  {
    return 'Pagi';
  }
  else if($waktu >= '10:00:00' AND $waktu < '15:00:00')
  {
    return 'Siang';
  }
  else if($waktu >= '15:00:00' AND $waktu < '18:00:00')
  {
    return 'Sore';
  }
  else 
  {
    return 'Malam';
  }
  
}

function gantiEnter($string)
{
$hasil = str_replace(array('\r\n', '\r', '\n'), '<br />', $string);
return $hasil;
}

function gantiKoma($string)
{
$hasil = str_replace(array('\r\n', '\r', '\n'), ', ', $string);
return $hasil;
}

function gantiEdit($string)
{
$hasil = str_replace(array('\r\n', '\r', '\n'), '&#13;&#10;', $string);
return $hasil;
}

function labelGrafik($arr,$var)
{
   $arr1=array();
foreach($arr as $data){
            $arr1[]='"'.$data[$var].'"';
           
        }

 $hasil=implode(",",$arr1);
 
return $hasil;
}

function labelGrafikBulan($arr,$var)
{
   $arr1=array();
foreach($arr as $data){
            $arr1[]='"'.get_bulan($data[$var]).'"';
           
        }

 $hasil=implode(",",$arr1);
 
return $hasil;
}

function dataGrafik($arr,$var)
{
   $arr1=array();
foreach($arr as $data){
            $arr1[]=$data[$var];
           
        }

 $hasil=implode(",",$arr1);
 
return $hasil;
}

function random_color($alpha=1) {
    $red=mt_rand( 0, 255 );
    $green=mt_rand( 0, 255 );
    $blue=mt_rand( 0, 255 );
    $color="'rgba(".$red.",".$green.",".$blue.",".$alpha.")'";
    
    return $color;
}

function dataWarna($arr,$alpha)
{
   $arr1=array();
foreach($arr as $data){
            $arr1[]=random_color($alpha);
           
        }

 $hasil=implode(",",$arr1);
 
return $hasil;
}

function satuWarna($arr,$alpha)
{
   $arr1=array();
   $warna=random_color($alpha);
foreach($arr as $data){
            $arr1[]=$warna;
           
        }

 $hasil=implode(",",$arr1);
 
return $hasil;
}

function rentangUsia()
    {
       $usia=array('17-20','21-25','26-30','31-35','36-40','41-45','46-50','51-55','56-60','61-65','66-80');
       return $usia;
    }

    function rentangTinggi()
    {
       $usia=array('<120','120-130','131-140','141-150','151-160','161-170','171-180','>180');
       return $usia;
    }

    function rentangBerat()
    {
       $usia=array('<40','41-50','51-60','61-70','71-80','81-90','91-100','>100');
       return $usia;
    }

    function rentangKerja()
    {
       $usia=array('<1','1-2','3-4','5-6','7-8','9-10','11-15','16-20','21-25','26-30','31-40','>40');
       return $usia;
    }

    