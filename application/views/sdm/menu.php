<style>
.sidebar, .sidebar-bg {
    background: #008B8B;
}
.sidebar .nav > li > a:focus, .sidebar .nav > li > a {
    color: #000000;
}
.sidebar .sub-menu > li > a {
    color: #000000;
}
.sidebar .nav > li.nav-header {
    color: #000000;
}
</style>

<?php
echo '<li class="'.$apengumuman.'"><a href="'.base_url('sdm/pengumuman').'">
        <i class="fa fa-home"></i>
        <span>Home</span>
      </a></li>';




if($jenis=='DOSEN')
{
echo '<li class="has-sub '.$aprofil.'">
          <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-user"></i>
          <span>Profil</span>
      </a>
          <ul class="sub-menu">';
          if($this->uri->segment('2')=='profil')
          {

            foreach ($tabs as $key => $value) {
              $cl = ($key == $tab) ? 'active' : '';
            echo '<li class="'.$cl.'"><a href="'.base_url('sdm/profil/'.$key).'">'.$value.'</a></li>';
                                    
            }
           
          }
          else
          {
             echo'<li ><a href="'.base_url('sdm/profil').'">Biodata</a></li>
                <li><a href="'.base_url('sdm/profil/pendidikan').'">Pendidikan</a></li>
                <li><a href="'.base_url('sdm/profil/pelatihan').'">Pelatihan</a></li>
                <li><a href="'.base_url('sdm/profil/seminar').'">Seminar</a></li>
                <li><a href="'.base_url('sdm/profil/penghargaan').'">Penghargaan</a></li>
                <li><a href="'.base_url('sdm/profil/penelitian').'">Peneltian</a></li>
                <li><a href="'.base_url('sdm/profil/publikasi').'">Publikasi</a></li>
                <li><a href="'.base_url('sdm/profil/pengabdian').'">Pengabdian Masyarakat</a></li>
                <li><a href="'.base_url('sdm/profil/serdos').'">Sertifikasi Dosen</a></li>
                <li><a href="'.base_url('sdm/profil/kegmhs').'">Kegiatan Mahasiswa</a></li>
                <li><a href="'.base_url('sdm/profil/dokumen').'">Dokumen</a></li>';
          } 
      echo'</ul>
      </li>';

echo '<li class="has-sub '.$alayanan.'">
          <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-graduation-cap"></i>
          <span>Layanan Akademik</span>
          </a>
          <ul class="sub-menu">
            <li><a href="'.base_url('sdm/layanan/jadwal').'">
            Jadwal Mata Kuliah
            </a></li>
             <li><a href="'.base_url('sdm/layanan/makul').'">
            Mata Kuliah Diampu
            </a></li>
            <li><a href="'.base_url('sdm/layanan/nilai').'">
            Pengelolaan Nilai
            </a></li>
            <li><a href="'.base_url('sdm/layanan/bimbakad').'">
            Bimbingan Akademik
            </a></li>
            <li><a href="'.base_url('sdm/layanan/bimbta').'">
            Bimbingan TA
            </a></li>
            <li><a href="'.base_url('sdm/layanan/virtual').'">
            Virtual Class
            </a></li>
            <li><a href="'.base_url('sdm/layanan/materi').'">
            Materi Kuliah Online
            </a></li>
            <li><a href="'.base_url('sdm/layanan/tugas').'">
            Kantong Tugas
            </a></li>
            <li><a href="'.base_url('sdm/layanan/makul').'">
            Mata Kuliah Diampu
            </a></li>
            <li><a href="'.base_url('sdm/layanan/soal').'">
            Bank Soal
            </a></li>
            <li><a href="'.base_url('sdm/layanan/sarana').'">
            Sarana
            </a></li>
        </ul>
    </li>';

}
else
{
  echo '<li class="has-sub '.$aprofil.'">
          <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-user"></i>
          <span>Profil</span>
      </a>
          <ul class="sub-menu">';
          if($this->uri->segment('2')=='profil')
          {

            foreach ($tabs as $key => $value) {
              $cl = ($key == $tab) ? 'active' : '';
            echo '<li class="'.$cl.'"><a href="'.base_url('sdm/profil/'.$key).'">'.$value.'</a></li>';
                                    
            }
           
          }
          else
          {
             echo'<li ><a href="'.base_url('sdm/profil').'">Biodata</a></li>
                <li><a href="'.base_url('sdm/profil/pendidikan').'">Pendidikan</a></li>
                <li><a href="'.base_url('sdm/profil/pelatihan').'">Pelatihan</a></li>
                <li><a href="'.base_url('sdm/profil/seminar').'">Seminar</a></li>
                <li><a href="'.base_url('sdm/profil/penghargaan').'">Penghargaan</a></li>
                <li><a href="'.base_url('sdm/profil/penelitian').'">Peneltian</a></li>
                <li><a href="'.base_url('sdm/profil/publikasi').'">Publikasi</a></li>
                <li><a href="'.base_url('sdm/profil/pengabdian').'">Pengabdian Masyarakat</a></li>
                <li><a href="'.base_url('sdm/profil/kegmhs').'">Kegiatan Mahasiswa</a></li>
                <li><a href="'.base_url('sdm/profil/dokumen').'">Dokumen</a></li>';
          } 
      echo'</ul>
      </li>';

}

echo '<li class="'.$aprofil1.'"><a href="'.base_url('sdm/gaji').'">
        <i class="fa fa-book"></i>
        <span>Gaji dan Honorarium</span>
      </a></li>';

echo '<li class="'.$aprofil1.'"><a href="'.base_url('sdm/pesan').'">
        <i class="fa fa-book"></i>
        <span>Bantuan/ Pesan</span>
      </a></li>';



echo '<li class=""><a href="'.base_url('logout').'">
        <i class="fa fa-sign-out-alt"></i>
        <span>Logout</span>
      </a></li>';