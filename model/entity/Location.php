<?php
class Location
{

private $id;
private $dateDebutLoc;
private $dateFinLoc;
private $userId;
private $annoncesId;

function setId($id) { $this->id = $id; }
function getId() { return $this->id; }
function setDateDebutLoc($dateDebutLoc) { $this->dateDebutLoc = $dateDebutLoc; }
function getDateDebutLoc() { return $this->dateDebutLoc; }
function setDateFinLoc($dateFinLoc) { $this->dateFinLoc = $dateFinLoc; }
function getDateFinLoc() { return $this->dateFinLoc; }
function setUserId($userId) { $this->userId = $userId; }
function getUserId() { return $this->userId; }
function setAnnoncesId($annoncesId) { $this->annoncesId = $annoncesId; }
function getAnnoncesId() { return $this->annoncesId; }


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
      return $bddManager->getLocationRepository()->saveLocation($this);
     
    }

    public function delete(BddManager $bddManager)
    {
      $bddManager->getLocationRepository()->deleteLocation($this);
    }        
        
            

        
}


