<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="text-center">
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Unit</th>
        <th colspan="2">Dosen</th>
        <th colspan="2">Pegawai</th>
        <th colspan="3">Jumlah</th>
      </tr>
      <tr>
        <th>L</th>
        <th>P</th>
        <th>L</th>
        <th>P</th>
        <th>L</th>
        <th>P</th>
        <th>L + P</th>
      </tr>
    </thead>
    <tbody class="text-center">
          <?php

          $ttl=0;
          $ttp=0;
          $tdl=0;
          $tdp=0;
          $tpl=0;
          $tpp=0;
          foreach ($record as $row) {
            $no++;
            $dl=jlhJkUnit($row['id'],'DOSEN','L');
            $dp=jlhJkUnit($row['id'],'DOSEN','P');
            $pl=jlhJkUnit($row['id'],'PEGAWAI','L');
            $pp=jlhJkUnit($row['id'],'PEGAWAI','P');
            $tl=$dl+$pl;
            $tp=$dp+$pp;
            $ts=$tl+$tp;
            echo '<tr >
                  <td>'.$no.'</td>
                  <td class="text-left">'.$row['nama'].'</td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/DOSEN/'.$row['id']).'">'.$dl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/DOSEN/'.$row['id']).'">'.$dp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/PEGAWAI/'.$row['id']).'">'.$pl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/PEGAWAI/'.$row['id']).'">'.$pp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/SEMUA/'.$row['id']).'">'.$tl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/SEMUA/'.$row['id']).'">'.$tp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/SEMUA/SEMUA/'.$row['id']).'">'.$ts.'</a></td>
                </tr>';
            $tdl=$tdl+$dl;
            $tdp=$tdp+$dp;
            $tpl=$tpl+$pl;
            $tpp=$tpp+$pp;
            $ttl=$ttl+$tl;
            $ttp=$ttp+$tp;
            }
          $tts=$ttl+$ttp;
          ?>
      
    </tbody>
    <tfoot class="text-center">
      <?php
      echo '<tr>
                  <td colspan="2">Jumlah</td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/DOSEN/SEMUA').'">'.$tdl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/DOSEN/SEMUA').'">'.$tdp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/PEGAWAI/SEMUA').'">'.$tpl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/PEGAWAI/SEMUA').'">'.$tpp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/SEMUA/SEMUA').'">'.$ttl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/SEMUA/SEMUA').'">'.$ttp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/SEMUA/SEMUA/SEMUA').'">'.$tts.'</a></td>
                </tr>';
      ?>
    </tfoot>
  </table>
</div>
          
            

