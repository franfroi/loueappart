<?php

class registerService{
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
        //$this->params['username'] represente ici un $_POST['username']
        if(empty($this->params['username'])){
            $this->error['username']='Nom utilsateur manquant';
        }

        if(empty($this->params['password'])){
            $this->error['password']='Mot de passe manquant';
        }

        if(strlen($this->params['password'])<8){
            $this->error['password']='Min 8 caracteres';
        }
        if(($this->params['repassword'])!=($this->params['password'])){
            $this->error['repassword']='Non identique password';
        }
         if(empty($this->params['email'])){
            $this->error['email']='Email manquant';
        }
        if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $this->params['email'])){
             $this->error['email']='Email non valide';
        }

        if(empty($this->error)==false){
        return $this->error;
        }

        $this->user=$this->checkMail();
        if($this->user){
            $this->error['email']='le mail existe deja';
            return $this->error;

        }
        else{
             $this->user=$this->register();
        }

    }     

 //normalement dans bdd manager
       
        function checkMail(){
            $email = $this->params['email'];
            $connexion = new PDO("mysql:host=localhost;dbname=blog;charset=UTF8", 'root', '');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $object = $connexion->prepare('SELECT * FROM user WHERE email=:email ');
            $object->execute(array(
                'email' => $email
            ));
            $user = $object->fetchAll(PDO::FETCH_ASSOC);

            if(empty($user) == false){
                return $user;
            }
            return false;
        }

         function register(){
            $username = $this->params['username'];
            $password = $this->params['password'];
            $email = $this->params['email'];

            $connexion = new PDO("mysql:host=localhost;dbname=blog;charset=UTF8", 'root', '');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $object = $connexion->prepare('INSERT INTO user SET  username=:username ,password=:password,email=:email ');
            $object->execute(array(
               'password' => md5($password),
                'username' => $username,
                'email' => $email
            ));
           
           return $object->rowCount();
        }
        
 }