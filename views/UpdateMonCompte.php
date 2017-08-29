<?= $header ?>
<?php

 $id =$_POST['getid'];
            $user=new User();
            $bdd= new BddManager();
            $userRepository=$bdd->getUserRepository();
            $user = $userRepository->getUserById($id); 

           ?>

<form name="userId" method="POST" action="updateCompteService">
<table class="table">
 
  <tbody>
    <tr>
      <th scope="row">Nom</th>
      <td><input type="text" name="name" id="name"  tabindex="1" value="<?php if (isset($_POST['name'])){echo $_POST['name'];}else{ echo  $user->getName();} ?>" >
            <div id="errorname" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["name"])==false){echo $updateCompteService["name"];}}?>
            </div></td>
    </tr>

    <tr>
      <th scope="row">Prénom</th>
      <td> <input type="text" name="prenom" id="prenom"  tabindex="2" value="<?php if (isset($_POST['prenom'])){echo $_POST['prenom'];}else{ echo  $user->getPrenom();} ?>">
            <div id="errorprenom" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["prenom"])==false){echo $updateCompteService["prenom"];}}?>
            </div></td>
    </tr>
    
    <tr>
      <th scope="row">Pseudonyme</th>
      <td> <input type="text" name="pseudo" id="pseudo"  tabindex="3"
            value="<?php if (isset($_SESSION["tempPseudo"])){if ($_SESSION['tempPseudo'] != NULL){
                echo $_SESSION["tempPseudo"];}}else{ echo  $user->getPseudo();} ?>">
            <div id="errorpseudo" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["pseudo"])==false){echo $updateCompteService["pseudo"];}}?>
            </div></td>
    </tr>

     <tr>
      <th scope="row">Password</th>
      <td><input type="text" name="password" id="password"  tabindex="4" value="<?php if (isset($_POST['password'])){echo $_POST['password'];}else{ echo  $user->getPassword();}?>">
            <div id="errorpassword" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["password"])==false){echo $updateCompteService["password"];}}?>
            </div></td>
    </tr>
    <tr>
    <tr>
      <th scope="row">Validation Password</th>
      <td><input type="text" name="repassword" id="repassword"  tabindex="5" value="<?php if (isset($_POST['repassword'])){echo $_POST['repassword'];}else{ echo  $user->getPassword();}?>">
            <div id="errorrepassword" class="errors">
                <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["repassword"])==false){echo $updateCompteService["repassword"];}}?>
            </div></td>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td> <input type="text" name="mail" id="mail" placeholder="Votre Email *" tabindex="6"
            value="<?php if (isset($_SESSION["tempMail"])){if ($_SESSION['tempMail'] != NULL){
                echo $_SESSION["tempMail"];}}else{ echo  $user->getMail();} ?>">
            <div id="errormail" class="errors">
                 <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["mail"])==false){echo $updateCompteService["mail"];}}?>
            </div></td>
    </tr>
    <tr>
        <td></td>
        <input type="hidden" name="id" value="<?= $user->getId();?>">
             <input type="hidden" name="m" value="<?= $user->getMail();?>">
              <input type="hidden" name="p" value="<?= $user->getPseudo();?>">
        <input name="getid" type="hidden" value="<?=$user->getId()?>">
        <td><input id="envoi" type="submit" class="btn btn-info" value="Valider " >
       
    </td>
    </tr>
  </tbody>
</table>
</form> 

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformInscription.js"></script>