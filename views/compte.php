<?php
if (!empty($id)){
            $user=new User();
            $bdd= new BddManager();
            $userRepository=$bdd->getUserRepository();
            $user = $userRepository->getUserById($id);
            $statut=new StatutUser();
            $statutRepository=$bdd->getStatutUserRepository();
            $statut = $statutRepository->getStatutByUser($user);
}      
else {
    $id=($_POST["id"]);
            $user=new User();
            $bdd= new BddManager();
            $userRepository=$bdd->getUserRepository();
           
             $user = $userRepository->getUserById($id);
            

}
    
?>
<?= $header ?>
<main>
<div class="form-style">
    <form action="updateCompteService" method="POST">
        <div class="titre">Formulaire Update</div>

        <fieldset>
            <legend><span class="nombre">#</span> Informations</legend>
            <label><span class="intitule"> Nom *</span></label>
            <a href="#">*<span> Nom <br /><br />Minimun <br />3 caractères</span> </a>
            <input type="text" name="name" id="name"  tabindex="1" value="<?php if (isset($_POST['name'])){echo $_POST['name'];}else{ echo  $user->getName();} ?>" >
            <div id="errorname" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["name"])==false){echo $updateCompteService["name"];}}?>
            </div>

            <label><span class="intitule">Prénom *</span></label>
            <a href="#">*<span>Prénom <br /><br />Minimun <br />3 caractères</span> </a> 
            <input type="text" name="prenom" id="prenom"  tabindex="2" value="<?php if (isset($_POST['prenom'])){echo $_POST['prenom'];}else{ echo  $user->getPrenom();} ?>">
            <div id="errorprenom" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["prenom"])==false){echo $updateCompteService["prenom"];}}?>
            </div>

            <label><span class="intitule">Pseudonyme *</span></label>
            <a href="#">*<span>Pseudonyme <br /><br />Minimun <br />8 caractères</span> </a>
            <input type="text" name="pseudo" id="pseudo"  tabindex="3"
            value="<?php if (isset($_SESSION["tempPseudo"])){if ($_SESSION['tempPseudo'] != NULL){
                echo $_SESSION["tempPseudo"];}}else{ echo  $user->getPseudo();} ?>">
            <div id="errorpseudo" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["pseudo"])==false){echo $updateCompteService["pseudo"];}}?>
            </div>

            <label><span class="intitule">Mot de passe *</span></label>
            <a href="#">*<span> Password <br /><br />Minimun <br />8 caractères</span> </a>
            <input type="text" name="password" id="password"  tabindex="4" value="<?php if (isset($_POST['password'])){echo $_POST['password'];}else{ echo  $user->getPassword();}?>">
            <div id="errorpassword" class="errors">
             <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["password"])==false){echo $updateCompteService["password"];}}?>
            </div>

            <label><span class="intitule">Confirmation Mot de passe *</span></label>
            <a href="#">*<span>Password identique</span> </a>
            <input type="text" name="repassword" id="repassword"  tabindex="5" value="<?php if (isset($_POST['repassword'])){echo $_POST['repassword'];}else{ echo  $user->getPassword();}?>">
            <div id="errorrepassword" class="errors">
                <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["repassword"])==false){echo $updateCompteService["repassword"];}}?>
            </div>

            <label><span class="intitule">Email *</span></label>
            <a href="#">*<span>Format mail<br /><br />abc@mail.com</span> </a>
            <input type="text" name="mail" id="mail" placeholder="Votre Email *" tabindex="6"
            value="<?php if (isset($_SESSION["tempMail"])){if ($_SESSION['tempMail'] != NULL){
                echo $_SESSION["tempMail"];}}else{ echo  $user->getMail();} ?>">
            <div id="errormail" class="errors">
                 <?php  if(!empty($updateCompteService)) {if (empty($updateCompteService["mail"])==false){echo $updateCompteService["mail"];}}?>
            </div>

            
            <input type="hidden" name="id" value="<?= $user->getId();?>">
             <input type="hidden" name="m" value="<?= $user->getMail();?>">
              <input type="hidden" name="p" value="<?= $user->getPseudo();?>">
           

        </fieldset>

             <input type="submit" value="Modifier" tabindex="6"/>
    </form>
</div>
</main>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformInscription.js"></script>
            