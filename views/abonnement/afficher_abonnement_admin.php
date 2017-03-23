<h1 class="text-center">Administration - Visualiser les abonnements d'un utilisateur</h1>
<?php if( empty($abonnements) ) { ?>

<p class="text-center">Cet utilisateur n'est abonné à aucune émission</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($abonnements as $abonnement) { ?>
		<li>
			<h2>
				<?php
				echo $abonnement->get_nom_emission();
				?>
			</h2>
		</li>
	<?php } ?>
</ul>

<?php } ?>
