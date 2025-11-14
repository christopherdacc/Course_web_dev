<?php
$message = "";
$message_erreur = "";

if (isset($_POST['inscrire'])) {
//si appui sur le boutin s'inscrire
// Afficahge du contenu du tableau associatif $_SERVER
    foreach ($_POST as $key => $val) {
        $message .= "\$_POST['$key'] = $val<br>\n";
    }

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $passe1 = htmlspecialchars($_POST['passe1']);
    $passe2 = htmlspecialchars($_POST['passe2']);
    $commentaire = htmlspecialchars($_POST['commentaire']);

//vérification de la validité des saisies
    if (!isset($_POST['civilite'])) {
        $message_erreur .= "La civilité doit etre coché<br>";
    }
    if (empty($nom)) {
        $message_erreur .= 'Vous devez inserer votre nom<br>';
    } elseif (strlen($nom)>100){
        $message_erreur .= 'Votre nom est enorme<br>';
    }
    if (empty($prenom)) {
        $message_erreur .= 'Vous devez inserer votre prenom<br>';
    } elseif (strlen($prenom)>100){
        $message_erreur .= 'Votre prenom est enorme<br>';
    }
    if (empty($mail)) {
        $message_erreur .= 'Vous devez inserer votre mail<br>';
    } elseif (strlen($mail)>250){
        $message_erreur .= 'Votre mail est enorme<br>';
    }
    if (empty($pseudo)) {
        $message_erreur .= 'Vous devez insere votre pseudos<br>';
    } elseif (strlen($pseudo)<5 || strlen($pseudo)>10){
        $message_erreur .= 'Votre pseudo doit etre compris entre 6 et 10 charactères<br>';
    }
    if (empty($passe1)) {
        $message_erreur .= 'Vous devez insere votre mot de pass<br>';
    } elseif (strlen($passe1)<6){
        $message_erreur .= 'Votre mot de pass est petit<br>';
    }
    if (empty($passe2)) {
        $message_erreur .= 'Vous devez reinsere votre mot de pass<br>';
    } elseif (strlen($passe2)<6){
        $message_erreur .= 'Votre mot de pass est petit<br>';
    }
    if (strcmp($passe1, $passe2)!=0){
        $message_erreur .= 'Les mots de pass sont différents<br>';
    }


    if (empty($message_erreur)) {
        //affichage des info saisie avec test
        $message .= "<p>Nous avons pris en compte votre inscription.\n";
        $message .= "Voici les données saisies :</p>\n";
        $message .= "<ul>";
        $message .= "<li>Civilité : ";
        if (isset($civilite)) {
            if ($civilite == 'H') {
                $message .= "M</li>";
            } else {
                $message .= "Mme</li>";
            }
        } else {
            $message .= "Case non cochée</li>";
        }
        $message .= "<li>Nom : " . $nom . "</li>";
        $message .= "<li>Prenom : " . $prenom . "</li>";
        $message .= "<li>Mail : " . $mail . "</li>";
        $message .= "<li>Telephone : " . $telephone;
        if (empty($telephone)) {
            $message .= 'Non saisi</li>';
        } else {
            $message .= '</li>';
        }
        $message .= "<li>Pseudo : " . $pseudo . "</li>";
        $message .= "<li>Pass1 : " . $passe1 . "</li>";
        $message .= "<li>Pass2 : " . $passe2 . "</li>";
        if (isset($_POST['abo_newsletter'])) {
            $message .= '<li>Abonnement Newsletter : Oui</li>';
        } else {
            $message .= '<li>Abonnement Newsletter : Non</li>';
        }
        $message .= "<li>Commentaire : " . $commentaire;
        if (empty($commentaire)) {
            $message .= 'Non saisi</li>';
        } else {
            $message .= '</li>';
        }
        $message .= "</ul>";
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link rel="stylesheet" href="formulaire.css">
    </head>
    <body>
        <header>
            <h1><a href="index.php">TP PHP-MySQL n°2 : Traitement de formulaire en PHP</a></h1>
        </header>
        <nav>
            <!-- Insérer une barre de navigation ici -->
        </nav>
        <main>
            <?php if (!empty($message)) { ?>
                <section>
                    <h2>Inscription</h2>
                    <?php echo $message; ?>
                </section>
            <?php } ?>
            <?php if (!empty($message_erreur)) { ?>
                <section class="erreur">
                    <h2>Erreur</h2>
                    <?php echo $message_erreur; ?>
                </section>
            <?php } ?>
            <?php if (!isset($_POST['inscrire'])) { ?>
                <!-- **************************************** -->
                <!-- Affichage du formulaire                  -->


                <section class="section-formulaire">     
                    <h2>Inscription</h2>
                    <form action="" method="POST">
                        <section>
                            <h3>Coordonnées</h3>
                            <p>
                                <label for="m">Civilité</label>
                                <label for="m"><input type="radio" id="m" name="civilite" value="H"> M</label>
                                <label for="mme"><input type="radio" id="mme" name="civilite" value="F"> Mme</label>
                            </p>
                            <div class="deux-champs">
                                <p>
                                    <label for="nom">Nom </label>
                                    <input type="text" id="nom" name="nom" placeholder="Nom"  value="" maxlength="100" required>
                                </p>
                                <p>
                                    <label for="prenom">Prénom </label>
                                    <input type="text" id="prenom" name="prenom" placeholder="Prénom"  value="" maxlength="100" required>
                                </p>
                            </div>
                            <p>
                                <label for="mail">Adresse Mail </label>
                                <input type="email" id="mail" name="mail" placeholder="Adresse Mail"  value="" maxlength="250" required>
                            </p>
                            <p>
                                <label for="telephone">Numéro de téléphone </label>
                                <input type="tel" id="telephone" name="telephone" placeholder="Numéro de téléphone (facultatif)"  value="" maxlength="50">
                            </p>
                        </section>
                        <section>
                            <h3>Informations de connexion</h3>
                            <p>
                                <label for="pseudo">Pseudo </label>
                                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" value="" minlength="5" maxlength="10" required>
                            </p>  
                            <div class="deux-champs">
                                <p>
                                    <label for="passe1">Mot de passe </label>
                                    <input type="password" id="passe1" name="passe1" placeholder="Mot de passe" value="" minlength="6" required>
                                </p>  
                                <p>
                                    <label for="passe2">Confirmer le mot de passe </label>
                                    <input type="password" id="passe2" name="passe2" placeholder="Mot de passe" value="" minlength="6" required>
                                </p>
                            </div>
                        </section>
                        <section>
                            <h3>Divers</h3>
                            <p>
                                <input type="checkbox" id="abo_newsletter" name="abo_newsletter" value="">
                                <label for="abo_newsletter">Abonnement à la newsletter</label>
                            </p>
                            <p>
                                <label for="commentaire">Commentaire</label>
                                <textarea id="commentaire" name="commentaire" placeholder="Laissez un commentaire" rows="2"></textarea>
                            </p>
                        </section>
                        <section>
                            <p><input type="submit" name="inscrire" value="S'inscrire"></p>
                        </section>
                    <?php } ?>
                </form>
            </section>
        </main>
        <footer>
            <!-- Insérer un pied de page ici -->
        </footer>
    </body>
</html>