<?php


class AnnonceRepository
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function getAnnonceById($id){
        $pdo = $this->connexion->prepare('SELECT *
        FROM annonces WHERE id=:id');
        $pdo->execute(array(
            'id'=>$id
        ));
        $annonce = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($annonce)){
            return new Annonce($annonce[0]);
        }
        return false;
        //Ici nous sommes en train de passer un tableau!!
    }


public function getSearchAnnonce($type,$chambre,$ville,$prix){
        $pdo = $this->connexion->prepare('SELECT *
        FROM annonces WHERE type=:type and chambre=:chambre and ville=:ville and prix=:prix');
        $pdo->execute(array(
            'type'=>$type,
             'chambre'=>$chambre,
              'ville'=>$ville,
               'prix'=>$prix

        ));
        $annonce = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($annonce)){
            return new Annonce($annonce[0]);
        }
        return false;
        //Ici nous sommes en train de passer un tableau!!
    }
    

    public function getAllAnnonce(){


        $pdo = $this->connexion->prepare(' SELECT * FROM annonces ');
        $pdo->execute(array());
        $annonce = $pdo->fetchAll(PDO::FETCH_ASSOC);
         
            if(!empty($annonce)){
            $tableauAnnonce=[];
            foreach($annonce as $tableauDonneesAnnonce){
                 $tableauAnnonce[]=new Annonce($tableauDonneesAnnonce);
            }
            return $tableauAnnonce;
         
        } 
        return false;
    }
    

     public function saveAnnonce(Annonce $Annonce){
        if(empty($Annonce->getId()) == true ){
            return $this->insertAnnonce($Annonce);
        }else{
            $this->updateAnnonce($Annonce);
        }
    }
     public function insertAnnonce(Annonce $Annonce){
        $query="INSERT INTO annonces SET
        type=:type,
        chambre=:chambre,
        description=:description,
        superficie=:superficie,
        ville=:ville,
        prix=:prix,
        dateDebut=:dateDebut,
        dateFin=:dateFin,
        foto1=:foto1,
        foto2=:foto2,
        foto3=:foto3,
        userId=:userId";
        $pdoLastInsert=$this->connexion;
        $pdo = $pdoLastInsert->prepare($query);
        $pdo->execute(array(
            'type'=>$Annonce->getType(),
            'chambre'=>$Annonce->getChambre(),
            'description'=>$Annonce->getDescription(),
            'superficie'=>$Annonce->getSuperficie(),
            'ville'=>$Annonce->getVille(),
            'prix'=>$Annonce->getPrix(),
            'dateDebut'=>$Annonce->getDateDebut(),
            'dateFin'=>$Annonce->getDateFin(),
            'foto1'=>$Annonce->getFoto1(),
            'foto2'=>$Annonce->getFoto2(),
            'foto3'=>$Annonce->getFoto3(),
            'userId' => $Annonce->getUserId()


        ));
        $insertId = $pdoLastInsert->lastInsertId();
        return $insertId;
    }


     public function getAnnonceByUser(User $user)
    {
       
        $query = "SELECT * FROM annonces WHERE userId=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id'=>$user->getId()
        ));
        $users = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($users)){
            $tableauAnnonces=[];
            foreach ($users as $tableauDonneesAnnonces){
                $tableauAnnonces[] = new Annonce($tableauDonneesAnnonces);
            }
            return $tableauAnnonces;
        }
        return false;
    }

    public function deleteAnnonce(Annonce $Annonce){

        

        $query="DELETE FROM annonces WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id' =>$Annonce->getId()
        ));
        return $pdo->rowCount();
    }

     public function updateAnnonce(Annonce $Annonce){


        $query="UPDATE annonces SET 
        type=:type,
        chambre=:chambre,
        description=:description,
        superficie=:superficie,
        ville=:ville,
        prix=:prix,
        dateDebut=:dateDebut,
        dateFin=:dateFin,
        foto1=:foto1,
        foto2=:foto2,
        foto3=:foto3
       
        WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id' =>$Annonce->getId(),
            'type'=>$Annonce->getType(),
            'chambre'=>$Annonce->getChambre(),
            'description'=>$Annonce->getDescription(),
            'superficie'=>$Annonce->getSuperficie(),
            'ville'=>$Annonce->getVille(),
            'prix'=>$Annonce->getPrix(),
            'dateDebut'=>$Annonce->getDateDebut(),
            'dateFin'=>$Annonce->getDateFin(),
            'foto1'=>$Annonce->getFoto1(),
            'foto2'=>$Annonce->getFoto2(),
            'foto3'=>$Annonce->getFoto3()
            
            
        ));
        return $pdo->rowCount();
    }
    
}