"use strict";

var validateRecherche = function() {
    var auteur = $('#auteur').val().trim()
    var titre = $('#titre').val().trim()
    console.log("auteur: '"+auteur+"' titre: '" + titre + "'");
    if (!auteur && !titre) {
        alert('Il faut saisir au moins un champ de recherche.');
        return false;
    }
};

$(function() {
    $('#form-recherche').on('submit', validateRecherche);
});
