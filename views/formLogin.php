<?= $header ?>

<main>
<div class="form-style">
    <form action="loginService" method="POST">
        <div class="titre">Sign in</div>

        <fieldset>
            <legend><span class="nombre">#</span> Informations</legend>
            <label><span class="intitule">Votre Pseudonyme *</span></label>
            <a href="#">*<span>Minimun <br />8 caractères</span> </a> 
            
            <input type="text" name="pseudo" id="pseudo" placeholder="Votre Pseudonyme * " tabindex="1">
            <div id="errorpseudo" class="errors "tabindex="100">
            <?php  if(!empty($loginService)) {if (empty($loginService["pseudo"])==false){echo $loginService["pseudo"];}}?>
            </div>

            <label><span class="intitule">Votre Password *</span></label>
            <a href="#">*<span>Minimun <br />8 caractères</span> </a>
            <input type="text" name="password" id="password" placeholder="Votre Mot de passe * " tabindex="2">
            <div id="errorpassword" class="errors">
            <?php  if(!empty($loginService)) {if (empty($loginService["password"])==false){echo $loginService["password"];}}?>
            
            <?php  if(!empty($loginService)) {if (empty($loginService["identifiants"])==false){echo $loginService["identifiants"];}}?>    
            </div>
        </fieldset>

            <input type="submit" value="Envoyer" tabindex="3"/>
    </form>
</div>
</main>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformLogin.js"></script> 


<?= $footer ?>