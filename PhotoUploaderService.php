<?php
if(empty($this->params['foto1']['error'])){
$foto='foto1' ;
}
if(empty($this->params['foto2']['error'])){
$foto='foto2' ;
}
if(empty($this->params['foto3']['error'])){
$foto='foto3' ;
}


$target_path = "Images/";
$target_path = $target_path . basename( $_FILES[$foto]['name']);

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES[$foto]) AND $_FILES[$foto]['error'] == 0)
{
    // Testons si le fichier n'est pas trop gros
    if ($_FILES[$foto]['size'] <= 1000000)
    {
        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES[$foto]['name']);

        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpeg', 'gif', 'png');// à tester le JPG et JPEG en majuscule
        if (in_array($extension_upload, $extensions_autorisees))
        {
            // On peut valider le fichier et le stocker définitivement
            $newName = hash('sha1',$_FILES[$foto]['name'].'.'.$extension_upload);

            move_uploaded_file($_FILES[$foto]['tmp_name'], 'Images/' . basename($newName));
            //echo "Transfert du fichier complété !";
           // return $newName;
            
        }
    }else{
        //echo 'Erreur fichier trop gros';
    }
}else{
    $erreur = $_FILES[$foto]['error'];
   // echo "Le transfert du fichier a subis une erreur de code $erreur";
}
