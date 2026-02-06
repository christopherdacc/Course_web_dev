<?php
// Enregistrer les variables de session dans des variables du script
require 'obtenir_var_session.php';
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Bibliotheque</title>    
    <link rel="stylesheet" href="bibliotheque.css">
    <link rel="stylesheet" href="formulaire.css">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="validation.js"></script>  
  </head>
  <body>
    <header class="entete">
      <h1>Bibliothèque</h1>
    </header>
    <nav class="menu">
      <ul>
        <li><a href="">Abonnés</a>
          <ul>
              <li><a href="">Liste</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="">Modification</a></li>
            <li><a href="">Suppression</a></li>
          </ul>
        </li>
        <li><a href="">Livres</a>
          <ul>
            <li><a href="livres_liste.php">Liste</a></li>
            <li><a href="">Ajout</a></li>
            <li><a href="">Modification</a></li>
            <li><a href="">Suppression</a></li>
          </ul>
        </li>
        <li><a href="">Emprunts</a>
          <ul>
            <li><a href="">Liste</a></li>
            <li><a href="emprunt.php">Emprunt</a></li>
            <li><a href="">Modification</a></li>
            <li><a href="">Retour</a></li>
          </ul>
        </li>
        <li>
          <?php if (isset($session_idutilisateur) && !empty($session_idutilisateur)) { ?>
            <a href="">Mon compte</a>
            <ul>
              <li><a href="inscription.php?id=<?php echo $session_idutilisateur; ?>">Modification</a></li>
              <li><a href="logout.php">Déconnexion</a></li>
            </ul>
          <?php } else { ?>
            <a href="login.php">Connexion</a>
          <?php } ?>
        </li>
      </ul>
    </nav>