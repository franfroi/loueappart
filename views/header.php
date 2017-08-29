<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
   <link rel="stylesheet" href="style/style.css">
    <title><?=$heading; ?></title>
   
</head>
<body>
<?php
//si non connecter
//les boutons s'affichent
$logout="";
$DepotAnnonce="";
$moncompte="";
$mesannonces="";
 //$creersujet="";
 //les boutons s'affichent
 $connect='<li>'.'<a href="formLogin"  >'.'Se connecter'.'</a>'.'</li>';
 $compte='<li>'.'<a href="formInscription"  >'.'Créer compte'.'</a>'.'</li>';
  $search='<li>'.'<a href="Search"  >'.'Rechercher une annonce'.'</a>'.'</li>';
//si connecter

if(isset($_SESSION['user'])){
   // $id=$_SESSION['user'];
   //les boutons disparaissent
    $connect="";
    $compte="";
  
    //les boutons s'affichent
    $logout='<li>'.'<a href="logout"  >'.'Se deconnecter'.'</a>'.'</li>';
    $DepotAnnonce='<li>'.'<a href="FormAnnonce"  >'.'Déposer votre Annonce'.'</a>'.'</li>';
    $moncompte='<li>'.'<a href="MonCompte"  >'.'Mon compte'.'</a>'.'</li>';
            
            $user=new User();
            $user= $_SESSION["user"] ;
            $bdd= new BddManager();
            $id=$user->getId();
            
            $userRepository=$bdd->getUserRepository();
            $user = $userRepository->getUserById($id);

            $userRepository=$bdd->getAnnonceRepository();
            $user = $userRepository->getAnnonceByUser($user);
           
if ($user!=false){

    $mesannonces='<li>'.'<a href="MesAnnonces"  >'.'Biens Proposés'.'</a>'.'</li>';
}}
?>
<nav class="navbar navbar-inverse navbar-fixed-top " role="navigation"> 
         	<div class="navbar-header">   
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
             <a id="titre_site" class="navbar-brand" href="#header"> R&B</a>
                
			</div>

            <div class="collapse navbar-collapse ">
                <ul class="nav navbar-nav ">
                        <li ><a href="accueil">Accueil</a></li>
                             <?php echo $search;?>
                            <?php echo $compte;?>
                            <?php echo $connect;?>
                            <?php echo $DepotAnnonce;?>
                            <?php echo $mesannonces;?>
                            <?php echo $moncompte;?>
                            <?php echo $logout;?>
                            
                        
                </ul>
            </div>
        
</nav>
<br><br>
<br><br>
<?php
if (isset($_SESSION["user"])){
$user=new User;
$user= $_SESSION["user"] ;

//echo $user->getId();
echo "Bienvennue  ".$user->getPseudo();
//echo "Utilisateur ".$user->getId()." est connecté ";

}
?>


