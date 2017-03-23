<h1 class="text-center">Administration - visualiser les favoris d'un utilisateur</h1>
<?php if( empty($favoris) ) { ?>

<p class="text-center">Cet utilisateur n'a aucun favori</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($favoris as $favori) { ?>
		<li>
			<h2>
				<?php
				echo $favori->get_nom_favori();
				?>
			</h2>
		</li>
	<?php } ?>
</ul>

<?php } ?>
