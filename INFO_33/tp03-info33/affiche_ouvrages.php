<?php
// La variable $message contiendra les éventuels messages de l'application à afficher
$message = "";

// La variable $message_erreur contiendra les éventuels messages d'erreur de l'application à afficher
$message_erreur = "";

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

// Affichage de la table produit.
if (empty($message_erreur)) {
    $tableau_ouvrage = "";
    $sql = 'select * from ouvrage';
    $requete = mysqli_query($connexion, $sql);
    if ($requete && $requete2) {
        $message .= "<b>Liste des ouvrages :</b><br>";
        $tableau_ouvrage.= "<table>\n<thead>\n";
        $tableau_ouvrage.= "<tr><th>ISBN</th><th>Titre</th></tr>\n";
        $tableau_ouvrage.= "</thead>\n<tbody>\n";
        while ($ligne = mysqli_fetch_assoc($requete) && $ligne2 = mysqli_fetch_assoc($requete2)) {
            $tableau_ouvrage .= "<tr><td>" . $ligne['ISBN'] . " </td><td> " . $ligne['Titre'] . "</td></tr>\n" ;
        }
        $tableau_ouvrage.= "</tbody>\n</table>\n";
    } else {
        $message_erreur .= "Echec de l\'affichage.<br>\n";
        $message_erreur .= "Error n° " . mysqli_errno($connexion) . "<br>\n";
        $message_erreur .= mysqli_error($connexion) . "<br>\n";
    }
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
        <style>
            table{
                border:1px solid black;
                border-collapse: collapse;
            }
            th,td{
                border:1px solid black;
            }
        </style>
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
            <?php
            if (!empty($tableau_ouvrage)) {
                ?>
                <!-- **************************************** -->
                <!-- Tableau ouvrage      -->
                <section>
                    <h2>Tableau ouvrage</h2>
                    <?php
                    echo "<section>\n" . $tableau_ouvrage . "</section>\n";
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