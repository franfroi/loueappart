<?php
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
        //$this->params['username'] represente ici un $_POST['username']
        if(empty($this->params['username'])){
            $this->error['username']='Nom utilsateur manquant';
        }

        if(empty($this->params['password'])){
            $this->error['password']='Mot de passe manquant';
        }
        if(empty($this->error)==false){
        return $this->error;
        }
        $this->user=$this->checkUsernamePassword();
        if(empty($this->user)){
            $this->error['identifiants']='le nom de l\'utilsateur ou mot de passe incorrect';
            return $this->error;

        }
        else{
            return $this->user;
        }
    }    

        //normalement dans bdd manager
        function checkUsernamePassword(){
            $username = $this->params['username'];
            $password = $this->params['password'];

            $connexion = new PDO("mysql:host=localhost;dbname=blog;charset=UTF8", 'root', '');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $object = $connexion->prepare('SELECT id, username FROM user WHERE username=:username AND password=:password');
            $object->execute(array(
                'password' => md5($password),
                'username' => $username
            ));
            $user = $object->fetchAll(PDO::FETCH_ASSOC);
            if(empty($user) == false){
                return $user;
            }
            return false;
        }
    



}