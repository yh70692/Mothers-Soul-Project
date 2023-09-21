<?php

if(isset($_POST['add_to_bag'])){

   if($user_id == ''){
      header('location:user/login.php');
   }else{

      $item_id = $_POST['id'];
      $item_id = filter_var($item_id, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $img = $_POST['img'];
      $img = filter_var($img, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      $check_bag_numbers = $conn->prepare("SELECT * FROM `bag` WHERE name = ? AND user_id = ?");
      $check_bag_numbers->execute([$name, $user_id]);

      if($check_bag_numbers->rowCount() > 0){
         $message[] = 'already in bag!';
      }else{

         $insert_bag = $conn->prepare("INSERT INTO `bag`(user_id, item_id, name, price, quantity, img) VALUES(?,?,?,?,?,?)");
         $insert_bag->execute([$user_id, $item_id, $name, $price, $qty, $img]);
         $message[] = 'added to bag!';
         
      }

   }

}

?>