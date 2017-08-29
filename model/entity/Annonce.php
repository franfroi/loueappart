<?php
 class Annonce
{
private $id;
private $type;
private $chambre;
private $description;
private $superficie;
private $ville;
private $prix;
private $dateDebut;
private $dateFin;
private $foto1;
private $foto2;
private $foto3;
private $userId;


function setId($id) { $this->id = $id; }
function getId() { return $this->id; }
function setType($type) { $this->type = $type; }
function getType() { return $this->type; }
function setChambre($chambre) { $this->chambre = $chambre; }
function getChambre() { return $this->chambre; }
function setDescription($description) { $this->description = $description; }
function getDescription() { return $this->description; }
function setSuperficie($superficie) { $this->superficie = $superficie; }
function getSuperficie() { return $this->superficie; }
function setVille($ville) { $this->ville = $ville; }
function getVille() { return $this->ville; }

function setPrix($prix) { $this->prix = $prix; }
function getPrix() { return $this->prix; }

function setDateDebut($dateDebut) { $this->dateDebut = $dateDebut; }
function getDateDebut() { return $this->dateDebut; }
function setDateFin($dateFin) { $this->dateFin = $dateFin; }
function getDateFin() { return $this->dateFin; }
function setFoto1($foto1) { $this->foto1 = $foto1; }
function getFoto1() { return $this->foto1; }
function setFoto2($foto2) { $this->foto2 = $foto2; }
function getFoto2() { return $this->foto2; }
function setFoto3($foto3) { $this->foto3 = $foto3; }
function getFoto3() { return $this->foto3; }
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
      return $bddManager->getAnnonceRepository()->saveAnnonce($this);
     
    }

    public function delete(BddManager $bddManager)
    {
      $bddManager->getAnnonceRepository()->deleteAnnonce($this);
    }        
        
            

        
}