<?= $header ?>
<?php
if (isset($_SESSION["user"])){
$user=new User;
$user= $_SESSION["user"] ;

//echo $user->getId();

}

        $bdd= new BddManager;
        $AnnoncesRepository=$bdd->getAnnonceRepository();
        $Annonces = $AnnoncesRepository->getAnnonceByUser($user);
       

     foreach ($Annonces as $value) {
         
?>
 <form name="getannonceByUser" method="POST" action="oneAnnonce">
<table class="table table-hover">
       
  <thead>
    <tr>
      <th><?=$value->getId()?></th>
      <th>Type de bien</th>
      <th>Ville</th>
      <th>Nombre chambres</th>
      <th>Superficie</th>
      <th>Prix</th>
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
      </tr>
         <tr>
        <input name="getid" type="hidden" value="<?=$value->getId()?>">
        <td> <input id="envoi" type="submit" class="btn btn-info" value="Voir annonce">
        <td> <input id="envoi" type="submit" class="btn btn-info" value="Modifier annonce" formaction="UpdateAnnonce">
        <td> <input id="envoi" type="submit" class="btn btn-info" value="Supprimer annonce"formaction="DeleteAnnonce">
        </tr>
  
  </tbody>


  
          </table> 
          </form>
  <?php 
 } 


 
 
 ?>

  
   
       
   

