<ul class="blog-list">
	<li class="no-list-style"><h4><?=$client->first_name?> <?=$client->last_name?></h4></li>
	<li><a href="/my/clients/<?=$client->id?>">Ülevaade</a></li>
	<li><a href="/trainer/client/<?=$client->id?>/training-plan">Treeningkavad</a></li>
	<li><a href="#">Toitumiskavad</a></li>
</ul>
