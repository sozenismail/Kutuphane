<?php include "header.php";


  include "../netting/baglan.php"; 


    $db->exec("set names utf8"); 
   

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
                    <h2>Kitap İşlemleri <small><?php
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

                  <?php  
                  if ($_POST) {
                

               
                $uploads_dir="../../dimg/kitap";
                @$tmp_name=$_FILES["kitapResim"]["tmp_name"];
                @$name=$_FILES["kitapResim"]["name"];
                $benzersizsayi1=rand(20000,32000);
                $benzersizsayi2=rand(20000,32000);
                $benzersizsayi3=rand(20000,32000);
                $benzersizsayi4=rand(20000,32000);
                $benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
                $refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
                @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


                


                $kitapAd=$_POST["kitapAd"]; 
                $basimYili=$_POST["basimYili"];

                $kategoriId=$_POST["kategori"]; 
                $yazarId=$_POST["yazar"]; 

                $sayfaSayisi=$_POST["sayfaSayisi"];
                $isbn=$_POST["isbn"];
                $kitapOzet=$_POST["kitapOzet"];
                 
                   
                $v = $db->prepare("select * from kitap  ");
                $v->execute(array());
                $x =$v->fetch(PDO::FETCH_ASSOC);
                $z =$v->rowCount();  

                $x = $db->prepare("insert into kitap set 

                    kitapAd=?,
                    basimYili=?,
                    
                    sayfaSayisi=?,
               
                    isbn=?,
                    kitapOzet=?,
                    kategoriId=?,
                    yazarId=?,
                    kitapResim=?



                  ");

                  $x->execute(array($kitapAd,$basimYili,$sayfaSayisi,$isbn,$kitapOzet,$kategoriId,$yazarId,$refimgyol));

                  if ($v) {

                       
                    header("location:../production/kitap.php?durum=ok");

                 
                  }
                  else{
                    header("location:../production/kitap.php?durum=no");
                  }
              
               }   
               else{   ?>
              
              
    

                       <div class="x_content">
   
                    <form action="" method="POST" enctype="multipart/form-data" id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">


                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Resim Seç<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="file" id="first-name" required="required" name="kitapResim"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                       


                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kitap Ad <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="first-name" required="required" name="kitapAd" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Basım Yılı <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="first-name" required="required" name="basimYili"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Sayfa Sayısı <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="first-name" required="required" name="sayfaSayisi"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">ISBN <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="first-name" required="required" name="isbn"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Özet <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          
                          <textarea rows="6" cols="100" style="width:70%;"   required="required" name="kitapOzet"></textarea>

                        </div>
                      </div>
                  
                <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Yazar <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: 8px; ">

                         
                         <select name="yazar">
        
                        <?php 
                            

                          $v = $db->prepare("select * from yazar");
                          $v->execute(array());
                          $x =$v->fetchALL(PDO::FETCH_ASSOC);
                          
                          foreach ($x as $m) {
                             echo '<option value="'.$m["yazarId"].'">'.$m["yazarAdSoyad"].'</option>';         
                            }

                         ?>

                        </select>
                               
                                    
                         
                        </div>
                      </div>   




                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kategori <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: 8px; ">

                         
                         <select name="kategori">
        
                        <?php 
                            

                          $v = $db->prepare("select * from kategori");
                          $v->execute(array());
                          $x =$v->fetchALL(PDO::FETCH_ASSOC);
                          
                          foreach ($x as $m) {
                             echo '<option value="'.$m["kategoriId"].'">'.$m["kategoriAd"].'</option>';         
                            }

                         ?>

                        </select>
                               
                                    
                         
                        </div>
                      </div>

                      
 


                       <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit"  class="btn btn-primary">Ekle</button>
                         
                        </div>

                </form>
                  </div>
              <?php } ?>
                 

                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->



        

      <?php include "footer.php"; ?>