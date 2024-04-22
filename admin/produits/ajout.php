
<?php

session_start();


$nom = $_POST['nom'];

$description = $_POST['description'];

$prix = $_POST['prix'];

$stock = $_POST['stock'];

$categorie = $_POST['categorie'];

// uplod image 

$target_dir = "../../assets/img";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
   
        $image = $_FILES["image"]["name"];


  } else {
    echo "Sorry, there was an error uploading your file.";
  }

$date = date('Y-m-d');


// 2_la chaine de connexion 
function connectT(){

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
$conn = connectT();

// 3_la creation de la requette
$requete = "INSERT INTO produit(nom,prix,description,image,categorie,stock, date_creation) VALUES ('$nom','$prix', '$description','$image','$categorie','$stock', '$date')";

// 4_execution de la requette 

$resultat = $conn->query($requete);

if ($resultat) {
    header('location:liste.php?ajout=ok');
}








?>