<?php 
	include_once './src/shared/header.php';
	include_once './src/shared/nav.php';

	if (!isset($_SESSION['LoginStatus']) || $_SESSION['LoginStatus'] != true) {
		header("refresh:0;url=./login.php");
		die();
	}

	$stmt = $db->prepare('SELECT * FROM islemler INNER JOIN kitap ON kitap.kitapId = islemler.kitapId INNER JOIN yazar ON yazar.yazarId = kitap.yazarId WHERE islemler.uyeId = ? ORDER BY islemId DESC');
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
						<th><abbr>İşlem No</abbr></th>
						<th><abbr>Kitap</abbr></th>
						<th><abbr>Yazar</abbr></th>
						<th><abbr>Alım Tarihi</abbr></th>
						<th><abbr>Bitiş Tarihi</abbr></th>
						<th><abbr>Teslim Tarihi</abbr></th>
						<th><abbr>Süre Uzat</abbr></th>
						<!-- <th><abbr>Beğen</abbr></th> -->
						<th><abbr>Ücret</abbr></th>
					</tr>
				</thead>
				<tbody>
					<?php for($i = 0; $i < count($result); $i++):
						
						$date = date("d.m.Y  H:i:s");
						$now = date('Y-m-d', strtotime($date));
						$time = strtotime($now) - strtotime($result[$i]['bitisTarihi']);
						$day = floor(($time)/3600/24*-1);
						$payment = floor((($time)/3600/24)) * 0.5;
						if ($result[$i]['teslimTarihi'] != NULL) {
							$time = strtotime($result[$i]['teslimTarihi']) - strtotime($result[$i]['bitisTarihi']);
							$payment = floor((($time)/3600/24)) * 0.5;
						}
						$count = strtotime($result[$i]['baslangicTarihi']) - strtotime($result[$i]['bitisTarihi']);
						$count = floor(($count)/3600/24*-1);
					?>
					<tr class="<?= $result[$i]['islemDurum'] == 0 ? 'has-background-warning' : ($payment > 0 ? 'has-background-danger' : 'has-background-success') ?>">
						<th><?= $i+1 ?></th>
						<td><?= $result[$i]['islemId'] ?></td>
						<td><a href="./book.php?id=<?= $result[$i]['kitapId'] ?>"><?= $result[$i]['kitapAd'] ?></a></td>
						<td><?= $result[$i]['yazarAdSoyad'] ?></td>
						<td><?= $result[$i]['baslangicTarihi'] ?></td>
						<td><?= $result[$i]['bitisTarihi'] ?></td>
						<td><?= $result[$i]['teslimTarihi'] != NULL ? $result[$i]['teslimTarihi'] : ($day >= 0 ? $day.' gün var' :  -1*$day.' gün geçti') ?></td>
						<td>
							<?php if ($result[$i]['islemDurum'] == 0 || $count >= 22 || $count < 0 || $payment > 0): ?>
								Daha fazla uzatamazsınız
							<?php else: ?>
							<a href="./src/functions/transactions.php?id=<?= $result[$i]['islemId'] ?>&type=time&value=<?= date('Y-m-d', strtotime($result[$i]['bitisTarihi']. ' + 7 days')); ?>" 
									class="button is-rounded is-dark is-outlined is-small">
								<span class="icon is-small"><i class="fa fa-clock-o"></i></span><span>1 Hafta Uzat</span>
							</a>
							<?php endif ?>
						</td>
						<!-- <td>
							<?php 
								$stmt = $db->prepare('SELECT * FROM begeni WHERE kitapId = ? AND uyeId = ?');
								$stmt->execute([$result[$i]['kitapId'], $_SESSION['UserID']]);
								$like = $stmt->fetchAll(PDO::FETCH_ASSOC);
								if (!empty($like) && count($like) == 1):
							?>
							<a href="./src/functions/transactions.php?id=<?= $result[$i]['kitapId'] ?>&type=unlike" 
								class="button is-rounded is-link is-small">
								<span class="icon is-small"><i class="fa fa-thumbs-o-up"></i></span><span>Beğendin</span>
							</a>
							<?php else: ?>
							<a href="./src/functions/transactions.php?id=<?= $result[$i]['kitapId'] ?>&type=like" 
								class="button is-rounded is-link is-small">
								<span class="icon is-small"><i class="fa fa-thumbs-o-up"></i></span><span>Beğen</span>
							</a>
							<?php endif ?>
						</td> -->
						<td><?= $payment >=0 ? $payment : '0' ?> <i class="fa fa-try" aria-hidden="true"></i></td>
					</tr>
					<?php endfor ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include_once './src/shared/footer.php' ?>