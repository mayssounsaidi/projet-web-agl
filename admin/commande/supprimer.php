<?php 
session_start();
include "../../config/functions.php";

$id = $_GET['id'];

function AnuulerPanier ($conn, $id) {
    try {
        $date = date('Y-m-d');
        $requete = "UPDATE panier SET etat='Annulee', date_modificatiion='$date' WHERE id=$id";
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

$valider = AnuulerPanier($conn, $id);

header('location:liste.php?valider=ok');
?>