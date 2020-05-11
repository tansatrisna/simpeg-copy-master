<div class="row">
     <div class="col-lg-2">
     </div>
     <div class="col-lg-8">

        <!-- begin panel -->
        <div class="panel panel-success text-center">
            <div class="panel-heading">
                
                <h3 class="panel-title"><?=identitas('nama')?>  </h3>
            </div>
            
             <div class="panel-body text-left">
               

                <h4>Silahkan mengisi kuisioner terlebih dahulu. Masukan dan saran anda merupakan evaluasi demi perbaikan pelayanan di kampus ini!</h4>
                <table class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kuisioner</th>
                            <th>Jumlah Pertanyaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=0;

                        foreach ($record as $row) {
                            if(cekSelesai($row['id'],$idsdm)==1)
                            {
                                $aksi='Sudah Dikerjakan';
                            }
                            else
                            {
                                $aksi=aksiDetail('isikuisioner/mulai',enkrip($row['id']),'Mulai Isi Kuisioner');
                            }
                            $no++;
                            echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.$row['nama'].'</td>
                                    <td>'.jlhSoalKuisioner($row['id']).'</td>
                                    <td>'.$aksi.'</td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                    
                </table>

                 
             </div>
             <div class="panel-footer">
                 <a href="<?=base_url('sdm')?>" class="btn btn-success btn-block" title="">Kembali Ke Home</a>
             </div>

             
           
        </div>

    </div>
    <div class="col-lg-2">
     </div>

   
</div>  