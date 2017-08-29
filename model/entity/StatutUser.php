<?php
 class StatutUser
{
    private $id;
    private $statut;
    private $userId;


//get and set
function setId($id) { $this->id = $id; }
function getId() { return $this->id; }
function setStatut($statut) { $this->statut = $statut; }
function getStatut() { return $this->statut; }
function setUserId($userId) { $this->userId = $userId; }
function getUserId() { return $this->userId; }

 public function __construct($donnees=array())
    {
            //var_dump($donnees);
            $this->hydrate($donnees);
    }

    public function hydrate($donnees)
    {
       foreach ($donnees as $key => $value)
        {

            //ici on rajoute un remplacemnt des underscore
            $key=preg_replace("#_#","",$key);
            //donc pour l'index id on met en majusscule
            //et le prefix avec set
           $method="set".ucfirst($key);
          if(method_exists($this,$method))
          {
                $this->$method($value);
          }
       }
    }
      public function save(BddManager $bddManager)
    {
      //$this tout court sert à passer l'objet lui même
      $bddManager->getStatutUserRepository()->saveStatutUser($this);
    }
         

        public function delete(BddManager $bddManager)
        {
        return $bddManager->getStatutUserRepository()->deleteStatutUser($this);
          }



}