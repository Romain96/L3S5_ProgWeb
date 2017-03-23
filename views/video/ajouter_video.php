<h1 class="text-center">Administration - ajouter une vidéo</h1>

<form action="<?=BASEURL?>/index.php/video/creer_video" method="POST">

	<div class="formline">
		<label for="NOM">Nom de la vidéo : </label>
		<input type="text" name="NOM" placeholder="nom de la vidéo" id="NOM"/><br>
	</div>

	<div class="formline">
		<label for="DESCRIPTION">Description : </label>
		<input type="text" name="DESCRIPTION" placeholder="description" id="DESCRIPTION"/><br>
	</div>

	<div class="formline">
		<label for="DUREE">Durée en s : </label>
		<input type="text" name="DUREE" placeholder="durée en s" id="DUREE"/><br>
	</div>

	<div class="formline">
		<label for="PREMIERE_DIFFUSION">Année de première diffusion : </label>
		<input type="text" name="PREMIERE_DIFFUSION" placeholder="année de première diffusion" id="PREMIERE_DIFFUSION"/><br>
	</div>

	<div class="formline">
		<label for="DERNIERE_DIFFUSION">Date de dernière diffusion : </label>
		<input type="text" name="DERNIERE_DIFFUSION" placeholder="12/12/2016" id="DERNIERE_DIFFUSION"/><br>
	</div>

	<div class="formline">
		<label for="PAYS">Pays : </label>
		<input type="text" name="PAYS" placeholder="France" id="PAYS"/><br>
	</div>

	<div class="formline">
		<label for="MULTI_LANGUE">Multi langue : </label>
		<input type="radio" name="MULTI_LANGUE" value=1 checked> Oui
		<input type="radio" name="MULTI_LANGUE" value=0> Non<br>
	</div>

        <div class="formline">
		<label for="FORMAT_IMAGE">Format de l'image : </label>
		<input type="text" name="FORMAT_IMAGE" placeholder="16:9" id="FORMAT_IMAGE"/><br>
	</div>

        <div class="formline">
		<label for="NOM_EMISSION">Nom de l'émission : </label>
		<input type="text" name="NOM_EMISSION" placeholder="nom de l'émission" id="NOM_EMISSION"/><br>
	</div>

        <div class="formline">
		<label for="NUMERO">Numéro de l'épisode : </label>
		<input type="text" name="NUMERO" placeholder="numéro" id="NUMERO"/><br>
	</div>

        <div class="formline">
		<label for="DISPONIBILITE">Date de disponibilité : </label>
		<input type="text" name="DISPONIBILITE" placeholder="date de disponibilite" id="DISPONIBILITE"/><br>
	</div>

        <div class="formline">
		<label for="VUES">Nombre de vues : </label>
		<input type="text" name="VUES" placeholder="0" id="VUES"/><br>
	</div>

	<div class="formline">
		<label></label>
		<input type="submit" value="Ajouter la vidéo">
	</div>
</form>
