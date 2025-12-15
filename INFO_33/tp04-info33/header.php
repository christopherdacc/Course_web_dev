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
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bibliotheque</title>    
        <link rel="stylesheet" href="bibliotheque.css"> 
        <link rel="stylesheet" href="formulaire.css">
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
                        <li><a href="">Liste</a></li>
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

                    <?php
                    if (!isset($session_idutilisateur)) {
                        ?>
                        <a href="login.php">Connexion</a>
                    <?php } else {
                        ?> 
                        <a href="logout.php">Déconnexion</a>
                    <?php }
                    ?> 


                </li>

            </ul>
        </nav>