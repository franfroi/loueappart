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
        if(empty($this->params['pseudo'])){
            $this->error['pseudo']='Pseudo obligatoire';
        }
         if(strlen($this->params['pseudo'])<8){
            $this->error['pseudo']='pseudo Min 8 caracteres';
        }

         if(empty($this->params['password'])){
             $this->error['password']='Mot de passe manquant';
         } 
        if(strlen($this->params['password'])<8){
            $this->error['password']='password Min 8 caracteres';
        }



//         if(empty($this->error['pseudo'])==false){
//             //var_dump($this->error['pseudo']);
//             //die();
//         return $this->error['pseudo'];
//         }
//         else if(!empty($this->error['pseudo'])==false) {
//            // die("ici");
//            $this->error['pseudo']="";
//         }

//         if(empty($this->error['password'])==false){
// die("ici");
//         return $this->error['password'];
//         }
//          else if(!empty($this->error['password'])==false){

//                      die("ici");
//            $this->error['password']="";
//         }

       

        $pseudo=$this->params['pseudo'];
        $password=$this->params['pseudo'];
       
        $bdd=new BddManager();
        $userRepository = $bdd->getUserRepository();
        $user = $userRepository->checkUsernamePassword($pseudo,$password);


   //var_dump($user);  
         if(empty($user)){
            // var_dump($user);
             //die();
            $this->error['pseudo']='le nom de l\'utilsateur ou mot de passe incorrect';
             $this->error['password']='le nom de l\'utilsateur ou mot de passe incorrect';
             return $this->error;

        }
         else{
             
           $_SESSION["user"] = $user;
           Flight::redirect('/');
         }
    }    

        
    



}