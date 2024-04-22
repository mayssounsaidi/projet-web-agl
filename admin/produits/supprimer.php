
<?php


$produitid= $_GET['idc'];

function connectB(){

    // Définir les informations de connexion à la base de données
    define("MONHOST","localhost");
    define("MONUSER","root");
    define("MONPWD","");
    define("MABD","ghada");

    try {
        // Créer l'objet PDO pour la connexion à la base de données en utilisant les constantes définies
        $conn = new PDO("mysql:host=" . MONHOST . ";dbname=" . MABD, MONUSER, MONPWD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Retourner la connexion
        return $conn;
    } catch (PDOException $e) {
        // En cas d'erreur lors de la connexion, afficher l'erreur
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        // Arrêter l'exécution du script en cas d'échec de la connexion
        die();
    }
}

// Appel de la fonction connect() pour obtenir la connexion à la base de données
$conn = connectB();

$requette= "DELETE FROM produit WHERE id='$produitid' ";

$resultat = $conn->query($requette);

if($resultat){

    //echo "categorie supprimer ";

    header('location:liste.php?delete=ok');


}






?>