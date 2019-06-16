<?php 
	include "../shared/database.php";

	if(isset($_POST['login'])){
		$tc = trim(htmlspecialchars(strip_tags($_POST['tc'])));
		$password = trim(htmlspecialchars(strip_tags($_POST['password'])));

		$stmt = $db->prepare('SELECT uyeId, uyeAdSoyad, uyeTc, uyeSifre FROM uye WHERE uyeTC = ? AND uyeSifre = ?');
		$stmt->execute([$tc, $password]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (count($result) == 1) {
			$_SESSION['LoginStatus'] = true;
			$_SESSION['UserName'] = $result[0]['uyeAdSoyad'];
			$_SESSION['UserID'] = $result[0]['uyeId'];
			echo $_SESSION['LoginStatus'];
		} else {
			header("refresh:0;url=../../login.php").die();
		}
		
	} else {
		session_destroy();
	}
	header("refresh:0;url=../../");