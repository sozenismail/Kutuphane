

   <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>
                  <?php 

                if ($kullanicicek["kullanici_yetki"]==5) {
                 echo "Yetki:Yönetici";
                }

                 ?>
                </h3>
                <ul class="nav side-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i>Anasayfa <span class="label label-success pull-right"></span></a></li>
 
                   <ul class="nav side-menu">
                

                   <li><a href="uye.php"><i class="fa fa-image"></i>Üye İşlemleri <span class="label label-success pull-right"></span></a></li>
                   <li><a href="kitap.php"><i class="fa fa-file-text"></i>Kitap İşlemleri <span class="label label-success pull-right"></span></a></li>
                   <li><a href="kategori.php"><i class="fa fa-bookmark"></i>Kategori İşlemleri<span class="label label-success pull-right"></span></a></li>
                   <li><a href="yazar.php"><i class="fa fa-certificate"></i>Yazar İşlemleri<span class="label label-success pull-right"></span></a></li>
                   <li><a href="islemler.php"> <i class="fa fa-check"></i>İşlemler<span class="label label-success pull-right"></span></a></li>
 
                </ul>
              </div>
            

            </div>
            <!-- /sidebar menu -->