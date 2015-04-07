<div class="login_top">
	<div class="container">
		<div class="col-md-6">
			<div class="login-page">
				<h4 class="title">Uus kasutaja</h4>
				<p>
					Loo konto ning ühine teistega
				</p>
				<div class="button1">
					<input type="submit" value="Create an Account" onclick="document.location.href='/register'">
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="login-page">
				<div class="login-title">
					<h4 class="title">Sisene</h4>
					<div id="loginbox" class="loginbox">
						<?=form_open('/enter', 'method="post" name="login" id="login-form"')?>
							<?
							if ($error) {
								?><div class="alert alert-danger"><?= $error ?></div><?
							}
							?>
							<fieldset class="input">
								<p id="login-form-username">
									<label for="modlgn_username">Kasutajanimi <?=form_error('username')?> <?=form_error('monkey')?></label>
									<input id="modlgn_username" type="text" name="username" class="inputbox" size="18" autocomplete="off">
								</p>
								<p id="login-form-password">
									<label for="modlgn_passwd">Parool <?=form_error('password')?></label>
									<input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18" autocomplete="off">
								</p>
								<div class="remember">
									<p id="login-form-remember">
										<label><a href="#">Forget Your Password ? </a></label>
									</p>
									<input type="submit" name="Submit" class="button" value="Login"><div class="clear"></div>
								</div>
							</fieldset>
						<?=form_close()?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>