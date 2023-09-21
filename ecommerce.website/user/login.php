<?php

include '../framework/connection.php'; //creates a link to the database connection

session_start();

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="/images/favicon.ico">
   <title>User Login</title>
   
   <!-- cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>LOGIN</h3>
      <input type="email" name="email" required placeholder="Enter your registered email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="password" required placeholder="Enter your registered email's password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Login" class="btn" name="submit">
      <p>Forgot Password? Click below.</p>
      <a href="forgot_pass.php" class="option-btn">Forgot Password</a>
      <p>Haven't created an account? Register below.</p>
      <a href="register.php" class="option-btn">Register Now</a>
   </form>

</section>

<script src="js/script.js"></script>

</body>
</html>