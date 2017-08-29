<?php


class StatutUserRepository
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function getStatutById($id){
        $query = "SELECT * FROM admin WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id'=>$id
        ));
        $Statut = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($Statut)){
            return new StatutUser($Statut[0]);
        }
        return false;
        //Ici nous sommes en train de passer un tableau!!
    }

    public function getStatutByUser(User $user)
    {
       
        $query = "SELECT * FROM admin WHERE userId=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id'=>$user->getId()
        ));
        $users = $pdo->fetchAll(PDO::FETCH_ASSOC);


         if(!empty($users)){
            return new StatutUser($users[0]);
        }
        // if(!empty($users)){
        //     $tableauStatut=[];
        //     foreach ($users as $tableauDonneesStatut){
        //         $tableauStatut[] = new StatutUser($tableauDonneesStatut);
        //     }
        //     return $tableauStatut;
        //}
        return false;
    }

    public function getAllStatutUser(){

        $pdo = $this->connexion->prepare('SELECT * FROM admin');
        $pdo->execute(array());
        $statutUsers = $pdo->fetchAll(PDO::FETCH_ASSOC);


        if(!empty($statutUsers)){
            $tableauStatutUsers=[];
            foreach($statutUsers as $tableauDonneesStatut){
                $tableauStatutUsers[]=new StatutUser($tableauDonneesStatut);
            }
            return $tableauStatutUsers;
        }
        return false;
    }
    
    public function saveStatutUser(StatutUser $statutUser){
        
        if(empty($statutUser->getId()) == true ){
            $this->insertStatutUser($statutUser);
        }else{
            $this->updateStatutUser($statutUser);
        }
    }

    public function insertStatutUser(StatutUser $statutUser){
        $query="INSERT INTO admin SET statut=:statut, userId=:userId";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'statut'=>$statutUser->getStatut(),
            'userId' => $statutUser->getUserId()
        ));
        return $pdo->rowCount();
    }

    public function updateStatutUser(StatutUser $statutUser){

       
        $query="UPDATE admin SET statut=:statut, userId=:userId WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id' =>$statutUser->getId(),
            'statut'=>$statutUser->getStatut(),
            'userId' => $statutUser->getUserId()
            
        ));
        return $pdo->rowCount();
    }

    public function deleteStatutUser(StatutUser $statutUser){
        $query="DELETE FROM admin WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id'=>$statutUser->getId()
        ));
        return  $object->rowCount();
    }

    
}