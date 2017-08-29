<?php

class AnnonceRegisterSercice
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
      

        //description
        if(empty($this->params['description'])){
            $this->error['description']='Obligatoire';
           // die("ici22");
        }

        //superficie
        if(empty($this->params['superficie'])){
            $this->error['superficie']='Obligatoire';
        }

        //ville
        if(empty($this->params['ville'])){
            $this->error['ville']='Obligatoire';
        }

        //dateDebut
         if(empty($this->params['dateDebut'])){
            $this->error['dateDebut']='Obligatoire';
        }
        //dateFin
         if(empty($this->params['dateFin'])){
            $this->error['dateFin']='Obligatoire';
        }

      

         if(empty($this->error)==false){
         return false;
        }
        
    }
} 