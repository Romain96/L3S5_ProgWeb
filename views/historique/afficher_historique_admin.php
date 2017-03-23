<h1 class="text-center">Administration - visualiser les favoris d'un utilisateur</h1>
<?php if( empty($historiques) ) { ?>

<p class="text-center">Cet utilisateur n'a aucun historique</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($historiques as $historique) { ?>
		<li>
			<h2>
				<?php
				echo $historique->get_nom_video();
				?>
			</h2>
                        <?php echo 'date de visionnage : '.$historique->get_date_visionnage(); ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
