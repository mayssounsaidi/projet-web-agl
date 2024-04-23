<?php
session_start();
include 'config/functions.php';
$categories = getAllCategories($conn);

include 'config/header.php';
?>
   <!--home section starts-->
   <section class="home" id="home">

      <div class="content">
         <h3>fresh flowers</h3>
         <span>natural & beautiful flowers</span>
         <p>Embark on a floral journey with us! Explore our exquisite selection, from radiant roses to delicate daisies.
            Order now to bring nature's beauty straight to your doorstep, and let every petal tell a story of love and
            delight</p>
         <a href="#" class="btn">shop now</a>
      </div>

   </section>
   <!--home section ends-->



   <!--about section starts-->

   <section class="about" id="about">

      <h1 class="heading"><span> about </span> us </h1>

      <div class="row">

         <div class="image">
            <img src="assets/img/22 (1).jpg" alt="">
            <h3>best flower sellers</h3>
         </div>

         <div class="content">
            <h3>why choose us</h3>
            <p>Welcome to our online flower shop, where beauty is just a click away.
               Discover a wide range of fresh blooms, stunning bouquets, and lovely arrangements handcrafted by our
               skilled florists.
               Whether it's for a special event or to simply brighten someone's day, we're here to make your floral
               shopping experience effortless
               and enjoyable.Trust our local florist partners to deliver happiness right to your doorstep with every
               order</p>
            <a href="#" class="btn">learn more</a>
         </div>
      </div>
   </section>
   <!--about section ends-->

   <!--icons section start -->

   <section class="icons-container">

      <div class="icons">

         <img src="assets/img/téléchargement.png" alt="">
         <div class="info">
            <h3>free delivery</h3>
            <span>on all orders</span>
         </div>

      </div>

      <div class="icons">

         <img src="assets/img/téléchargement 2.png" alt="">
         <div class="info">
            <h3>10 days returns</h3>
            <span>moneyback guarantee</span>
         </div>

      </div>

      <div class="icons">

         <img src="assets/img/telechargement3.png" alt="">
         <div class="info">
            <h3>offer and gifts</h3>
            <span>on all orders</span>
         </div>

      </div>
      <div class="icons">

         <img src="assets/img/telechargement4.jpg" alt="">
         <div class="info">
            <h3>secure paymens</h3>
            <span>protected by paya</span>
         </div>

      </div>

   </section>
   <!--icons section ends -->

   
   <!--products section starts -->

   <section class="products" id="products">
      <h1 class="heading"> latest<span> products</span> </h1>
     <div class="box-container">
      <?php foreach ($products as $product) { ?>
         <div class="box">
            <div class="image">
               <img src="assets/img/<?php echo $product['image']; ?>"alt="">
               <div class="icons">
                  <a href="category.php?id=<?php echo $product['id'];?>" class="cart-btn">View</a>
               </div>
            </div>
      
            <div class="content">
               <h3><?php echo $product['nom']; ?></h3>
               <div class="price"><?php echo $product['description']; ?></div>
            </div>
         </div>
         <?php } ?>
      </div>
  </section>
  <!--products section ends -->
  