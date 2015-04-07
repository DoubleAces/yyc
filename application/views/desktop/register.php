<div class="login_top">
	<div class="container">
		<div class="col-md-6">
			<div class="login-page">
				<div class="login-title">
					<h4 class="title">Loo konto</h4>
					<div id="loginbox" class="loginbox">
						<?=form_open('/signup', 'method="post" name="signup" id="login-form"')?>
						<fieldset class="input">
							<p id="login-form-username">
								<label for="modlgn_username">Kasutajanimi <?=form_error('username')?></label>
								<input id="modlgn_username" type="text" name="username" class="inputbox" size="18" autocomplete="off">
							</p>
							<p id="login-form-password">
								<label for="modlgn_passwd">Eesnimi <?=form_error('first_name')?></label>
								<input id="modlgn_passwd" type="text" name="first_name" class="inputbox" size="18" autocomplete="off">
							</p>
							<p id="login-form-password">
								<label for="modlgn_passwd">Perekonnanimi <?=form_error('last_name')?></label>
								<input id="modlgn_passwd" type="text" name="last_name" class="inputbox" size="18" autocomplete="off">
							</p>
							<p id="login-form-password">
								<label for="modlgn_passwd">E-post <?=form_error('email')?></label>
								<input id="modlgn_passwd" type="text" name="email" class="inputbox" size="18" autocomplete="off">
							</p>
							<p id="login-form-password">
								<label for="modlgn_passwd">Parool <?=form_error('password')?></label>
								<input id="modlgn_passwd" type="password" name="password" class="inputbox" size="18" autocomplete="off">
							</p>
							<p id="login-form-password">
								<label for="modlgn_passwd">Korda parooli <?=form_error('repeat_password')?></label>
								<input id="modlgn_passwd" type="password" name="repeat_password" class="inputbox" size="18" autocomplete="off">
							</p>
							<div class="remember">
								<input type="submit" name="Submit" class="button" value="Registreeri"><div class="clear"></div>
							</div>
						</fieldset>
						<?=form_close()?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="col-md-6">
			<div class="login-page">
				<h4 class="title">Oled juba registreerinud?</h4>
				<p>
					Logi sisse!
				</p>
				<div class="button1">
					<a href="/login"><input type="submit" value="Logi sisse"></a>
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</div>
</div>