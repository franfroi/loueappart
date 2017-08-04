var $form = $('form');

//$(element).find permet d'aller chercher les éléments enfants de form
// On a un gain de temps en effectuant cette opération car on ne parcours pas
//le DOM entierement à chaque appel !!!
var $inputs = {
    all : $form.find("input, select"),
    pseudo: $form.find('#pseudo'),
    password : $form.find('#password')
   
};


var $errorpseudo = $("#errorpseudo");
var $errorpassword = $("#errorpassword");
var thereWasError = false;
var thereWasErrorall = false;


$( document ).ready(function() {
  $inputs.pseudo.focus();
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
         //$(this).focus();
         
    }

});

$inputs.pseudo.focusout(function(event){ 
     //event.preventDefault(); //Empeche le rechargement de la page !
   cleanErrors();
    if($(this).val().length < 8 ){
         //$(this).focus();
        $(this).addClass("redborder");
        var msg = "Pseudo trop court !";
         
        showError(msg, $inputs.pseudo);
      
        
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
         //$(this).focus();
         
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



$form.submit(function(event){ //On soumet/envoi le formulaire

    event.preventDefault(); //Empeche le rechargement de la page !
    cleanErrors();
 //check
   
     if( $inputs.pseudo.val().length < 8 ){
        var msg = "Pseudo trop court !";
        showError(msg, $inputs.pseudo);
    }
     if( $inputs.password.val().length < 8 ){
        var msg = "Password trop court !";
        showError(msg, $inputs.password);
    }
   

    
   if((thereWasError == false) && (thereWasErrorall == true)){
        
         //unbind : supprimer toute les actions associé à l'évenement
       $form.unbind("submit").submit();

     }   

 });

function showError(errorMsg, $target){
switch ( $target)
{
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
              
}
 
}

function cleanErrors(){
    $errorpseudo.html(""); //Vide le html
    $errorpassword.html(""); //Vide le html
       
    $inputs.all.removeClass("redborder"); //Retire la classe d'erreur
    thereWasError = false;
    thereWasErrorall = true;
}

  






