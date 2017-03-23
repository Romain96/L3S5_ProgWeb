<h1 class="text-center">Administration : tous les abonnements</h1>
<?php if( empty($abonnements) ) { ?>

<p class="text-center">Il n'y a aucun abonnement dans la base :(</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($abonnements as $abonnement) { ?>
		<li>
			<h2>
				<?php
				echo $abonnement->get_nom_emission();
				?>
			</h2>
                        <?php echo 'login associé : '.$abonnement->get_login(); ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
