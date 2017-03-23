<h1 class="text-center">Administration - Tous les favoris</h1>
<?php if( empty($favoris) ) { ?>

<p class="text-center">Il n'y a aucun favori dans la base :(</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($favoris as $favori) { ?>
		<li>
			<h2>
				<?php
				echo $favori->get_nom_favori();
				?>
			</h2>
                        <?php echo 'Utilisateur associé : '.$favori->get_login(); ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
