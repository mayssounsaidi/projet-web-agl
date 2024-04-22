<?php

session_start();
if(isset($_SESSION['nom'])){

  header('location:index.php');

}




include "config/functions.php";

$showRegistrationAlert=0;

$categories=getAllCategories($conn);

if(!empty($_POST)){
  
  if(AddVisiteur($conn,$_POST)){
    $showRegistrationAlert=1;

  }
}

include "config/header.php";

 ?>

      <!--fin nav-->
<div class="col-5 mx-auto p-5">
    <h1 class="text-center">Registre</h1>
    <form action="signup.php" method="post">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"> nom </label>
            <input type="text" name="nom"  class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"> prenom </label>
            <input type="text"  name="prenom"  class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">tele </label>
            <input type="text" name="telephone"  class="form-control" id="exampleInputPassword1">
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Mot de passe </label>
          <input type="password" name="mp"  class="form-control" id="exampleInputPassword1">
        </div>
        
        <button type="submit" class="btn btn-login w-100">Envoyer</button>
        <a href="login.php" class="btn w-100 btn-register-go">Se connecter</a>
      </form>

    </div>

       <!--footer-->
       <?php
   
   include "config/footer.php"
    

    ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.7/sweetalert2.all.min.js"></script>

<?php
if($showRegistrationAlert==1){
  print "<script>
  Swal.fire({
    title: 'Success',
    text: 'Creation de compte avec success',
    icon: 'Success',
    confirmButtonText: 'OK',
    timer:2000
  })
  
  </script>";
  
}

?>

</html>