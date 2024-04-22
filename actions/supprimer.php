<?php
session_start();
include "../config/functions.php";

$id = $_GET['id'];
$commandes = $_SESSION['panier'][3];
$commande = $commandes[$id];


$total_supprimer = $commande[2];
echo $total_supprimer;
$_SESSION['panier'][1] -= $total_supprimer;
unset($_SESSION['panier'][3][$id]);
header('location:../panier.php');
exit();

?>