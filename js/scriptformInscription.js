var $form = $('form');

//$(element).find permet d'aller chercher les éléments enfants de form
// On a un gain de temps en effectuant cette opération car on ne parcours pas
//le DOM entierement à chaque appel !!!
var $inputs = {
    all : $form.find("input, select"),
    name : $form.find('#name'),
    prenom: $form.find('#prenom'),
    pseudo: $form.find('#pseudo'),
    password : $form.find('#password'),
    repassword : $form.find('#repassword'),
    mail : $form.find('#mail')
    
  

};

var $errorname = $("#errorname");
var $errorprenom = $("#errorprenom");
var $errorpseudo = $("#errorpseudo");
var $errorpassword = $("#errorpassword");
var $errorrepassword = $("#errorrepassword");
var $errormail = $("#errormail");
var thereWasError = false;
var thereWasErrorall = false;


$( document ).ready(function() {
  $inputs.name.focus();
});

 //Check name
$inputs.name.keyup(function(event){ 
      
    if($(this).val().length >= 3 ){
         $(this).addClass("greenborder");
         $errorname.html("");
    }

});

$inputs.name.keydown(function(event){ 

    if($(this).val().length <= 3 ){
         $(this).removeClass("greenborder");
        // $(this).focus();
         
    }

});

$inputs.name.focusout(function(event){ 
   cleanErrors();
    if($(this).val().length < 3 ){
        $(this).addClass("redborder");
          //$(this).focus();
        var msg = "Nom trop court !";
        showError(msg, $inputs.name);
       
        
    }
    
});

//Check prenom
$inputs.prenom.keyup(function(event){ 
      
    if($(this).val().length >= 3 ){
         $(this).addClass("greenborder");
         $errorprenom.html("");
    }

});

$inputs.prenom.keydown(function(event){ 

    if($(this).val().length <= 3 ){
         $(this).removeClass("greenborder");
        // $(this).focus();
         
    }

});

$inputs.prenom.focusout(function(event){ 
     //event.preventDefault(); //Empeche le rechargement de la page !
   cleanErrors();
    if($(this).val().length < 3 ){
        $(this).addClass("redborder");
        var msg = "Prénom trop court !";
        showError(msg, $inputs.prenom);
        //$(this).focus();
        
    }
    
});

//Check pseudo
$inputs.pseudo.keyup(function(event){ 
      
    if($(this).val().length >= 8 ){
         $(this).addClass("greenborder");
         $errorpseudo.html("");
    }

});

$inputs.pseudo.keydown(function(event){ 

    if($(this).val().length <= 8 ){
         $(this).removeClass("greenborder");
        // $(this).focus();
         
    }

});

$inputs.pseudo.focusout(function(event){ 
     //event.preventDefault(); //Empeche le rechargement de la page !
   cleanErrors();
    if($(this).val().length < 8 ){
        $(this).addClass("redborder");
        var msg = "Pseudo trop court !";
        showError(msg, $inputs.pseudo);
        //$(this).focus();
        
    }
    
});

//Check password
$inputs.password.keyup(function(event){ 
      
    if($(this).val().length >= 8 ){
         $(this).addClass("greenborder");
         $errorpassword.html("");
    }

});

$inputs.password.keydown(function(event){ 

    if($(this).val().length <= 8 ){
         $(this).removeClass("greenborder");
        // $(this).focus();
         
    }

});

$inputs.password.focusout(function(event){ 
     //event.preventDefault(); //Empeche le rechargement de la page !
   cleanErrors();
    if($(this).val().length < 8 ){
        $(this).addClass("redborder");
        var msg = "Password trop court !";
        showError(msg, $inputs.password);
        //$(this).focus();
        
    }
    
});

//Check repassword
$inputs.repassword.keyup(function(event){ 
      
    if($(this).val() == $inputs.password.val() ){
         $(this).addClass("greenborder");
         $errorrepassword.html("");
    }

});

$inputs.repassword.keydown(function(event){ 

    if($(this).val() != $inputs.password.val() ){
         $(this).removeClass("greenborder");
        // $(this).focus();
         
    }

});

$inputs.repassword.focusout(function(event){ 
     //event.preventDefault(); //Empeche le rechargement de la page !
   cleanErrors();
    if($(this).val() != $inputs.password.val() ){
        $(this).addClass("redborder");
        var msg = "Password non identique !";
        showError(msg, $inputs.repassword);
        //$(this).focus();
        
    }
    
});
//Check mail

$inputs.mail.keyup(function(event){ 
     
   if (validate_Email($inputs.mail.val())){
         $(this).addClass("greenborder");
         $errormail.html("");
        
    }
});

 $inputs.mail.keydown(function(event){ 

     if (!validate_Email($inputs.mail.val())){
         $(this).removeClass("greenborder");
        // $(this).focus();
        
        
    }
         
    

});

$inputs.mail.focusout(function(event){ 
   // event.preventDefault(); //Empeche le rechargement de la page !
    cleanErrors();

   if (!validate_Email($inputs.mail.val()))    {
        $inputs.mail.addClass("redborder");
        var msg = "Email incorrect !";
        showError(msg, $inputs.mail);
        // $(this).focus();
         
    }
       
    

});



$form.submit(function(event){ //On soumet/envoi le formulaire

    event.preventDefault(); //Empeche le rechargement de la page !
    cleanErrors();
 //check
    if( $inputs.name.val().length < 8 ){
        var msg = "Nom trop court !";
        showError(msg, $inputs.name);
    }
    if( $inputs.prenom.val().length < 8 ){
        var msg = "Prenom trop court !";
        showError(msg, $inputs.prenom);
    }

     if( $inputs.pseudo.val().length < 8 ){
        var msg = "Pseudo trop court !";
        showError(msg, $inputs.pseudo);
    }
     if( $inputs.password.val().length < 8 ){
        var msg = "Password trop court !";
        showError(msg, $inputs.password);
    }
    if( $inputs.repassword.val()!= $inputs.password.val()  ){
        var msg = "Password non identique !";
        showError(msg, $inputs.repassword);
    }
     if($inputs.mail.val().length < 1){
        var msg = "Email non valide ! ";
        showError(msg, $inputs.mail);
    }
    if (!validate_Email($inputs.mail.val()))    {
        var msg = "  Mauvais format Email !";
        showError(msg, $inputs.mail);
        
         
    }

    
   if((thereWasError == false) && (thereWasErrorall == true)){
        
         //unbind : supprimer toute les actions associé à l'évenement
       $form.unbind("submit").submit();

     }   

 });

function showError(errorMsg, $target){
switch ( $target)
{
  case $inputs.name:
    $errorname.append("<p>"+errorMsg+"</p>"); //Ajouter du texte/html a la suite
    $target.addClass("redborder");
    thereWasError = true;
    break;  
    case $inputs.prenom:
    $errorprenom.append("<p>"+errorMsg+"</p>"); //Ajouter du texte/html a la suite
    $target.addClass("redborder");
    thereWasError = true;
    break;  
    case $inputs.pseudo:
    $errorpseudo.append("<p>"+errorMsg+"</p>"); //Ajouter du texte/html a la suite
    $target.addClass("redborder");
    thereWasError = true;
    break; 
    case $inputs.password:
    $errorpassword.append("<p>"+errorMsg+"</p>"); //Ajouter du texte/html a la suite
    $target.addClass("redborder");
    thereWasError = true;
    break; 
    case $inputs.repassword:
    $errorrepassword.append("<p>"+errorMsg+"</p>"); //Ajouter du texte/html a la suite
    $target.addClass("redborder");
    thereWasError = true;
    break;  
    case $inputs.mail:
    $errormail.append("<span>"+errorMsg+"</span>"); //Ajouter du texte/html a la suite
    $target.addClass("redborder");
    thereWasError = true;
    break; 
    
            
}
 
}

function cleanErrors(){
    $errorname.html(""); //Vide le html
    $errorprenom.html(""); //Vide le html
    $errorpseudo.html(""); //Vide le html
    $errorpassword.html(""); //Vide le html
    $errorrepassword.html(""); //Vide le html
    $errormail.html(""); //Vide le html
   
    $inputs.all.removeClass("redborder"); //Retire la classe d'erreur
    thereWasError = false;
    thereWasErrorall = true;
}

    function validate_Email(sendemail) {
    var expression = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return expression.test(sendemail);
}
   






