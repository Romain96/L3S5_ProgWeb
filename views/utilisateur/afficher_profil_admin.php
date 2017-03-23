<h1 class="text-center">Administration - Visualiser le profil</h1>
<?php if( empty($utilisateur) ) { ?>

<p class="text-center">Il n'y a aucun utilisateur dans la base :(</p>

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

                <!-- visionner les abonnements, les favoris et l'historique -->
                <?php $login = $utilisateur->get_login(); ?>
                <?php echo "<form action=\"".BASEURL."/index.php/historique/afficher_historique_admin\""." method = \"post\">"; ?>
                        <?php echo "<input type=\"hidden\" name=\"utilisateur\" value=\"$login\">"; ?>
                        <?php echo "<input type=\"submit\" value=\"voir l'historique\">"; ?>
                <?php echo "</form>"; ?>
                <?php echo "<form action=\"".BASEURL."/index.php/abonnement/afficher_abonnement_admin\""." method = \"post\">"; ?>
                        <?php echo "<input type=\"hidden\" name=\"utilisateur\" value=\"$login\">"; ?>
                        <?php echo "<input type=\"submit\" value=\"voir les abonnements\">"; ?>
                <?php echo "</form>"; ?>
                <?php echo "<form action=\"".BASEURL."/index.php/favori/afficher_favoris_admin\""." method = \"post\">"; ?>
                        <?php echo "<input type=\"hidden\" name=\"utilisateur\" value=\"$login\">"; ?>
                        <?php echo "<input type=\"submit\" value=\"voir les favoris\">"; ?>
                <?php echo "</form>"; ?>

                <!-- supprimer l'utilisateur -->
                <?php echo "<form action=\"".BASEURL."/index.php/utilisateur/supprimer_utilisateur\""." method = \"post\">"; ?>
                        <?php echo "<input type=\"hidden\" name=\"utilisateur\" value=\"$login\">"; ?>
                        <?php echo "<input type=\"submit\" value=\"Supprimer cet utilisateur\">"; ?>
                <?php echo "</form>"; ?>
	</li>
</ul>

<?php } ?>
