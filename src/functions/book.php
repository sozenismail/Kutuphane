<?php
	include "../shared/database.php";

	if (isset($_GET['type']) && $_GET['type'] == 'like') {
		$id = trim(htmlspecialchars(strip_tags($_GET['id'])));
		$stmt = $db->prepare('INSERT INTO begeni (kitapId, uyeId) VALUES (?, ?)');
		$result = $stmt->execute([$id, $_SESSION['UserID']]);
	} else if (isset($_GET['type']) && $_GET['type'] == 'unlike') {
		$id = trim(htmlspecialchars(strip_tags($_GET['id'])));
		$stmt = $db->prepare('DELETE FROM begeni WHERE kitapId = ? AND uyeId = ?');
		$result = $stmt->execute([$id, $_SESSION['UserID']]);
	}

	header("refresh:0;url=".$_SERVER['HTTP_REFERER']);