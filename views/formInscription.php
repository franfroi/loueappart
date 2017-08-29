<?= $header ?>
<main>
<div class="form-style">
    <form action="registerService" method="POST">
        <div class="titre">Formulaire Inscription</div>

        <fieldset>
            <legend><span class="nombre">#</span> Informations</legend>
            <label><span class="intitule">Votre Nom *</span></label>
            <a href="#">*<span> Nom <br /><br />Minimun <br />3 caractères</span> </a>
            <input type="text" name="name" id="name" placeholder="Votre Nom * " tabindex="1" value="<?php if (isset($_POST['name'])){echo $_POST['name'];} ?>" >
            <div id="errorname" class="errors">
             <?php  if(!empty($registerService)) {if (empty($registerService["name"])==false){echo $registerService["name"];}}?>
            </div>

            <label><span class="intitule">Votre Prénom *</span></label>
            <a href="#">*<span>Prénom <br /><br />Minimun <br />3 caractères</span> </a> 
            <input type="text" name="prenom" id="prenom" placeholder="Votre Prenom * " tabindex="2" value="<?php if (isset($_POST['prenom'])){echo $_POST['prenom'];} ?>">
            <div id="errorprenom" class="errors">
             <?php  if(!empty($registerService)) {if (empty($registerService["prenom"])==false){echo $registerService["prenom"];}}?>
            </div>

            <label><span class="intitule">Votre Pseudonyme *</span></label>
            <a href="#">*<span>Pseudonyme <br /><br />Minimun <br />8 caractères</span> </a>
            <input type="text" name="pseudo" id="pseudo" placeholder="Votre Pseudonyme * " tabindex="3"
            value="<?php if (isset($_SESSION["tempPseudo"])){if ($_SESSION['tempPseudo'] != NULL){
                echo $_SESSION["tempPseudo"];}} ?>">
            <div id="errorpseudo" class="errors">
             <?php  if(!empty($registerService)) {if (empty($registerService["pseudo"])==false){echo $registerService["pseudo"];}}?>
            </div>

            <label><span class="intitule">Votre mot de passe *</span></label>
            <a href="#">*<span> Password <br /><br />Minimun <br />8 caractères</span> </a>
            <input type="text" name="password" id="password" placeholder="Votre Mot de passe * " tabindex="4">
            <div id="errorpassword" class="errors">
             <?php  if(!empty($registerService)) {if (empty($registerService["password"])==false){echo $registerService["password"];}}?>
            </div>

            <label><span class="intitule">Confirmation de votre mot de passe *</span></label>
            <a href="#">*<span>Password identique</span> </a>
            <input type="text" name="repassword" id="repassword" placeholder="Retapez votre Mot de passe * " tabindex="5">
            <div id="errorrepassword" class="errors">
                <?php  if(!empty($registerService)) {if (empty($registerService["repassword"])==false){echo $registerService["repassword"];}}?>
            </div>

            <label><span class="intitule">Votre Email *</span></label>
            <a href="#">*<span>Format mail<br /><br />abc@mail.com</span> </a>
            <input type="text" name="mail" id="mail" placeholder="Votre Email *" tabindex="6"
            value="<?php if (isset($_SESSION["tempMail"])){if ($_SESSION['tempMail'] != NULL){
                echo $_SESSION["tempMail"];}} ?>">
            <div id="errormail" class="errors">
                 <?php  if(!empty($registerService)) {if (empty($registerService["mail"])==false){echo $registerService["mail"];}}?>
            </div>
     

        </fieldset>

             <input type="submit" value="Envoyer" tabindex="6"/>
    </form>
</div>
</main>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformInscription.js"></script>

<?= $footer ?>