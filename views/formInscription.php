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
    <form action="" method="POST">
    <div class="titre">Formulaire Inscription</div>

    <fieldset>
    <legend><span class="nombre">#</span> Informations</legend>

    <p> <a href="#">*<span>Minimun <br />3 caractères</span> </a> </p>
    <input type="text" name="name" id="name" placeholder="Votre Nom * " tabindex="1">
    <div id="errorname" class="errors"></div>

    <p> <a href="#">*<span>Minimun <br />3 caractères</span> </a> </p>
    <input type="text" name="prenom" id="prenom" placeholder="Votre Prenom * " tabindex="2">
    <div id="errorprenom" class="errors"></div>

    <p> <a href="#">*<span>Minimun <br />8 caractères</span> </a> </p>
    <input type="text" name="pseudo" id="pseudo" placeholder="Votre Pseudonyme * " tabindex="2">
    <div id="errorpseudo" class="errors"></div>

    <p> <a href="#">*<span>Minimun <br />8 caractères</span> </a> </p>
    <input type="text" name="password" id="password" placeholder="Votre Mot de passe * " tabindex="3">
    <div id="errorpassword" class="errors"></div>

    <p> <a href="#">*<span>Password identique</span> </a> </p>
    <input type="text" name="repassword" id="repassword" placeholder="Retapez votre Mot de passe * " tabindex="4">
    <div id="errorrepassword" class="errors"></div>

    <p> <a href="#">*<span>Format mail<br />abc@mail.com</span> </a> </p>
    <input type="text" name="mail" id="mail" placeholder="Votre Email *" tabindex="5">
    <div id="errormail" class="errors"></div>

       

    </fieldset>

    

    <input type="submit" value="Envoyer" tabindex="6"/>
    </form>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/scriptformInscription.js"></script>
</body>
</html>