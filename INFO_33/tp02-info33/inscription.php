<?php
$message = "";

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



//affichage des info saisie avec test
$message .= "<p>Nous avons pris en compte votre inscription.\n";
$message .= "Voici les données saisies :</p>\n";
$message .= "<ul>";
$message .= "<li>Civilité : ";
if (isset($civilite)) {
    if($civilite=='H'){
        $message.= "M</li>";
    }else{
        $message.= "Mme</li>";
    }
}else{
    $message.= "Case non cochée</li>";
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
$message .= "<li>Abonnement Newsletter : " . $_POST['abo_newsletter'];
if (isset($_POST['abo_newsletter'])) {
    $message .= 'Oui</li>';
} else {
    $message .= 'Non</li>';
}
$message .= "<li>Commentaire : " . $commentaire;
if (empty($commentaire)) {
    $message .= 'Non saisi</li>';
} else {
    $message .= '</li>';
}
$message .= "</ul>";
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Traitement de formulaire en PHP</title>
    </head>
    <body>
        <header>
            <h1><a href="index.php">TP PHP-MySQL n°2 : Traitement de formulaire en PHP</a></h1>
        </header>
        <nav>
            <!-- Insérer une barre de navigation ici -->
        </nav>
        <main>
            <section>
                <h2>Compte rendu</h2>
<?php echo $message; ?>


            </section>
        </main>
        <footer>
            <!-- Insérer un pied de page ici -->
        </footer>
    </body>
</html>