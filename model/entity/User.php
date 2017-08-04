<?php
 class User
{
    private $id;
    private $name;
    private $prenom;
    private $pseudo;
    private $password;
    private $mail;

    function setId($id) { $this->id = $id; }
    function getId() { return $this->id; }
    function setName($name) { $this->name = $name; }
    function getName() { return $this->name; }
    function setPrenom($prenom) { $this->prenom = $prenom; }
    function getPrenom() { return $this->prenom; }
    function setPseudo($pseudo) { $this->pseudo = $pseudo; }
    function getPseudo() { return $this->pseudo; }
    function setPassword($password) { $this->password = $password; }
    function getPassword() { return $this->password; }
    function setMail($mail) { $this->mail = $mail; }
    function getMail() { return $this->mail; }

    public function __construct($donnees=array())
    {
            //var_dump($donnees);
            $this->hydrate($donnees);
    }

    public function hydrate($donnees)
    {
       foreach ($donnees as $key => $value)
        {

            //ici on rajoute un remplacemnt des underscore
            $key=preg_replace("#_#","",$key);
            //donc pour l'index id on met en majusscule
            //et le prefix avec set
           $method="set".ucfirst($key);
          if(method_exists($this,$method))
          {
                $this->$method($value);
          }
       }
    }

    public function save(BddManager $bddManager)
    {
      //$this tout court sert à passer l'objet lui même
      $bddManager->getUserRepository()->saveUser($this);
    }

    public function delete(BddManager $bddManager)
    {
      $bddManager->getUserRepository()->deleteUser($this);
    }        
        
            

        
}