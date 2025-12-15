<?php
// La variable $message contiendra les éventuels messages de l'application à afficher
$message = "";

// La variable $message_erreur contiendra les éventuels messages d'erreur de l'application à afficher
$message_erreur = "";

// **********************************************
// Traitement du formulaire
//
// Initialisation des variables contenant les données saisies dans le formulaire
// et utilisées pour remplir le formulaire

$pseudo = "";
$passe = "";

require 'base_connexion.php';

if (isset($_POST['connecter'])) {
    //***************************
    // Clic sur le bouton "Se connecter" de valeur name="connecter"
    // Traitement du formulaire
    // 
    // Filtrage du contenu de $_POST et assignation à des variables locales
    // htmlspecialchars() : Convertit les caractères spéciaux en entités HTML
    // trim() : Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
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
        // Saisie des données du formulaire dans la table utilisateur
        // après verification que le pseudo et le mail n'existent 
        // pas déjà dans la table
        // 
        // Vérification que le pseudo existe dans la table utilisateur
        $requete = "select * from utilisateur where Pseudo = '$pseudo'";
        $resultat = mysqli_query($connexion, $requete);
        if ($resultat) {
            // Vérification du nombre de lignes du résultat
            if (mysqli_num_rows($resultat) != 0) {
                // Le pseudo existe bien dans la table
                //Récupérer des information de l'utilisateur dans la table
                $ligne = mysqli_fetch_assoc($resultat);
                //Vérification du mot de passe
                
                if (password_verify($passe,$ligne['Password'])){
                    //Si l'utilisateur est validé
                    $message .= "$pseudo Utilisateur validé";
                    //Ouverture d'une session si cela n'est pas deja fait
                    if (session_status() === PHP_SESSION_NONE){
                        session_start();
                    }
                    
                    //enregistrement de l'identifiant, du pseudo, du nom et du prénom de l'utilisateur authentifié dans des variables de session, et 
                    $_SESSION['session_idutilisateur']=$ligne['IdUtilisateur'];
                    $_SESSION['session_pseudo']=$ligne['Pseudo'];
                    $_SESSION['session_nom']=$ligne['Nom'];
                    $_SESSION['session_prenom']=$ligne['Prenom'];
                    
                    //redirection vers la page d'accueil index.php
                    header('Location: index.php');
                    //Fin du script en cas d'echec de la redirection
                    exit();
                }
                else {
                    $message_erreur .= "Connexion impossible: Le mot de passe n'est pas valide<br>\n";
                }
            }else{
                $message_erreur .= "Connexion impossible: Le pseudo $pseudo n'existe pas<br>\n";
            }
        } else {
            $message_erreur .= "Erreur de la requête $requete<br>\n";
            $message_erreur .= "Erreur n° " . mysqli_errno($connexion) . " : " . mysqli_error($connexion) . "<br>\n";
        }
    }
}

?> 
<?php require 'base_deconnexion.php' ?>
<?php require 'header.php' ?>
        <main>
<?php
if (!empty($message_erreur) || !empty($message)) {
    ?>
                <!-- **************************************** -->
                <!-- Messages éventuels de l'application      -->
                <section class="section-formulaire">
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
                // S'il y a eu des erreurs ou si aucun appui sur le bouton "S'incrire" 
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
                                <input type="text" id="pseudo" name="pseudo" placeholder="Votre Pseudo" value="<?php echo $pseudo ?>" minlength="5" maxlength="10" required>
                            </p>
                            <p>
                                <label for="passe">Mot de passe </label>
                                <input type="password" id="passe" name="passe" placeholder="Votre mot de passe" value="" minlength="6" required>
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
<?php require 'footer.php' ?>