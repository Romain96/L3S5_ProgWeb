<h1 class="text-center">Mon historique</h1>
<?php if( empty($historiques) ) { ?>

<p class="text-center">Vous n'avez aucun historique pour l'instant</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($historiques as $historique) { ?>
		<li>
			<h2>
				<?php
				echo $historique->get_nom_video();
				?>
			</h2>
                        <?php echo 'date de visionnage : '.date("d/m/Y H:i:s",strtotime($historique->get_date_visionnage())); ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
