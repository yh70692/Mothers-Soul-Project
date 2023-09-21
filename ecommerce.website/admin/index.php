<?php

include '../framework/connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panal</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'header.php'; ?>

<section class="dashboard">

   <h1 class="heading">SITE ANALYTICS</h1>
   <section class="welcome">
         <h3>WELCOME!</h3>
         <p><?= $fetch_profile['name']; ?></p>
   </section>
   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE transaction_status = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         <p>Money To be Made</p>
         <h3><span>R</span><?= $total_pendings; ?></h3>
         <a href="orders.php" class="btn">View Pennding Orders</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE transaction_status = ?");
            $select_completes->execute(['completed']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
         <p>Money Made</p>
         <h3><span>+R</span><?= $total_completes; ?></h3>
         <a href="orders.php" class="btn">View Competed Orders</a>
      </div>

      <div class="box">
         <?php
            $select_items = $conn->prepare("SELECT * FROM `items`");
            $select_items->execute();
            $number_of_items = $select_items->rowCount()
         ?>
         <p>Total Menu Items</p>
         <h3><?= $number_of_items; ?></h3>
         <a href="items.php" class="btn">View Menu Items</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <p>Total User Accounts</p>
         <h3><?= $number_of_users; ?></h3>
         <a href="users_accounts.php" class="btn">View All Users</a>
      </div>
      </div>
      <div class="box">
         <p>Client Site</p>
	      <h3>Vist Mothers Soul</h3>
         <a href="../home.php" class="btn">Vist Site</a>
      </div>

   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>