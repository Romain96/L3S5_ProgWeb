<h1 class="text-center">Administration - visualiser une émission</h1>

<?php if( empty($emission) ) { ?>

<p class="text-center">Cette émission n'existe pas :(</p>

<?php } else { ?>

<ul class="squarelist">
	<li>
		<h2>
			<?php
			echo $emission->get_nom_emission();
                        ?>
                </h2>
                <?php echo 'Catégorie : '.$emission->get_categorie(); ?>
                <!-- voir les vidéos associées ou supprimer l'émission -->
                <?php $nom = $emission->get_nom_emission(); ?>
                <?php echo "<form action=\"".BASEURL."/index.php/video/afficher_videos_emission_admin\""." method = \"post\">"; ?>
                        <?php echo "<input type=\"hidden\" name=\"nom_emission\" value=\"$nom\">"; ?>
                        <?php echo "<input type=\"submit\" value=\"voir les vidéos de cette émission\">"; ?>
                <?php echo "</form>"; ?>
                <?php echo "<form action=\"".BASEURL."/index.php/emission/supprimer_emission\""." method = \"post\">"; ?>
                        <?php echo "<input type=\"hidden\" name=\"nom_emission\" value=\"$nom\">"; ?>
                        <?php echo "<input type=\"submit\" value=\"Supprimer cette émission\">"; ?>
                <?php echo "</form>"; ?>
	</li>
</ul>

<?php } ?>
