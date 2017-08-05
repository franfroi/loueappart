<?php


class UserRepository
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    public function getUserById($id){
        $pdo = $this->connexion->prepare('SELECT *
        FROM user WHERE id=:id');
        $pdo->execute(array(
            'id'=>$id
        ));
        $user = $pdo->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($user)){
            return new User($user[0]);
        }
        return false;
        //Ici nous sommes en train de passer un tableau!!
    }

    

    public function getAlluser(){

        $pdo = $this->connexion->prepare('SELECT *
      FROM user');
        $pdo->execute(array());
        $users = $pdo->fetchAll(PDO::FETCH_ASSOC);


        if(!empty($users)){
            $tableauUsers=[];
            foreach($users as $tableauDonneesUsers){
                $tableauUsers[]=new User($tableauDonneesUsers);
            }
            return $tableauUsers;
        }
        return false;
    }
    
    public function saveUser(User $user){
        if(empty($user->getId()) == true ){
            $this->insertUser($user);
        }else{
            $this->updateUser($user);
        }
    }

    public function insertUser(User $user){
        $query="INSERT INTO user SET name=:name, prenom=:prenom, pseudo=:pseudo, password=:password, mail=:mail";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'name'=>$user->getName(),
            'prenom' => $user->getPrenom(),
            'pseudo'=>$user->getPseudo(),
            'password'=>$user->getPassword(),
            'mail' => $user->getMail()
        ));
        return $pdo->rowCount();
    }

    public function updateUser(User $user){
        $query="UPDATE user SET name=:name, prenom=:prenom, pseudo=:pseudo, password=:password, mail=:mail WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id' =>$user->getId(),
            'name'=>$user->getName(),
            'prenom' => $user->getPrenom(),
            'pseudo'=>$user->getPseudo(),
            'password'=>$user->getPassword(),
            'mail' => $user->getMail()
        ));
        return $pdo->rowCount();
    }

    public function deleteUser(User $user){

        /**
         * Effacer les entités filles (SQL)
         * Ceci n'est pas nécessaire si notre clé contrainte est déclarée
         * avec ON DELETE CASCADE. Par contre attention si vous avez
         * des fichiers comme des photos vous devez les effacer ici
         * tout comme les fichiers log.txt
         */
        // $mesCourses = $voiture->getMesCourses($this);
        // var_dump($mesCourses);
        // die();
        // if(!empty($mesCourses)){
        //     foreach($mesCourses as $objetCourses){
        //         /**
        //          * Alfonso: chaque objetPromotion à sa fonction delete
        //          * pour qu'elle marche il faut qu'elle ait le BDD
        //          */
        //         $objetCourses->delete($this);
        //     }
        // }

        $query="DELETE FROM user WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id' =>$user->getId()
        ));
        return $pdo->rowCount();
    }


        
        public function checkUsernamePassword($pseudo,$password){
            
            $query="SELECT id,pseudo FROM user WHERE pseudo=:pseudo AND password=:password";
            $pdo = $this->connexion->prepare($query);
            $pdo->execute(array(
                'pseudo' => $pseudo,
                'password' => $password
                    
                ));
            $user = $pdo->fetchAll(PDO::FETCH_ASSOC);

                     
             if(!empty($user)){
                
                return new User($user[0]);
               
               
            }

            return false;
         }


        public function checkMail($mail){
            $query="SELECT * FROM user WHERE mail=:mail";
            $pdo = $this->connexion->prepare($query);
            $pdo->execute(array(
                'mail' => $mail
            ));
            $Amail = $pdo->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($Amail)){
                return $Amail;
            }
            return false;
        }
        
        public function checkPseudo($pseudo){
            $query="SELECT * FROM user WHERE pseudo=:pseudo ";
            $pdo = $this->connexion->prepare($query);
            $pdo->execute(array(
                'pseudo' => $pseudo
            ));
            $Apseudo = $pdo->fetchAll(PDO::FETCH_ASSOC);

            if(empty($Apseudo) == false){
                return $Apseudo;
            }
            return false;
        }

    
}