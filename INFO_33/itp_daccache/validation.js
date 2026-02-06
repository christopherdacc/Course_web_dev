"use strict";

function confirmPassword() {
  
  /* ********************************************* */
  /*  QUESTIONS IV.1.f et IV.1.g                   */
  /*  ECRIRE VOTRE CODE ICI                        */
  
   var passe1 = document.getElementById("passe1").value;
        var passe2 = document.getElementById("passe2").value;
        if (passe1 !== passe2) {
            //alert("Passwords Do not match");
            let nouvelle_couleur = $('red').val();
            $('#passe2').css('color', nouvelle_couleur);
            $('#passe1').css('color', nouvelle_couleur);
            document.getElementById("passe1").style.borderColor = "#E34234";
            document.getElementById("passe2").style.borderColor = "#E34234";
        }
        else {
            alert("Passwords Match!!!");
        }
  
  /* ********************************************* */  
  
};

$(function () {
  $("#inscription-form").submit(confirmPassword);
});
