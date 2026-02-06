<?php
// La variable $message contiendra les messages à afficher
$message = "";

// La variable $message_erreur contiendra les éventuels messages d'erreur à afficher
$message_erreur = "";

// Initilaisation de la variable $affiche_liste_livres contenant l'affichage
// de la liste des livres
$affiche_liste_livres = "";

// Connexion à la base de données bibliotheque du serveur localhost
require 'base_connexion.php';

// ***********************************************
// Construction de l'affichage de la liste
// des livres
// ***********************************************
//  QUESTIONS II.2 et III.3 ECRIRE VOTRE CODE ICI
// ***********************************************

if (empty($message_erreur)) {
    // Affichage de la table ouvrage complétée par les noms
    // et les prénoms des auteurs
    $requete = "select o.Titre, o.ISBN, group_concat(a.Nom,' ',coalesce(a.Prenom,'') separator ', ') as 'Auteurs'
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
            $affiche_liste_livres .= "Aucun ouvrage<br>\n";
        } else {
            // Construction du tableau affichant le résultat de la requête
            $affiche_liste_livres .= "<table>\n";
            $affiche_liste_livres .= "<tbody>\n";
            // Récupération des lignes du résultat de la requête
            while ($ligne = mysqli_fetch_assoc($resultat)) {
                $affiche_liste_livres .= "<tr><td>" . $ligne['Titre'] . " </td>"
                        . "<td>" . $ligne['Auteurs'] . "</td><td><a class='selection' href='fiche_livre.php'>" . $ligne['ISBN'] . "</a></td></tr>\n";
            }
            // Fin du tableau affichant le résultat de la requête
            $affiche_liste_livres .= "</tbody>\n</table>\n";
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
  <!-- Affichage de la listes des livres        -->

  <!-- **************************************** -->
  <!--  QUESTION II.2 ECRIRE VOTRE CODE ICI     -->
  <!-- **************************************** -->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Catalog</title>
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
                <section class="section-affichage-livres">
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
            if (!empty($affiche_liste_livres)) {
                ?>
                <!-- **************************************** -->
                <!-- Affichage de la table ouvrage            -->
                <section class="section-affichage-livres">
                    <h2>Catalogue</h2>
                    <?php
                    echo $affiche_liste_livres;
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