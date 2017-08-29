<?php
//echo "bbbbb";
class loginService
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

        
      // $this->params['username'] represente ici un $_POST['username']
        if(strlen($this->params['pseudo'])<8){
            $this->error['pseudo']='Min 8 caracteres';
        }

        if(strlen($this->params['password'])<8){
            $this->error['password']='Min 8 caracteres';
        }

            
        if(empty($this->error)==false){
            return $this->error;
        }
        else{
           
            
                $bdd=new BddManager();
                $user=new User;
                $user->setPseudo($this->params['pseudo']);
                $user->setPassword($this->params['password']);
                $userRepository = $bdd->getUserRepository();
                $user = $userRepository->checkUsernamePassword($user);


 
                if(empty($user)){
                
                    $this->error['identifiants']='Pseudonyme ou Mot de passe incorrect';
                    return $this->error;
                }

                else{
                    
                $_SESSION["user"] = $user;
               // Flight::redirect('/');
                }
        }
     }    

        
    



}