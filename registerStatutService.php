<?php

class registerStatutService
{
    private $params;
    private $error;
   // private $user;

    function setParams($params) { $this->params = $params; }
    function getParams() { return $this->params; }
    function setError($error) { $this->error = $error; }
    function getError() { return $this->error; }
    // function setUser($user) { $this->user = $user; }
    // function getUser() { return $this->user; }

    public function launchControls(){
        //$this->params['name'] represente ici un $_POST['name']

        //id
        if(empty($this->params['id'])){
            $this->error['id']='Obligatoire';
                                  
               
        }
    }
 
               
}