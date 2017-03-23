<h1 class="text-center">Administration - Tous les historiques</h1>
<?php if( empty($historiques) ) { ?>

<p class="text-center">Il n'y a aucun historique dans la base :(</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($historiques as $historique) { ?>
		<li>
			<h2>
				<?php
				echo $historique->get_nom_video();
				?>
			</h2>
                        <?php echo 'Utilisateur associé : '.$historique->get_login(); ?>
                        <?php echo 'date de visionnage : '.$historique->get_date_visionnage(); ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
