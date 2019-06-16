<?php 
	include_once './src/shared/header.php';
	include_once './src/shared/nav.php';

	if (!isset($_SESSION['LoginStatus']) || $_SESSION['LoginStatus'] != true) {
		header("refresh:0;url=./login.php");
		die();
	}

	$stmt = $db->prepare('SELECT * FROM yorumlar INNER JOIN kitap ON kitap.kitapId = yorumlar.kitapId INNER JOIN yazar ON yazar.yazarId = kitap.yazarId WHERE uyeId = ? ORDER BY yorumId DESC');
	$stmt->execute([$_SESSION['UserID']]);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="container">
	<div class="columns">
		<div class="column is-12" style="overflow-x: auto;">
			<table class="table" style="width: 100%">
				<thead>
					<tr>
						<th><abbr>Sıra</abbr></th>
						<th><abbr>Kitap</abbr></th>
						<th><abbr>Yazar</abbr></th>
						<th><abbr>Yorum</abbr></th>
						<th><abbr>Yorumu Kaldır</abbr></th>
					</tr>
				</thead>
				<tbody>
					<?php for($i = 0; $i < count($result); $i++): ?>
					<tr>
						<th><?= $i+1 ?></th>
						<td><a href="./book.php?id=<?= $result[$i]['kitapId'] ?>"><?= $result[$i]['kitapAd'] ?></a></td>
						<td><?= $result[$i]['yazarAdSoyad'] ?></td>
						<td><?= $result[$i]['yorumIcerik'] ?></td>
						<td><a href="./src/functions/comments.php?kitapId=<?= $result[$i]['kitapId'] ?>&yorumId=<?= $result[$i]['yorumId'] ?>&type=remove">
							<i class="fa fa-trash" aria-hidden="true"></i> Kaldır
						</td>
					</tr>
					<?php endfor ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include_once './src/shared/footer.php' ?>