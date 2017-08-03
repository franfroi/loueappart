
<?php
$nom="";
$pass="";
$repass="";
$mail="";
    // si $registerService n'est pas vide on l'affiche dans un var_dump()
    if(!empty($registerService)) {
        //var_dump($registerService);
        if(!empty( $registerService["username"])){$nom= $registerService["username"];}
        if(!empty( $registerService["password"])){$pass=$registerService["password"];} 
        if(!empty( $registerService["repassword"])){$repass= $registerService["repassword"];}
        if(!empty( $registerService["email"])){$mail= $registerService["email"];}
     }
?>
<form method="POST" action="register">
<h1>Incription</h1><br>
<label>Nom</label><br>
<input type="text" name="username"/>
<?= $nom ?><br>
<label>Password</label><br>
<input type="text" name="password"/>
<?= $pass ?><br>
<label>Repassword</label><br>
<input type="text" name="repassword"/>
<?= $repass ?><br>
<label>mail</label><br>
<input type="text" name="email"/>
<?= $mail ?><br>
<input type="submit" value="envoyer">
</form>

  <?php          
   
?>