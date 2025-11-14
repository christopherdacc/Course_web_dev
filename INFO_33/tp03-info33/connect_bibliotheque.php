<?php
// La variable $message contiendra les éventuels messages de l'application à afficher
$message = "";

// La variable $message_erreur contiendra les éventuels messages d'erreur de l'application à afficher
$message_erreur = "";

// Gestion d'erreur manuelle : désactivation des rapports d'erreur
// error_reporting(0); // Désactivation du rapport d'erreurs de PHP
mysqli_report(MYSQLI_REPORT_OFF); // Désactivation du rapport d'erreur mysqli
// Connexion (avec sélection de la base de données).
$connexion = mysqli_connect('localhost', 'root', '', 'bibliotheque');
if ($connexion) {
    $message .= "Connexion réussi<br>\n";
    //Changement du jeu de charactère pour UTF8
    mysqli_set_charset($connexion, "utf8");
} else {
    $message_erreur .= "Echec de la connexion.<br>\n";
    $message_erreur .= "Error n° " . mysqli_connect_errno($connexion) . "<br>\n";
    $message_erreur .= mysqli_connect_error($connexion) . "<br>\n";
}


// Déconnexion de la base de données
if ($connexion) {
    mysqli_close($connexion);
    $message .= "Déconnexion réussie<br>\n";
} else {
    $message_erreur .= "Déconnexion échec<br>\n";
}
?> 
<!doctype html>
<!-- **************************************** -->
<!-- Construction de la page HTML             --> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Programmation MySQL en PHP</title>
        <link rel="stylesheet" href="formulaire.css">   
    </head>
    <body>
        <header>
            <h1><a href="index.php">TP PHP/MySQL n°3 : Programmation MySQL en PHP</a></h1>
        </header>
        <nav>
            <!-- Insérer une barre de navigation ici -->
        </nav>
        <main>
            <?php
            if (!empty($message_erreur) || !empty($message)) {
                ?>
                <!-- **************************************** -->
                <!-- Messages éventuels de l'application      -->
                <section>
                    <h2>Logs</h2>
                    <?php
                    if (!empty($message_erreur)) {
                        echo "<section class=\"erreur\">\n" . $message_erreur . "</section>\n";
                    }
                    if (!empty($message)) {
                        echo "<section>\n" . $message . "</section>\n";
                    }
                    ?>
                </section>          
                <?php
            }
            ?> 
        </main>
        <footer>
            <!-- Insérer un pied de page ici -->
        </footer>
    </body>
</html>