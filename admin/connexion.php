
<?php
session_start();
if(isset($_SESSION['nom'])){

  header('location:index.php');

}



include "../config/functions.php";

$user=true;

if (!empty($_POST)) {
  $user = ConnectAdmin($conn, $_POST);
  if ($user !== false) {
      session_start();
      $_SESSION['id']= $user['id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['nom'] = $user['nom'];
      $_SESSION['prenom'] = $user['prenom'];
      $_SESSION['mp'] = $user['mp'];
    
      header('location:index.php');
  }}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-fleur</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.7/sweetalert2.min.css">
</head>

<body>
   


      <!--fin nav-->
<div class="col-12 p-5">

<h1 class="text-center"> Espace Admin: Connexion</h1>
      
<form action="connexion.php" method="post">
        
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Mot de passe </label>
          <input type="password" name="mp" class="form-control" id="exampleInputPassword1">
        </div>
        
        <button type="submit" class="btn btn-primary">connecter</button>
      </form>

    </div>

       <!--footer-->
       <?php
   
   include "template/footer.php";
    

    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.7/sweetalert2.all.min.js"></script>

<?php
if(!$user){
  print "<script>
  Swal.fire({
    title: 'Erreur',
    text: 'Cordonnes non valide ',
    icon: 'Ereur',
    confirmButtonText: 'OK',
    timer:2000
  })
  
  </script>";
  
}

?>
</html>