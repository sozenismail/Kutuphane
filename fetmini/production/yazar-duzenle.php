<?php include "header.php";


  include "../netting/baglan.php"; 

 



     $yazarsor=$db->prepare("SELECT * from yazar where yazarId=:yazarId ");
     $yazarsor->execute(array("yazarId" => $_GET["yazarId"]));
     $yazarcek=$yazarsor->fetch(PDO::FETCH_ASSOC);

 

 ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Ayarlar</h3>
              </div>

           
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                   <div class="x_title">
                  <div class="col-md-6" align="left">
                    <h2 style="padding-right:20px;">Yazar Düzenleme İşlemleri </h2> 
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
                    <a href="yazar.php"><button  class="btn btn-warning "><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button> </a></div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
 
                    <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">

                    <input type="hidden" name="yazarId" value="<?php echo $yazarcek["yazarId"]; ?>">
 
 


                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yazar Ad Soyad <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="yazarAdSoyad" value="<?php  echo $yazarcek["yazarAdSoyad"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uyruk <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="yazarUyruk" value="<?php  echo $yazarcek["yazarUyruk"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cinsiyet <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" name="yazarCinsiyet" value="<?php  echo $yazarcek["yazarCinsiyet"]; ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      
 

                    
 

           
                       <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="yazarduzenle" class="btn btn-primary">Kaydet</button>
                         
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