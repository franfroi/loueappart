<?= $header ?>

<?php
if (isset($_POST["getid"])){

        $bdd= new BddManager;
        $AnnoncesRepository=$bdd->getAnnonceRepository();
        $oneAnnonce = $AnnoncesRepository->getAnnonceById($_POST["getid"]);
   }     
if (isset($_SESSION["lastInsertAnnonce"])){
            $bdd= new BddManager;
        $AnnoncesRepository=$bdd->getAnnonceRepository();
        $oneAnnonce = $AnnoncesRepository->getAnnonceById($_SESSION["lastInsertAnnonce"]);
         unset($_SESSION["lastInsertAnnonce"] );
       }
    
          
?>



<table class="table table-hover">
  <thead>
    <tr>
      <th><?=$oneAnnonce->getId()?></th>
      <th>Type de bien</th>
      <th>Ville</th>
      <th>Nombre chambres</th>
      <th>Superficie</th>
      <th>Prix/ jour</th>
      <th>Description</th>
       <?php

if (isset($_SESSION["user"])){ ?>
           <td> <input id="envoi" type="submit" class="btn btn-info" value="Louer" formaction="faireLocation"></td>
             <input name="id" type="hidden"  value="<?=$oneAnnonce->getId()?>" >
 <?php      }
?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td> <?=$oneAnnonce->getType()?></td>
      <td> <?=$oneAnnonce->getVille()?></td>
      <td><?=$oneAnnonce->getChambre()?></td>
      <td><?=$oneAnnonce->getSuperficie()?></td>
      <td><?=$oneAnnonce->getPrix()?></td>
       <td><?=$oneAnnonce->getDescription()?></td>
      
     
     
    </tr>
 
  </tbody>
</table>

<div class="foto">
  <?= '<img src="Images/'.$oneAnnonce->getFoto1().'" width="300" height="300">';?>
</div>
<div class="foto">
  <?= '<img src="Images/'.$oneAnnonce->getFoto2().'" width="300" height="300">';?>
</div>
<div class="foto">
  <?= '<img src="Images/'.$oneAnnonce->getFoto3().'" width="300" height="300">';?>

</div>

 




 
   
       
   

