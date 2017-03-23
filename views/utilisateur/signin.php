<h1 class="text-center">
	Se connecter<br>
</h1>
<p>Pas encore de compte ? --> <a href="<?=BASEURL?>/index.php/utilisateur/inscription">Créer un compte</a></p>
<form action="<?=BASEURL?>/index.php/utilisateur/connexion" method="POST">

	<div class="formline">
		<label for="LOGIN">Login : </label>
		<input type="text" name="LOGIN" placeholder="login" id="LOGIN"/><br>
	</div>

	<div class="formline">
		<label for="MDP">Mot de passe : </label>
		<input type="password" name="MDP" placeholder="********" id="MDP"/><br>
	</div>

	<div class="formline">
		<label></label>
		<input type="submit" value="Se connecter">
	</div>
</form>
