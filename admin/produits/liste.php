
<?php 

session_start();

include "../../config/functions.php";

$categories= getAllCategories($conn);
$produits=getAllProducts($conn);


include "../template/header.php";
?>


<div class="container-fluid">
  <div class="row">
   

  <?php
   
   include "../template/navigation.php";

?>



    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4"> <!-- Début de la section main -->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Liste des produits</h1>
        
        
        
        
        <div>
        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter</a>
        </div>


      </div>
      
      <div> <!-- Début de la section du tableau -->
        
      <?php 
          
          if(isset($_GET['ajout']) && $_GET['ajout'] =="ok" ){

            print'<div class="alert alert-success">
            produit Ajoute avec success
              </div>';
                  }
                 ?>

<?php 
          
          if(isset($_GET['delete']) && $_GET['delete'] =="ok" ){

            print'<div class="alert alert-success">
            produit Supprimee avec success
              </div>';
                  }
                 ?>

<?php 
          
          if(isset($_GET['modif']) && $_GET['modif'] =="ok" ){

            print'<div class="alert alert-success">
            produit modifiee avec success
              </div>';
                  }
                 ?>
      
      
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th scope="col">Decription</th>
              <th scope="col">Prix</th>
              <th scope="col">Categorie</th>
              <th scope="col">Stock</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            
          <?php 
          
          
          
          foreach($produits as $i => $p){
              $CategorieById = getCategorieById($conn, $p['categorie']);
            
            $i++;

                     print'<tr>
                     <th scope="row">'.$i.'</th>
                     <td>
                     <img src="../../assets/img/'.$p['image'].'" width="50" height="50" /> '. $p['nom'].'
                     </td>
                     <td>'.$p['description'].'</td>
                     <td>'.$p['prix'].'</td>
                     <td>'.$CategorieById['nom'].'</tWd>
                     <td>'.$p['stock'].'</td>
                     <td>
       
                           <a data-bs-toggle="modal" data-bs-target="#editModal'.$p['id'].'" class="btn btn-success">Modifier</a>
                           <a href="supprimer.php?idc='.$p['id'].'"class="btn btn-danger">Supprimer</a>
       
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Produit </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
      <form action="ajout.php" method="post" enctype="multipart/form-data">

      <div class="form-group">
    <input type="text" name="nom" class="form-control" placeholder="nom de produit...">
  </div>

  <!-- Ajout d'un espace -->
  <div class="mb-3"></div>

  <div class="form-group">
    <label for="description" class="form-label">Description</label>
    <textarea  name="description" class="form-control" placeholder="description de produit..."></textarea>
  </div>

  <div class="mb-3"></div>
  <div class="form-group">
    <label for="prix" class="form-label">Prix</label>
    <input type="number" step="0.01" name="prix" class="form-control" placeholder="prix de produit...">
  </div>
  <div class="mb-3"></div>
  <div class="form-group">
    <label for="stock" class="form-label">Stock</label>
    <input type="number" step="0.01" name="stock" class="form-control" placeholder="stock de produit...">
  </div>
   
  <div class="mb-3"></div>
  <div class="form-group">
    <label for="image" class="form-label">Image</label>
    <input type="file" name="image" class="form-control" placeholder="prix de produit...">
  </div>
  
<div class="form-group">

<div class="mb-3"></div>

<label for="categorie" class="form-label">Categorie</label>

<select name="categorie" class="form-control">

<?php    

foreach($categories as $ $index => $c)

print'<option value="'.$c['id'].'"> '.$c['nom'].' </option>';

?>

</select>

</div>

<input type="hidden" name="createur" value="<?php echo $_SESSION['id'];?>"/>





  </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary">Ajouter</button>
      </div>
      </form>
    </div>
  </div>
</div>




<?php



foreach($produits as $index => $produit){ ?>



<!-- Modal Modifier -->
<div class="modal fade" id="editModal<?php echo $produit['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Categorie </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
      <form action="modifier.php" method="post" enctype="multipart/form-data">
      <input type="hidden" value=" <?php  echo $produit['id'] ; ?>" name="idc"  />

      <div class="form-group">
      <label for="nom" class="form-label
      ">Nom</label>
      <input type="text" name="nom" class="form-control" value="<?php  echo $produit['nom'];  ?>  " placeholder="nom de produit...">
  </div>

  <!-- Ajout d'un espace -->
  <div class="mb-3"></div>

  <div class="form-group">
    <label for="description" class="form-label
    ">Description</label>
    <textarea  name="description" class="form-control" placeholder="description de categorie..."> <?php  echo $produit['description'];  ?> </textarea>
    <label for="prix" class="form-label
    ">Prix</label>
    <input type="text" name="prix" class="form-control" value="<?php  echo $produit['prix'];  ?>  " placeholder="<?php  echo $produit['prix'];  ?> ">
    <label for="stock" class="form-label">Stock</label>
    <input type="text" name="stock" class="form-control" value="<?php  echo $produit['stock'];  ?>  " placeholder="<?php  echo $produit['stock'];  ?> ">
    <label for="Img" class="form-label
    ">Image</label>
    <input type="file" name="image" class="form-control" value="<?php  echo $produit['image'];  ?>  " placeholder="<?php  echo $produit['image'];  ?> ">
    <input type="hidden" name="oldimage" value="<?php  echo $produit['image'];  ?>  " />
    <select name="categorie" class="form-control">

    <?php    

    foreach($categories as $ $index => $c)

    print'<option value="'.$c['id'].'"> '.$c['nom'].' </option>';

    ?>

    </select>
  </div>

  <div class="mb-3"></div>


      
  


      
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

