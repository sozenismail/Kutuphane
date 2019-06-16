<?php 
	include_once './src/shared/header.php';
	include_once './src/shared/nav.php';

	if (isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = $_GET['id'];
		$stmt = $db->prepare('SELECT * FROM kitap INNER JOIN kategori ON kategori.kategoriId=kitap.kategoriId INNER JOIN yazar ON yazar.yazarId=kitap.yazarId WHERE kitapId = ?');
		$stmt->execute([$id]);
		$book = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$stmt = $db->prepare('SELECT COUNT(kitapId) as okunmaSayısı FROM islemler WHERE kitapId = ?');
		$stmt->execute([$id]);
		$count = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt = $db->prepare('SELECT count(begeniId) as begeni FROM begeni WHERE kitapId = ?');
		$stmt->execute([$id]);
		$likes = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt = $db->prepare('SELECT * FROM kitap INNER JOIN yazar ON yazar.yazarId=kitap.yazarId WHERE kitap.yazarId = ? AND kitapId != ?');
		$stmt->execute([$book['yazarId'], $id]);
		$otherBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$stmt = $db->prepare('SELECT * FROM yorumlar INNER JOIN uye ON uye.uyeId = yorumlar.uyeId WHERE kitapId = ? ORDER BY yorumId DESC');
		$stmt->execute([$id]);
		$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$stmt = $db->prepare('SELECT * FROM kitap INNER JOIN yazar ON yazar.yazarId=kitap.yazarId WHERE kitapId != ?');
		$stmt->execute([$id]);
		$randomBook = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$randomBookIndex = mt_rand(0, count($randomBook)-1);

		if (isset($_SESSION['LoginStatus']) && $_SESSION['LoginStatus'] == true) {
			$stmt = $db->prepare('SELECT * FROM begeni WHERE kitapId = ? AND uyeId = ?');
			$stmt->execute([$id, $_SESSION['UserID']]);
			$like = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		/* echo "<pre>";
		print_r($_SERVER);
		die(); */
	} else {
		die();
	}
?>

<div class="container">
	<div class="columns is-multiline">
		<!-- <div class="column is-12">
			<nav class="breadcrumb" aria-label="breadcrumbs">
				<ul>
					<li class="has-text-primary"><span>Ana Sayfa</span></li>
					<li class="has-text-primary"><span><?= $book['kategoriAd'] ?></span></li>
					<li class="has-text-primary"><span><?= $book['yazarAdSoyad'] ?></span></li>
					<li class="is-active"><span><?= $book['kitapAd'] ?></span></li>
				</ul>
			</nav>
		</div> -->
		<div class="column is-3">
			<figure class="bookImage image is-2by3">
				<img src="./<?= $book['kitapResim'] ?>" alt="Placeholder image">
			</figure>
			<div class="bookStatistics has-text-centered" style="margin-top: 15px">
				<span title="<?= $count['okunmaSayısı'] ?> kere okundu"><i class="fa fa-book" aria-hidden="true"></i> <?= $count['okunmaSayısı'] ?></span> - 
				<span title="<?= $likes['begeni'] ?> kişi beğendi."><i class="fa fa-thumbs-up" aria-hidden="true"></i> <?= $likes['begeni'] ?></span> - 
				<span title="<?= count($comments) ?> kişi yorum yaptı."><i class="fa fa-comment" aria-hidden="true"></i> <?= count($comments) ?></span>
				<?php 
					if (isset($_SESSION['LoginStatus']) && $_SESSION['LoginStatus'] == true):
						if (!empty($like) && count($like) == 1): ?>
				 | <a href="./src/functions/book.php?id=<?= $book['kitapId'] ?>&type=unlike"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Beğendin</a>
						<?php else: ?>
				 | <a href="./src/functions/book.php?id=<?= $book['kitapId'] ?>&type=like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Beğen</a>
				<?php endif; endif; ?>
			</div>
		</div>
		<div class="column is-9">
			<div class="bookHeader">
				<p class="title"><?= $book['kitapAd'] ?></p>
				<p class="subtitle has-text-grey"><?= $book['yazarAdSoyad'] ?></p>
			</div>
			<div class="bookDetail">
				<!-- <span class="tag is-success">Stok: Var</span> -->
				<span class="tag is-white">ISBN: <?= $book['isbn'] ?></span>
				<span class="tag is-white">Tür: <?= $book['kategoriAd'] ?></span>
				<span class="tag is-white">Sayfa: <?= $book['sayfaSayisi'] ?></span>
				<span class="tag is-white">Basım Yılı: <?= $book['basimYili'] ?></span>
			</div>
			<div class="bookSummary">
				<p><?= $book['kitapOzet'] ?></p>
			</div>
		</div>
	</div>


	<?php if (count($otherBooks) > 0):  ?>
	<h1 class="title is-4 has-text-grey-dark">Bu Yazarın Diğer Kitapları</h1>
	<div class="columns is-mobile bookOthers" style="overflow-x: auto">
		<?php for($i = 0; $i < count($otherBooks); $i++): ?>
		<div class="column is-6-mobile is-3-tablet is-2-desktop">
			<div class="card">
				<div class="card-image">
					<figure class="image is-2by3">
						<img src="./<?= $otherBooks[$i]['kitapResim'] ?>" alt="Placeholder image">
					</figure>
				</div>
				<div class="card-content">
					<a href="./book.php?id=<?= $otherBooks[$i]['kitapId'] ?>">
						<div class="media">
							<div class="media-content has-text-centered">
								<p class="title is-6 has-text-white"><?= $otherBooks[$i]['kitapAd'] ?></p>
								<p class="subtitle is-7 has-text-grey-light"><?= $otherBooks[$i]['yazarAdSoyad'] ?></p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<?php endfor ?>
	</div>
	<?php endif ?>

	<div class="columns is-multiline">
		<div class="column is-12-mobile is-9-tablet is-10-desktop">
			<h1 class="title is-4 has-text-grey-dark">Kimler Ne Demiş?</h1>
			<?php if (isset($_SESSION['LoginStatus']) && $_SESSION['LoginStatus'] == true): ?>
				<form action="./src/functions/comments.php" method="POST">
				<div class="field">
					<div class="control">
						<input type="hidden" name="id" value="<?= $book['kitapId'] ?>">
						<textarea class="textarea has-text-grey-dark" placeholder="Yorum yap" name="comment"></textarea>
					</div>
				</div>
				<div class="field">
					<p class="control" style="text-align: right">
						<button class="button is-dark is-rounded" type="submit" name="newComment">Yorum Yap</button>
					</p>
				</div>
				</form>
			<?php endif ?>
			<?php if(count($comments) == 0): ?>
			<h1 class="column is-12">Bu kitap hakkında yorum yapılmamış</h1>
			<?php else: for($i = 0; $i < count($comments); $i++): ?>
			<div class="comment">
				<p class="title is-5 has-text-grey-dark"><?= $comments[$i]['uyeAdSoyad'] ?>
					<?php if (isset($_SESSION['UserID']) && $comments[$i]['uyeId'] == $_SESSION['UserID']): ?>
					- <a title="Yorumu Kaldır" class="has-text-grey-dark" href="./src/functions/comments.php?kitapId=<?= $comments[$i]['kitapId'] ?>&yorumId=<?= $comments[$i]['yorumId'] ?>&type=remove"><i class="fa fa-trash" aria-hidden="true"></i></a>
					<?php endif ?>
				</p>
				<p class="subtitle is-6 has-text-grey"><?= $comments[$i]['yorumIcerik'] ?></p>
			</div>
			<?php endfor; endif; ?>
		</div>
		<div class="column is-12-mobile is-3-tablet is-2-desktop">
			<h1 class="title is-4 has-text-grey-dark has-text-centered">Rastgele Kitap</h1>
			<div class="card">
				<div class="card-image">
					<figure class="image is-2by3">
						<img src="./<?= $randomBook[$randomBookIndex]['kitapResim'] ?>" alt="Placeholder image">
					</figure>
				</div>
				<div class="card-content">
					<a href="./book.php?id=<?= $randomBook[$randomBookIndex]['kitapId'] ?>">
						<div class="media">
							<div class="media-content has-text-centered">
								<p class="title is-6 has-text-white"><?= $randomBook[$randomBookIndex]['kitapAd'] ?></p>
								<p class="subtitle is-7 has-text-grey-light"><?= $randomBook[$randomBookIndex]['yazarAdSoyad'] ?></p>
							</div>
						</div>
					</a>
				</div>
		</div>
	</div>
</div>

<?php include_once './src/shared/footer.php' ?>