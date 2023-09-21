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
   <title>Mothers Soul Menu</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user/header.php'; ?>

<section class="items">

   <h1 class="heading">Mothers Soul Menu</h1>

   <div class="box-container">

   <?php
     $select_items = $conn->prepare("SELECT * FROM `items`"); 
     $select_items->execute();
     if($select_items->rowCount() > 0){
      while($fetch_items = $select_items->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
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
      <input type="submit" value="add to bag" class="btn" name="add_to_bag">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty"> No Menu Items : ( </p>';
   }
   ?>

   </div>

</section>

<?php include 'framework/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>