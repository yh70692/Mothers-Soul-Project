<?php

include '../framework/connection.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $payment_option = $_POST['payment_option'];
   $payment_option = filter_var($payment_option, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $item_total = $_POST['item_total'];
   $total_price = $_POST['total_price'];

   $check_bag = $conn->prepare("SELECT * FROM `bag` WHERE user_id = ?");
   $check_bag->execute([$user_id]);

   if($check_bag->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, payment_option, address, item_total, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $payment_option, $address, $item_total, $total_price]);

      $delete_bag = $conn->prepare("DELETE FROM `bag` WHERE user_id = ?");
      $delete_bag->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your bag is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>your orders</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $bag_items[] = '';
         $select_bag = $conn->prepare("SELECT * FROM `bag` WHERE user_id = ?");
         $select_bag->execute([$user_id]);
         if($select_bag->rowCount() > 0){
            while($fetch_bag = $select_bag->fetch(PDO::FETCH_ASSOC)){
               $bag_items[] = $fetch_bag['name'].' ('.$fetch_bag['price'].' x '. $fetch_bag['quantity'].') - ';
               $item_total = implode($bag_items);
               $grand_total += ($fetch_bag['price'] * $fetch_bag['quantity']);
      ?>
         <p> <?= $fetch_bag['name']; ?> <span>(<?= 'R'.$fetch_bag['price'].' x '. $fetch_bag['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">your bag is empty!</p>';
         }
      ?>
         <input type="hidden" name="item_total" value="<?= $item_total; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">Grand Total : <span>R<?= $grand_total; ?></span></div>
      </div>

      <h3>place your orders</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Name :</span>
            <input type="text" name="name" placeholder="Enter your name" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>Number :</span>
            <input type="number" name="number" placeholder="Enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" placeholder="Enter your email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="payment_option" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address :</span>
            <input type="text" name="flat" placeholder="e.g. flat number/ street name/ town" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Refrence Pin Code : (needed for online payments) </span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
         <h2>*NOTE : ORDERS ARE ONLY DELIVERED IN THE CITY OF CAPE TOWN*</h2>
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">

   </form>

</section>

<?php include '../framework/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>