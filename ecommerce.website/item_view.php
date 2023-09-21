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
   <title>Item View</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user/header.php'; ?>

<section class="quick-view">

   <h1 class="heading">Item Details</h1>

   <?php
     $id = $_GET['item_id'];
     $select_items = $conn->prepare("SELECT * FROM `items` WHERE id = ?"); 
     $select_items->execute([$id]);
     if($select_items->rowCount() > 0){
      while($fetch_items = $select_items->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="id" value="<?= $fetch_items['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_items['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_items['price']; ?>">
      <input type="hidden" name="img" value="<?= $fetch_items['img_1']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="item_img/<?= $fetch_items['img_1']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="item_img/<?= $fetch_items['img_1']; ?>" alt="">
               <img src="item_img/<?= $fetch_items['img_2']; ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $fetch_items['name']; ?></div>
            <div class="flex">
               <div class="price"><span>R</span><?= $fetch_items['price'] ?><span></span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="details"><?= $fetch_items['details']; ?></div>
            <div class="flex-btn">
               <input type="submit" value="add to bag" class="btn" name="add_to_bag">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty"> No Item To View </p>';
   }
   ?>

</section>

<?php include 'framework/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>