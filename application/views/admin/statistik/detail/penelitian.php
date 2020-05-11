<form class="form-inline m-b-15" action="<?=base_url($post)?>" method="post" accept-charset="utf-8">
  <input type="hidden" name="cari">
   <div class="form-group row">
     <label class="control-label m-r-20 m-l-20">Jenis SDM</label>
     <select name="jenis" class="form-control" onchange="submit()">
       <option value="">..::Semua SDM::..</option>
       <?=opEnum('m_sdm','jenis',$jenis)?>
     </select>
     <label class="control-label m-r-20 m-l-20">Unit</label>
     <select name="unit" class="form-control" onchange="submit()">
       <option value="">..::Semua Unit::..</option>
       <?=opUnit($unit)?>
     </select>
      <label class="control-label m-r-20 m-l-20">Tahun</label>
     <select name="tahun" class="form-control" onchange="submit()">
       
       <?=opTahun($tahun)?>
     </select>
      
      
   </div>
  
</form>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
    <thead class="text-center">
      <tr>
        <th>No</th>
        <th>Nama/Unit</th>
        <th>Judul Penelitian</th>
        <th>Tahun</th>
        <th>Sumber Dana</th>
        <th>Biaya</th>
      </tr>
    </thead>
    <tbody>
          <?php
          $total=0;
          foreach ($record as $row) {
            $no++;
            echo '<tr >
                  <td class="text-center">'.$no.'</td>
                  <td>'.viewSdm($row['idsdm']).'<br>'.viewUnit($row['unit']).'</td>
                  <td>'.$row['judul_penelitian'].'</td>
                  <td class="text-center">'.$row['tahun'].'</td>
                  <td>'.viewKodeApp('DANAPENLIT',$row['sumber_dana']).'</td>
                  <td class="text-right">'.rupiah($row['biaya_penelitian']).'</td>
                  </tr>';
              $total=$total+$row['biaya_penelitian'];
            }
         
          ?>
      
    </tbody>
    <tfoot class="text-center">
      <?php
      echo '<tr>
                  <td colspan="5">Jumlah</td>
                  <td class="text-right">'.rupiah($total).'</td>
                </tr>';
      ?>
    </tfoot>
  </table>
</div>
          
            

