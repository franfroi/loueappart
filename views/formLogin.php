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
    <form action="loginService" method="POST">
    <div class="titre">Formulaire Login</div>

    <fieldset>
    <legend><span class="nombre">#</span> Informations</legend>
   
    <p> <a href="#">*<span>Minimun <br />8 caractères</span> </a> </p>
    <input type="text" name="pseudo" id="pseudo" placeholder="Votre Pseudonyme * " tabindex="1">
    <div id="errorpseudo" class="errors "tabindex="100">
    <?php  if(!empty($loginService)) {if (empty($loginService["pseudo"])==false){echo $loginService["pseudo"];}}?>
    </div>
    <p> <a href="#">*<span>Minimun <br />8 caractères</span> </a> </p>
    <input type="text" name="password" id="password" placeholder="Votre Mot de passe * " tabindex="2">
    <div id="errorpassword" class="errors">
    <?php  if(!empty($loginService)) {if (empty($loginService["password"])==false){echo $loginService["password"];}}?>
    
    <?php  if(!empty($loginService)) {if (empty($loginService["identifiants"])==false){echo $loginService["identifiants"];}}?>    
</div>
    </fieldset>

    

    <input type="submit" value="Envoyer" tabindex="3"/>
    </form>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
 <script src="js/scriptformLogin.js"></script> 


</body>
</html>