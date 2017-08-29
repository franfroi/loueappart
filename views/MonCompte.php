<?= $header ?>
<?php
            $user=new User();
            $user= $_SESSION["user"] ;
            $bdd= new BddManager();
            $id=$user->getId();
            $userRepository=$bdd->getUserRepository();
            $user = $userRepository->getUserById($id);
?>

<form name="userId" method="POST">
<table class="table">
 
  <tbody>
    <tr>
      <th scope="row">Nom</th>
      <td><?=$user->getName();?></td>
    </tr>

    <tr>
      <th scope="row">Prénom</th>
      <td><?=$user->getPrenom();?></td>
    </tr>
    
    <tr>
      <th scope="row">Pseudonyme</th>
      <td><?=$user->getPseudo();?></td>
    </tr>

     <tr>
      <th scope="row">Password</th>
      <td><?=$user->getPassword();?></td>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td><?=$user->getMail();?></td>
    </tr>
    <tr>
        <td></td>
        
        <input name="getid" type="hidden" value="<?=$user->getId()?>">
        <td><input id="envoi" type="submit" class="btn btn-info" value="Modifier " formaction="UpdateMonCompte">
         <input id="envoi" type="submit" class="btn btn-info" value="Supprimer "formaction="DeleteUserid">
    </td>
    </tr>
  </tbody>
</table>
</form>