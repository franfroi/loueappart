<?= $header ?>

<?php


        $bdd= new BddManager;
        $AnnoncesRepository=$bdd->getAnnonceRepository();
        $Annonces = $AnnoncesRepository->getAllAnnonce();
        
        if (!empty($Annonces)){

     foreach ($Annonces as $value) {
          
?>


 <form name="getannonce" method="POST" action="oneAnnonce">
<table class="table table-hover">
       
  <thead>
    <tr>
      <th><?=$value->getId()?></th>
      <th>Type de bien</th>
      <th>Ville</th>
      <th>Nombre chambres</th>
      <th>Superficie</th>
      <th>Prix / jour</th>
    </tr>
  </thead>
  <tbody>
 
    <tr>
           
      <th scope="row"><?= '<img src="Images/'.$value->getFoto1().'"  width="100" height="100">';?></th>
      <td> <?=$value->getType()?></td>
      <td> <?=$value->getVille()?></td>
      <td><?=$value->getChambre()?></td>
      <td><?=$value->getSuperficie()?></td>
      <td><?=$value->getPrix()?></td>
        <input name="getid" type="hidden" value="<?=$value->getId()?>">
      <td> <input id="envoi" type="submit" class="btn btn-info" value="Voir annonce">
    </tr>
  
  </tbody>


  
          </table> 
          </form>
  <?php 
 } }

        
 
 
 ?>

  
   
       
   

