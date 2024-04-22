<?php
session_start();
include 'config/functions.php';
$categories= getAllCategories($conn);

if(isset ($_GET['id'])){
   $produit= getProduitBYID($conn,$_GET['id']);
}

if(isset ($_SESSION['panier'])){
    if(count ($_SESSION['panier'][3]) > 0){
        $commandes = $_SESSION['panier'][3];
    }
}

$panierTotal = 0;
if(isset($_SESSION['panier'])){
    $panierTotal = $_SESSION['panier'][1];
}
include 'config/header.php';
?>
<div class="container gap-3 d-flex row justify-content-center mx-auto">
<div class="row col-8 mt-4">
    <h2>Panier utilisateur</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($commandes)){
            foreach($commandes as $index => $comm){
                $produit = getProduitById($conn, $comm[0]);
                print'<tr>
                <td>
                <img src="assets/img/'.$produit['image'].'" class="img-thumbnail" style="width: 100px;">
                '.$produit['nom'].'
                </td>
                <td class="prix">'.$produit['prix'].'</td>
                <td>'.$comm[1].'</td>
                <td>'.$comm[2].' Dt</td>
                <td>
                <a href="actions/supprimer.php?id='.$index.'" class="btn btn-danger">Supprimer</a>
                </td>
                </tr>';
            }
            }
            ?>

        </tbody>
    </table>
</div>
<div class="row col-3 mt-4 side-panier">
    <h4>Valider la commande</h4>
    <div class="total">
        <h5>Total: <?php echo $panierTotal; ?> <span> DT </span></h5>
    </div>
    <a href="actions/valider.php" class="btn btn-valider w-100">Valider</a>
</div>

</div>
<?php
include 'config/footer.php';
?>