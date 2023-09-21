<?php

include '../framework/connection.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
   

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = ?"); 
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user) {
      $update_profile = $conn->prepare("UPDATE `users` SET name = ? WHERE email = ?"); //selects and runs a update query with user given email and name
      $update_profile->execute([$name, $email]);

      $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709'; 
      $new_pass = sha1($_POST['new_pass']);
      $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
      $cpass = sha1($_POST['cpass']);
      $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

      if($new_pass != $cpass){
         $message[] = 'confirm password not matched!'; //checks pass
      }elseif($new_pass != $empty_pass){
            $update_user_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE `email` = ?");
            $update_user_pass->execute([$cpass, $email]);
            $message[] = 'password updated successfully!';
            header('location:login.php');
         }else{
            $message[] = 'please enter a password!';
         }

    }else{
      $message[] = 'Your email does not exist try to Register instead!';
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
   <title>Forgot Password</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="form-container">
   <!-- Users are required to remeber their username and email in order to change password -->
   <form action="" method="post">
      <h3>Forgot Password</h3>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>

</section>

<script src="js/script.js"></script>

</body>
</html>