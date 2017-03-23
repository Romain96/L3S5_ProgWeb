<h1 class="text-center">Mes favoris</h1>
<?php if( empty($favoris) ) { ?>

<p class="text-center">Vous n'avez aucun favoris pour l'instant</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($favoris as $favori) { ?>
		<li>
			<h2>
				<?php
				echo $favori->get_nom_favori();
				?>
			</h2>
			<!-- retirer la vidéo dans ses favoris -->
			<?php $nom_video = $favori->get_nom_favori(); ?>
			<?php $login = $u->get_login(); ?>
                        <?php echo "<form action=\"".BASEURL."/index.php/favori/supprimer_favori\""." method = \"post\">"; ?>
				<?php echo "<input type=\"hidden\" name=\"LOGIN\" value=\"$login\">"; ?>
                                <?php echo "<input type=\"hidden\" name=\"NOM_FAVORI\" value=\"$nom_video\">"; ?>
                                <?php echo "<input type=\"submit\" value=\"Supprimer de mes favoris\">"; ?>
                        <?php echo "</form>"; ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
