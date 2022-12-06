<?php

include('../../Back/Deco.php');

$user = new Deco;

if (isset($_POST['submit_deco'])) {

    $profil_deco = $user->disconnect();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/HEADER_FOOTER/header.css">
</head>


<header>
    <nav class="navbar">

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="./index.php" class="nav-link">Accueil</a>
            </li>

            <?php
            if (isset($_SESSION['droits'])) {
                // User classique 
                if ($_SESSION['droits']) {
            ?>

                    <form id="form_deco" action="" method="POST">
                        <input type="submit" class="btn" name="submit_deco" value="Déconnexion"><br>
                    </form>

                <?php }
            } else { ?>
                <!-- Non connecté  -->

                <li class="nav-item">
                    <a href="./connexion.php" class="nav-link">Connexion</a>
                </li>
                <li class="nav-item">
                    <a href="./inscription.php" class="nav-link">Inscription</a>
                </li>
                </form>

        </ul>
    <?php } ?>
    <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    </nav>

    <script src="../JAVASCRIPT/header.js"></script>

</header>