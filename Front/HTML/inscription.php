<?php
session_start();
// include('../../Model/bdd.php');
include('../../Back/Utilisateurs.php');

// if(validateEmail())
if (isset($_POST['submit'])) {
    if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['password2'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $user = new User($nom, $prenom, $email, $password, $password2);
        $user_register = $user->register($nom, $prenom, $email, $password, $password2);
    }
}

if(isset($erreur)){
    echo $erreur;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../CSS/inscription.css">
    <link rel="icon" href="../MEDIAS/icon.png">
</head>

<body>
<header>
    <?php
    require('HEADER_FOOTER/header.php');
    ?>
</header>

<main>
    <h1 id="title">S'inscrire</h1><br>
        <form id="form_inscription" action="" method="POST">

            <img class="img" src="../MEDIAS/Autres/linefeuillev2.png" alt="Banderoles de plantes">
        <div id="name">
            <div class="input">
                <p>Nom :</p>
                <input class="box-input" type="text" name="nom"  required />
            </div>

            <div class="input">
                <p>Prénom :</p>
                <input class="box-input" type="text" name="prenom" required /> 
            </div>
        </div>
            <div class="input">
                <p>Email :</p>
                <input class="mail" id="email" type="text" name="email" required />
            </div>

            <div class="input">
                <p>Mot de passe :</p>
                <input class="box-input" type="password" name="password" required />
            </div>

            <div class="input">
                <p>Confirmez votre mot de passe :</p>
                <input class="text" type="password" name="password2" required="">
            </div>

           <br> <input id="bouton_inscri_inscription" type="submit" name="submit" value="S'inscrire" /><br><br>

            <p class="lr_h2">Déjà inscrit ? <a class="lien_connexion" href="connexion.php">Connectez-vous !</a></p>
        </form>

    <script src="../../Back/js/verifications.js"></script>
        <?php 

// echo $erreur;

        ?>
</main>

<footer>
    <?php
    require('HEADER_FOOTER/footer.php');
    ?>
</footer>
</body>

</html>