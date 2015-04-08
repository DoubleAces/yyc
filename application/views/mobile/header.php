<div class="menu" id="menu">
	<div class="header-top">
		<div class="logo">
			<a href="index.html"><img src="<?=base_url()?>images/mobile/logo.png" alt="" /></a>
		</div>
		<nav class="nav">
			<a href="#" id="w3-menu-trigger"> </a>
			<ul class="nav-list nav" id="nav">
				<li class="nav-item <?if($this->router->fetch_class() == 'home') { ?>current<? }?>"><a href="/home">Avaleht</a></li>
				<li class="nav-item"><a href="#">Treenerid</a></li>
				<li class="nav-item"><a href="#">Blogid</a></li>
				<li class="nav-item"><a href="#">Artiklid</a></li>
				<li class="nav-item"><a href="#">Retseptid</a></li>
				<li class="nav-item" <?if(in_array($this->router->fetch_class(), array('my', 'client'))) { ?>class="active"<? }?>><a href="/login">Minu konto</a></li>
			</ul>
		</nav>
		<div class="clear"> </div>
		<script src="<?=base_url()?>js/responsive.menu.js"></script>
	</div>
</div>