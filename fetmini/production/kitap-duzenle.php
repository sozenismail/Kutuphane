<?php include "header.php";


  include "../netting/baglan.php"; 

 



     $kitapsor=$db->prepare("SELECT * from kitap where kitapId=:kitapId ");
     $kitapsor->execute(array("kitapId" => $_GET["kitapId"]));
     $kitapcek=$kitapsor->fetch(PDO::FETCH_ASSOC);


 ?>
 
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Ayarlar</h3>
              </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Anahtar kelimeniz">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Ara</button>
                    </span>
                  </div>
                </div>
              </div>-->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                   <div class="x_title">
                  <div class="col-md-6" align="left">
                    <h2>Kitap İşlemleri </h2>
                    <small><?php
                     if (@$_GET['durum']=='ok') 
                    {?>
                    
                    <b style="color:green;"> İşlem Başarılı</b>

                   <?php } 


                   else if  (@$_GET['durum']=='no') {?>

                      <b style="color:red;"> İşlem Yapılamadı</b>


                   <?php }?></small></h2>

                    </div>

                    <div class="col-md-6" align="right">
                    <a href="kitap.php"><button  class="btn btn-warning "><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button> </a></div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
 
                    <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">

                    <input type="hidden" name="kitapId" value="<?php echo $kitapcek["kitapId"]; ?>">
                    <input type="hidden" name="kitapResim" value="<?php echo $kitapcek["kitapResim"]; ?>">


                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Yüklü Resim<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img width="200" height="100" src="../../<?php echo $kitapcek["kitapResim"]; ?>">
                        </div>
                      </div>


                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Resim Seç<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="first-name"  name="kitapResim"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>



                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kitap Ad <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="kitapAd" value="<?php  echo $kitapcek["kitapAd"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Basım Yılı <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="basimYili" value="<?php  echo $kitapcek["basimYili"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      


                       <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kategori  <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: 8px; ">

                         <select name="kategori">
        
                          <?php 
                               
                            $kategorisor=$db->prepare("select * from kategori");
                            $kategorisor->execute(array());
                            $kategoricek =$kategorisor->fetchALL(PDO::FETCH_ASSOC);

                            foreach ($kategoricek as $degisken) {
                               echo '<option value="'.$degisken["kategoriId"].'">'.$degisken["kategoriAd"].'</option>';         
                              }

                           ?>

                        </select>
                         
                        </div>
                      </div>
                        



                         
                 


                       <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Sayfa Sayısı<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="sayfaSayisi"  value="<?php echo $kitapcek["sayfaSayisi"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">ISBN<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="isbn"  value="<?php echo $kitapcek["isbn"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                        
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Özet <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          
                          <textarea rows="6" cols="100" style="width:70%;"   required="required" name="kitapOzet">
                          <?php echo $kitapcek["kitapOzet"]; ?>
                          </textarea>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Yazar  <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: 8px; ">

                         <select name="yazar">
        
                          <?php 
                               
                            $yazarsor=$db->prepare("select * from yazar");
                            $yazarsor->execute(array());
                            $yazarcek =$yazarsor->fetchALL(PDO::FETCH_ASSOC);

                            foreach ($yazarcek as $degisken) {
                               echo '<option value="'.$degisken["yazarId"].'">'.$degisken["yazarAdSoyad"].'</option>';         
                              }

                           ?>

                        </select>
                         
                        </div>
                      </div>
                        
 

                       


                       
                          
                         
                        </div>
                      </div>









                      





                       <div align="right" class="col-md-5 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="kitapduzenle" class="btn btn-primary">Güncelle</button>
                         
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