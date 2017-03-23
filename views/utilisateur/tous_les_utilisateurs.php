<h1 class="text-center">Administration - Tous les utilisateurs</h1>
<?php if( empty($utilisateurs) ) { ?>

<p class="text-center">Il n'y a aucun utilisateur dans la base :(</p>

<?php } else { ?>

<ul class="squarelist">
	<?php foreach($utilisateurs as $utilisateur) { ?>
		<li>
			<h2>
				<?php
				echo $utilisateur->get_prenom().' '.$utilisateur->get_nom();
				?>
			</h2>
                        <?php echo '('.$utilisateur->get_login().')'; ?><br>
			<?php echo "<form action=\"".BASEURL."/index.php/utilisateur/afficher_profil_admin\""." method = \"post\">"; ?>
				<?php $login = $utilisateur->get_login(); ?>
  				<?php echo "<input type=\"hidden\" name=\"utilisateur\" value=\"$login\">"; ?>
  				<?php echo "<input type=\"submit\" value=\"voir le profil\">"; ?>
			<?php echo "</form>"; ?>
		</li>
	<?php } ?>
</ul>

<?php } ?>
