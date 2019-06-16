<?php 
	include_once './src/shared/header.php';
	include_once './src/shared/nav.php';

	if (!isset($_SESSION['LoginStatus']) || $_SESSION['LoginStatus'] != true) {
		header("refresh:0;url=./login.php");
		die();
	}

	$stmt = $db->prepare('SELECT * FROM begeni INNER JOIN kitap ON kitap.kitapId = begeni.kitapId INNER JOIN yazar ON yazar.yazarId = kitap.yazarId WHERE uyeId = ?');
	$stmt->execute([$_SESSION['UserID']]);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
	<div class="columns is-mobile is-multiline">
		<?php for($i = 0; $i < count($result); $i++): ?>
		<div class="column is-6-mobile is-3-tablet is-2-desktop">
			<div class="card">
				<div class="card-image">
					<figure class="image is-2by3">
						<img src="./<?= $result[$i]['kitapResim'] ?>" alt="Placeholder image">
					</figure>
				</div>
				<div class="card-content">
					<a href="./book.php?id=<?= $result[$i]['kitapId'] ?>">
						<div class="media">
							<div class="media-content has-text-centered">
								<p class="title is-6 has-text-white"><?= $result[$i]['kitapAd'] ?></p>
								<p class="subtitle is-7 has-text-grey-light"><?= $result[$i]['yazarAdSoyad'] ?></p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<?php endfor;
			if (count($result) > 24) :
		?>
		<div class="pagination column is-12">
			<a class="button is-primary" title="This is the first page" disabled>Önceki Sayfa</a>
			<a class="button is-primary">Sonraki Sayfa</a>
		</div>
		<?php endif ?>
	</div>
</div>


<?php include_once './src/shared/footer.php' ?>