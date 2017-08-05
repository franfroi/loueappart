<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
    
    <title>form</title>
</head>
<body>
<div class="form-style">
    <form action="registerService" method="POST">
    <div class="titre">Formulaire Inscription</div>

    <fieldset>
    <legend><span class="nombre">#</span> Informations</legend>

    <p> <a href="#">*<span> Nom <br /><br />Minimun <br />3 caractères</span> </a> </p>
    <input type="text" name="name" id="name" placeholder="Votre Nom * " tabindex="1">
    <div id="errorname" class="errors">
    <?php  if(!empty($registerService)) {if (empty($registerService["name"])==false){echo $registerService["name"];}}?>
    </div>

    <p> <a href="#">*<span>Prénom <br /><br />Minimun <br />3 caractères</span> </a> </p>
    <input type="text" name="prenom" id="prenom" placeholder="Votre Prenom * " tabindex="2">
    <div id="errorprenom" class="errors">
    <?php  if(!empty($registerService)) {if (empty($registerService["prenom"])==false){echo $registerService["prenom"];}}?>
    </div>

    <p> <a href="#">*<span>Pseudonyme <br /><br />Minimun <br />8 caractères</span> </a> </p>
    <input type="text" name="pseudo" id="pseudo" placeholder="Votre Pseudonyme * " tabindex="3">
    <div id="errorpseudo" class="errors">
    <?php  if(!empty($registerService)) {if (empty($registerService["pseudo"])==false){echo $registerService["pseudo"];}}?>
    </div>

    <p> <a href="#">*<span> Password <br /><br />Minimun <br />8 caractères</span> </a> </p>
    <input type="text" name="password" id="password" placeholder="Votre Mot de passe * " tabindex="4">
    <div id="errorpassword" class="errors">
    <?php  if(!empty($registerService)) {if (empty($registerService["password"])==false){echo $registerService["password"];}}?>
    </div>


    <p> <a href="#">*<span>Password identique</span> </a> </p>
    <input type="text" name="repassword" id="repassword" placeholder="Retapez votre Mot de passe * " tabindex="5">
    <div id="errorrepassword" class="errors">
     <?php  if(!empty($registerService)) {if (empty($registerService["repassword"])==false){echo $registerService["repassword"];}}?>
    </div>

    <p> <a href="#">*<span>Format mail<br /><br />abc@mail.com</span> </a> </p>
    <input type="text" name="mail" id="mail" placeholder="Votre Email *" tabindex="6">
    <div id="errormail" class="errors">
     <?php  if(!empty($registerService)) {if (empty($registerService["mail"])==false){echo $registerService["mail"];}}?>
    </div>

       

    </fieldset>

    

    <input type="submit" value="Envoyer" tabindex="6"/>
    </form>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformInscription.js"></script>
</body>
</html>