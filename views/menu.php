<nav>
	<ul>
		<li><a href="<?=BASEURL?>">Accueil</a></li>
		<?php if (user_connected()) { ?>
			<?php if(isset($_SESSION['admin'])) { ?>
				<li><a href="<?=BASEURL?>/index.php/utilisateur/lister_utilisateurs">Utilisateurs</a></li>
				<li><a href="<?=BASEURL?>/index.php/video/lister_videos_admin">Vidéos</a></li>
				<li><a href="<?=BASEURL?>/index.php/emission/lister_emissions_admin">Emissions</a></li>
				<li><a href="<?=BASEURL?>/index.php/favori/lister_favoris">Favoris</a></li>
				<li><a href="<?=BASEURL?>/index.php/abonnement/lister_abonnements">Abonnements</a></li>
				<li><a href="<?=BASEURL?>/index.php/historique/lister_historiques">Historiques</a></li>
				<li><a href="<?=BASEURL?>/index.php/utilisateur/deconnexion">Déconnexion</a></li>
			<?php } else { ?>
				<li><a href="<?=BASEURL?>/index.php/utilisateur/afficher_profil">Profil</a></li>
				<li><a href="<?=BASEURL?>/index.php/video/lister_videos">Vidéos</a></li>
				<li><a href="<?=BASEURL?>/index.php/emission/lister_emissions">Emissions</a></li>
				<li><a href="<?=BASEURL?>/index.php/favori/mes_favoris">Favoris</a></li>
				<li><a href="<?=BASEURL?>/index.php/abonnement/mes_abonnements">Abonnements</a></li>
				<li><a href="<?=BASEURL?>/index.php/historique/mon_historique">Historique</a></li>
				<li><a href="<?=BASEURL?>/index.php/utilisateur/deconnexion">Déconnexion</a></li>
				<?php } ?>
		<?php } else { ?>
			<li><a href="<?=BASEURL?>/index.php/utilisateur/connexion">Connexion</a></li>
		<?php }	?>
	</ul>
</nav>
