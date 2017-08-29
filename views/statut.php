<?= $header ?>
 <table>
  <tr>
    <th>Nom</th>
    <th>Prenom</th> 
    <th>Pseudo</th>
    <th>Mail</th>
     <th>Statut</th>
  </tr>
<?php
        $bdd= new BddManager;
        $usersRepository=$bdd->getUserRepository();
        $users = $usersRepository->getAlluser();
        
        foreach ($users as $value)
        {
             
?>                    
   <!--on envoie dans un form pour poster $sujet_id-->

    <form method="POST" action="UpdateUser" >      
  <tr>
    <td><?=$value["name"];?></td>
    <td><?=$value["prenom"];?></td> 
    <td><?=$value["pseudo"];?></td>
    <td><?=$value["mail"];?></td>
    <td><?=$value["statut"];?></td>
    <input type='hidden' name='modif' id='modif' value='<?=$value['id'] ?>'>
    <td><input type="submit" value="Modifier"/></td>
    <td><input type="submit" value="Supprimer" formaction="DeleteUser"/></td>
  </tr>


</form>
<?php
}
?>
  </table>       

