<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../admin/index.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="../admin/index.php">Overview</a>
         <a href="../admin/items.php">Menu Items</a>
         <a href="../admin/orders.php">Orders</a>
         <a href="../admin/users_accounts.php">Users</a>
         <a href="../admin/admin_accounts.php">Admins</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_admin.php" class="btn">Edit Account Info</a>
         <a href="../admin/logout.php" class="delete-btn" onclick="return confirm('Are you sure?');">Logout</a> 
      </div>

   </section>

</header>