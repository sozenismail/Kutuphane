<?php include "header.php"; 



 
          $uyesor=$db->prepare("select * from uye order by uyeId DESC limit 25");
          $uyesor->execute();
          $say=$uyesor->rowCount();
     


?>




  
    
                        




        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
             

              
            </div>
            <div class="col-md-12">
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                 

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
                  <h2 style="padding-right:20px;">Üye İşlemleri</h2>
                    <small><?php
                    echo  $say." kayıt listelendi";
                     if (@$_GET['durum']=='ok') 
                    {?>
                    
                    <b style="color:green;"> İşlem Başarılı</b>

                   <?php } 


                   else if  (@$_GET['durum']=='no') {?>

                      <b style="color:red;"> İşlem Yapılamadı</b>


                   <?php }?></small></h2>

                    </div>

                    <div class="col-md-6" align="right">
                    <a href="uye-ekle.php"><button  class="btn btn-danger "><i class="fa fa-plus" aria-hidden="true"></i> Yeni Üye Ekle</button> </a></div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                              <th class="column-title text-center">Üye Ad Soyad </th>
                              <th class="column-title text-center">Üye Bölüm</th>
                          
                           
              
                            <th width="80" class="column-title text-center"> </th>
                            <th width="80" class="column-title text-center"> </th>
                          
                            </th>
                           
                          </tr>
                        </thead>

                        <tbody>

                        <?php 
                          while (  $uyecek=$uyesor->fetch(PDO::FETCH_ASSOC)) {
                          
                          
                         ?>

                          <tr>
                            
                          <td class="text-center"><?php echo $uyecek["uyeAdSoyad"]; ?></td>
                          <td class="text-center"><?php echo $uyecek["uyeBolum"]; ?></td>
                           
                           




                            <td class="text-center "><a href="uye-duzenle.php?uyeId=<?php echo $uyecek["uyeId"]; ?>"><button style="width:80px;" class="btn btn-primary btn-xs"> <i class="fa fa-pencil" aria-hidden="true"></i> Düzenle </button></a></td>

                              
                             <td class="text-center "><a href="../netting/islem.php?uyesil=ok&uyeId=<?php echo $uyecek["uyeId"]; ?>"><button style="width:80px;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Sil</button></a></td>
                      
                            </td>
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