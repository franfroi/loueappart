<?php
require 'flight/Flight.php';
require 'autoloader.php';

session_start();

Flight::render('header', array(), 'header');
Flight::render('footer', array(), 'footer');

//accueil
Flight::route('/', function(){
    
    Flight::render('accueil');
});

//forminscription
Flight::route('/formInscription', function(){
  $registerService= new registerService();
    Flight::render('formInscription');
});

//formlogin
Flight::route('/formLogin', function(){
   $loginService = new loginService();
    Flight::render('formLogin');
});

//loginService
Flight::route('/loginService', function(){
   // include 'model/service/loginService.php';
    // // on définie une variable $request pour faciliter l'accès au données du formulaire
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
    
    Flight::render('formLogin', array('loginService' => $loginService->getError()));
 
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
        $newUser->save($bdd);
        Flight::redirect('/formLogin');
    }
   
     
 
});

Flight::start();
?>

