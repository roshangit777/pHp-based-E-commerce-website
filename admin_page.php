<?php

include 'config.php';

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
   <title>admin panel</title>
   <style>
   @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap');

   :root{
      --purple:#8e44ad;
      --red:#c0392b;
      --orange:#f39c12;
      --black:#333;
      --white:#fff;
      --light-color:#666;
      --light-white:#ccc;
      --light-bg:#f5f5f5;
      --border:.1rem solid var(--black);
      --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   }

   *{
      font-family: 'Rubik', sans-serif;
      margin:0; padding:0;
      box-sizing: border-box;
      outline: none; border:none;
      text-decoration: none;
      transition:all .2s linear;
   }

   *::selection{
      background-color: var(--purple);
      color:var(--white);
   }

   *::-webkit-scrollbar{
      height: .5rem;
      width: 1rem;
   }

   *::-webkit-scrollbar-track{
      background-color: transparent;
   }

   *::-webkit-scrollbar-thumb{
      background-color: var(--purple);
   }

   html{
      font-size: 62.5%;
      overflow-x: hidden;
   }

   body{
      background-color: var(--light-bg);
   }

   section{
      padding:3rem 2rem;
   }

   .title{
      text-align: center;
      margin-bottom: 2rem;
      text-transform: uppercase;
      color:var(--black);
      font-size: 4rem;
   }

   .empty{
      padding:1.5rem;
      text-align: center;
      border:var(--border);
      background-color: var(--white);
      color:var(--red);
      font-size: 2rem;
   }

   .message{
      position: sticky;
      top:0;
      margin:0 auto;
      max-width: 1200px;
      background-color: var(--light-bg);
      padding:2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      z-index: 10000;
      gap:1.5rem;
   }

   .message span{
      font-size: 2rem;
      color:var(--black);
   }

   .message i{
      cursor: pointer;
      color:var(--red);
      font-size: 2.5rem;
   }

   .message i:hover{
      transform: rotate(90deg);
   }

   .btn,
   .option-btn,
   .delete-btn,
   .white-btn{
      display: inline-block;
      margin-top: 1rem;
      padding:1rem 3rem;
      cursor: pointer;
      color:var(--white);
      font-size: 1.8rem;
      border-radius: .5rem;
      text-transform: capitalize;
   }

   .btn:hover,
   .option-btn:hover,
   .delete-btn:hover{
      background-color: var(--black);
   }

   .white-btn,
   .btn{
      background-color: var(--purple);
   }

   .option-btn{
      background-color: var(--orange);
   }

   .delete-btn{
      background-color: var(--red);
   }

   .white-btn:hover{
      background-color: var(--white);
      color:var(--black);
   }

   @keyframes fadeIn {
      0%{
         transform: translateY(1rem);
         opacity: .2s;
      }
   }

   .header{
      position: sticky;
      top:0; left:0; right:0;
      z-index: 1000;
      background-color: var(--white);
      box-shadow: var(--box-shadow);
   }

   .header .flex{
      display: flex;
      align-items: center;
      padding:2rem;
      justify-content: space-between;
      position: relative;
      max-width: 1200px;
      margin:0 auto;
   }

   .header .flex .logo{
      font-size: 2.5rem;
      color:var(--black);
   }

   .header .flex .logo span{
      color:var(--purple);
   }

   .header .flex .navbar a{
      margin:0 1rem;
      font-size: 2rem;
      color:var(--black);
   }

   .header .flex .navbar a:hover{
      color:var(--purple);
   }

   .header .flex .icons div{
      margin-left: 1.5rem;
      font-size: 2.5rem;
      cursor: pointer;
      color:var(--black);
   }

   .header .flex .icons div:hover{
      color:var(--purple);
   }

   .header .flex .account-box{
      position: absolute;
      top:120%; right:2rem;
      width: 30rem;
      box-shadow: var(--box-shadow);
      border-radius: .5rem;
      padding:2rem;
      text-align: center;
      border-radius: .5rem;
      border:var(--border);
      background-color: var(--white);
      display: none;
      animation:fadeIn .2s linear;
   }

   .header .flex .account-box.active{
      display: inline-block;
   }

   .header .flex .account-box p{
      font-size: 2rem;
      color:var(--light-color);
      margin-bottom: 1.5rem;
   }

   .header .flex .account-box p span{
      color:var(--purple);
   }

   .header .flex .account-box .delete-btn{
      margin-top: 0;
   }

   .header .flex .account-box div{
      margin-top: 1.5rem;
      font-size: 2rem;
      color:var(--light-color);
   }

   .header .flex .account-box div a{
      color:var(--orange);
   }

   .header .flex .account-box div a:hover{
      text-decoration: underline;
   }

   #menu-btn{
      display: none;
   }

   .dashboard .box-container{
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
      gap:1rem;
      max-width: 1200px;
      margin:0 auto;
      align-items: flex-start;
   }

   .dashboard .box-container .box{
      border-radius: 2rem;
      padding:2rem;
      background-color: var(--white);
      box-shadow: var(--box-shadow);
      border:var(--border);
      text-align: center;
   }

   .dashboard .box-container .box h3{
      font-size: 4rem;
      color:var(--black);
   }

   .dashboard .box-container .box p{
      margin-top: 1.5rem;
      padding:1.5rem;
      background-color: var(--light-bg);
      color:var(--purple);
      font-size: 2rem;
      border-radius: 1rem;
      border:var(--border);
   }

</style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <lin rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['total_price'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>Rs <?php echo $total_pendings; ?>/-</h3>
         <p>total pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>Rs <?php echo $total_completed; ?>/-</h3>
         <p>completed payments</p>
      </div>

      <div class="box">
         <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>order placed</p>
      </div>

      <div class="box">
         <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>products added</p>
      </div>

      <div class="box">
         <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>normal users</p>
      </div>

      <div class="box">
         <?php
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>total accounts</p>
      </div>

      <div class="box">
         <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>new messages</p>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
