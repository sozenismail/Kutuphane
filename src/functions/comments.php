<?php 
	include "../shared/database.php";

	if (isset($_POST['newComment'])) {
		$id = trim(htmlspecialchars(strip_tags($_POST['id'])));
		$comment = trim(htmlspecialchars(strip_tags($_POST['comment'])));
		$stmt = $db->prepare('INSERT INTO yorumlar (kitapId, uyeId, yorumIcerik) VALUES (?, ?, ?)');
		$result = $stmt->execute([$id, $_SESSION['UserID'], $comment]);
	} else if (isset($_GET['type']) && $_GET['type'] == 'remove') {
		$bookID = trim(htmlspecialchars(strip_tags($_GET['kitapId'])));
		$commentID = trim(htmlspecialchars(strip_tags($_GET['yorumId'])));
		$stmt = $db->prepare('DELETE FROM yorumlar WHERE kitapId = ? AND uyeId = ? AND yorumId = ?');
		$result = $stmt->execute([$bookID, $_SESSION['UserID'], $commentID]);
	}

	header("refresh:0;url=".$_SERVER['HTTP_REFERER']);