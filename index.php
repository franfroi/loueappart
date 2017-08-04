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
   
    Flight::render('formInscription');
});

//formlogin
Flight::route('/formLogin', function(){
   $loginService = new loginService();
    Flight::render('formLogin');
});

// Flight::route('/formLogin', function(){
//     $registerService = new registerService();
//     Flight::render('formLogin');
// });
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
    
   
  
    // on envoie les donner de getError() sur la page formInscription
    // si $registerService == null alors l'utilisateur à bien était ajouter
    //$registerService->register($params);
    
    
     //Flight::render('formLogin', array('loginService' => $loginService->getError()));
     Flight::render('formLogin', array('loginService' => $loginService->getError()));
 
});

Flight::route('/loginInscription', function(){
   // include 'model/service/loginService.php';
    // // on définie une variable $request pour faciliter l'accès au données du formulaire
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
    $registerService = new loginService();
    $registerService->setParams($params);
    $registerService->launchControls();
    
   
  
    // on envoie les donner de getError() sur la page formInscription
    // si $registerService == null alors l'utilisateur à bien était ajouter
    //$registerService->register($params);
    
    
    // Flight::render('formInscription', array('registerService' => $registerService->getError()));
      Flight::render('formInscription', array('registerService' => $registerService));
 
});

Flight::start();
?>

