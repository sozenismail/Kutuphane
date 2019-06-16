<?php include "header.php";


  include "../netting/baglan.php"; 

 



    $kategorisor=$db->prepare("SELECT * from kategori where kategoriId=:kategoriId ");
     $kategorisor->execute(array("kategoriId" => $_GET["kategoriId"]));
     $kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);


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
                    <h2>Kategori İşlemleri
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
                    <a href="kategori.php"><button  class="btn btn-warning "><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button> </a></div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
 
                    <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">

                    <input type="hidden" name="kategoriId" value="<?php echo $kategoricek["kategoriId"]; ?>">
                    <input type="hidden" name="kategoriResim" value="<?php echo $kategoricek["kategoriResim"]; ?>">


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img width="200" height="100" src="../../<?php echo $kategoricek["kategoriResim"]; ?>">
                        </div>
                      </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="first-name"  name="kategoriResim"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>



                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Ad <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="kategoriAd" value="<?php  echo $kategoricek["kategoriAd"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

           
                       <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="kategoriduzenle" class="btn btn-primary">Kaydet</button>
                         
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