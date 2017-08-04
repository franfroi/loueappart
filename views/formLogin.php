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
    <div id="errorpseudo" class="errors "tabindex="100"></div>

    <p> <a href="#">*<span>Minimun <br />8 caractères</span> </a> </p>
    <input type="text" name="password" id="password" placeholder="Votre Mot de passe * " tabindex="2">
    <div id="errorpassword" class="errors"></div>

         

    </fieldset>

    

    <input type="submit" value="Envoyer" tabindex="3"/>
    </form>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<!-- <script src="js/scriptformLogin.js"></script> -->

<?php
 if(!empty($loginService)) {
     
          var_dump ($loginService);
          //echo "pseudo  ".$loginService["pseudo"];
          //echo "password  ".$loginService["password"];
          //echo "identifiants  ".$loginService["identifiants"];
         //echo $loginService->error["identifiants"];
      }
?>
</body>
</html>