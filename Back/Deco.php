<?php 
// include('../../Back/bdd/bdd.php');
// require_once('../../Model/droits.php');
class Deco{
    public function disconnect()
    {
        unset($_SESSION['id']);
        unset($_SESSION['nom']);
        unset($_SESSION['prenom']);
        unset($_SESSION['email']);
        unset($_SESSION['droits']);
        session_destroy();
        header('location: index.php');
    }
    
}    ?>