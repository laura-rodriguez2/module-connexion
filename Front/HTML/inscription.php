<?php
session_start();
include('../../Back/Utilisateurs.php');

if (isset($_POST['submit'])) {
    if (isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['login']) and isset($_POST['password']) and isset($_POST['password2'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $user = new User($nom, $prenom, $login, $password, $password2);
        $user_register = $user->register($nom, $prenom, $login, $password, $password2);
    }
}

if (isset($erreur)) {
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

            <div id="name">
                <div class="input">
                    <p>Nom :</p>
                    <input class="box-input" type="text" name="nom" required />
                </div>

                <div class="input">
                    <p>Prénom :</p>
                    <input class="box-input" type="text" name="prenom" required />
                </div>
            </div>
            <div class="input">
                <p>Login</p>
                <input class="mail" id="login" type="text" name="login" required />
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

    </main>

    <footer>
        <?php
        require('HEADER_FOOTER/footer.php');
        ?>
    </footer>
</body>

</html>