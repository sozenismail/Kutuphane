<?php include_once './src/shared/header.php'; ?>
<section class="hero is-fullheight" id="login">
	<div class="hero-body">
		<div class="container">
			<div class="container">
				<div class="columns is-mobile is-centered has-text-centered">
					<div class="column is-12-mobile is-4-tablet window">
						<h1 class="title has-text-white">
							Giriş Yap
						</h1>
						<form action="./src/functions/login.php" method="POST">
							<div class="field">
								<p class="control has-icons-left has-icons-right">
									<input class="input is-white" type="text" placeholder="TC No" name="tc">
									<span class="icon is-small is-left">
										<i class="fa fa-envelope"></i>
									</span>
								</p>
							</div>
							<div class="field">
								<p class="control has-icons-left">
									<input class="input is-white" type="password" placeholder="Şifreniz" name="password">
									<span class="icon is-small is-left">
										<i class="fa fa-lock"></i>
									</span>
								</p>
							</div>
							<div class="field">
								<p class="control">
									<button class="button is-white is-fullwidth is-rounded" type="submit" name="login">
										Giriş Yap
									</button>
								</p>
							</div>
							<div class="field">
								<p class="control has-text-centered">
									<a href="./index.php" class="has-text-grey-light">Giriş Yapmadan Devam Et</a>
								</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include_once './src/shared/footer.php' ?>
