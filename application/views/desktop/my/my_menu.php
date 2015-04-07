<ul class="blog-list">
	<li style="list-style: none; margin-left: 0px; margin-bottom: 0px;"><h4>Minu konto</h4></li>
	<?
	if ($this->session->activeUser->is_trainer == 1) {
		?><li><a href="/my/clients">Kliendid</a></li><?
	}
	?>
	<li><a href="/my/training">Treeningkavad</a></li>
	<li><a href="/logout">Logout</a></li>
</ul>
