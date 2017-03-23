<h1 class="text-center">Modifier le profil</h1>

<form action="<?=BASEURL?>/index.php/utilisateur/modifier_profil" method="POST">

	<div class="formline">
		<?php $login = $u->get_login();?>
		<?php echo "<input type=\"hidden\" name=\"LOGIN\" value=\"$login\" id=\"LOGIN\"/><br>" ;?>
	</div>

	<div class="formline">
		<label for="MDP">Mot de passe : </label>
		<input type="password" name="MDP" placeholder="********" id="MDP"/><br>
	</div>

	<div class="formline">
		<label for="PRENOM">Prénom : </label>
		<input type="text" name="PRENOM" placeholder="********" id="PRENOM"/><br>
	</div>

	<div class="formline">
		<label for="NOM">Nom : </label>
		<input type="text" name="NOM" placeholder="********" id="NOM"/><br>
	</div>

	<div class="formline">
		<label for="DATE_NAISSANCE">Date de naissance : </label>
		<input type="text" name="DATE_NAISSANCE" placeholder="01/07/1996" id="DATE_NAISSANCE"/><br>
	</div>

	<div class="formline">
		<label for="EMAIL">Email : </label>
		<input type="text" name="EMAIL" placeholder="test@adresse.com" id="EMAIL"/><br>
	</div>

	<div class="formline">
		<label for="PAYS">Pays : </label>
		<input type="text" name="PAYS" placeholder="France" id="PAYS"/><br>
	</div>

	<div class="formline">
		<label for="NEWSLETTER">Abonnement à la newsletter : </label>
		<input type="radio" name="NEWSLETTER" value=1 checked> Oui
		<input type="radio" name="NEWSLETTER" value=0> Non<br>
	</div>

	<div class="formline">
		<label></label>
		<input type="submit" value="Modifier le profil">
	</div>
</form>
