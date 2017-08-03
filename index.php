<?php
require 'flight/Flight.php';
//require 'model/loginService.php';
require 'model/registerService.php';

Flight::render('header', array(), 'header');
Flight::render('footer', array(), 'footer');
Flight::route('/', function(){
    //$registerService = new registerService();
    Flight::render('Form');
});
Flight::route('/formInscription', function(){
    $registerService = new registerService();
    Flight::render('formInscription');
});
Flight::route('POST /register', function(){
    // on définie une variable $request pour faciliter l'accès au données du formulaire
    $request = Flight::request();
    // on créer l'array que l'on va passer à notre RegisterService
    $params = [
    'username' => $request->data['username'],
    'password' => $request->data['password'],
    'repassword' => $request->data['repassword'],
    'email' => $request->data['email']
    ];
    // on créer notre instance, on définie les paramètres, on lance la requete
    $registerService = new registerService();
    $registerService->setParams($params);
    $registerService->launchControls();
    if ($registerService->launchControls()==NULL){$registerService->register($params);
   }
    // on envoie les donner de getError() sur la page formInscription
    // si $registerService == null alors l'utilisateur à bien était ajouter
    //$registerService->register($params);
    
    // Flight::render('acecueil', array());
     Flight::render('formInscription', array('registerService' => $registerService->getError()));
 //Flight::redirect('footer');
});
Flight::start();
?>

