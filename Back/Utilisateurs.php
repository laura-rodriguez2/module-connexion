<?php 
class User{

public $erreur;

public function __construct()
{
    $this->bdd = $this->getBdd(); 
}

public function getBdd()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=module_connexion', 'root', '');
        return $bdd;
    }

public function getAllInfos()
    {
        if(isset($_SESSION['login']))
        {
            $tab=[];
            $login = $_SESSION['login'];
            $infos =  $this->getBdd()->query("SELECT * FROM utilisateurs WHERE login='$login'");
            
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
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $confirmation = htmlspecialchars ($_POST['password2']);

if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['password2'])){
    $loginlenght = strlen($login); 


    $sql = "SELECT * FROM utilisateurs WHERE login = ? ";
    // on prépare la requête 
    $requete=$bdd->prepare($sql); 
    // on injecte les valeurs 
    $requete->bindValue(1, $login, PDO::PARAM_STR);
    // on exécute
    $requete->execute(array($login));

    $loginexist= $requete->rowCount();
    ($requete);
    $droits= 1;

    if ($loginlenght > 255){
    $erreur= "Votre login ne doit pas depasser 255 caractères !";  
    } 
    

    elseif($password !== $confirmation){
            $erreur="Les mots de passes sont differents !";
    }
    if($loginexist !== 0){
            $erreur = "login déjà pris !";
    }
    if($erreur == ""){
        $hashage = password_hash($password, PASSWORD_BCRYPT);
        $insertmbr= $bdd->prepare("INSERT INTO  utilisateurs (nom, prenom, login, password, droits) VALUES(?, ?, ?, ?, ?)");
        $insertmbr->execute(array($nom, $prenom, $login, $hashage, $droits));
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
    // Permet de faire un echo a la page inscription
}



public function connexion($loginconnect, $passwordconnect){

    if(isset($_POST['formconnexion']))
{
    $loginconnect = htmlspecialchars($_POST['loginconnect']);
    $passwordconnect = $_POST['passwordconnect'];
    $bdd = $bdd = $this->getBdd();
    
    if(!empty($loginconnect) AND !empty($passwordconnect))
        {
            $requeteutilisateur = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?"); 
            $requeteutilisateur->execute(array($loginconnect)); 
            $result = $requeteutilisateur->fetchAll();   // Return TOUTE la requete ( tableau )
                if (count($result) > 0){ // S'il trouve pas de même nom, il return mauvais nom
                    $sqlPassword = $result[0]['password'];  // Récupere le resultat du tableau (0)  /!\ SI PAS LE 0 ça marche pas /!\ et la colonne password
                    if(password_verify($passwordconnect, $sqlPassword)) // Si passwordconnect est hashé et qu'il est pareil que sql password c'est bon 
                        {
                        $_SESSION['id'] = $result[0]['id'];
                        $_SESSION['nom'] = $result[0]['nom'];
                        $_SESSION['prenom'] = $result[0]['prenom'];
                        $_SESSION['login'] = $result[0]['login'];
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
    else
        {
        $erreur = "Tous les champs doivent être remplis !";
        }
}
if(isset($erreur)){
    return $erreur;
}
}

public function profil($nom, $prenom, $login, $password){
    $bdd = $this->getBdd();

if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
    $requtilisateur = $bdd->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $requtilisateur->execute(array($_SESSION['id']));
    $infoutilisateur = $requtilisateur->fetch();

    if (isset($_POST['newnom']) && !empty($_POST['newnom']) && $_POST['newnom'] != $infoutilisateur['nom']) {
        $nom = $_POST['newnom'];
        $requetenom = $bdd->prepare("SELECT * FROM utilisateurs WHERE nom = ?");
        $requetenom->execute(array($nom));
        $nomexist = $requetenom->rowCount();

        if ($nomexist !== 0) {
            $erreur = "Le nom existe déjà !";
        } else {
            $newnom = htmlspecialchars($_POST['newnom']);
            $insertnom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
            $insertnom->execute(array($newnom, $_SESSION['id']));
            $_SESSION['nom'] = $newnom;
            header('Location: profil.php');
        }
    }


    if (isset($_POST['newprenom']) && !empty($_POST['newprenom']) && $_POST['newprenom'] != $infoutilisateur['prenom']) {
        $prenom = $_POST['newprenom'];
        $requeteprenom = $bdd->prepare("SELECT * FROM utilisateurs WHERE prenom = ?");
        $requeteprenom->execute(array($prenom));
            $newprenom = htmlspecialchars($_POST['newprenom']);
            $insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
            $insertprenom->execute(array($newprenom, $_SESSION['id']));
            $_SESSION['prenom'] = $newprenom;
    }

    if (isset($_POST['newlogin']) && !empty($_POST['newlogin']) && $_POST['newlogin'] != $infoutilisateur['login']) {
        $login = $_POST['newlogin'];
        $requetelogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $requetelogin->execute(array($login));
        $loginexist = $requetelogin->rowCount();

        if ($loginexist !== 0) {
            $erreur = "Le mail existe déjà !";
        } else {
            $newlogin = htmlspecialchars($_POST['newlogin']);
            $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
            $insertlogin->execute(array($newlogin, $_SESSION['id']));
            $_SESSION['login'] = $newlogin;
            header('Location: profil.php');
        }
    }
}
if (isset($_POST['newmdp']) && !empty($_POST['newmdp']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])) {
    $mdp1 = $_POST['newmdp'];
    $mdp2 = $_POST['newmdp2'];

    if ($mdp1 == $mdp2) {
        $hachage = password_hash($mdp1, PASSWORD_BCRYPT);
        $insertmdp = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
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




// PAS ENCORE MAJ A PARTIR DE LA !!!
public function admin(){
    $user =  $this->getBdd()->query("SELECT * FROM utilisateurs");
    // $listedroits = $bdd->query('SELECT * FROM droits');
    // $users = $users->fetchAll();
    return $user;
    
    // ID nécessaire pour la connexion 
if (!isset($_SESSION['id']) || $_SESSION['id_droits'] != 1337) {
    header("Location: profil.php");
    exit();
}
}
}

?>

