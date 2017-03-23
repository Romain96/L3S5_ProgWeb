<h1 class="text-center">Administration - Ajouter une émission</h1>

<form action="<?=BASEURL?>/index.php/emission/creer_emission" method="POST">

	<div class="formline">
		<label for="NOM_EMISSION">Nom de l'émission : </label>
		<input type="text" name="NOM_EMISSION" placeholder="nom de l'émission" id="NOM_EMISSION"/><br>
	</div>

	<div class="formline">
		<label for="CATEGORIE">Catégorie de l'émission : </label>
		<input type="text" name="CATEGORIE" placeholder="catégorie" id="CATEGORIE"/><br>
	</div>

	<div class="formline">
		<label></label>
		<input type="submit" value="Ajouter l'émission">
	</div>
</form>
