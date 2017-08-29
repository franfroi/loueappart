<?php
require 'flight/Flight.php';
require 'autoloader.php';

session_start();

Flight::render('header', array(), 'header');
Flight::render('footer', array(), 'footer');

//accueil
Flight::route('/', function(){
    $Page="accueil";
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('Accueil');
});
//accueil
Flight::route('/accueil', function(){
    $Page="accueil";
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('Accueil');
});
//logout
Flight::route('/logout', function(){
  session_destroy ();
  Flight::redirect('/');
});






//formlogin-------------------------------
Flight::route('/formLogin', function(){
    $Page="Connexion";
    $loginService = new loginService();
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('formLogin');
    });
//loginService
Flight::route('/loginService', function(){
     $Page="Connexion";
     Flight::render('header', array('heading'=>$Page), "header");

      $request = Flight::request();
    // on créer l'array que l'on va passer à notre RegisterService
    $params = [
    'pseudo' => $request->data['pseudo'],
    'password' => $request->data['password'],
    
    ];
    // on créer notre instance, on définie les paramètres, on lance la requete
    $loginService = new loginService();
    $loginService->setParams($params);
    $loginService->launchControls();

    //si pas erreur on se logue
    if (($loginService->launchControls())==null)
    {

                Flight::redirect('/');
               
    }
    Flight::render('formLogin', array('loginService' => $loginService->getError()));
 
});


//forminscription-----------------------------
Flight::route('/formInscription', function(){
    $Page="Inscription";
    $registerService= new registerService();
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('formInscription');
});
//registerService
Flight::route('/registerService', function(){

    $request = Flight::request();

    // on créer l'array que l'on va passer à notre RegisterService
    $params = [
    'name' => $request->data['name'],
    'prenom' => $request->data['prenom'],
    'pseudo' => $request->data['pseudo'],
    'password' => $request->data['password'],
    'repassword' => $request->data['repassword'],
    'mail' => $request->data['mail'],
    
    ];
    // on créer notre instance, on définie les paramètres, on lance la requete
    $registerService = new registerService();
    $registerService->setParams($params);
    $registerService->launchControls();
      
    //si  erreur on renvoie au form
    Flight::render('formInscription', array('registerService' => $registerService->getError()));

    //si pas erreur on enregistre
    if (($registerService->launchControls())==null)
    {
        $bdd= new BddManager;
        $newUser=new User();

        $newUser->setName($request->data['name']);
        $newUser->setPrenom( $request->data['prenom']);
        $newUser->setPseudo($request->data['pseudo']);
        $newUser->setPassword( $request->data['password']);
        $newUser->setMail($request->data['mail']);
        $lastInsert=$newUser->save($bdd);
        
         unset($_SESSION["tempPseudo"] );
         unset($_SESSION["tempMail"] );
              // var_dump($lastInsert);
        
        
        // insertion dans la base statut en tant abonne  valeur 3 dans statut

         $newStatut=new StatutUser();
         $newStatut->setStatut("3");
         $newStatut->setUserId($lastInsert);
         $newStatut->save($bdd);
         Flight::redirect('/formLogin');
     }  

});

//formUpdateInscription-------------------
Flight::route('/formUpdateInscription', function(){
     $Page="Modification utilisateur";
     Flight::render('header', array('heading'=>$Page), "header");
   
    $bdd=new BddManager();
    $registerService= new registerService();
    Flight::render('formUpdateInscription');
});
//Moncompte-------------
Flight::route('/MonCompte', function(){
    if (isset($_SESSION["user"])){
     $Page="Mon compte";
     Flight::render('header', array('heading'=>$Page), "header");
     Flight::render('MonCompte');
     }
     else {
          Flight::redirect('/');
     }
});

//UpdateMonCompte-------------
Flight::route('/UpdateMonCompte', function(){
    if (isset($_SESSION["user"])){
      
     $Page="Mon compte";
     Flight::render('header', array('heading'=>$Page), "header");
     Flight::render('UpdateMonCompte');
     }
     else {
          Flight::redirect('/');
     }
});

//UpdateCompteService
Flight::route('/updateCompteService', function(){
 
    $request = Flight::request();

    // on créer l'array que l'on va passer à notre UpdateService
 
    $params = [
    'id' => $request->data['id'],
    'name' => $request->data['name'],
    'prenom' => $request->data['prenom'],
    'pseudo' => $request->data['pseudo'],
    'password' => $request->data['password'],
    'repassword' => $request->data['repassword'],
    'mail' => $request->data['mail'],
    
    ];
             
// on créer notre instance, on définie les paramètres, on lance la requete
    $updateCompteService = new updateCompteService();
    $updateCompteService->setParams($params);
    $updateCompteService->launchControls();
    
    //si  erreur on renvoie au form
    Flight::render('UpdateMonCompte', array('updateCompteService' => $updateCompteService->getError()));

    //si pas erreur on enregistre
    if (($updateCompteService->launchControls())==null)
    {

// si ok on update
        $bdd= new BddManager;
        $UpdateUserRepository = $bdd->getUserRepository();
        $UpdateUser = $UpdateUserRepository->getUserById($request->data['id']);


//modification d'un user
        $newUser=new User();
        $newUser->setId($request->data['id']);
        $newUser->setName($request->data['name']);
        $newUser->setPrenom( $request->data['prenom']);
        $newUser->setPseudo($request->data['pseudo']);
        $newUser->setPassword( $request->data['password']);
        $newUser->setMail($request->data['mail']);
        $newUser->save($bdd);

      Flight::redirect('/MonCompte');
    }

});
//Moncomptedelete-------------
Flight::route('/DeleteUserid', function(){
    if (isset($_SESSION["user"])){
        $id =$_POST['getid'];
        $bdd= new BddManager;
        $userRepository=$bdd->getUserRepository();
        $DeleteUser = $userRepository->getUserById($id);
        $DeleteUser->delete($bdd);
   
       session_destroy ();
        Flight::redirect('/');
      }
});
 



 //formStatut-----------------------------
 
Flight::route('/formStatut', function(){
    if (isset($_SESSION["user"])){
            $user=new User();
            $user= $_SESSION["user"] ;
            $bdd= new BddManager();
            $statutRepository=$bdd->getStatutUserRepository();
            $statut = $statutRepository->getStatutByUser($user);

                foreach ($statut as  $value) {
                         if ($value->getStatut()<3){
                            $Page="Statut";
                            //$registerStatutService= new registerStatutService();
                            Flight::render('header', array('heading'=>$Page), "header");
                            Flight::render('formStatut');
                        }
                }   
    }
    else{
        //si pas connecter and pas de droit retour accueil
      Flight::redirect('/');
    }

});


//registerStatutService
Flight::route('/registerStatutService', function(){

    $request = Flight::request();

    // on créer l'array que l'on va passer à notre RegisterService
    $params = [
    'statut' => $request->data['selectStatut'],
    'id' => $request->data['id'],    
    ];

    
     // on créer notre instance, on définie les paramètres, on lance la requete
     $registerStatutService = new registerStatutService();
     $registerStatutService->setParams($params);
     $registerStatutService->launchControls();
      
     //si  erreur on renvoie au form
     Flight::render('formStatut', array('registerStatutService' => $registerStatutService->getError()));

    //si pas erreur on enregistre
    if (($registerStatutService->launchControls())==null)
    {
        $bdd= new BddManager();
        $newStatut=new StatutUser();

        $newStatut->setStatut($request->data['selectStatut']);
        $newStatut->setUserId( $request->data['id']);
        $newStatut->save($bdd);
        
        Flight::redirect('/Statut');
 }

});

//statut
Flight::route('/statut', function(){
    $Page="Statut";
    Flight::render('header', array('heading'=>$Page), "header");
    
    Flight::render('statut');
});



//UpdateUser
    Flight::route('/UpdateUser', function(){
    $id =$_POST['modif'];
    $Page="Update";
    $updateService = new updateService();        
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('UpdateUser', array('id' => $id
    ));
    

});

//UpdateService
Flight::route('/updateService', function(){
 
    $request = Flight::request();

    // on créer l'array que l'on va passer à notre UpdateService
  // $idUpdate=
    $paramStatut = [
    'statut' => $request->data['selectStatut'],
    
       
    ];
    $params = [
    'id' => $request->data['id'],
    'name' => $request->data['name'],
    'prenom' => $request->data['prenom'],
    'pseudo' => $request->data['pseudo'],
    'password' => $request->data['password'],
    'repassword' => $request->data['repassword'],
    'mail' => $request->data['mail'],
    
    ];
             
// on créer notre instance, on définie les paramètres, on lance la requete
    $updateService = new updateService();
    $updateService->setParams($params);
   //var_dump($updateService);
  // die();
    $updateService->launchControls();
     
    //si  erreur on renvoie au form
    Flight::render('UpdateUser', array('updateService' => $updateService->getError()));

    //si pas erreur on enregistre
    if (($updateService->launchControls())==null)
    {

// si ok on update
        $bdd= new BddManager;
        $UpdateUserRepository = $bdd->getUserRepository();
        $UpdateUser = $UpdateUserRepository->getUserById($request->data['id']);


//modification d'un user
        $newUser=new User();
        $newUser->setId($request->data['id']);
        $newUser->setName($request->data['name']);
        $newUser->setPrenom( $request->data['prenom']);
        $newUser->setPseudo($request->data['pseudo']);
        $newUser->setPassword( $request->data['password']);
        $newUser->setMail($request->data['mail']);
        $newUser->save($bdd);

//avec modif statut
        $UpdateStatutRepository = $bdd->getStatutUserRepository();
        $UpdateStatut = $UpdateStatutRepository->getStatutByUser($newUser);
        $idStatut=$UpdateStatut->getId();
       
        $newStatut=new StatutUser();
        $newStatut->setId($idStatut);
        $newStatut->setStatut($request->data['selectStatut']);
        $newStatut->setUserId( $request->data['id']);
        $newStatut->save($bdd);
      Flight::redirect('/statut');
    }

});

//DeleteUser
    Flight::route('/DeleteUser', function(){
    $id =$_POST['modif'];
        $bdd= new BddManager;
        $deleteUserRepository = $bdd->getUserRepository();
        $deleteUser = $deleteUserRepository->getUserById( $id);
        $deleteUser->delete($bdd);
       
    $Page="delete";
    $updateService = new updateService();        
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::redirect('/statut');
    

});
//search
    Flight::route('/Search', function(){
            
  
    $Page="Recherche";
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('Search');

});

//searchservice
    Flight::route('/SearchService', function(){
     $request = Flight::request();       
     $params = [
    'type' => $request->data['type'],
    'chambre' => $request->data['chambre'],
    'ville' => $request->data['ville'],
    'prix' => $request->data['prix'],    
      
    ];
    $type=$request->data['type'];
    $chambre=$request->data['chambre'];
    $ville=$request->data['ville'];
    $prix=$request->data['prix'];

        $bdd= new BddManager;
        $AnnoncesRepository=$bdd->getAnnonceRepository();
        $Annonces = $AnnoncesRepository->getSearchAnnonce($type,$chambre,$ville,$prix);  


    $Page="Recherche";
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('Find');

});






//Annonce insert
    Flight::route('/FormAnnonce', function(){
         if (empty($_SESSION["user"])){
           Flight::redirect('/');
             }
       
  
    $Page="Annonce";
    Flight::render('header', array('heading'=>$Page), "header");
    //Flight::render('FormAnnonce',array('id'=>$id) );
    Flight::render('FormAnnonce');

});

 Flight::route('/AnnonceRegisterSercice', function(){
$request = Flight::request();
 if (isset($_SESSION["user"])){
             $user=new User();
             $user= $_SESSION["user"] ;
             $id= $user->getId();
             
             
    // on créer l'array que l'on va passer à notre RegisterService
    $params = [
    'type' => $request->data['type'],
    'chambre' => $request->data['chambre'],
    'description' => $request->data['description'],
    'superficie' => $request->data['superficie'],
    'ville' => $request->data['ville'],
    'prix' => $request->data['prix'],
    'dateDebut' => $request->data['dateDebut'],
    'dateFin' => $request->data['dateFin'],
    'foto1' => $request->files['foto1'],
    'foto2' => $request->files['foto2'],
    'foto3' => $request->files['foto3'],
     'userId' => $id
    
    
    ];

    

    
    // // on créer notre instance, on définie les paramètres, on lance la requete
     $AnnonceRegisterSercice = new AnnonceRegisterSercice();
     $AnnonceRegisterSercice->setParams($params);
     $AnnonceRegisterSercice->launchControls();
    
    // //si  erreur on renvoie au form
     Flight::render('FormAnnonce', array('AnnonceRegisterSercice' => $AnnonceRegisterSercice->getError()));
 
    // //si pas erreur on enregistre
    if (( $AnnonceRegisterSercice->launchControls())==null)
    
    {

       
 
        $photos=array();
         if(empty($params['foto1']["error"])){
            $photo=new Photo1();
            $name=$photo->upload();
            $photos["foto1"]=$name;
            $foto1=$photos["foto1"];
         
            
         }
         else{
             $photos["foto1"]="01NoImage.png";
                $foto1=$photos["foto1"];
                      
         }
        

         
         if(empty($params['foto2']["error"])){
           
            $photo=new Photo2();
            $name=$photo->upload();
            $photos["foto2"]=$name;
             $foto2=$photos["foto2"];
            
         }
          else{
             $photos["foto2"]="01NoImage.png";
                $foto2=$photos["foto2"];
                
                      
         }
         if(empty($params['foto3']["error"])){
           
            $photo=new Photo3();
            $name=$photo->upload();
            $photos["foto3"]=$name;
             $foto3=$photos["foto3"];
            
            
         }

         else{
             $photos["foto3"]="01NoImage.png";
                $foto3=$photos["foto3"];
                      
         }
           
        
        $bdd= new BddManager;
        $newAnnonce=new Annonce();
        $newAnnonce->setType($request->data['type']);
        $newAnnonce->setChambre( $request->data['chambre']);
        $newAnnonce->setDescription($request->data['description']);
        $newAnnonce->setSuperficie( $request->data['superficie']);
        $newAnnonce->setVille($request->data['ville']);
        $newAnnonce->setPrix($request->data['prix']);
        $newAnnonce->setDateDebut($request->data['dateDebut']);
        $newAnnonce->setDateFin($request->data['dateFin']);
        $newAnnonce->setFoto1($foto1);
        $newAnnonce->setFoto2($foto2);
        $newAnnonce->setFoto3($foto3);
        $newAnnonce->setUserId($id);
        $lastInsertAnnonce=$newAnnonce->save($bdd);
        $_SESSION["lastInsertAnnonce"]=$lastInsertAnnonce ;

          Flight::redirect('/Oneannonce');
            
    }   

    else{
         Flight::redirect('/FormAnnonce');
    }         
}
       
        
    
         
    });

//oneAnnonce
    Flight::route('/oneAnnonce', function(){
       
        $Page="Annonce";
        Flight::render('header', array('heading'=>$Page), "header");
        Flight::render('oneAnnonce');
});
       
 //MesAnnonces
    Flight::route('/MesAnnonces', function(){
       
        $Page="Annonce";
        Flight::render('header', array('heading'=>$Page), "header");
        Flight::render('MesAnnonces');
});
      
    
  //DeleteAnnonce
    Flight::route('/DeleteAnnonce', function(){
        $id =$_POST['getid'];
        $bdd= new BddManager;
        $AnnoncesRepository=$bdd->getAnnonceRepository();
        $DeleteAnnonce = $AnnoncesRepository->getAnnonceById($id);
        $DeleteAnnonce->delete($bdd);
       
    $Page="delete";
         
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::redirect('/');
    

});  



//UpdateAnnonce
Flight::route('/UpdateAnnonce', function(){
            
    $Page="UpdateAnnonce";
    Flight::render('header', array('heading'=>$Page), "header");
    Flight::render('UpdateAnnonce');

});  
//UpdateAnnonceRegisterSercice
Flight::route('/UpdateAnnonceRegisterSercice', function(){
$request = Flight::request();
 if (isset($_SESSION["user"])){
             $user=new User();
             $user= $_SESSION["user"] ;
             $id= $user->getId();
             
             
    // on créer l'array que l'on va passer à notre RegisterService
    $params = [
    'type' => $request->data['type'],
    'chambre' => $request->data['chambre'],
    'description' => $request->data['description'],
    'superficie' => $request->data['superficie'],
    'ville' => $request->data['ville'],
    'prix' => $request->data['prix'],
    'dateDebut' => $request->data['dateDebut'],
    'dateFin' => $request->data['dateFin'],
    'foto1' => $request->files['foto1'],
    'foto2' => $request->files['foto2'],
    'foto3' => $request->files['foto3'],
     'userId' => $id
    
    
    ];

        $photos=array();
         if(empty($params['foto1']["error"])){
            $photo=new Photo1();
            $name=$photo->upload();
            $photos["foto1"]=$name;
            $foto1=$photos["foto1"];
                    
         }
         else{
             $photos["foto1"]=$_POST["foto11"];
             $foto1=$photos["foto1"];
                     
         }
          if(empty($params['foto2']["error"])){
            $photo=new Photo2();
            $name=$photo->upload();
            $photos["foto2"]=$name;
            $foto2=$photos["foto2"];
                    
         }
         else{
             $photos["foto2"]=$_POST["foto22"];
             $foto2=$photos["foto2"];
                     
         }
         if(empty($params['foto3']["error"])){
            $photo=new Photo3();
            $name=$photo->upload();
            $photos["foto3"]=$name;
            $foto3=$photos["foto3"];
                    
         }
         else{
             $photos["foto3"]=$_POST["foto33"];
             $foto3=$photos["foto3"];
                     
         }

//modification d'une annonce
        $id =$_POST['getid'];
      
        $bdd= new BddManager;
               
        $UpdateAnnonce=new Annonce();
        $UpdateAnnonce->setId($id);
        $UpdateAnnonce->setType($request->data['type']);
        $UpdateAnnonce->setChambre( $request->data['chambre']);
        $UpdateAnnonce->setDescription($request->data['description']);
        $UpdateAnnonce->setSuperficie( $request->data['superficie']);
        $UpdateAnnonce->setVille($request->data['ville']);
        $UpdateAnnonce->setPrix($request->data['prix']);
        $UpdateAnnonce->setDateDebut($request->data['dateDebut']);
        $UpdateAnnonce->setDateFin($request->data['dateFin']);
        $UpdateAnnonce->setFoto1($foto1);
        $UpdateAnnonce->setFoto2($foto2);
        $UpdateAnnonce->setFoto3($foto3);
        $UpdateAnnonce->setUserId($id);
        
        $UpdateAnnonce->save($bdd);

 }
 Flight::redirect('/MesAnnonces');
});  
Flight::start();
?>

