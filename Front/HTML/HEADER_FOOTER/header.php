<?php
// include('../../Back/bdd/bdd.php');

// $bdd = get_pdo();

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
        <!-- <a href="./index.php" class="nav-branding"><img src="../MEDIAS/Autres/logo2.png" height="60px"></a> -->

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="./index.php" class="nav-link">Accueil</a>
            </li>

            <?php
            if (isset($_SESSION['droits'])) {
                    // User classique 
                if ($_SESSION['droits'] == 1) {
            ?>
                    <li class="nav-item">
                        <a href="./profil.php" class="nav-link"><img src="../MEDIAS/Icons/user.png" alt="" height="40px" width="40px"></a>
                    </li>
                <?php }
            } else { ?>
            <!-- Non connecté  -->
                <li class="nav-item">
                    <a href="./inscription.php" class="nav-link">Inscription</a>
                </li>
                <li class="nav-item">
                    <a href="./connexion.php" class="nav-link">Connexion</a>
                </li>
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