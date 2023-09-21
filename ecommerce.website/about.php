<?php

include 'framework/connection.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.ico">
   <title>About Mothers Soul</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user/header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Why Choose Mother's Soul</h3>
         <p>Just like every African Mother when it comes to food we put passion and love to every pot, plate or pan. 
            We here to satifiy your appetite. Here we a family, with our new delivery we can enjoy good food at home.</p>
         <a href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoyL9Frn6VLTgjkfge6OG_MLqVQPxQZarI8g&usqp=CAU" class="btn">Message Us</a>
      </div>

   </div>


</section>

<section class="reviews">
   
   <h1 class="heading">Our Reviews</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/face1.jpg" alt="">
         <h3>Rafe Porter Simons (Resturant Inspector)</h3>
         <p>Amazing in house conditions from the customers, food and overall environment absolutly 10/10 but I'll give it 4 stars casue we can always improve.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/face2.jpg" alt="">
         <h3>Naomi Hammond (Renowned Chef)</h3>
         <p>Best local business food I've had in a while. Fantastic astablishment with great food, it should be a five star hotal bravo Mother's Soul!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/face3.jpg" alt="">
         <h3>SmackDown81 (Internet Personlity)</h3>
         <p>If you saw my video you know how I feel about this place, if you didnt go watch it @youtube.com/smackdown81/videos. Otherwise buy a meal already!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/face4.jpg" alt="">
         <h3>Grill House (Internet Magazine)</h3>
         <p>Cape Town is home to a variety of resturant owners. Mothers Soul separates it's self from the compition by not being a traditional resturant establishment but a home.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
      </div>
      

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>


<?php include 'framework/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>