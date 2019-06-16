<?php include "header.php"; 

       
 

      if (isset($_POST['arama'])) {
        
        $aranan=$_POST['aranan'];
        $islemsor=$db->prepare("select * from islemler inner join uye on uye.uyeId=islemler.uyeId inner join kitap on kitap.kitapId=islemler.kitapId where uyeAdSoyad LIKE '%$aranan%' order by islemId DESC limit 25");

        $islemsor->execute();
        $say=$islemsor->rowCount();

      }
      else{


          $islemsor=$db->prepare("select * from islemler inner join kitap on kitap.kitapId=islemler.kitapId inner join uye on uye.uyeId=islemler.uyeId  order by islemId DESC limit 25");
          $islemsor->execute();
          $say=$islemsor->rowCount();
      }

       

           
?>
 

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
             

              
            </div>
            <div class="col-md-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                <form action="" method="POST">
                  <div class="input-group">
                    <input type="text" class="form-control" name="aranan" placeholder="Anahtar Kelime Giriniz.">
                    <span class="input-group-btn">
                      <button class="btn btn-default" name="arama" type="submit">Ara</button>
                    </span>
                  </div>
                  </form>

                </div>
              </div>
              </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <div class="col-md-6" align="left">
                    <h2>İşlemler
                    <small><?php
                    echo  $say." kayıt listelendi";
                     if (@$_GET['durum']=='ok') 
                    {?>
                    
                    <b style="color:green;"> İşlem Başarılı</b>

                   <?php } 


                   else if  (@$_GET['durum']=='no') {?>

                      <b style="color:red;"> İşlem Yapılamadı</b>


                   <?php } 

                   

                  else if  (@$_GET['durum']=='uzatmabasarisiz') {?>

                        <b style="color:red;"> Uzatma Sayısı Doldu !</b>
  
  
                     <?php }?></small></h2>

                      
                    </div>

                    <div class="col-md-6" align="right">
                    <a href="islem-ekle.php"><button  class="btn btn-danger "><i class="fa fa-plus" aria-hidden="true"></i> İşlem Başlat</button> </a></div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                               <th class="column-title text-center">Üye Ad</th>
                               <th class="column-title text-center">Kitap Ad  </th>
                                <th class="column-title text-center">Başlangıç Tarihi</th>
                                <th class="column-title text-center">Bitiş Tarihi</th>
                                <th class="column-title text-center">Ücret</th>

                                
                                <th class="column-title text-center">  </th>

                            
             
                            <th width="80" class="column-title text-center"> </th>
                            <th   width="80" class="column-title text-center"> </th>
                          
                            </th>
                           
                          </tr>
                        </thead>

                        <tbody>
                           
                        <?php 
                          while (  $islemcek=$islemsor->fetch(PDO::FETCH_ASSOC)) {
                          
                          
                         ?>

                          <tr>
                            
 
                            <td class="text-center"><?php echo $islemcek["uyeAdSoyad"]; ?></td>

                            <td class="text-center"><?php echo $islemcek["kitapAd"]; ?></td>


                                <td class="text-center"><?php echo $islemcek["baslangicTarihi"]; ?></td>
                                <td class="text-center"><?php echo $islemcek["bitisTarihi"]; ?></td>

                              <?php  

                          $Date =   date("d.m.Y  H:i:s");
                          $suan=date('Y-m-d', strtotime($Date )) ;
                          $yeniucret=strtotime($suan)-strtotime($islemcek["bitisTarihi"]);
                          $islemcek["islemUcreti"]= ($yeniucret/3600/24)*0.5;
                            
                        

                              if($islemcek["islemUcreti"]<0)

                              { ?>

                              <td class="text-center">0 TL</td>
 
                             <?php }
                             
                             else { ?>

                                <td class="text-center"><?php echo $islemcek["islemUcreti"]; ?> TL</td>

                             <?php } ?>
 

                            <td class="text-center"> </td>
                            




                             
                              <?php 
                              if($islemcek["islemDurum"]==1)
                              {  ?>

          <td class="text-center "><a href="../netting/islem.php?islemtamamla=ok&islemId=<?php echo $islemcek["islemId"]; ?>"><button style="width:100%;" class="btn btn-success btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> İşlemi Tamamla</button></a></td>
          <td class="text-center "><a href="../netting/islem.php?islemuzat=ok&islemId=<?php echo $islemcek["islemId"]; ?>"><button style="width:100%;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> İşlemi Uzat</button></a></td>
                  
                                </td>

                         <?php  }  

                            else { ?>

             <td class="text-center "><button style="width:100%;" disabled="" class="btn btn-success btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Bitti</button></a></td>
             <td class="text-center "><button style="width:100%;" disabled="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> İşlemi Uzat</button></a></td>
                 
                                </td>
                           <?php }
                                
                          ?>

                              
                            
                          </tr>
                          <?php } ?>
                         
                        </tbody>
                      </table>
                    </div>



                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->



        

      <?php include "footer.php"; ?>