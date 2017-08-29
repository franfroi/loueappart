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
                          

                $bdd=new BddManager();

                $mail=new User;
                $mail->setMail($this->params['mail']);
                $userRepository = $bdd->getUserRepository();
                $mail = $userRepository->checkMail($mail);
                

                $pseudo=new User;
                $pseudo->setPseudo($this->params['pseudo']);
                $userRepository = $bdd->getUserRepository();
                $pseudo = $userRepository->checkPseudo($pseudo);

                if(empty($pseudo==false)){
                    $this->error['pseudo']='Ce pseudonyme éxiste déja';
                    $tempMail=$this->params['mail']; 
                    $_SESSION["tempMail"] = $tempMail;
                    
                
                    return $this->error;
                }
                if(empty($mail)==false){
                    $this->error['mail']='Ce mail éxiste déja';
                    
                    //envoie une session temp 
                
                 $tempPseudo=$this->params['pseudo'];      
                 $_SESSION["tempPseudo"] = $tempPseudo;
                    
                    return $this->error;
                }

               
                
        }

    }     
   
}