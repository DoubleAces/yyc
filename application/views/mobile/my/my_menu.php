<ul class="blog-list">
	<li class="no-list-style"><h4>Minu konto</h4></li>
	<?
	if ($this->session->activeUser->is_trainer == 1) {
		?><li><a href="/my/clients">Kliendid</a></li><?
	}
	?>
	<li><a href="/my/training">Minu treeningkavad</a></li>
	<li><a href="/logout">Logout</a></li>
</ul>
