var $form = $('form');

//$(element).find permet d'aller chercher les éléments enfants de form
// On a un gain de temps en effectuant cette opération car on ne parcours pas
//le DOM entierement à chaque appel !!!
var $inputs = {
    all : $form.find("input, select"),
    name : $form.find('#name'),
    prenom: $form.find('#prenom'),
    mail : $form.find('#mail')
    // ,
    // password : $form.find('#password'),
    // password_check : $form.find('#password-confirm'),
  

};

var $errorname = $("#errorname");
var $errormail = $("#errormail");
var thereWasError = false;

$( document ).ready(function() {
  $inputs.name.focus();
});

 //Check name
$inputs.name.keyup(function(event){ 
      
    if($(this).val().length >= 8 ){
         $(this).addClass("greenborder");
         $errorname.html("");
    }

});

$inputs.name.keydown(function(event){ 

    if($(this).val().length <= 8 ){
         $(this).removeClass("greenborder");
         $(this).focus();
         
    }

});

$inputs.name.focusout(function(event){ 
   cleanErrors();
    if($(this).val().length < 8 ){
        $(this).addClass("redborder");
        var msg = "Nom trop court !";
        showError(msg, $inputs.name);
        $(this).focus();
        
    }
    
});

//Check prenom
$inputs.prenom.keyup(function(event){ 
      
    if($(this).val().length >= 8 ){
         $(this).addClass("greenborder");
         $errorprenom.html("");
    }

});

$inputs.prenom.keydown(function(event){ 

    if($(this).val().length <= 8 ){
         $(this).removeClass("greenborder");
         $(this).focus();
         
    }

});

$inputs.prenom.focusout(function(event){ 
  // cleanErrors();
    if($(this).val().length < 8 ){
        $(this).addClass("redborder");
        var msg = "Nom trop court !";
        showError(msg, $inputs.prenom);
        $(this).focus();
        
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
         $(this).focus();
        
        
    }
         
    

});

$inputs.mail.focusout(function(event){ 
    event.preventDefault(); //Empeche le rechargement de la page !
    cleanErrors();

   if (!validate_Email($inputs.mail.val()))    {
        $inputs.mail.addClass("redborder");
        var msg = "Email incorrect !";
        showError(msg, $inputs.mail);
         $(this).focus();
         
    }
       
    

});



$form.submit(function(event){ //On soumet/envoi le formulaire

    event.preventDefault(); //Empeche le rechargement de la page !

    // cleanErrors();
   if(thereWasError == false){
        
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
    case $inputs.mail:
    $errormail.append("<p>"+errorMsg+"</p>"); //Ajouter du texte/html a la suite
    $target.addClass("redborder");
   
    thereWasError = true;
    break; 
    
            
}
 
}

function cleanErrors(){
    $errorname.html(""); //Vide le html
    $errormail.html(""); //Vide le html
    $inputs.all.removeClass("redborder"); //Retire la classe d'erreur
    thereWasError = false;
}

    function validate_Email(sendemail) {
    var expression = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return expression.test(sendemail);
}
   






