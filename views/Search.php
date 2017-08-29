<?= $header ?>
<main>
<?php
 $bdd= new BddManager;
        $AnnoncesRepository=$bdd->getAnnonceRepository();
        $Annonces = $AnnoncesRepository->getAllAnnonce();
        
        if (!empty($Annonces)){
?>
<form name="Search" method="POST" action="SearchService">
 
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
    <label for="ville">Ville</label>
    <input type="text" class="form-control" id="Ville" name="ville">
  </div>

  <div class="form-group">
    <label for="prix">Prix par jour</label>
    <input type="text" class="form-control" id="prix" name="prix">
  </div>

 
  
 <div class="form-group">
  <button type="submit" class="btn btn-primary">Envoyer</button>
  <div>
</form>


</main>
<?php
        }
        else{?>
          <div class="form-group">
    <label for="annonce">Pas D'annonces</label>
   
     
  
  </div>
  <?php
        }
?>