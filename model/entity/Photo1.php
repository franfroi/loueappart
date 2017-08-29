<?php
 class Photo1

{
public function upload(){

  



$target_path = "Images/";
$target_path = $target_path . basename( $_FILES['foto1']['name']);

if (isset($_FILES['foto1']) AND $_FILES['foto1']['error'] == 0)
{
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['foto1']['size'] <= 1000000)
    {
        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['foto1']['name']);

        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpeg', 'gif', 'png','jpg');// à tester le JPG et JPEG en majuscule
        if (in_array($extension_upload, $extensions_autorisees))
        {
            // On peut valider le fichier et le stocker définitivement
            $newName = hash('sha1',$_FILES['foto1']['name']).'.'.$extension_upload;
            
            move_uploaded_file($_FILES['foto1']['tmp_name'], 'Images/' . basename($newName));
            //echo "Transfert du fichier complété !";
            return $newName;
            
        }
    }else{
        //echo 'Erreur fichier trop gros';
    }
}else{
    $erreur = $_FILES['foto1']['error'];
   // echo "Le transfert du fichier a subis une erreur de code $erreur";
}
}
 
}

