<?php
session_start();
include('../../Back/Utilisateurs.php');

// Verification connecté ou non 
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$user = new User;

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../CSS/profil.css">
    <link rel="icon" href="../MEDIAS/icon.png">
</head>

<body>
    <header>
        <?php
        require('HEADER_FOOTER/header.php');
        ?>
    </header>

    <main>
        <h1 id="title">Bonjour, <?php echo $_SESSION['prenom'] ?> ! </h1><br>

        <form id="form_inscription" action="" method="POST">

            <?php
            if (isset($_POST['submit'])) {

                $profil_update = $user->profil($_POST['newnom'], $_POST['newprenom'], $_POST['newemail'], $_POST['newmdp']);

                if ($profil_update == "erreur") {
                    echo 'email déjà existant';
                } else if ($profil_update == "erreur2") {
                    echo 'Mot de passe trop court';
                }
            }
            ?>

            <section class="section_input">
                <h2>Modifier mes informations</h2>
                <div class="input">
                    <p>Nouveau nom :</p>
                    <input type="text" class="input" name="newnom" value="<?php echo $_SESSION['nom'] ?>" />
                </div>

                <div class="input">
                    <p>Nouveau prénom :</p>
                    <input type="text" class="input" name="newprenom" value="<?php echo $_SESSION['prenom'] ?>" />
                </div>

                <div class="input">
                    <p>Nouveau login :</p>
                    <input type="text" class="input" name="newemail" value="<?php echo $_SESSION['login'] ?>" />
                </div>
                <br>
                <p>- Confirmations -</p>
                <div class="input">
                    <p>Rentrez votre mot de passe :</p>
                    <input type="password" class="input" name="newmdp" placeholder="Mot de passe" required />
                </div>

                <div class="input">
                    <p>Confirmez votre mot de passe :</p>
                    <input type="password" class="input" name="newmdp2" placeholder="Confirmez votre mot de passe" required />
                </div>

                <input type="submit" class="bouton_profil" name="submit" value="Enregistrer" /><br>
            </section>

        </form>


    </main>

    <footer>
        <?php
        require('HEADER_FOOTER/footer.php');
        ?>
    </footer>
</body>

</html>