<?php 

if (isset($_SESSION["user"])){
$user=new User;
$user= $_SESSION["user"] ;

//echo $user->getId();
echo "Utilisateur ".$user->getPseudo()." est connecté ";
//var_dump($user);
}