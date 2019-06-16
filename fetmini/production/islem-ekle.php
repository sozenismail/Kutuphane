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
                    <h2>İşlem Başlat <small><?php
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
                

                

                    $baslangicTarihi=$_POST["baslangicTarihi"];
                    $bitisTarihi=$_POST["bitisTarihi"];
                    $teslimTarihi=$_POST["teslimTarihi"];

 
                    $uyeId=$_POST["uye"]; 
                    $kitapId=$_POST["kitap"]; 

                    
                    
                    
                    $v = $db->prepare("select * from islemler  ");
                    $v->execute(array());
                    $x =$v->fetch(PDO::FETCH_ASSOC);
                    $z =$v->rowCount();  

                $x = $db->prepare("insert into islemler set 

                
                baslangicTarihi=?,     
                bitisTarihi=?,
                
                uyeId=?,
                kitapId=?



                  ");

                  $x->execute(array($baslangicTarihi,$bitisTarihi,$uyeId,$kitapId));

                  if ($v) {

                       
                    header("location:../production/islemler.php?durum=ok");

                 
                  }
                  else{
                    header("location:../production/islemler.php?durum=no");
                  }
              
               }   
               else{   ?>
              
              
    

                       <div class="x_content" style="margin-top:50px;">
   
                    <form action="" method="POST" enctype="multipart/form-data" id="demo-form2"  data-parsley-validate class="form-horizontal form-label-left">

 

                    <?php
                    $Date =   date("d.m.Y  H:i:s");

                    
                     ?>


                     <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlangıç Tarihi<span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="first-name" required="required"   name="baslangicTarihi" value="<?php echo date('Y-m-d', strtotime($Date )); ?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Bitiş Tarihi <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="first-name" required="required"  name="bitisTarihi" value="<?php  echo date('Y-m-d', strtotime($Date. ' + 7 days')); ?>"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
 

 

                      
                  
                <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Üye <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: 8px; ">

                         
                         <select class="form-control" name="uye">
        
                        <?php 
                            

                          $v = $db->prepare("select * from uye");
                          $v->execute(array());
                          $x =$v->fetchALL(PDO::FETCH_ASSOC);
                          
                          foreach ($x as $m) {
                             echo '<option  value="'.$m["uyeId"].'">'.$m["uyeAdSoyad"].'</option>';         
                            }

                         ?>

                        </select>
                               
                                    
                         
                        </div>
                      </div>   




                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kitap <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: 8px; ">

                         
                         <select class="form-control" name="kitap">
        
                        <?php 
                            

                          $v = $db->prepare("select * from kitap");
                          $v->execute(array());
                          $x =$v->fetchALL(PDO::FETCH_ASSOC);
                          
                          foreach ($x as $m) {
                             echo '<option value="'.$m["kitapId"].'">'.$m["kitapAd"].'</option>';         
                            }

                         ?>

                        </select>
                               
                                    
                         
                        </div>
                      </div>

                      
 


                       <div align="right" class="col-md-11 col-sm-6 col-xs-126">
                          <button type="submit"  class="btn btn-primary">BAŞLAT</button>
                         
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