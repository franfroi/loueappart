<?php
require 'model/registerService.php';

//pour utiliser la librairie PHPUNIT
use PHPUnit\Framework\TestCase;

    class testregisterService extends TestCase
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

            $registerService=new registerService();
            $registerService->launchControls($array);
            //la methode suivante veridie que notre array erreur a l'index username
            //var_dump($registerService->getError());
            $this->assertArrayHaskey('username',$registerService->getError());

         }

        public function testNoPassword()
            {
                $array =array (
                    'username'=>'user',
                    'password'=>'',
                    'repassword'=>'123',
                    'email'=>'fff@gk.frfsdfsfd'
                );

                $registerService=new registerService();
                $registerService->setParams($array);
                $registerService->launchControls($array);
                    
            //var_dump($registerService->getError());
                $this->assertArrayHaskey('password',$registerService->getError());

            }

        public function testNolenghtPassword()
            {
                $array =array (
                    'username'=>'user',
                    'password'=>'1238',
                    'repassword'=>'123',
                    'email'=>'abc@ll.fr'
                );

                $registerService=new registerService();
                $registerService->setParams($array);
                $registerService->launchControls($array);
                    
            //var_dump($registerService->getError());
            $this->assertArrayHaskey('password',$registerService->getError());

            }
        
        public function testRePassword()
        {
            $array =array (
                'username'=>'user',
                'password'=>'12345678',
                'repassword'=>'123',
                    'email'=>'fff@gk.fr'
            );

            $registerService=new registerService();
            $registerService->setParams($array);
            $registerService->launchControls($array);
                
            //var_dump($registerService->getError());
            $this->assertArrayHaskey('repassword',$registerService->getError());

        }

        public function testNoMail()
        {
            $array =array (
                'username'=>'francois',
                'password'=>'12345678',
                'repassword'=>'12345678',
                    'email'=>''
            );

            $registerService=new registerService();
            $registerService->setParams($array);
            $registerService->launchControls($array);
                
            //var_dump($registerService->getError());
            $this->assertArrayHaskey('email',$registerService->getError());

        }

         public function Mailformat()
        {
            $array =array (
                'username'=>'francois',
                'password'=>'12345678',
                'repassword'=>'12345678',
                    'email'=>'blala'
            );

            $registerService=new registerService();
            $registerService->setParams($array);
            $registerService->launchControls($array);
                
           
            $this->assertArrayHaskey('email',$registerService->getError());
             //var_dump($registerService->getError());
        }

            public function testMailExist()
        {
            $array =array (
                'username'=>'francois',
                'password'=>'12345678',
                'repassword'=>'12345678',
                    'email'=>'fc@fc.fr'
            );

            $registerService=new registerService();
            $registerService->setParams($array);
            $registerService->launchControls($array);
                
           // var_dump($registerService->getError());
            $this->assertArrayHaskey('email',$registerService->getError());

        }
            public function testMailNoExist()
            {
                 $registerService=new registerService();
                $array =array (
                    'username'=>'francois',
                    'password'=>'12345678',
                    'repassword'=>'12345678',
                     'email'=>'fc@fcfgfggf.fr'
                );

                $registerService->setParams($array);
                $registerService->launchControls($array);
                    
                //var_dump($registerService->getUser());
                $this->assertEquals(true,is_array($registerService->getUser()));
                $this->assertArrayHaskey('id',$registerService->getUser()[0]);
               

            }
           
    }