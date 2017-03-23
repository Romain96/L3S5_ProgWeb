<h1 class="text-center">Mes abonnements</h1>
<?php if( empty($abonnements) ) { ?>

<p class="text-center">Vous n'êtes abonné à aucune émission pour l'instant</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($abonnements as $abonnement) { ?>
		<li>
			<h2>
				<?php
				echo $abonnement->get_nom_emission();
				?>
			</h2>
                        <?php echo $abonnement->get_login(); ?>
			<!-- supprimer de ses abonnements -->
			<?php $login = $u->get_login(); ?>
			<?php $nom = $abonnement->get_nom_emission(); ?>
			<?php echo "<form action=\"".BASEURL."/index.php/abonnement/supprimer_abonnement\""." method = \"post\">"; ?>
				<?php echo "<input type=\"hidden\" name=\"LOGIN\" value=\"$login\">"; ?>
				<?php echo "<input type=\"hidden\" name=\"NOM_EMISSION\" value=\"$nom\">"; ?>
				<?php echo "<input type=\"submit\" value=\"Retirer de mes abonnements\">"; ?>
			<?php echo "</form>"; ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
