<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lovati Paysages</title>
    <meta description="">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="icon" href="../MEDIAS/icon.png">
</head>

<body>
    <header>
        <?php
        include_once('./HEADER_FOOTER/header.php');
        ?>
    </header>

    <main>
        <div class="div">
            <a href="connexion.php" class="btn">
                Connexion
            </a>
            <a href="inscription.php" class="btn">
                Inscription
            </a>
        </div>

    </main>

    <footer>
        <?php
        include_once('HEADER_FOOTER/footer.php');
        ?>
    </footer>
</body>

</html>