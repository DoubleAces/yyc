<div class="header-bottom">
	<div class="container">
		<div class="social">
			<ul>
				<li class="facebook"><a href="#"><span> </span></a></li>
				<li class="twitter"><a href="#"><span> </span></a></li>
				<li class="instagram"><a href="#"><span> </span></a></li>
				<li><a href="#"><span class="label label-danger" style="vertical-align: top; border-radius: 10px; font-size: 74%">1</span></a></li>
			</ul>
		</div>

		<div class="clear"></div>
	</div>
</div>
<div class="menu" id="menu">
	<div class="container">
		<div class="logo">
			<a href="/home" style="color: #FFF; font-size: 28px;">FitCom</a>
		</div>
		<div class="h_menu4">
			<a class="toggleMenu" href="#">Menu</a>
			<ul class="nav">
				<li <?if($this->router->fetch_class() == 'home') { ?>class="active"<? }?>><a href="/home">Avaleht</a></li>
				<li><a href="#">Treenerid</a></li>
<!--				<li><a href="#">Blogid</a></li>-->
<!--				<li><a href="#">Artiklid</a></li>-->
<!--				<li><a href="#">Retseptid</a></li>-->
				<li <?if(in_array($this->router->fetch_class(), array('my', 'client'))) { ?>class="active"<? }?>><a href="/login">Minu konto</a></li>
			</ul>
			<script type="text/javascript" src="<?=base_url()?>js/nav.js"></script>
		</div>
		<div class="clear"></div>
	</div>
</div>