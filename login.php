<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
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

section{
   padding:3rem 2rem;
}

.empty{
   padding:1.5rem;
   text-align: center;
   border:var(--border);
   background-color: var(--white);
   color:var(--red);
   font-size: 2rem;
}

#login {
  text-align: center;
  padding-top: 30px;
  background-color: #FFF;
}

#login h1{
  color:#f39c12;
  font-size: 3rem;
}

#login h2{
  font-size: 2rem;
}


.message{
   position: sticky;
   top:0;
   margin:0 auto;
   max-width: 1200px;
   background-color: var(--white);
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

.title{
   text-align: center;
   margin-bottom: 2rem;
   text-transform: uppercase;
   color:var(--black);
   font-size: 4rem;
}

.btn,
.option-btn,
.delete-btn,
.white-btn{
   display: inline-block;
   margin-top: 1rem;
   padding:1rem 1rem;
   cursor: pointer;
   color:var(--white);
   font-size: 1.4rem;
   border-radius: .80rem;
   text-transform: capitalize;
}

.btn:hover,
.option-btn:hover,
.delete-btn:hover{
   background-color: #088178;
}

.white-btn,
.btn{
   background-color: var(--purple);
}

.option-btn{
   background-color: var(--orange);
}

.delete-btn{
   background-color: #088178;
}

.white-btn:hover{
   background-color: var(--white);
   color:var(--black);
}

.form-container{
   min-height: 50vh;
   background-color: #f444;
   display: flex;
   align-items: center;
   justify-content: center;
   padding:2rem;
}

.form-container form{
   padding:1rem;
   width: 40rem;
   border-radius: 1.8rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   background-color: var(--white);
   text-align: center;
}

.form-container form h3{
   font-size: 2.2rem;
   margin-bottom: 1rem;
   text-transform: uppercase;
   color:var(--black);
}

.form-container form .box{
   width: 100%;
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color:var(--black);
   border:var(--border);
   margin:1rem 0;
}

.form-container form p{
   padding-top: 1.5rem;
   font-size: 2rem;
   color:var(--purple);
}

.form-container form p a{
   color:var(--purple);
}

.form-container form p a:hover{
   text-decoration: underline;
}
</style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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

<section id="login">
  <h1> THE COZY LIBRARY<h1>
    <h2>A book store</h2>
  </section>




<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>Don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>

</body>
</html>
