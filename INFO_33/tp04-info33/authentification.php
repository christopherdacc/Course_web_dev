<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//enregistrement de l'identifiant, du pseudo, du nom et du prénom de l'utilisateur authentifié dans des variables de session, et 
if (isset($_SESSION['session_idutilisateur'])) {
    $session_idutilisateur = $_SESSION['session_idutilisateur'];
    $session_pseudo = $_SESSION['session_pseudo'];
    $session_nom = $_SESSION['session_nom'];
    $session_prenom = $_SESSION['session_prenom'];
} else{
    header('Location: login.php');
    exit();
}
?>