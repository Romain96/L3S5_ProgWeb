<h1 class="text-center">Toutes les vidéos disponibles</h1>

<?php if( empty($videos) ) { ?>

<p class="text-center">Il n'y a pas encore de vidéos...</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach ($videos as $video) { ?>
		<li>
			<h2>
				<?php
				echo $video->get_nom();
                                ?>
                        </h2>
                        <img src="<?=BASEURL?>/images/miniature.png" height="180" width="320">
                        <?php echo 'Description : '.$video->get_description(); ?><br>
                        <?php echo 'Durée (en s) :'.$video->get_duree(); ?><br>
                        <?php echo 'Date de première diffusion : '.$video->get_premiere_diffusion(); ?><br>
                        <?php echo 'Date de dernière diffusion : '.$video->get_derniere_diffusion(); ?><br>
                        <?php echo 'Pays : '.$video->get_pays(); ?><br>
                        <?php echo 'Multi langue : '.$video->get_multi_langue(); ?><br>
                        <?php echo 'Format de l\'image : '.$video->get_format_image(); ?><br>
                        <?php echo 'Nom de l\'émission : '.$video->get_nom_emission(); ?><br>
                        <?php echo 'Numéro de l\'épisode : '.$video->get_numero(); ?><br>
                        <?php echo 'Disponibilité : '.$video->get_disponibilite(); ?><br>
                        <?php echo 'Nombre de vues : '.$video->get_vues(); ?><br>

			<!-- ajouter la vidéo dans ses favoris ou visionner -->
			<?php $nom_video = $video->get_nom(); ?>
			<?php $login = $u->get_login(); ?>
			<?php echo "<form action=\"".BASEURL."/index.php/historique/ajouter_historique\""." method = \"post\">"; ?>
				<?php echo "<input type=\"hidden\" name=\"LOGIN\" value=\"$login\">"; ?>
                                <?php echo "<input type=\"hidden\" name=\"NOM_VIDEO\" value=\"$nom_video\">"; ?>
                                <?php echo "<input type=\"submit\" value=\"Visionner la vidéo\">"; ?>
                        <?php echo "</form>"; ?>
                        <?php echo "<form action=\"".BASEURL."/index.php/favori/ajouter_favori\""." method = \"post\">"; ?>
				<?php echo "<input type=\"hidden\" name=\"LOGIN\" value=\"$login\">"; ?>
                                <?php echo "<input type=\"hidden\" name=\"NOM_FAVORI\" value=\"$nom_video\">"; ?>
                                <?php echo "<input type=\"submit\" value=\"Ajouter à mes favoris\">"; ?>
                        <?php echo "</form>"; ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
