<?php
// La variable $message contiendra les messages à afficher
$message = "";

// La variable $message_erreur contiendra les éventuels messages d'erreur à afficher
$message_erreur = "";

// Initialisation de la variable contenant l'ISBN du livre à afficher
// $isbn = "2021116190";
$isbn = "";

// La variable $affiche_fiche_livre contiendra l'affichage
// de la fiche du livre
$affiche_fiche_livre = "";

// Connexion à la base de données bibliotheque du serveur localhost
require 'base_connexion.php';

// ***********************************************
// Construction de l'affichage de la fiche
// du livre
// ***********************************************
//  QUESTIONS III.1 et III.2 ECRIRE VOTRE CODE ICI
// ***********************************************

if (empty($message_erreur)) {
    // Affichage de la table ouvrage complétée par les noms
    // et les prénoms des auteurs
    $requete = "select o.Titre, o.ISBN, o.Resume, group_concat(a.Nom,' ',coalesce(a.Prenom,'') separator ', ') as 'Auteurs'
                from auteur a
                  inner join auteur_ouvrage ao ON ao.IdAuteur = a.IdAuteur
                    inner join ouvrage o ON ao.ISBN = o.ISBN
                group by o.Titre
                order by o.Titre asc;";

    // Exécution de la requête 
    $resultat = mysqli_query($connexion, $requete);
    if ($resultat) {
        // Vérification du nombre de lignes du résultat
        if (mysqli_num_rows($resultat) == 0) {
            // La table ouvrage est vide
            $affiche_fiche_livres .= "Aucun ouvrage<br>\n";
        } else {
            if ($isbn == 'ISBN'){
                
            }
            
            $affiche_fiche_livres .= "<img href";
        }
    } else {
        $message_erreur .= "Erreur de la requête $requete<br>\n";
        $message_erreur .= "Erreur n° " . mysqli_errno($connexion) . " : " . mysqli_error($connexion) . "<br>\n";
    }
}


// Déconnexion de la base de données
require 'base_deconnexion.php';

// Construction de la page HTML
require 'header.php';
?>
<main>
  <?php
  // Messages éventuels de l'application
  require 'messages_application.php';
  ?>
  <!-- **************************************** -->
  <!-- Affichage de la fiche du livre           -->

  <!-- **************************************** -->
  <!--  QUESTION III.1 ECRIRE VOTRE CODE ICI    -->
  <!-- **************************************** -->
  
  <!doctype html>
<!-- **************************************** -->
<!-- Construction de la page HTML             --> 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Info livre</title>
        <link rel="stylesheet" href="bibliotheque.css">
    </head>
    <body>
        <nav>
            <!-- Insérer une barre de navigation ici -->
        </nav>
        <main>
            <?php
            if (!empty($message_erreur) || !empty($message)) {
                ?>
                <!-- **************************************** -->
                <!-- Messages de l'application                -->
                <section class="affiche-livre">
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
            if (!empty($affiche_fiche_livre)) {
                ?>
                <!-- **************************************** -->
                <!-- Affichage de la table ouvrage            -->
                <section class="section-formulaire">
                    <h2>Ouvrages</h2>
                    <?php
                    echo $affiche_fiche_livre;
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
  
  <!-- **************************************** -->

</main>
<?php require 'footer.php'; ?>