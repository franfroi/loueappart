<?php


class LocationRepository
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function getLocationById($id){
        $pdo = $this->connexion->prepare('SELECT *
        FROM location WHERE id=:id');
        $pdo->execute(array(
            'id'=>$id
        ));
        $location = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($location)){
            return new Location($location[0]);
        }
        return false;
        //Ici nous sommes en train de passer un tableau!!
    }
}