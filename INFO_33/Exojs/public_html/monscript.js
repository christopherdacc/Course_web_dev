let num1, num2;

function changer_nom(){
    let nouveau_nom = $('#lentree').val();
    $('#nom').text(nouveau_nom);
}

function changer_couleur(){
    let nouvelle_couleur = $('#lacouleur').val();
    $('#nom').css('color', nouvelle_couleur);
}

function convert_temp(){
    let celcius_temp = $('#latemperatureC').val();
    let celcius_temp2 = $('#latemperatureC2').val();
    let F_temp;
    let F_temp2;
    F_temp = (celcius_temp * (9/5))+32;
    F_temp2 = (celcius_temp2 * (9/5))+32;
    
    $('#F_temperature').text(F_temp);
    $('#F_temperature2').text(F_temp2);
    
}

function getRandomInt() {
  num1 = Math.floor(Math.random() * 10) + 1;
  num2 = Math.floor(Math.random() * 10) + 1;
  $('#premier_n').text(num1);
  $('#deuxieme_n').text(num2);
  $('#premier_n1').text(num1);
  $('#deuxieme_n1').text(num2);
}

function checker() {
  let answer = num1 * num2;
  let userAnswer = Number($('#reponse').val());
  
  if (answer === userAnswer) {
    $('#reponse_check').text('correct');
    getRandomInt(); // generate new question
    $('#reponse').val(''); // clear the input
  } else {
    $('#reponse_check').text('fausse');
  }
}





$(function(){
    $("#lebouton").click(changer_nom);
    $("#lebouton2").click(changer_couleur);
    $("#lebouton3").click(convert_temp);
    $("#latemperatureC2").on('input',convert_temp);
    $("#lebouton4").click(checker);
});

$(document).ready(function() {
  getRandomInt();
});

/*function initialisation(){          //other method
    $("#lebouton").click(changer_nom);
}
$(initialisation);*/