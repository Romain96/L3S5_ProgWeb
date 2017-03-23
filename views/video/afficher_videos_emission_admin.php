<h1 class="text-center">Administration - visualiser les vidéos d'une émission</h1>

<?php if( empty($videos) ) { ?>

<p class="text-center">Cette émission ne comporte pas de vidéos :(</p>

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
                        <!-- supprimer -->
                        <?php $nom_video = $video->get_nom(); ?>
                        <?php echo "<form action=\"".BASEURL."/index.php/video/supprimer_video\""." method = \"post\">"; ?>
                                <?php echo "<input type=\"hidden\" name=\"nom_video\" value=\"$nom_video\">"; ?>
                                <?php echo "<input type=\"submit\" value=\"Supprimer cette vidéo\">"; ?>
                        <?php echo "</form>"; ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
