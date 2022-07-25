<div id="menu">
	<ul>
		<li><a href="index.php">ACCUEIL</a></li>
		<?php foreach ($categories as $categorie) : ?>
			<li><a href="index.php?action=categorie&id=<?= $categorie->id ?>"><?= $categorie->libelle ?></a></li>
		<?php endforeach ?>
		<li><a href="index.php?profil=administrateur"> ADMIN </a></li>
		<li><a href="index.php?profil=editeur"> EDITEUR </a></li>
		<li><a href="http://localhost/mglsi_news_exam/index.php?connect=true">se connecter</a></li>
	</ul>


</div>