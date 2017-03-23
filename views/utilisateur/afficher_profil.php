<h1 class="text-center">Mon profil</h1>
<?php if( empty($utilisateur) ) { ?>

<p class="text-center">Vous n'avez pas de profil (???)</p>

<?php } else { ?>

<ul class="squarelist">
	<li>
		<h2>
			<?php
			echo $utilisateur->get_prenom().' '.$utilisateur->get_nom();
			?>
		</h2>
                <?php echo 'Login : '.$utilisateur->get_login(); ?><br>
                <?php echo 'Mot de passe : '.$utilisateur->get_mdp(); ?><br>
                <?php echo 'Date de naissance : '.$utilisateur->get_date_naissance(); ?><br>
                <?php echo 'Email : '.$utilisateur->get_email(); ?><br>
                <?php echo 'Pays : '.$utilisateur->get_pays(); ?><br>
                <?php echo 'Newsletter : '.$utilisateur->get_newsletter(); ?>

                <!-- modifier son profil -->
                <?php echo "<form action=\"".BASEURL."/index.php/utilisateur/modifier_profil\""." method = \"get\">"; ?>
                        <?php echo "<input type=\"submit\" value=\"Modifier mon profil\">"; ?>
                <?php echo "</form>"; ?>
	</li>
</ul>

<?php } ?>
