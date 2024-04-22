<?php
session_start();

/* session_start();
if(!isset($_SESSION['nom'])){
    header('location:../connexion.php');
    exit();
} */
include "../config/functions.php";

$visiteur = $_SESSION['id'];
$id_produit = $_POST['produit'];
$qte = $_POST['qte'];
$produit = getProduitById($conn, $id_produit);
$total = $produit['prix'] * $qte;
$date = date('Y-m-d');

if(!isset ($_SESSION['panier'])){
    $_SESSION['panier'] = array($visiteur , 0, $date, array() );
}
foreach($_SESSION['panier'][3] as $index => $p){
    if($p[0] == $id_produit){
        $_SESSION['panier'][3][$index][1] += $qte;
        $_SESSION['panier'][3][$index][2] += $total;
        $_SESSION['panier'][1] += $total;
        header('location:../panier.php');
        exit(); 
    }
}


$_SESSION['panier'][1] += $total;
$_SESSION['panier'][3][] = array($id_produit, $qte, $total, $date);
header('location:../panier.php');

/* // Creation du panier 
$requette_panier = "INSERT INTO panier (visiteur,total,date_creation) VALUES ($visiteur, $total, '$date')";
$result = $conn->query($requette_panier);

$panier_id = $conn->lastInsertId();


$requette = "INSERT INTO commandes (produit, quantite, total, panier, date_creation) VALUES ($id_produit, $qte, $total, $panier_id, '$date')";
$result = $conn->query($requette);  */ 

/* header('location:../panier.php');
 */


?>
