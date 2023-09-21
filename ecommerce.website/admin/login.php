<?php

include '../framework/connection.php';

session_start();

if(isset($_POST['submit'])){

   $admin_name = $_POST['input_name'];
   $admin_name = filter_var($admin_name, FILTER_SANITIZE_STRING);
   $admin_password = $_POST['input_password'];
   $admin_password = filter_var($admin_password, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$admin_name, $admin_password]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'Invalid Credentials!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.ico">
   <title>Administration Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

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

<section class="form-container">

   <form action="" method="post">
      <h3>ADMIN LOGIN</h3>
      <p>Default Crediantials</p>
      <p><span>Admin1</span>||<span>Pass1</span></p>
      <input type="text" name="input_name" required placeholder="Username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="input_password" required placeholder="Password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="LOGIN" class="btn" name="submit">
   </form>

</section>
   
</body>
</html>