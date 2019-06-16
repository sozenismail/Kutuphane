<?php include "header.php"; 




      if (isset($_POST['arama'])) {
        
        $aranan=$_POST['aranan'];
        $kategorisor=$db->prepare("select * from kategori where kategoriAd LIKE '%$aranan%' order by kategoriId  ASC limit 25");
        $kategorisor->execute();
        $say=$kategorisor->rowCount();

      }
      else{


          $kategorisor=$db->prepare("select * from kategori order by kategoriId DESC limit 25");
          $kategorisor->execute();
          $say=$kategorisor->rowCount();
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
                  <h2 style="padding-right:20px;">Kategori İşlemleri</h2>
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
                    <a href="kategori-ekle.php"><button  class="btn btn-danger "><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</button> </a></div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                      <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            
                              <th class="column-title text-center">Kategori Resim </th>
                              <th class="column-title text-center">Kategori Ad</th>
                          
                           
              
                            <th width="80" class="column-title text-center"> </th>
                            <th width="80" class="column-title text-center"> </th>
                          
                            </th>
                           
                          </tr>
                        </thead>

                        <tbody>

                        <?php 
                          while (  $kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {
                          
                          
                         ?>

                          <tr>
                            
                            <td class="text-center "><img width="200" height="100" src="../../<?php echo $kategoricek["kategoriResim"]; ?>"></td>
                            <td class="text-center"><?php echo $kategoricek["kategoriAd"]; ?></td>
                           
                           




                            <td class="text-center "><a href="kategori-duzenle.php?kategoriId=<?php echo $kategoricek["kategoriId"]; ?>"><button style="width:80px;" class="btn btn-primary btn-xs"> <i class="fa fa-pencil" aria-hidden="true"></i> Düzenle </button></a></td>

                             
                      




                             <td class="text-center "><a href="../netting/islem.php?kategorisil=ok&kategoriId=<?php echo $kategoricek["kategoriId"]; ?>"><button style="width:80px;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> Sil</button></a></td>
                      
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