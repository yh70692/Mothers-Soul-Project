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
   <title>orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'user/header.php'; ?>

<section class="orders">

   <h1 class="heading">placed orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">;Login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>placed on : <span><?= $fetch_orders['order_date']; ?></span></p>
      <p>name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>number : <span><?= $fetch_orders['number']; ?></span></p>
      <p>address : <span><?= $fetch_orders['address']; ?></span></p>
      <p>payment method : <span><?= $fetch_orders['payment_option']; ?></span></p>
      <p>your orders : <span><?= $fetch_orders['item_total']; ?></span></p>
      <p>total price : <span>R<?= $fetch_orders['total_price']; ?></span></p>
      <p> payment status : <span style="color:<?php if($fetch_orders['transaction_status'] == 'pending'){ 
         echo 'red'; }else
         { echo 'green'; }; ?>"><?= $fetch_orders['transaction_status']; ?></span></p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">you have made no orders, lets change that</p>';
      }
      }
   ?>

   </div>

</section>

<footer class="footer">

   <div class="credit">&copy; copyright @ <?= date('Y'); ?> by <span>Mothers Soul .LTE</span></div>

</footer>

<script src="js/script.js"></script>

</body>
</html>