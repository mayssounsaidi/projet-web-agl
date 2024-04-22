<?php

session_start();

include "../../config/functions.php";

$categories = getAllCategories($conn);

include "../template/header.php";

?>

  <div class="container-fluid">
    <div class="row">


      <?php

      include "../template/navigation.php";

      ?>



      <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> <!-- Début de la section main -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Liste des catégories</h1>




          <div>
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter</a>
          </div>
        </div>

        <div> <!-- Début de la section du tableau -->


          <?php

          if (isset($_GET['ajout']) && $_GET['ajout'] == "ok") {

            print '<div class="alert alert-success">
            Categorie Ajoute avec success
              </div>';
          }
          ?>

          <?php

          if (isset($_GET['delete']) && $_GET['delete'] == "ok") {

            print '<div class="alert alert-success">
            Categorie Supprimee avec success
              </div>';
          }
          ?>

          <?php

          if (isset($_GET['modif']) && $_GET['modif'] == "ok") {

            print '<div class="alert alert-success">
            Categorie modifiee avec success
              </div>';
          }
          ?>








          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Decription</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $i = 0;

              foreach ($categories as $c) {

                $i++;

                print '<tr>
                     <th scope="row">' . $i . '</th>
                     <td>
                      <img src="../../assets/img/' . $c['image'] . '" width="50" height="50" class="rounded-circle">
                     ' . $c['nom'] . '
                     </td>
                     <td>' . $c['description'] . '</td>
                     <td>
       
                           <a data-bs-toggle="modal" data-bs-target="#editModal' . $c['id'] . '" class="btn btn-success">Modifier</a>
                           <a href="supprimer.php?idc=' . $c['id'] . '"class="btn btn-danger">Supprimer</a>
       
                     </td>
                   </tr>';
              }

              ?>


            </tbody>
          </table>



        </div> <!-- Fin de la section du tableau -->
      </div> <!-- Fin de la section main -->

    </div> <!-- Fin de la row -->
  </div> <!-- Fin du container-fluid -->



  <!-- Modal Ajout -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Categorie </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="ajout.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <input type="text" name="nom" class="form-control" placeholder="nom de categorie...">
            </div>

            <!-- Ajout d'un espace -->
            <div class="mb-3"></div>

            <div class="form-group">
              <textarea name="description" class="form-control" placeholder="description de categorie..."></textarea>
            </div>

            <div class="form-group">
              <input type="file" name="image" class="form-control" placeholder="image de categorie...">
            </div>


        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
        </form>
      </div>
    </div>
  </div>




  <?php



  foreach ($categories as $index => $categorie) { ?>



    <!-- Modal Modifier -->
    <div class="modal fade" id="editModal<?php echo $categorie['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Categorie </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="modifier.php" method="post" enctype="multipart/form-data">
      
              <input type="hidden" value=" <?php echo $categorie['id']; ?>" name="idc" />

              <div class="form-group">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" value="<?php echo $categorie['nom'];  ?>  " placeholder="nom de categorie...">
              </div>

              <!-- Ajout d'un espace -->
              <div class="mb-3"></div>

              <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" placeholder="description de categorie..."> <?php echo $categorie['description'];  ?> </textarea>
              </div>
              <!-- Ajout d'un espace -->
              <div class="mb-3"></div>
              <div class="form-group">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" placeholder="image de categorie...">
                <input type="hidden" name="oldimage" value="<?php echo $categorie['image'];  ?>  " />
              </div>



          </div>
          <div class="modal-footer">

            <button type="submit" class="btn btn-primary">Modifier</button>
          </div>
          </form>
        </div>
      </div>
    </div>




  <?php
  }

  include "../template/footer.php";
  ?>