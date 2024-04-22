<?php 
session_start();
include "../../config/functions.php";

$id = $_POST['id'];
$etat = $_POST['etat'];

function ModifierEtatPanier ($conn, $id , $etat) {
    try {
        $date = date('Y-m-d');
        $requete = "UPDATE panier SET etat='$etat' , date_modificatiion='$date' WHERE id=$id";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        return true;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

$valider = ModifierEtatPanier($conn, $id , $etat);

header('location:liste.php?valider=ok');
?>