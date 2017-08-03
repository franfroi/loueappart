<?php
require 'model/loginService.php';

//pour utiliser la librairie PHPUNIT
use PHPUnit\Framework\TestCase;

    class testLoginService extends TestCase
    {
         public function testPushAndPop()
        {
            $stack = [];
            $this->assertEquals(0, count($stack));

            array_push($stack, 'foo');
            $this->assertEquals('foo', $stack[count($stack)-1]);
            $this->assertEquals(1, count($stack));

            $this->assertEquals('foo', array_pop($stack));
            $this->assertEquals(0, count($stack));
        }


         public function testNoUsername()
        {
            $array =array (
                'username'=>'',
                'password'=>'password'
            );

            $service=new loginService();
            $service->launchControls($array);
            //la methode suivante veridie que notre array erreur a l'index username
            //var_dump($service->getError());
            $this->assertArrayHaskey('username',$service->getError());

         }

          public function testNoPassword()
        {
            $array =array (
                'username'=>'user',
                'password'=>''
            );

            $service=new loginService();
            $service->setParams($array);
            $service->launchControls($array);
                  
           //var_dump($service->getError());
            $this->assertArrayHaskey('password',$service->getError());

         }
          public function testCredentialsBadPassword()
        {
            $service=new loginService();
            $array =array (
                'username'=>'francois',
                'password'=>'123'
            );

            $service->setParams($array);
            $service->launchControls($array);
                  
           //var_dump($service->getUser());
           //retourne false si pas bon
            $this->assertEquals(false,$service->getUser());
        }
         public function testCredentialsBadUsername()
        {
            $service=new loginService();
            $array =array (
                'username'=>'francoi',
                'password'=>'1234'
            );

            $service->setParams($array);
            $service->launchControls($array);
                  
           //var_dump($service->getUser());
           //retourne false si pas bon
            $this->assertEquals(false,$service->getUser());
        }

          public function testCredentials()
        {
             $service=new loginService();
            //avec les bons identifiants
             $array =array (
                'username'=>'francois',
                'password'=>'1234'
            );
            $service->setParams($array);
            $service->launchControls($array);
                  
           var_dump($service->getUser());
            $this->assertEquals(true,is_array($service->getUser()));
            $this->assertArrayHaskey('id',$service->getUser()[0]);
         }
    }