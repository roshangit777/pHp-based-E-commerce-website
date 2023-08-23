<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>
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

   #menu-btn{
      display: none;
   }

   .users .box-container{
      display: grid;
      grid-template-columns: repeat(auto-fit, 30rem);
      justify-content: center;
      gap:1.5rem;
      max-width: 1200px;
      margin:0 auto;
      align-items: flex-start;
   }

   .users .box-container .box{
      background-color: var(--white);
      padding:2rem;
      border:var(--border);
      box-shadow: var(--box-shadow);
      border-radius: 2rem;
      text-align: center;
   }

   .users .box-container .box p{
      padding-bottom: 1.5rem;
      font-size: 1.9rem;
      color:var(--light-color);
   }

   .users .box-container .box p span{
      color:var(--purple);
   }

   .users .box-container .box .delete-btn{
      margin-top: 0;
   }


</style>


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">


</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> user accounts </h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> username : <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> user type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
