<h1 class="text-center">Toutes les émissions disponibles</h1>

<?php if( empty($emissions) ) { ?>

<p class="text-center">Il n'y a pas encore de d'émissions...</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach ($emissions as $emission) { ?>
		<li>
			<h2>
				<?php
				echo $emission->get_nom_emission();
                                ?>
                        </h2>
                        <?php echo 'Catégorie : '.$emission->get_categorie(); ?>
			<!-- voir les vidéos associées -->
	                <?php $nom = $emission->get_nom_emission(); ?>
	                <?php echo "<form action=\"".BASEURL."/index.php/emission/afficher_emission\""." method = \"post\">"; ?>
	                        <?php echo "<input type=\"hidden\" name=\"nom_emission\" value=\"$nom\">"; ?>
	                        <?php echo "<input type=\"submit\" value=\"voir l'émission\">"; ?>
	                <?php echo "</form>"; ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
