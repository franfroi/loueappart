<?php
 function loadMyClass($class){
    if(class_exists($class)===false){
        $string= "model/entity/".$class.'.php';

        if(file_exists($string)===true){
            require_once $string;
        }
         $string= "model/repository/".$class.'.php';
        if(file_exists($string)===true){
            require_once $string;
        }
         $string= "model/service/".$class.'.php';
        if(file_exists($string)===true){
            require_once $string;
        }
         $string= "model/".$class.'.php';
        if(file_exists($string)===true){
            require_once $string;
        }
    }
        
       
    
}
spl_autoload_register("loadMyClass");
?>