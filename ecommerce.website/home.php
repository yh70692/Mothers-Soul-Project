<?php

include 'framework/connection.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'framework/bag-wishlist.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.ico">
   <title>Main Page</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'user/header.php'; ?>

<div class="home-bg">

<section class="home">
   <div class="swiper home-slider">
   <div class="swiper-wrapper">
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/chefs.png" alt="">
         </div>
         <div class="content">
            <span>Enjoy every meal with Mothers Soul</span>
            <h3>Made From Seadoned Veterine Chefs</h3>
            <a href="menu.php" class="btn">View Menu</a>
         </div>
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/gatsby.png" alt="">
         </div>
         <div class="content">
            <span>Limited time only Sign Up to</span>
            <h3>Recieve 50% off all menu items</h3>
            <a href="menu.php" class="btn">View Menu</a>
         </div>
      </div>
      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/cury-dish.png" alt="">
         </div>
         <div class="content">
            <span>Only Place To Serve</span>
            <h3>Premuime African Cuisine</h3>
            <a href="menu.php" class="btn">View Menu</a>
         </div>
      </div>
</div>
      <div class="swiper-pagination"></div>
   </div>
</section>

</div>

<section class="home-items">
   <h1 class="heading">Latest Offerings</h1>
   <div class="swiper items-slider">
   <div class="swiper-wrapper">
   <?php
     $select_items = $conn->prepare("SELECT * FROM `items` LIMIT 6"); 
     $select_items->execute();
     if($select_items->rowCount() > 0){
      while($fetch_items = $select_items->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="id" value="<?= $fetch_items['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_items['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_items['price']; ?>">
      <input type="hidden" name="img" value="<?= $fetch_items['img_1']; ?>">
      <a href="item_view.php?item_id=<?= $fetch_items['id']; ?>" class="fas fa-eye"></a>
      <img src="item_img/<?= $fetch_items['img_1']; ?>" alt="">
      <div class="name"><?= $fetch_items['name']; ?></div>
      <div class="flex">
         <div class="price"><span>R</span><?= $fetch_items['price']; ?><span></span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Add To Bag" class="btn" name="add_to_bag">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No menu items? Site must be under contruction! its not your fault.</p>';
   }
   ?>
   </div>
   <div class="swiper-pagination"></div>
   </div>
</section>

<section class="category">

   <h1 class="heading">Shop through Categories</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=appetizer" class="swiper-slide slide">
      <img src="images/appetizers.gif" alt="">
      <h3>Appetizers</h3>
   </a>

   <a href="category.php?category=sandwich" class="swiper-slide slide">
      <img src="images/sandwiches.gif" alt="">
      <h3>Sandwiches</h3>
   </a>

   <a href="category.php?category=main" class="swiper-slide slide">
      <img src="images/mains.gif" alt="">
      <h3>Mains</h3>
   </a>

   <a href="category.php?category=dessert" class="swiper-slide slide">
      <img src="images/desserts.gif" alt="">
      <h3>Desserts</h3>
   </a>

   <a href="category.php?category=drink" class="swiper-slide slide">
      <img src="images/drinks.gif" alt="">
      <h3>Drinks</h3>
   
   </a>
   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'framework/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>
<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});
 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});
var swiper = new Swiper(".items-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>
</body>
</html>