<?php 
	if (isset($_GET['android']) && $_GET['android'] == true)
		$_SESSION['Android'] = true;
	if (!isset($_SESSION['Android']) || $_SESSION['Android'] != true):
?>
	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
			<a class="navbar-item" href="./" style="font-size:1.5em; font-weight: bold;">
				HIB
			</a>
		
			<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			</a>
		</div>
		
		<div id="navbarBasicExample" class="navbar-menu">
			<div class="navbar-start">
				<a class="navbar-item" href="./">
					Ana Sayfa
				</a>
				<?php if (isset($_SESSION['LoginStatus']) && $_SESSION['LoginStatus'] == true){ ?>
				<a class="navbar-item" href="./transactions.php">
					İşlemlerim
				</a>
				<a class="navbar-item" href="./mylib.php">
					Kütüphanem
				</a>
				<a class="navbar-item" href="./comments.php">
					Yorumlarım
				</a>
				<?php } ?>
			</div>
		
			<div class="navbar-end">
				<div class="navbar-item">
					<form action="./" method="GET">
						<div class="field">
							<div class="control">
								<input class="input" type="text" name="search" placeholder="Kitap Ara">
							</div>
						</div>
					</form>
				</div>
				<?php if (isset($_SESSION['LoginStatus']) && $_SESSION['LoginStatus'] == true){ ?>
					<div class="navbar-item">
						<p>Hoşgeldin, <b><?= $_SESSION['UserName'] ?></b></p>
					</div>
				</div>
					<div class="navbar-item">
					<div class="buttons">
						<a class="button is-light" href="./src/functions/login.php">
							<strong>Çıkış Yap</strong>
						</a>
					</div>
				</div>
				<?php } else { ?>
				<div class="navbar-item">
					<div class="buttons">
						<a class="button is-dark" href="./login.php">
							<strong>Giriş Yap</strong>
						</a>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</nav>
<?php endif ?>