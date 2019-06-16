<?php 

ob_start();
session_start();
	if (isset($_SESSION["kullaniciAd"])) {
		 
		 header("location:production");
	}

	else
	{
		header("location:production/login.php");
	}
 ?>