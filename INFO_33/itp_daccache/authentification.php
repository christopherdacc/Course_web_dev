<?php
// Démmarrer une session si cela n'a pas déjà été fait
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

// Vérification d'une éventuelle connexion d'un utilisateur
if (isset($_SESSION['session_idutilisateur'])) {
  // Un utilisateur est connecté
  // -> Récupération des informations de session dans des variables du script
  $session_idutilisateur = $_SESSION['session_idutilisateur'];
  $session_pseudo = $_SESSION['session_pseudo'];
  $session_nom = $_SESSION['session_nom'];
  $session_prenom = $_SESSION['session_prenom'];
} else {
  // Aucun utilisateur connecté
  // -> Redirection vers la page de connexion
  header('Location: login.php');

  // Fin du script au cas où la redirection n'ait pas pu se faire
  exit();
}
?>