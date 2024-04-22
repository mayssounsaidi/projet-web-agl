
<?php 

session_start();

include "../../config/functions.php";

$visiteurs= getAllVisitors($conn);
$Utilisateurs= getAllUsers($conn);

include "../template/header.php";
?>

<div class="container-fluid">
  <div class="row">
   

  <?php
   
   include "../template/navigation.php";

?>



    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> <!-- Début de la section main -->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Liste des visiteurs </h1>
        
        
        
        
        <div>
        
        </div>
      </div>
      
      <div> <!-- Début de la section du tableau -->
        
         
      <?php 
          
          if(isset($_GET['valider']) && $_GET['valider'] =="ok" ){

            print'<div class="alert alert-success">
            visiteur validee avec success
              </div>';
                  }
                 ?>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom et prenom</th>
              <th scope="col">email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            
          <?php 
          
        
          
          foreach($visiteurs as $i => $visiteur){

            $i++;

                     print'<tr>
                     <th scope="row">'.$i.'</th>
                     <td>'.$visiteur['nom'].' '.$visiteur['prenom'].'</td>
                     <td>'.$visiteur['email'].'</td>
                     <td>
       
                           <a href="valider.php?id='.$visiteur['id'].'"  class="btn btn-success">valider</a>
                           
       
                     </td>
                   </tr>';

          }
          
          ?>
          
        
          </tbody>
        </table>

        

      </div> <!-- Fin de la section du tableau -->
    </div> <!-- Fin de la section main -->
    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> <!-- Début de la section main -->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Liste des utilisateurs </h1>
        
        
        
        
        <div>
        
        </div>
      </div>
      
      <div> <!-- Début de la section du tableau -->
        
         
      <?php 
          
          if(isset($_GET['valider']) && $_GET['valider'] =="ok" ){

            print'<div class="alert alert-success">
            visiteur validee avec success
              </div>';
                  }
                 ?>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom et prenom</th>
              <th scope="col">email</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            
          <?php 
          
        
          
          foreach($Utilisateurs as $i => $user){

            $i++;

                     print'<tr>
                     <th scope="row">'.$i.'</th>
                     <td>'.$user['nom'].' '.$user['prenom'].'</td>
                     <td>'.$user['email'].'</td>
                   </tr>';

          }
          
          ?>
          
        
          </tbody>
        </table>

        

      </div> <!-- Fin de la section du tableau -->
    </div> <!-- Fin de la section main -->
  </div> <!-- Fin de la row -->
</div> <!-- Fin du container-fluid -->




<?php
include "../template/footer.php";
?>