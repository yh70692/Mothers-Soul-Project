<?php

include '../framework/connection.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['delete'])){
   $bag_id = $_POST['bag_id'];
   $delete_bag_item = $conn->prepare("DELETE FROM `bag` WHERE id = ?");
   $delete_bag_item->execute([$bag_id]);
}

if(isset($_GET['delete_all'])){
   $delete_bag_item = $conn->prepare("DELETE FROM `bag` WHERE user_id = ?");
   $delete_bag_item->execute([$user_id]);
   header('location:bag.php');
}

if(isset($_POST['update_qty'])){
   $bag_id = $_POST['bag_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `bag` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $bag_id]);
   $message[] = 'bag quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="../images/favicon.ico">
   <title>Shopping Bag</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="items shopping-bag">

   <h3 class="heading">Your Shopping Bag</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_bag = $conn->prepare("SELECT * FROM `bag` WHERE user_id = ?");
      $select_bag->execute([$user_id]);
      if($select_bag->rowCount() > 0){
         while($fetch_bag = $select_bag->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="bag_id" value="<?= $fetch_bag['id']; ?>">
      <img src="../item_img/<?= $fetch_bag['img']; ?>" alt="">
      <div class="name"><?= $fetch_bag['name']; ?></div>
      <div class="flex">
         <div class="price">R<?= $fetch_bag['price']; ?></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_bag['quantity']; ?>">
         <button type="submit" class="fas fa-edit" name="update_qty"></button>
      </div>
      <div class="sub-total"> Sub Total : <span>R<?= $sub_total = ($fetch_bag['price'] * $fetch_bag['quantity']); ?></span> </div>
      <input type="submit" value="delete item" onclick="return confirm('Remove from bag?');" class="delete-btn" name="delete">
   </form>
   <?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your bag is empty</p>';
   }
   ?>
   </div>

   <div class="bag-total">
      <p>Grand Total : <span>R<?= $grand_total; ?></span></p>
      <a href="../menu.php" class="option-btn">Continue Shopping</a>
      <a href="bag.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Remove all from bag?');">Remove all items</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>

<?php include '../framework/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>