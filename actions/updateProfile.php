<?php
session_start();

include "../config/functions.php";

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = md5($_POST['password']);

$id = $_SESSION['id'];

$requette = "UPDATE visiteurs SET nom = '$nom', prenom = '$prenom', email = '$email', mp = '$mdp' WHERE id = $id";
$result = $conn->query($requette);

$_SESSION['nom'] = $nom;
$_SESSION['prenom'] = $prenom;
$_SESSION['email'] = $email;
$_SESSION['mdp'] = $mdp;

header('location:../profile.php');
exit();
?>