<?php

include '../framework/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `items` SET name = ?, price = ?, details = ? WHERE id = ?");
   $update_product->execute([$name, $price, $details, $pid]);

   $message[] = 'Updated!';

   $old_image_01 = $_POST['old_image_01'];
   $img_1 = $_FILES['img_1']['name'];
   $img_1 = filter_var($img_1, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['img_1']['size'];
   $image_tmp_name_01 = $_FILES['img_1']['tmp_name'];
   $image_folder_01 = '../item_img/'.$img_1;

   if(!empty($img_1)){
      if($image_size_01 > 2000000){
         $message[] = 'image is too large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `item` SET img_1 = ? WHERE id = ?");
         $update_image_01->execute([$img_1, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../item_img/'.$img_1);
         $message[] = 'updated image 1!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $img_2 = $_FILES['img_2']['name'];
   $img_2 = filter_var($img_2, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['img_2']['size'];
   $image_tmp_name_02 = $_FILES['img_2']['tmp_name'];
   $image_folder_02 = '../item_img/'.$img_2;

   if(!empty($img_2)){
      if($image_size_02 > 2000000){
         $message[] = 'image is too large!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `items` SET img_2 = ? WHERE id = ?");
         $update_image_02->execute([$img_2, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../item_img/'.$old_image_02);
         $message[] = 'updated image 2!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Food Item</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="update-product">

   <h1 class="heading">update item</h1>

   <?php
      $update_id = $_GET['update'];
      $select_item = $conn->prepare("SELECT * FROM `items` WHERE id = ?");
      $select_item->execute([$update_id]);
      if($select_item->rowCount() > 0){
         while($fetch_item = $select_item->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_item['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_item['img_1']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_item['img_2']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../item_img/<?= $fetch_item['img_1']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../item_img/<?= $fetch_item['img_1']; ?>" alt="">
            <img src="../item_img/<?= $fetch_item['img_2']; ?>" alt="">
         </div>
      </div>
      <span>update name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="Enter food name" value="<?= $fetch_item['name']; ?>">
      <span>update price</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="Enter meal's price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_item['price']; ?>">
      <span>update details</span>
      <textarea name="details" class="box" required cols="30" rows="10" placeholder="Enter food details" ><?= $fetch_item['details']; ?></textarea>
      <span>update image 1</span>
      <input type="file" name="img_1" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>update image 2</span>
      <input type="file" name="img_2" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="items.php" class="option-btn">Back</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no product found!</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>