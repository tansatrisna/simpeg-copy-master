<form class="form-inline m-b-15" action="<?=base_url($post)?>" method="post" accept-charset="utf-8">
  <input type="hidden" name="cari">
   <div class="form-group row">
    
     <label class="control-label m-r-20 m-l-20">Unit</label>
     <select name="unit" class="form-control" onchange="submit()">
       <option value="">..::Semua Unit::..</option>
       <?=opUnit($unit)?>
     </select>
      
   </div>
  
</form>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="text-center">
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Golongan</th>
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
          if($unit=='')
          {
            $bunit='SEMUA';
          }
          else
          {
            $bunit=$unit;
          }
          $ttl=0;
          $ttp=0;
          $tdl=0;
          $tdp=0;
          $tpl=0;
          $tpp=0;
          foreach ($record as $row) {
            $no++;
            $dl=jlhJkGol($row['kderef'],'DOSEN','L',$unit);
            $dp=jlhJkGol($row['kderef'],'DOSEN','P',$unit);
            $pl=jlhJkGol($row['kderef'],'PEGAWAI','L',$unit);
            $pp=jlhJkGol($row['kderef'],'PEGAWAI','P',$unit);
            $tl=$dl+$pl;
            $tp=$dp+$pp;
            $ts=$tl+$tp;
            echo '<tr >
                  <td>'.$no.'</td>
                  <td class="text-left">'.$row['nmaref1'].'</td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/DOSEN/'.$bunit.'/'.$row['kderef']).'">'.$dl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/DOSEN/'.$bunit.'/'.$row['kderef']).'">'.$dp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/PEGAWAI/'.$bunit.'/'.$row['kderef']).'">'.$pl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/PEGAWAI/'.$bunit.'/'.$row['kderef']).'">'.$pp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/L/SEMUA/'.$bunit.'/'.$row['kderef']).'">'.$tl.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/P/SEMUA/'.$bunit.'/'.$row['kderef']).'">'.$tp.'</a></td>
                  <td><a href="'.base_url('statistik/sdmdetail/'.$seo.'/SEMUA/SEMUA/'.$bunit.'/'.$row['kderef']).'">'.$ts.'</a></td>
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
                  <td>'.$tdl.'</td>
                  <td>'.$tdp.'</td>
                  <td>'.$tpl.'</td>
                  <td>'.$tpp.'</td>
                  <td>'.$ttl.'</td>
                  <td>'.$ttp.'</td>
                  <td>'.$tts.'</td>
                </tr>';
      ?>
    </tfoot>
  </table>
</div>
          
            

