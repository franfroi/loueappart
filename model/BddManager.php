<?php

class BddManager
{
    private $connexion;
    private $userRepository;
    private $statutUserRepository;
    private $AnnonceRepository;

    function setUserRepository($userRepository) { $this->userRepository = $userRepository; }
    function getUserRepository() { return $this->userRepository; }

    function setStatutUserRepository($statutUserRepository) { $this->statutUserRepository = $statutUserRepository; }
    function getStatutUserRepository() { return $this->statutUserRepository; }

    function setAnnonceRepository($AnnonceRepository) { $this->AnnonceRepository = $AnnonceRepository; }
    function getAnnonceRepository() { return $this->AnnonceRepository; }

    public function __construct()
    {
        $this->connexion = Connexion::getConnexion();
        $this->setUserRepository(new UserRepository($this->connexion));
        $this->setStatutUserRepository(new StatutUserRepository($this->connexion));
        $this->setAnnonceRepository(new AnnonceRepository($this->connexion));
       
    }

}

 ?>
