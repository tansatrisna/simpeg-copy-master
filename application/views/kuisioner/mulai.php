<div class="row">
                    
                    <!-- begin col-8 -->
                     <div class="col-md-2">
                     </div>
                     <div class="col-md-8">

                        <!-- begin panel -->
                        <div class="panel panel-success text-center">
                            <div class="panel-heading">
                                
                                <h3 class="panel-title"><?=identitas('nama')?>  </h3>
                            </div>
                            
                             <div class="panel-body text-left">
                                <table class="table">
                                    
                                    <tbody>
                                        <tr>
                                            <td width="1%" nowrap>Nama</td>
                                            <td width="1%">:</td>
                                            <td ><?=viewSdm($rows['idsdm'])?></td>
                                        </tr>
                                        <tr>
                                            <td width="1%" nowrap>Nama Kuisioner</td>
                                            <td width="1%">:</td>
                                            <td ><?=viewKuisioner($rows['kuisioner'])?></td>
                                        </tr>
                                        <tr>
                                            <td width="1%" nowrap>Jumlah Pertanyaan</td>
                                            <td>:</td>
                                            <td><?=jlhSoalKuisioner($rows['kuisioner'])?></td>
                                        </tr>
                                        <tr>
                                            <td width="1%" nowrap>Keterangan</td>
                                            <td>:</td>
                                            <td><?=viewKuisioner($rows['kuisioner'],'keterangan')?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                 
                             </div>

                             <div class="panel-footer text-center">
                                <?php
                                if($rows['login']==0)
                                {
                                    echo'<a href="'.base_url().'isikuisioner/kerjakan/'.$seo.'" class="btn btn-lg btn-success btn-block">Mulai Mengisi Kuisioner</a>';
                                }
                                else
                                {
                                    echo'<a href="'.base_url().'isikuisioner/kerjakan/'.$seo.'" class="btn btn-lg btn-success btn-block">Lanjut Mengisi Kuisioner</a>';
                                }
                                ?>
                                <a href="<?=base_url('isikuisioner')?>" class="btn  btn-danger btn-block">Kembali</a>
                                 
                             </div>
                           
                        </div>

                    </div>

                    <div class="col-md-2">
                     </div>
                        <!-- end panel -->
                    <!-- </div> -->
                    <!-- end col-8 -->
                </div> 