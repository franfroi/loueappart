<?php

class registerService
{
    private $params;
    private $error;
    private $user;

    function setParams($params) { $this->params = $params; }
    function getParams() { return $this->params; }
    function setError($error) { $this->error = $error; }
    function getError() { return $this->error; }
    function setUser($user) { $this->user = $user; }
    function getUser() { return $this->user; }

    public function launchControls(){
        //$this->params['name'] represente ici un $_POST['name']

        //nom
        if(strlen($this->params['name'])<3){
            $this->error['name']='Min 3 caractères';
                                  
               
        }

        //prenom
        if(strlen($this->params['prenom'])<3){
            $this->error['prenom']='Min 3 caractères';

        }

        //pseudo
        if(strlen($this->params['pseudo'])<8){
            $this->error['pseudo']='Min 8 caracteres';
        }

        //password
        if(strlen($this->params['password'])<8){
            $this->error['password']='Min 8 caracteres';
        }

        //repassword
         if(($this->params['repassword'])!=($this->params['password'])){
            $this->error['repassword']='Mot de passe non identique';
        }
       
       
       
        //mail
        if (!preg_match('/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/', $this->params['mail'])){
             $this->error['mail']='Email non valide';
        }

        if(empty($this->error)==false){
        return $this->error;
        }
        
        else{
                //envoie une session temporaire 
               


                $pseudo=$this->params['pseudo'];
                $mail=$this->params['mail'];
            
                $bdd=new BddManager();
                $userRepository = $bdd->getUserRepository();
                $Amail = $userRepository->checkMail($mail);
                $Apseudo = $userRepository->checkPseudo($pseudo);

                // var_dump($Amail);
                // die();
                if(empty($Amail)==false){
                    $this->error['mail']='Ce mail éxiste déja';
                    
                //     //envoie une session temporaire 
                //     $tempMail="";      
                //     $_SESSION["tempMail"] = $tempMail;
                //      $tempName=$this->params['name'];      
                // $_SESSION["tempName"] = $tempName;
                
                // $tempPrenom=$this->params['prenom'];      
                // $_SESSION["tempPrenom"] = $tempPrenom;

                // $tempPseudo=$this->params['pseudo'];      
                // $_SESSION["tempPseudo"] = $tempPseudo;
                    
                    return $this->error;
                }

                if(empty($Apseudo==false)){
                    $this->error['pseudo']='Ce pseudonyme éxiste déja';

                //     //envoie une session temporaire 
                //     $tempPseudo="";      
                //     $_SESSION["tempPseudo"] = $tempPseudo;
                //      $tempName=$this->params['name'];      
                // $_SESSION["tempName"] = $tempName;
                
                // $tempPrenom=$this->params['prenom'];      
                // $_SESSION["tempPrenom"] = $tempPrenom;

               
                
                // $tempMail=$this->params['mail'];      
                // $_SESSION["tempMail"] = $tempMail;
                    return $this->error;
                }
                else{

                        
                // unset($_SESSION["tempName"]);
                // unset($_SESSION["tempPrenom"]);
                // unset($_SESSION["tempPseudo"]);
                // unset($_SESSION["tempMail"]);
                    /*            
                    $name=$this->params['name'];
                    $prenom=$this->params['prenom'];
                    $pseudo=$this->params['pseudo'];
                    $password=$this->params['password'];
                    $mail=$this->params['mail'];
                    echo "je suis bien";
                   $bdd=new BddManager();
                    $userRepository = $bdd->getUserRepository();
                    $register = $userRepository->register($name,$prenom,$pseudo,$password,$mail); 
               
                Flight::redirect('/formLogin'); */
                }
        }

    }     
   
}