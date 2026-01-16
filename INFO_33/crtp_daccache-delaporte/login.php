<?php
// La variable $message contiendra les éventuels messages de l'application à afficher
$message = "";

// La variable $message_erreur contiendra les éventuels messages d'erreur de l'application à afficher
$message_erreur = "";

// **********************************************
// Traitement du formulaire
//
// Initialisation des variables contenant les données saisies dans le formulaire 
$pseudo = "";
$passe = "";

// Connexion à la base de données bibliotheque du serveur localhost
require 'base_connexion.php';

if (isset($_POST['connecter'])) {
  //***************************
  // Clic sur le bouton "Se connecter" de valeur name="connecter"
  // Traitement du formulaire
  // 
  // Filtrage du contenu de $_POST et assignation à des variables locales
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $passe = trim($_POST['passe']);

  // Vérification de toutes les valeurs saisies
  // 
  if (empty($pseudo)) {
    $message_erreur .= "Le champ pseudo est obligatoire<br>\n";
  }

  if (empty($passe)) {
    $message_erreur .= "Le mot de passe est obligatoire<br>\n";
  }

  // Si aucun message d'erreur
  if (empty($message_erreur)) {
    //*******************************************
    // Vérification dans la table utilisateur
    // - que le pseudo existe
    // - que le mot de passe saisi est valide
    // 
    // Vérification que le pseudo existe dans la table utilisateur
    $requete = "select * from utilisateur where Pseudo = '$pseudo'";
    $resultat = mysqli_query($connexion, $requete);
    if ($resultat) {
      // Vérification du nombre de lignes du résultat
      if (mysqli_num_rows($resultat) != 0) {
        // Le pseudo existe bien dans la table
        // Récupération des informations de l'utlisateur
        $ligne = mysqli_fetch_assoc($resultat);

        // Vérification du mot de passe saisi
        if (password_verify($passe, $ligne['Password'])) {
          // Le pseudo et le mot de passe saisis sont valides
          // -> Initialisation des variables de session
          //
          // Démmarrer une session si cela n'a pas déjà été fait
          if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
          }

          // Initialisation des variables de session avec les données de l'utilisateur
          $_SESSION['session_idutilisateur'] = $ligne['IdUtilisateur'];
          $_SESSION['session_pseudo'] = $ligne['Pseudo'];
          $_SESSION['session_nom'] = $ligne['Nom'];
          $_SESSION['session_prenom'] = $ligne['Prenom'];

          // Redirection vers la page index.php
          header('Location: index.php');

          // Fin du script au cas où la redirection n'ait pas pu se faire
          exit();
        } else {
          $message_erreur .= "Erreur de connexion<br>\n";
        }
      } else {
        // Le pseudo n'existe pas
        $message_erreur .= "Erreur de connexion<br>";
      }
    } else {
      $message_erreur .= "Erreur de la requête<br>\n";
      $message_erreur .= "Erreur n° " . mysqli_errno($connexion) . " : " . mysqli_error($connexion) . "<br>\n";
    }
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
  // S'il y a eu des erreurs ou si aucun appui sur le bouton "Se connecter"
  if (!empty($message_erreur) || !isset($_POST['connecter'])) {
    ?>
    <!-- **************************************** -->
    <!-- Affichage du formulaire                  -->
    <section class="section-formulaire">
      <h2>Connexion</h2>
      <form action="" method="POST">
        <section>
          <p>
            <label for="pseudo">Login </label>
            <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" value="" required>
          </p>
          <p>
            <label for="passe">Mot de passe </label>
            <input type="password" id="passe" name="passe" placeholder="Votre mot de passe" value="" required>
          </p>
        </section>
        <section>
          <p><input type="submit" name="connecter" value="Se connecter"></p>
        </section>
      </form>
    </section>
    <?php
  }
  ?>
</main>
<?php require 'footer.php'; ?>