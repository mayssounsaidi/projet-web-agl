<?php
session_start();

$nom = $_POST['nom'];
$description = $_POST['description'];

$target_dir = "../../assets/img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image = $_FILES["image"]["name"];
} else {
    echo "Sorry, there was an error uploading your file.";
}

$createur = $_SESSION['id'];
$date_creation = date("Y-m-d");

function connect(){
    define("MONHOST","localhost");
    define("MONUSER","root");
    define("MONPWD","");
    define("MABD","ghada");

    try {
        $conn = new PDO("mysql:host=" . MONHOST . ";dbname=" . MABD, MONUSER, MONPWD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        die();
    }
}

$conn = connect();

$requete = $conn->prepare("INSERT INTO categories(nom, description, image, createur, date_creation) VALUES (:nom, :description, :image, :createur, :date_creation)");

$requete->bindParam(':nom', $nom);
$requete->bindParam(':description', $description);
$requete->bindParam(':image', $image);
$requete->bindParam(':createur', $createur);
$requete->bindParam(':date_creation', $date_creation);

$resultat = $requete->execute();

if ($resultat) {
    header('location:liste.php?ajout=ok');
}
?>
