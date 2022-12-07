<?php
session_start();
include('../../Back/Utilisateurs.php');

if (isset($_POST['formconnexion'])) {

    $user = new User;
    $userconnect = $user->connexion($_POST['loginconnect'], $_POST['passwordconnect']);
    if ($userconnect == "Vous etes co !") {
        header('location: profil.php');
    } else {
        echo $userconnect;
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../CSS/connexion.css">
    <link rel="icon" href="../MEDIAS/icon.png">
</head>

<body>
<header>
    <?php
    require('HEADER_FOOTER/header.php');
    ?>
</header>

<main>
    
    <h1 id="title">Se connecter</h1><br>

    <form id="form_connec" method="POST" action="">

        <div class="connec">
            <p>Login</p>
            <input type="text" class="box-input" name="loginconnect">
        </div>

        <div class="connec">
            <p>Mot de passe :</p>
            <input type="password" class="text" name="passwordconnect">
        </div>

        <br><input type="submit" id="bouton_co" name="formconnexion" value="Se connecter"><br><br>
        
        <p class="lr_h2">Vous n'avez pas de compte ? <a class="lien_connexion" href="inscription.php">Inscrivez-vous !</a></p>
    </form>

</main>

<footer>
    <?php
    require('HEADER_FOOTER/footer.php');
    ?>
</footer>
</body>

</html>