<?php
// include_once('bddco.php');

    function get_pdo(): PDO {
        return new PDO('mysql:host=localhost;dbname=module_connexion', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

if (!function_exists('e404')) {
function e404() {
    echo "Error 404";
}
}

// function get_all($bdd) {
//     $sql = "SELECT * FROM information";
//     $stmt = $bdd->prepare($sql);
//     $stmt->execute();
//     $stmt->setFetchMode(PDO::FETCH_ASSOC);

//     return $stmt;
// }

// get_all($bdd);

// class Bdd{
//    public function getBdd(){ 
//     return new PDO('mysql:host=localhost;dbname=lovatipaysages', 'root', '', [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//         ]);
//    }

// if (!function_exists('e404')) {
// function e404() {
//     echo "Error 404";
// }
// }
// }
?>