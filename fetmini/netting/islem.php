<?php 

	ob_start();
	session_start();
	include "baglan.php";

	if (isset($_POST["login"])) {



 
		 
		 $kullaniciAd=htmlspecialchars($_POST["kullaniciAd"]);
		 $kullaniciSifre=htmlspecialchars($_POST["kullaniciSifre"]);

		 if ($kullaniciAd && $kullaniciSifre ) {
		    
		    $kullanicisor=$db->prepare("select * from personel where kullaniciAd=:ad and kullaniciSifre=:password");
		    $kullanicisor->execute(array(

		    	"ad"=>$kullaniciAd,
		    	"password"=>$kullaniciSifre


		    	));

		    $say=$kullanicisor->rowCount();
		    if ($say >0) {
		    	 $_SESSION["kullaniciAd"]=$kullaniciAd;

		    	 header("location:../production/index.php");

		    }
		    else{
		    	header("location:../production/login.php?durum=no");
		    	exit;
		    }
		 }


	}

 
   

	if (isset($_POST["kitapduzenle"])) {

			
			if ($_FILES["kitapResim"]["size"] > 0) {
				
			
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
 
		$duzenle=$db->prepare("UPDATE kitap SET  kitapAd=:kitapAd, basimYili=:basimYili, sayfaSayisi=:sayfaSayisi , isbn=:isbn , kitapOzet=:kitapOzet , kitapResim=:resimyol , kategoriId=:kategoriId ,yazarId=:yazarId
               
        where kitapId={$_POST["kitapId"]}");
		$update=$duzenle->execute(array(
			"kitapAd"=> $_POST["kitapAd"],
			"basimYili" => $_POST["basimYili"],
			"sayfaSayisi"=> $_POST["sayfaSayisi"],
			"isbn"=> $_POST["isbn"], 
			"kitapOzet"=>$_POST["kitapOzet"],
			"resimyol"=> $refimgyol,
			"kategoriId"=>$_POST["kategori"],
			"yazarId"=>$_POST["yazar"]


			));

			$kitapId=$_POST["kitapId"];

		if ($update) {

			$resimsilunlink=$_POST["kitapResim"];
			unlink("../../$resimsilunlink");
			header("location:../production/kitap-duzenle.php?kitapId=$kitapId&durum=ok");
		}
		else{
			header("location:../production/kitap-duzenle.php?durum=no");
			exit;
		}
		
	}

	else {

		$duzenle=$db->prepare("UPDATE kitap SET  kitapAd=:kitapAd, basimYili=:basimYili, sayfaSayisi=:sayfaSayisi , isbn=:isbn , kitapOzet=:kitapOzet,  kategoriId=:kategoriId ,yazarId=:yazarId
               
        where kitapId={$_POST["kitapId"]}");
		$update=$duzenle->execute(array(
			"kitapAd"=> $_POST["kitapAd"],
			"basimYili" => $_POST["basimYili"],
			"sayfaSayisi"=> $_POST["sayfaSayisi"],
			"isbn"=> $_POST["isbn"], 
			"kitapOzet"=>$_POST["kitapOzet"],
			"kategoriId"=>$_POST["kategori"],
			"yazarId"=>$_POST["yazar"]


			));

			$kitapId=$_POST["kitapId"];

		if ($update) {

			header("location:../production/kitap-duzenle.php?kitapId=$kitapId&durum=ok");
		}
		else{
			header("location:../production/kitap-duzenle.php?durum=no");
			exit;
		}
	}

	 
	}


	if ($_GET["kitapsil"]=="ok") {
			
			$sil=$db->prepare("DELETE from kitap where kitapId=:kitapId ");
			$kontrol=$sil->execute(array("kitapId" => $_GET["kitapId"]));

				if ($kontrol) {
			header("location:../production/kitap.php?durum=ok");
		}
		else{
			header("location:../production/kitap.php?durum=no");
			exit;
		}

		}



		if (isset($_POST["kresimduzenle"])) {


		$uploads_dir="../../dimg/kullanici";
		@$tmp_name=$_FILES["personelResim"]["tmp_name"];
		@$name=$_FILES["personelResim"]["name"];
		
		$benzersizsayi4=rand(20000,32000);
		
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");


		$duzenle=$db->prepare("UPDATE personel SET  personelResim=:resim   where personelId={$_POST["personelId"]}");
		$update=$duzenle->execute(array(
			
			"resim"=> $refimgyol

			));

		

		if ($update) {

			$resimsilunlink=$_POST["eski_yol"];
			unlink("../../$resimsilunlink");
			header("location:../production/kullanici-profil.php?durum=ok");
		}
		else{
			header("location:../production/kullanici-profil.php?durum=no");
			exit;
		}
		
	}




	if (isset($_POST["kullaniciprofilkaydet"])) {


		$kullaniciSifre=$_POST["kullaniciSifre"];

		$ayarkaydet=$db->prepare("UPDATE personel SET  personelAdSoyad=:adsoyad, kullaniciSifre=:password  where  personelId={$_POST["personelId"]}");
		$update=$ayarkaydet->execute(array(
			"adsoyad"=> $_POST["personelAdSoyad"],
			
			"password"=> $kullaniciSifre




			));

		if ($update) {
			header("location:../production/kullanici-profil.php?durum=ok");
		}
		else{
			header("location:../production/kullanici-profil.php?durum=no");
			exit;
		}
	}


		if (isset($_POST["kategoriekle"])) {

		$uploads_dir="../../dimg/kategori";
		@$tmp_name=$_FILES["kategoriResim"]["tmp_name"];
		@$name=$_FILES["kategoriResim"]["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");





		$kaydet=$db->prepare("INSERT into kategori SET  kategoriAd=:ad,   kategoriResim=:resimyol  ");
		$insert=$kaydet->execute(array(
			"ad"=> $_POST["kategoriAd"],
			
			"resimyol"=> $refimgyol
			




			));

		if ($insert) {
			header("location:../production/kategori.php?durum=ok");
		}
		else{
			header("location:../production/kategori.php?durum=no");
			exit;
		}
	}


			if (isset($_POST["kategoriduzenle"])) {

			
			if ($_FILES["kategoriResim"]["size"] > 0) {
				
			
				$uploads_dir="../../dimg/kategori";
		@$tmp_name=$_FILES["kategoriResim"]["tmp_name"];
		@$name=$_FILES["kategoriResim"]["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


		$duzenle=$db->prepare("UPDATE kategori SET  kategoriAd=:ad,  kategoriResim=:resimyol   where kategoriId={$_POST["kategoriId"]}");
		$update=$duzenle->execute(array(
			"ad"=> $_POST["kategoriAd"],
		 
			
			"resimyol"=> $refimgyol


			));

			$kategoriId=$_POST["kategoriId"];

		if ($update) {

			$resimsilunlink=$_POST["kategoriResim"];
			unlink("../../$resimsilunlink");
			header("location:../production/kategori-duzenle.php?kategoriId=$kategoriId&durum=ok");
		}
		else{
			header("location:../production/kategori-duzenle.php?durum=no");
			exit;
		}
		
	}

		else {

		$duzenle=$db->prepare("UPDATE kategori SET  kategoriAd=:ad   where kategoriId={$_POST["kategoriId"]}");
		$update=$duzenle->execute(array(
			"ad"=> $_POST["kategoriAd"],
		 

			));

			$kategoriId=$_POST["kategoriId"];

		if ($update) {
			header("location:../production/kategori-duzenle.php?kategoriId=$kategoriId&durum=ok");
		}
		else{
			header("location:../production/kategori-duzenle.php?durum=no");
			exit;
		}
	}
	}


			if ($_GET["kategorisil"]=="ok") {
			
			$sil=$db->prepare("DELETE from kategori where kategoriId=:kategoriId ");
			$kontrol=$sil->execute(array("kategoriId" => $_GET["kategoriId"]));

				if ($kontrol) {
			header("location:../production/kategori.php?durum=ok");
		}
		else{
			header("location:../production/kategori.php?durum=no");
			exit;
		}

		}




		if (isset($_POST["uyeekle"])) {

		 
	
			$kaydet=$db->prepare("INSERT into uye SET  uyeAdSoyad=:uyeAdSoyad, uyeBolum=:uyeBolum, uyeCinsiyet=:uyeCinsiyet,uyeTc=:uyeTc,uyeTelefon=:uyeTelefon, uyeSifre=:uyeSifre ");
			$insert=$kaydet->execute(array(
				"uyeAdSoyad"=> $_POST["uyeAdSoyad"],
				"uyeBolum"=> $_POST["uyeBolum"],
				"uyeCinsiyet"=> $_POST["uyeCinsiyet"],
				"uyeTc"=> $_POST["uyeTc"],
				"uyeTelefon"=> $_POST["uyeTelefon"],
				"uyeSifre"=> $_POST["uyeSifre"]
				
	
	
	
	
				));
	
			if ($insert) {
				header("location:../production/uye.php?durum=ok");
			}
			else{
				header("location:../production/uye.php?durum=no");
				exit;
			}
			
		}


		
		if (isset($_POST["uyeduzenle"])) {

			
		 

		$duzenle=$db->prepare("UPDATE uye SET  uyeAdSoyad=:uyeAdSoyad, uyeBolum=:uyeBolum, uyeCinsiyet=:uyeCinsiyet, uyeTc=:uyeTc, uyeTelefon=:uyeTelefon,uyeSifre=:uyeSifre  where uyeId={$_POST["uyeId"]}");
		$update=$duzenle->execute(array(
			"uyeAdSoyad"=> $_POST["uyeAdSoyad"],
			"uyeBolum"=> $_POST["uyeBolum"],
			"uyeCinsiyet"=> $_POST["uyeCinsiyet"],
			"uyeTc"=> $_POST["uyeTc"],
			"uyeTelefon"=> $_POST["uyeTelefon"],
			"uyeSifre"=> $_POST["uyeSifre"]

			

			));

			$uyeId=$_POST["uyeId"];

		if ($update) {

			 
			header("location:../production/uye-duzenle.php?uyeId=$uyeId&durum=ok");
		}
		else{
			header("location:../production/uye-duzenle.php?durum=no");
			exit;
		}
	}
		
	
	if ($_GET["uyesil"]=="ok") {
			
		$sil=$db->prepare("DELETE from uye where uyeId=:uyeId ");
		$kontrol=$sil->execute(array("uyeId" => $_GET["uyeId"]));

			if ($kontrol) {
		header("location:../production/uye.php?durum=ok");
	}
	else{
		header("location:../production/uye.php?durum=no");
		exit;
	}

	}


	if (isset($_POST["yazarekle"])) {

		 
	
		$kaydet=$db->prepare("INSERT into yazar SET  yazarAdSoyad=:yazarAdSoyad, yazarUyruk=:yazarUyruk, yazarCinsiyet=:yazarCinsiyet  ");
		$insert=$kaydet->execute(array(
			"yazarAdSoyad"=> $_POST["yazarAdSoyad"],
			"yazarUyruk"=> $_POST["yazarUyruk"],
			"yazarCinsiyet"=> $_POST["yazarCinsiyet"] 
			
 

			));

		if ($insert) {
			header("location:../production/yazar.php?durum=ok");
		}
		else{
			header("location:../production/yazar.php?durum=no");
			exit;
		}
		
	}

	if (isset($_POST["yazarduzenle"])) {

			
		 

		$duzenle=$db->prepare("UPDATE yazar SET  yazarAdSoyad=:yazarAdSoyad, yazarUyruk=:yazarUyruk, yazarCinsiyet=:yazarCinsiyet  where yazarId={$_POST["yazarId"]}");
		$update=$duzenle->execute(array(
			"yazarAdSoyad"=> $_POST["yazarAdSoyad"],
			"yazarUyruk"=> $_POST["yazarUyruk"],
			"yazarCinsiyet"=> $_POST["yazarCinsiyet"] 
			

			));

			$yazarId=$_POST["yazarId"];

		if ($update) {

			 
			header("location:../production/yazar-duzenle.php?yazarId=$yazarId&durum=ok");
		}
		else{
			header("location:../production/yazar-duzenle.php?durum=no");
			exit;
		}
	}

	if ($_GET["yazarsil"]=="ok") {
			
		$sil=$db->prepare("DELETE from yazar where yazarId=:yazarId ");
		$kontrol=$sil->execute(array("yazarId" => $_GET["yazarId"]));

			if ($kontrol) {
		header("location:../production/yazar.php?durum=ok");
	}
	else{
		header("location:../production/yazar.php?durum=no");
		exit;
	}

	}


		if (isset($_GET["islemtamamla"])=="ok") {

				
	
				
			$Date =   date("d.m.Y  H:i:s");
			$islemDurum=0;
			$teslimTarihi=date('Y-m-d', strtotime($Date )) ;
			
			
			
			$islemsor=$db->prepare("select * from islemler where islemId=:islemId ");
			$islemsor->execute(['islemId' => $_GET["islemId"]]); 

  			$islemcek=$islemsor->fetch(PDO::FETCH_ASSOC);
 
			$Date =   date("d.m.Y  H:i:s");
			$suan=date('Y-m-d', strtotime($Date )) ;
			$yeniucret=strtotime($suan)-strtotime($islemcek["bitisTarihi"]);

			 
			$islemUcreti= floor((($yeniucret)/3600/24)*0.5);
			 

		 

		$duzenle=$db->prepare("UPDATE islemler SET islemDurum=:islemDurum,islemUcreti=:islemUcreti,teslimTarihi=:teslimTarihi
			
		where islemId=:islemId");
		$update=$duzenle->execute(array(
			"islemDurum"=> $islemDurum,
			"islemUcreti"=> $islemUcreti,
			"teslimTarihi"=>  $teslimTarihi,
			"islemId" => $_GET["islemId"]
			 
			));

			$islemId=$_GET["islemId"];

		if ($update) {
	
			header("location:../production/islemler.php?islemId=$islemId&durum=ok");
		}
		else{
			header("location:../production/islemler.php?durum=no");
			exit;
		}
		
	}



	if (isset($_GET["islemuzat"])=="ok") {

		$islemsor=$db->prepare("select * from islemler where islemId=:islemId ");
		$islemsor->execute(['islemId' => $_GET["islemId"]]); 

		$islemcek=$islemsor->fetch(PDO::FETCH_ASSOC);
		
				
		if($islemcek["uzatmaSayisi"]<=4)
		{
	 
		
		
		$islemsor=$db->prepare("select * from islemler where islemId=:islemId ");
		$islemsor->execute(['islemId' => $_GET["islemId"]]); 

		$islemcek=$islemsor->fetch(PDO::FETCH_ASSOC);
		
		$İlkAlisSayisi=1;
		$uzatmaSayisi=$İlkAlisSayisi+$islemcek["uzatmaSayisi"]+1;

	 
		 

		
		$Date =   date("d.m.Y");
		$suan=date('Y-m-d', strtotime($islemcek["bitisTarihi"]. ' + 7 days'));
  
		$duzenle=$db->prepare("UPDATE islemler SET bitisTarihi=:bitisTarihi, uzatmaSayisi=:uzatmaSayisi
		
		where islemId=:islemId");
		$update=$duzenle->execute(array(
			"bitisTarihi"=> $suan,
			"uzatmaSayisi" =>$uzatmaSayisi,
			"islemId" => $_GET["islemId"]
			
			));

			$islemId=$_GET["islemId"];

		if ($update) {

			header("location:../production/islemler.php?islemId=$islemId&durum=ok");
		}
		else{
			header("location:../production/islemler.php?durum=no");
			exit;
		}

	}
	else{

		header("location:../production/islemler.php?durum=uzatmabasarisiz");
			exit;

	}
	
   }
	

 ?>

 