<?php 
session_start();
include "../config/functions.php";

$visiteur = $_SESSION['id'];
$total = $_SESSION['panier'][1];
$date = date('Y-m-d');

 // Creation du panier 
$requette_panier = "INSERT INTO panier (visiteur,total,date_creation) VALUES ($visiteur, $total, '$date')";
$result = $conn->query($requette_panier);

$panier_id = $conn->lastInsertId();

$commandes = $_SESSION['panier'][3];

foreach ($commandes as $comm) {
    $id_produit = $comm[0];
    $qte = $comm[1];
    $total = $comm[2];
    $requette = "INSERT INTO commandes (produit, quantite, total, panier, date_creation) VALUES ($id_produit, $qte, $total, $panier_id, '$date')";
    $result = $conn->query($requette);
}

$_SESSION['panier'] = null;
header('location:../thanks.php');