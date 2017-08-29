<?= $header ?>
<main>

<form name="insertAnnonce" method="POST" action="AnnonceRegisterSercice" enctype="multipart/form-data">
 
  <div class="form-group">
    <label for="type">Type de bien</label>
    <select class="form-control" id="type" name="type">
      <option value="Maison">Maison</option>
      <option value="Appartement">Appartement</option>
     
    </select>
  </div>

<div class="form-group">
    <label for="chambre">Nombre Chambres</label>
    <select class="form-control" id="chambretype" name="chambre">
       <option value="1">1</option> 
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5 et plus</option>
     
    </select>
  </div>

  
  <div class="form-group">
    <label for="description">description</label>
    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
  </div>

  <div class="form-group">
    <label for="superficie">Superficie</label>
    <input type="text" class="form-control" id="superficie" name="superficie">
  </div>

  <div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" class="form-control" id="Ville" name="ville">
  </div>

  <div class="form-group">
    <label for="prix">Prix par jour</label>
    <input type="text" class="form-control" id="prix" name="prix">
  </div>

  <div class="form-group">
    <label for="dateDebut">Date Debut de location possible</label>
    <input type="date" class="form-control" id="dateDebut" name="dateDebut">
  </div>

  <div class="form-group">
    <label for="dateFin">Date de Fin location </label>
    <input type="date" class="form-control" id="dateFin" name="dateFin">
  </div>
  
  <div class="form-group">
    <label for="foto1">Photo 1 de votre bien</label>
    <input type="file" class="form-control-file" id="foto1" name="foto1" aria-describedby="fileHelp">
    <small id="foto1" class="form-text text-muted">Le poids de la photo ne doit pas execeder 1 Mega octet</small>
  </div>
  <div class="form-group">
    <label for="foto2">Photo 2 de votre bien</label>
    <input type="file" class="form-control-file" id="foto2" name="foto2" aria-describedby="fileHelp">
    <small id="foto2" class="form-text text-muted">Le poids de la photo ne doit pas execeder 1 Mega octet</small>
  </div>
  
  <div class="form-group">
    <label for="foto3">Photo 3 de votre bien</label>
    <input type="file" class="form-control-file" id="foto3" name="foto3" aria-describedby="fileHelp">
    <small id="foto3" class="form-text text-muted">Le poids de la photo ne doit pas execeder 1 Mega octet</small>
  </div>
  
 <div class="form-group">
  <button type="submit" class="btn btn-primary">Envoyer</button>
  <div>
</form>


</main>
<!-- <script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformInscription.js"></script> -->

<?= $footer ?>