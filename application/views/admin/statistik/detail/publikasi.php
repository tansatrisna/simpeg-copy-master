<form class="form-inline m-b-15" action="<?=base_url($post)?>" method="post" accept-charset="utf-8">
  <input type="hidden" name="cari">
   <div class="form-group row">
    
     <label class="control-label m-r-20 m-l-20">Unit</label>
     <select name="unit" class="form-control" onchange="submit()">
       <option value="">..::Semua Unit::..</option>
       <?=opUnit($unit)?>
     </select>
      <label class="control-label m-r-20 m-l-20">Tahun Awal</label>
     <select name="tahun1" class="form-control" onchange="submit()">
       
       <?=opTahun($tahun1)?>
     </select>
      <label class="control-label m-r-20 m-l-20">Tahun Akhir</label>
     <select name="tahun2" class="form-control" onchange="submit()">
       
       <?=opTahun($tahun2)?>
     </select>
      
   </div>
  
</form>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="text-center">
      <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Publikasi</th>
        <th colspan="<?=$col?>">Tahun</th>
        <th rowspan="2">Jumlah</th>
      </tr>
      <tr>
        <?php
        for($i=$tahun2; $i>=$tahun1; $i--)
        {
          echo '<th>'.$i.'</th>';
        }
        ?>
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
          
          foreach ($record as $row) {
            $no++;
            echo '<tr >
                  <td>'.$no.'</td>
                  <td class="text-left">'.$row['nmaref1'].'</td>';
                  $tot=0;

            for($i=$tahun2;$i>=$tahun1;$i--)
            {
              $jlh=jlhPubTahun($row['kderef'],$i,$unit);
              echo '<td><a href="'.base_url('statistik/pubdetail/'.$seo.'/'.$i.'/'.$i.'/'.$bunit.'/'.$row['kderef']).'">'.$jlh.'</td>';
              $tot=$tot+$jlh;
            }
            echo '<td><a href="'.base_url('statistik/pubdetail/'.$seo.'/'.$tahun1.'/'.$tahun2.'/'.$bunit.'/'.$row['kderef']).'">'.$tot.'</td>';
            
                  
                echo'</tr>';
            
            }
         
          ?>
      
    </tbody>
    <tfoot class="text-center">
      <?php
      echo '<tr>
                  <td colspan="2">Jumlah</td>';
                  $jumlah=0;
                  for($j=$tahun2; $j>=$tahun1; $j--)
                  {
                    $total=jlhPubTahun('',$j,$unit);
                    $jumlah=$jumlah+$total;
                     echo'<td>'.$total.'</td>';
                  }
                  echo'<td>'.$jumlah.'</td>
                </tr>';
      ?>
    </tfoot>
  </table>
</div>
          
            

