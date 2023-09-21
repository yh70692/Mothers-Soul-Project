<?php

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id']; 
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $password = sha1($_POST['password']);
   $password = filter_var($password, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $password]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:/ecommerce.website/home.php');
   }else{
      $message[] = 'Invalid Username or Password!';
   }

}


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

      <a href="/ecommerce.website/home.php" class="logo"><img src="/ecommerce.website/images/logo.png" style="width: 70px;height: 30px;display: block;"></a>

      <nav class="navbar">
         <a href="/ecommerce.website/home.php">Main Page</a>
         <a href="/ecommerce.website/menu.php">Menu</a>
         <a href="/ecommerce.website/orders.php">Orders</a>
         <a href="/ecommerce.website/about.php">About</a>
      </nav>

      <div class="icons">
         <?php
            $count_bag_items = $conn->prepare("SELECT * FROM `bag` WHERE user_id = ?");
            $count_bag_items->execute([$user_id]);
            $total_bag_counts = $count_bag_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="/ecommerce.website/user/bag.php"><i class="fas fa-shopping-bag"></i><span>(<?= $total_bag_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="user/update_user.php" class="btn">update profile</a>
         <a href="user/logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user/register.php" class="option-btn" >register</a>
            <a id="login-btn" href="javascript:void(0)" class="option-btn">login</a>
         </div>
         <div id="loginPopup" class="popup-container">
            <section class="form-container">
               <form action="" method="post">
                  <h3>LOGIN</h3>
                  <input type="email" name="email" required placeholder="Enter your registered email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                  <input type="password" name="password" required placeholder="Enter your registered email's password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
                  <input type="submit" value="Login" class="btn" name="submit">
                  <p>Forgot Password? Click below.</p>
                  <a href="user/forgot_pass.php" class="option-btn">Forgot Password</a>
               </form>
            </section>
         </div>

         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>
<style>
   .popup-container {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
   }
</style>

<script>
   document.getElementById("login-btn").addEventListener("click", function(event) {
      event.preventDefault();
      document.getElementById("loginPopup").style.display = "block";
   });

   document.addEventListener("click", function(event) {
      if (event.target.id === "loginPopup") {
         document.getElementById("loginPopup").style.display = "none";
      }
   });
</script>
