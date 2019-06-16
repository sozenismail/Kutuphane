<?php include "header.php";


  include "../netting/baglan.php"; 

 

 ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Personel İşlemleri  </h3>
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
                    <h2>
                    <?php echo $kullanicicek["kullaniciAd"]; ?> ile ilgili profil düzenlemesi yapıyorsunuz. <small><?php
                     if (@$_GET['durum']=='ok') 
                    {?>
                    
                    <b style="color:green;"> Güncelleme Başarılı</b>

                   <?php } 


                   else if  (@$_GET['durum']=='no') {?>

                      <b style="color:red;"> Güncelleme Yapılamadı</b>


                   <?php }?></small>

                    </h2>



                    <ul class="nav navbar-right panel_toolbox">
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">


                    <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">

                 


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Resim  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                        <?php 
                          if (strlen($kullanicicek["personelResim"])>0) {?>
                            
                            <img width="150"  src="../../<?php echo $kullanicicek["personelResim"]; ?>">
                         <?php } else{?>

                             <img width="150"  src="../../dimg/kullanici-resim-yok.jpg">

                        <?php }?>


                          
                        </div>
                      </div>

                         <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="first-name"  name="personelResim"  class="form-control col-md-7 col-xs-12">
                        </div>

                      </div>

                      <input type="hidden" name="eski_yol" value="<?php echo $kullanicicek["personelResim"]; ?>">
                       <input type="hidden" name="personelId" value="<?php echo $kullanicicek["personelId"]; ?>">

                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="kresimduzenle" class="btn btn-primary">Güncelle</button>
                         
                        </div>

                      </form>
                      <hr>
 
                    <form action="../netting/islem.php" method="POST" id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">

                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Adı<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" disabled="" required="required" name="kullaniciAd" value="<?php echo $kullanicicek["kullaniciAd"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                          <input type="hidden" name="personelId" value="<?php echo $kullanicicek["personelId"]; ?>">

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Personel Ad Soyad<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name"  required="required" name="personelAdSoyad" value="<?php echo $kullanicicek["personelAdSoyad"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Şifre<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="first-name"  required="required" name="kullaniciSifre" value="<?php echo $kullanicicek["kullaniciSifre"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                    


                       <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="kullaniciprofilkaydet" class="btn btn-primary">Güncelle</button>
                         
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