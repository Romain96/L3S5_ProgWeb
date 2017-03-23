<h1 class="text-center">Administration - toutes les émissions</h1>

<h2 class="text-center">
	<a href="<?=BASEURL?>/index.php/emission/creer_emission">Ajouter une émission</a>
</h2>

<?php if( empty($emissions) ) { ?>

<p class="text-center">Il n'y a pas encore de d'émissions :(</p>

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
	                <?php $nom_emission = $emission->get_nom_emission(); ?>
	                <?php echo "<form action=\"".BASEURL."/index.php/emission/afficher_emission_admin\""." method = \"post\">"; ?>
	                        <?php echo "<input type=\"hidden\" name=\"nom_emission\" value=\"$nom_emission\">"; ?>
	                        <?php echo "<input type=\"submit\" value=\"voir cette émission\">"; ?>
	                <?php echo "</form>"; ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
