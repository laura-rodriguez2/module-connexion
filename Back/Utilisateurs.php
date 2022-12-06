<?php 
// include('../../Back/bdd/bdd.php');
// require_once('../../Model/droits.php');
class User{

public $erreur;

public function __construct()
{
    $this->bdd = $this->getBdd(); 
}

public function getBdd()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=lovatipaysages;charset=utf8', 'root', '');
        return $bdd;
    }

public function getAllInfos()
    {
        if(isset($_SESSION['email']))
        {
            $tab=[];
            $email = $_SESSION['email'];
            $infos =  $this->getBdd()->query("SELECT * FROM users WHERE email='$email'");
            
            while($parameter = $infos->fetch())
            {
                array_push($tab, $parameter);
            }
            
            return $tab;
        }
        else
        {
    
            return "Aucun utilisateur n'est connecté";
        }
    }

public function register(){

if (isset($_POST['submit'])){
    $erreur = "";  
    $bdd = $this->getBdd();
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmation = htmlspecialchars ($_POST['password2']);

if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password2'])){
    $emaillenght = strlen($email); 


    $sql = "SELECT * FROM users WHERE email = ? ";
    // on prépare la requête 
    $requete=$bdd->prepare($sql); 
    // on injecte les valeurs 
    $requete->bindValue(1, $email, PDO::PARAM_STR);
    // on exécute
    $requete->execute(array($email));

    $emailexist= $requete->rowCount();
    ($requete);
    $droits= 1;

    if ($emaillenght > 255){
    $erreur= "Votre email ne doit pas depasser 255 caractères !";  
    } 
    
    
// EXEMPLE REQUETE PAS PREPAREE 

// $sql = "SELECT * FROM users WHERE email = $email ";
// $requete = $bdd->query($sql);
// $user = $requete->fetchAll();

// var_dump($user);



// FIN EXEMPLE PAS PREPAPRE 
//  EMAIL REGEX 
// $max = 10;
// $string = $_POST['email'];

// Check only letters; the regex searches for anything that isn't a plain letter
// if (preg_match('/[^a-zA-Z]/', $string)){
//     $erreur= 'only letters are allowed';
// } 

// // Check a value is provided
// $len = strlen($string);
// if ($len == 0) {
//     $erreur= 'you must provide a value';
// }

// // Check the string is long to long
// if ($len > $max) {
//    $erreur= 'the value cannot be longer than ' . $max;
// }


// fin email regex 


    // if ($prenomlenght > 255){
    //     $erreur= "Votre prenom ne doit pas depasser 255 caractères !";  
    //     }  

    elseif($password !== $confirmation){
            $erreur="Les mots de passes sont differents !";
    }
    if($emailexist !== 0){
            $erreur = "email déjà pris !";
    }
    if($erreur == ""){
        $hashage = password_hash($password, PASSWORD_BCRYPT);
        $insertmbr= $bdd->prepare("INSERT INTO  users (nom, prenom, email, password, droits) VALUES(?, ?, ?, ?, ?)");
        $insertmbr->execute(array($nom, $prenom, $email, $hashage, $droits));
        $erreur = "Votre compte à bien été créer !";
        header('location: connexion.php');
    }
}
}
    else{
        $erreur="Tout les champs doivent être remplis !";
    }

    if(isset($erreur)){
            return $erreur;
    }
    // Permet de faire un echo  a la page inscription
}



public function connexion($emailconnect, $passwordconnect){

    if(isset($_POST['formconnexion']))
{
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = $_POST['passwordconnect'];
    $bdd = $bdd = $this->getBdd();
    
    if(!empty($emailconnect) AND !empty($passwordconnect))
        {
            $requeteutilisateur = $bdd->prepare("SELECT * FROM users WHERE email = ?"); 
            $requeteutilisateur->execute(array($emailconnect)); 
            $result = $requeteutilisateur->fetchAll();   // Return TOUTE la requete ( tableau )
                if (count($result) > 0){ // S'il trouve pas de même nom, il return mauvais nom
                    $sqlPassword = $result[0]['password'];  // Récupere le resultat du tableau (0)  /!\ SI PAS LE 0 ça marche pas /!\ et la colonne password
                    if(password_verify($passwordconnect, $sqlPassword)) // Si passwordconnect est hashé et qu'il est pareil que sql password c'est bon 
                        {
                        $_SESSION['id'] = $result[0]['id'];
                        $_SESSION['nom'] = $result[0]['nom'];
                        $_SESSION['prenom'] = $result[0]['prenom'];
                        $_SESSION['email'] = $result[0]['email'];
                        $_SESSION['droits'] = $result[0]['droits'];
                        header("Location: index.php");
                        }
                    else 
                        {
                        $erreur = "Mauvais mot de passe !";
                        }
                        
            }
            else{
                $erreur = "Mauvais Login !";
            }
        }
        // if (isset($_SESSION['droits']) == '2'){
        //     header('Location: admin.php');
        // }
    else
        {
        $erreur = "Tous les champs doivent être remplis !";
        }
}
if(isset($erreur)){
    return $erreur;
}
}



// public function disconnect()
// {
//     unset($_SESSION['id']);
//     unset($_SESSION['nom']);
//     unset($_SESSION['prenom']);
// 	unset($_SESSION['email']);
// 	unset($_SESSION['droits']);
// 	session_destroy();
// 	header('location: index.php');
// }



public function profil($nom, $prenom, $email, $password){
    $bdd = $this->getBdd();

if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
    $requtilisateur = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $requtilisateur->execute(array($_SESSION['id']));
    $infoutilisateur = $requtilisateur->fetch();

    if (isset($_POST['newnom']) && !empty($_POST['newnom']) && $_POST['newnom'] != $infoutilisateur['nom']) {
        $nom = $_POST['newnom'];
        $requetenom = $bdd->prepare("SELECT * FROM users WHERE nom = ?");
        $requetenom->execute(array($nom));
        $nomexist = $requetenom->rowCount();

        if ($nomexist !== 0) {
            $erreur = "Le nom existe déjà !";
        } else {
            $newnom = htmlspecialchars($_POST['newnom']);
            $insertnom = $bdd->prepare("UPDATE users SET nom = ? WHERE id = ?");
            $insertnom->execute(array($newnom, $_SESSION['id']));
            $_SESSION['nom'] = $newnom;
            header('Location: profil.php');
        }
    }


    if (isset($_POST['newprenom']) && !empty($_POST['newprenom']) && $_POST['newprenom'] != $infoutilisateur['prenom']) {
        $prenom = $_POST['newprenom'];
        $requeteprenom = $bdd->prepare("SELECT * FROM users WHERE prenom = ?");
        $requeteprenom->execute(array($prenom));
        // $prenomexist = $requeteprenom->rowCount();

        // if ($nomexist !== 0) {
        //     $erreur = "Le nom existe déjà !";
        // } else {
            $newprenom = htmlspecialchars($_POST['newprenom']);
            $insertprenom = $bdd->prepare("UPDATE users SET prenom = ? WHERE id = ?");
            $insertprenom->execute(array($newprenom, $_SESSION['id']));
            $_SESSION['prenom'] = $newprenom;
            header('Location: profil.php');
        // }
    }

    if (isset($_POST['newemail']) && !empty($_POST['newemail']) && $_POST['newemail'] != $infoutilisateur['email']) {
        $email = $_POST['newemail'];
        $requeteemail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
        $requeteemail->execute(array($email));
        $emailexist = $requeteemail->rowCount();

        if ($emailexist !== 0) {
            $erreur = "Le mail existe déjà !";
        } else {
            $newemail = htmlspecialchars($_POST['newemail']);
            $insertemail = $bdd->prepare("UPDATE users SET email = ? WHERE id = ?");
            $insertemail->execute(array($newemail, $_SESSION['id']));
            $_SESSION['email'] = $newemail;
            header('Location: profil.php');
        }
    }
}
if (isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])) {
    $mdp1 = $_POST['newmdp'];
    $mdp2 = $_POST['newmdp2'];

    if ($mdp1 == $mdp2) {
        $hachage = password_hash($mdp1, PASSWORD_BCRYPT);
        $insertmdp = $bdd->prepare("UPDATE users SET password = ? WHERE id = ?");
        $insertmdp->execute(array($hachage, $_SESSION['id']));
        header('Location: profil.php');
    } else {
        $erreur = "Vos mots de passes ne correspondent pas !";
    }
}
if (isset($_POST['newnom']) && $_POST['newnom'] == $infoutilisateur['nom']) {
    header('Location: profil.php');
}
if(isset($erreur)){
    return $erreur;
}
}




// PARTIE ADMIN

// public function getAllInfos(){
// 	if(isset($_SESSION['nom']))
// 	{
// 		$tab=[];
// 		$nom = $_SESSION['nom'];
// 		$infos =  $this->getBdd()->query("SELECT *FROM users WHERE nom='$nom'");
		
// 		while($parameter = $infos->fetch())
// 		{
// 			array_push($tab, $parameter);
// 		}
// 		return $tab;
//     }
//     else
//     {
//     return "Aucun utilisateur n'est connecté";
//     }
// }	




// PAS ENCORE MAJ A PARTIR DE LA !!!
public function admin($nom, $droits, $email){
    $bdd = $this->getBdd();
    $users = $bdd->query('SELECT users.`id` as idutilisateur, `nom`, `password`, `email`, `id_droits`,`nom` FROM `users` INNER JOIN droits ON droits.id = users.id_droits ORDER BY users.id ASC;');
    $listedroits = $bdd->query('SELECT * FROM droits');
    $lis = $listedroits->fetchAll();
    
    // ID nécessaire pour la connexion 
if (!isset($_SESSION['id']) || $_SESSION['id_droits'] != 1337) {
    header("Location: profil.php");
    exit();
}

 // Fonction supprimé un utilisateur
if (isset($_GET['supprimer']) && !empty($_GET['supprimer'])) {
    $supprimer = (int) $_GET['supprimer'];
    $req = $bdd->prepare('DELETE FROM users WHERE id = ?');
    $req->execute(array($supprimer));
    header("Location: admin.php");
    exit();
}

 // Fonction Modifié le nom d'un utilisateur
if (isset($_POST['newnom']) && !empty($_POST['newnom'])) {
    $idchange = $_POST['id'];
    $nom = $_POST['newnom'];
    $requetenom = $bdd->prepare("SELECT * FROM users WHERE nom = ?"); // SAVOIR SI LE MEME nom EST PRIS
    $requetenom->execute(array($nom));
    $nomexist = $requetenom->rowCount(); // rowCount = Si une ligne existe = PAS BON

    if ($nomexist !== 0) {
        $msg = "Le nom existe déjà !";
    } else {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE users SET nom = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $idchange));
        header('Location: admin.php');
        exit();
    }
}

 // Fonction modifié l'email d'un utilisateur 
if (isset($_POST['newmail']) && !empty($_POST['newmail'])) {
    $idchange = $_POST['id'];
    $email = $_POST['newmail'];
    $requetemail = $bdd->prepare("SELECT * FROM users WHERE email = ?"); // SAVOIR SI LE MEME nom EST PRIS
    $requetemail->execute(array($email));
    $emailexist = $requetemail->rowCount(); // rowCount = Si une ligne existe = PAS BON

    if ($emailexist !== 0) {
        $msg = "L'email existe déjà !";
    } else {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertnom = $bdd->prepare("UPDATE users SET email = ? WHERE id = ?");
        $insertnom->execute(array($newmail, $idchange));
        header('Location: admin.php');
        exit();
    }
}

 // Fonction modifié le rang d'un utilisateur
if (isset($_POST['select'])) {

    $idchange = $_POST['id'];
    $rang = $_POST['select'];
    $changerrang = $bdd->prepare("UPDATE users SET id_droits = ? WHERE id = ?");
    $changerrang->execute(array($rang, $idchange));
    header('Location: admin.php');
    exit();

}
}

}


    // if(preg_match("#jpeg|png#",$_FILES["photo"]["type"])){
    //   // Upload accepté
    // }
    // else{
    //     echo "Format du fichier invalide.";
    // }


?>

