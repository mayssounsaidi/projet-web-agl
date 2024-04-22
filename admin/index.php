<?php 
session_start();
if(!isset($_SESSION['nom'])){
  header('location:connexion.php');
}
include "../config/functions.php";
include "template/header.php";
include "template/navigation.php";
?>

<?php
include "template/footer.php";
?>