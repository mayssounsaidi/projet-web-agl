<?php
session_start();

//1_recuperation de données du formulaire


$id= $_POST['idc'];
$nom = $_POST['nom'];
$description = $_POST['description'];
$date_modification = date("Y-m-d"); //"2024-04-01"
$prix = $_POST['prix'];
$stock = $_POST['stock'];
$categorie = $_POST['categorie'];

$target_dir = "../../assets/img/";
if(!empty($_FILES["image"]["name"])){
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = $_FILES["image"]["name"];
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}else{
    $image = $_POST['oldimage'];
}

// 2_la chaine de connexion 
function connectM(){

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
$conn = connectM();

// 3_la creation de la requette
    $requete = "UPDATE produit SET nom='$nom', description='$description' , date_modification='$date_modification', image='$image', prix='$prix', categorie='$categorie', stock = '$stock' WHERE id='$id'";

// 4_execution de la requette 

$resultat = $conn->query($requete);

if ($resultat) {
    header('location:liste.php?modif=ok');
}

?>
