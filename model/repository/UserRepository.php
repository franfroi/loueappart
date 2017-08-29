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

//         $pdo = $this->connexion->prepare(' SELECT user.id as userid,admin.id as adminid FROM user AS user
//  LEFT JOIN admin AS admin ON admin.userId=user.id;');
  $pdo = $this->connexion->prepare(' SELECT user.* ,admin.statut,admin.userId  FROM user AS user
 LEFT JOIN admin AS admin ON admin.userId=user.id;');
        $pdo->execute(array());
        $users = $pdo->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($users);
        // die("ici");
         if(!empty($users)){
            $tableauUsers=[];
            foreach($users as $tableauDonneesUsers){
                $tableauUsers[]=$tableauDonneesUsers;
                
            }
            return $tableauUsers;
        } 
        return false;
    }
    
    public function saveUser(User $user){
        if(empty($user->getId()) == true ){
            return $this->insertUser($user);
        }else{
            $this->updateUser($user);
        }
    }

    public function insertUser(User $user){
        $query="INSERT INTO user SET name=:name, prenom=:prenom, pseudo=:pseudo, password=:password, mail=:mail";
        $pdoLastInsert=$this->connexion;
        $pdo = $pdoLastInsert->prepare($query);
        $pdo->execute(array(
            'name'=>$user->getName(),
            'prenom' => $user->getPrenom(),
            'pseudo'=>$user->getPseudo(),
            'password'=>$user->getPassword(),
            'mail' => $user->getMail()
        ));
        $insertId = $pdoLastInsert->lastInsertId();
        return $insertId;
        //die("ici");
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

        

        $query="DELETE FROM user WHERE id=:id";
        $pdo = $this->connexion->prepare($query);
        $pdo->execute(array(
            'id' =>$user->getId()
        ));
        return $pdo->rowCount();
    }


        
        public function checkUsernamePassword(User $user){
            
            $query="SELECT id,pseudo FROM user WHERE pseudo=:pseudo AND password=:password";
            $pdo = $this->connexion->prepare($query);
            $pdo->execute(array(
                'pseudo'=>$user->getPseudo(),
                'password'=>$user->getPassword()
                    
                ));
            $user = $pdo->fetchAll(PDO::FETCH_ASSOC);

                     
             if(!empty($user)){
                
                return new User($user[0]);
               
               
            }

            return false;
         }


        public function checkMail(User $user){
            $query="SELECT * FROM user WHERE mail=:mail";
            $pdo = $this->connexion->prepare($query);
            $pdo->execute(array(
                'mail' =>$user->getMail()
            ));
            $mail = $pdo->fetchAll(PDO::FETCH_ASSOC);

            if(!empty($mail)){
                return $mail;
            }
            return false;
        }
        
        public function checkPseudo(User $user){
            $query="SELECT * FROM user WHERE pseudo=:pseudo ";
            $pdo = $this->connexion->prepare($query);
            $pdo->execute(array(
                'pseudo' => $user->getPseudo()
            ));
            $pseudo = $pdo->fetchAll(PDO::FETCH_ASSOC);

            if(empty($pseudo) == false){
                return $pseudo;
            }
            return false;
        }

    
}