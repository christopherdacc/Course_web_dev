<?php
// **********************************************
// Traitement du formulaire de recherche
// 
// La variable $message contiendra les messages à afficher
$message = "";

// La variable $message_erreur contiendra les éventuels messages d'erreur à afficher
$message_erreur = "";

// ***********************************************
//  QUESTION III.2 ECRIRE VOTRE CODE ICI
// ***********************************************
// Initialisation des variables
$auteur = "";
$titre = "";
$tableau_livre = "";

// Connexion à la base de données bibliotheque
require 'base_connexion.php';

// Filtrage des données saisies dans le formulaire
if (isset($_POST['soumettre'])) {

    $auteur = htmlspecialchars($_POST['auteur']);
    $titre = htmlspecialchars($_POST['titre']);
    if (empty($auteur) && empty($titre)) {
        $message_erreur .= "Il faut saisir le nom de l'auteur ou un titre pour faire une recherche<br>\n";
    }
    //cas recherche par auteur seulement
    if (empty($message_erreur) && empty($titre)) {
        $requete = "select Titre, 
  ( select group_concat(coalesce(a.Prenom,''),' ',a.Nom separator ', ') 
    from auteur a inner join auteur_ouvrage ao
      on ao.IdAuteur = a.IdAuteur
    where ao.ISBN = ouvrage.ISBN	
    group by ao.ISBN ) Auteurs, ISBN
from ouvrage
where
isbn in ( select distinct ao.isbn
         from auteur_ouvrage ao inner join auteur a on a.IdAuteur = ao.IdAuteur
         where lower(Nom) like '%$auteur%' or lower(Prenom) like '%$auteur%'
            or lower(Nom) like '%$auteur%' or lower(Prenom) like '%$auteur%'
)
and
isbn in ( select distinct o.isbn
          from ouvrage o
          where lower(Titre) like '%$titre%' or lower(Titre) like '%$titre%'
)
order by Titre;";
        $resultat = mysqli_query($connexion, $requete);

        if ($resultat) {
            if (mysqli_num_rows($resultat) != 0) {
                $tableau_livre .= "<table>\n<thead>\n";
                $tableau_livre .= "<tr><th>Titre</th><th>Auteurs</th><th>ISBN</th></tr>\n";
                $tableau_livre .= "</thead>\n<tbody>\n";
                while ($ligne = mysqli_fetch_assoc($resultat)) {
                    $tableau_livre .= "<tr><td>" . $ligne['Titre'] . " </td>"
                            . "<td>" . $ligne['Auteurs'] . "</td><td>" . $ligne['ISBN'] . "</td></tr>\n";
                }
                $tableau_livre .= "</tbody>\n</table>\n";
            }
        } else {
            $message_erreur .= "Erreur de la requête $requete<br>\n";
            $message_erreur .= "Erreur n° " . mysqli_errno($connexion) . " : " . mysqli_error($connexion) . "<br>\n";
        }
    }
}
require 'base_deconnexion.php';

// Vérification des valeurs saisies dans le formulaire
// Construction de la requête SQL de recherche de livres à partir
// des valeurs saisies dans le formulaire
// Exécution de la requête SQL
// Construction structurée par des balises et leurs classes,
// de l'affichage du résultat de la recherche
// à partir du résultat de la requête SQL
// Déconnexion de la base de données bibliotheque
// Construction de la page HTML
require 'header.php';
?>
<main>
    <?php
// Messages éventuels de l'application
    require 'messages_application.php';
    ?>   
    <!-- **************************************** -->
    <!-- Affichage du formulaire de recherche     --> 
    <!-- de livres                                -->

    <!-- **************************************** -->
    <!--  QUESTION II.3 et III.4                  -->
    <!--  ECRIRE VOTRE CODE ICI                   -->
    <!-- **************************************** -->
    <form action="" method="POST">
        <div style="padding:1rem; width:50%; border-style: solid; border-width: 1px; border-radius: 5px; border-color:grey; margin: auto; ">
            <h1>Recherche de livres</h1>
            <h4>Par auteur</h4>
            <input style="display: block;
                   width: 100%;
                   border-radius: 0.3em;
                   border: 1px solid rgba(34,36,38,.15);
                   padding: 0.7em 1em;"size="125" type="text" id="auteur" name="auteur" placeholder="Noms et prénoms des auteurs recherchés">
            <h4>Par titre</h4>
            <input style="display: block;
                   width: 100%;
                   border-radius: 0.3em;
                   border: 1px solid rgba(34,36,38,.15);
                   padding: 0.7em 1em;" size="125" type="text" id="titre" name="titre" placeholder="Mots du titre recherchés">
            <br>
            <br>
            <button style="padding: 0.8em 1.5em;background-color: #e0e0e0; border-radius: 0.3em;font-size: 0.9em;
                    font-weight: 700;border: none;
                    cursor: pointer;" type="submit" name="soumettre">Rechercher</button>
        </div>
    </form>



</body>
<!-- **************************************** -->


<!-- **************************************** -->
<!-- Affichage du résultat de la recherche    -->

<?php
if (!empty($message_erreur) || !empty($message)) {
    ?>
    <!-- **************************************** -->
    <!-- Messages de l'application                -->
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
if (!empty($tableau_livre)) {
    ?>
    <!-- **************************************** -->
    <!-- Affichage de la table ouvrage            -->
    <section id="affichage_livres">
        <?php
        echo $tableau_livre;
        ?>
    </section>          
    <?php
}
?>

<!-- **************************************** -->
<!--  QUESTION III.3 ECRIRE VOTRE CODE ICI    -->
<!-- **************************************** -->



<!-- **************************************** -->

</main>
<?php require 'footer.php'; ?>