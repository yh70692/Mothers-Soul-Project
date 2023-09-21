<?php

include '../framework/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_item'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $img_1 = $_FILES['img_1']['name'];
   $img_1 = filter_var($img_1, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['img_1']['dd'];
   $image_tmp_name_01 = $_FILES['img_1']['tmp_name'];
   $image_folder_01 = '../item_img/'.$img_1;

   $img_2 = $_FILES['img_2']['name'];
   $img_2 = filter_var($img_2, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['img_2']['size'];
   $image_tmp_name_02 = $_FILES['img_2']['tmp_name'];
   $image_folder_02 = '../item_img/'.$img_2;

   $select_items = $conn->prepare("SELECT * FROM `items` WHERE name = ?");
   $select_items->execute([$name]);

   if($select_items->rowCount() > 0){
      $message[] = 'Create unique product name, This one allready exist!';
   }else{

      $insert_items = $conn->prepare("INSERT INTO `items`(name, details, price, img_1, img_2) VALUES(?,?,?,?,?)");
      $insert_items->execute([$name, $details, $price, $img_1, $img_2]);

      if($insert_items){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000){
            $message[] = 'Image is large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            $message[] = 'New Item Added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `items` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('item_img/'.$fetch_delete_image['img_1']);
   unlink('item_img/'.$fetch_delete_image['img_2']);
   $delete_product = $conn->prepare("DELETE FROM `items` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_bag = $conn->prepare("DELETE FROM `bag` WHERE pid = ?");
   $delete_bag->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:items.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="/ecommerce.website/images/favicon.ico">
   <title>Food Panal</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="add-items">

   <h1 class="heading">ADD NEW MENU ITEM</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>Food name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="Enter food name" name="name">
         </div>
         <div class="inputBox">
            <span>Meal price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="Enter meal's price" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="inputBox">
            <span>Meal image 01 (required)</span>
            <input type="file" name="img_1" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>Meal image 02</span>
            <input type="file" name="img_2" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>Food details or Ingrediants (required)</span>
            <textarea name="details" placeholder="Enter food details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      <input type="submit" value="Add To Menu" class="btn" name="add_item">
   </form>

</section>

<section class="show-items">

   <h1 class="heading">Current Menu</h1>

   <div class="box-container">

   <?php
      $select_items = $conn->prepare("SELECT * FROM `items`");
      $select_items->execute();
      if($select_items->rowCount() > 0){
         while($fetch_items = $select_items->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="/ecommerce.website/item_img/<?= $fetch_items['img_1']; ?>" alt="">
      <div class="name"><?= $fetch_items['name']; ?></div>
      <div class="price">R<span><?= $fetch_items['price']; ?></span></div>
      <div class="details"><span><?= $fetch_items['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_item.php?update=<?= $fetch_items['id']; ?>" class="option-btn">update</a>
         <a href="item.php?delete=<?= $fetch_items['id']; ?>" class="delete-btn" onclick="return confirm('Remove from menu?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty"> No Menu Items : ( </p>';
      }
   ?>
   
   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>