<?php 
session_start();
include_once('../../Back/Utilisateurs.php');
include_once('../../Back/bdd/bdd.php');


// Verification connecté ou non 
// if (!isset($_SESSION['id']) || $_SESSION['droits'] != 2) {
//     header("Location: ../index.php");
//     exit();
// }


$bdd = get_pdo();
// if (!isset($_SESSION['id']) || $_SESSION['droits'] != "ADMIN") {
//     header("Location: profil.php");
//     exit();
//  }
$request = $bdd->prepare("SELECT * FROM utilisateurs"); 
$request->execute();
$user = $request->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../../CSS/ADMIN/admin_gererUtilisateurs.css">
    <link rel="icon" href="../MEDIAS/icon.png">
</head>


<body>
<header>
    <?php
    require('HEADER_FOOTER/header.php');
    ?>
</header>

<main class="main">
<tbody>
                <?php foreach($user as $toto){?>
                    <tr>
                        Nom :<td> <?= $toto['nom']; ?></td><br>
                        Prénom :<td> <?= $toto['prenom']; ?></td><br>
                        Login : <td><?= $toto['email']; ?></td><br>
                        Droits :<td> <?= $toto['droits']; ?></td><br>
                        
                    </tr>
                <?php } ?>
            </tbody>
    </table>

    <br>
    <br>

</main>

<footer>
    <?php
    require('HEADER_FOOTER/footer.php');
    ?>
</footer>
</body>

</html>