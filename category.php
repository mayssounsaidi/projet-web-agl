<?php
session_start();
include 'config/functions.php';
$category = getCategorieById($conn, $_GET['id']);
$products = getAllProducts($conn, $_GET['id']);

include 'config/header.php';
?>
   <section class="home" id="home">

<div class="content">
   <h3><?php echo $category['nom']; ?></h3>
   <span><?php echo $category['description']; ?></span>
   <p>Embark on a floral journey with us! Explore our exquisite selection, from radiant roses to delicate daisies.
      Order now to bring nature's beauty straight to your doorstep, and let every petal tell a story of love and
      delight</p>
   <a href="#" class="btn">shop now</a>
</div>

</section>

<section class="products" id="products">
     <div class="box-container">
        <?php foreach($products as $product) { ?>
        <div class="box">
              <span class="discount">-10%</span>
              <div class="image">
                 <img src="assets/img/<?php echo $product['image']; ?>" alt="">
                 <div class="icons">
                    <form action="actions/commander.php" method="post">
                       <input type="hidden" name="produit" value="<?php echo $product['id']; ?>">
                       <input type="hidden" name="prix" value="<?php echo $product['prix']; ?>">
                       <input type="number" name="qte" value="1">
                        <button type="submit" class="cart-btn">add to cart</button>
                    </form>
                 </div>
              </div>
        
              <div class="content">
                 <h3><?php echo $product['nom']; ?></h3>
                 <div class="price"> <?php echo $product['prix']; ?>dt<span> 43dt</span></div>
              </div>
        </div>
        <?php } ?>
      </div>
  </section>


<?php
include 'config/footer.php';
?>