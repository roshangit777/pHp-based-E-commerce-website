<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
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

.heading{
   min-height: 70vh;
   display: flex;
   background-image: url("images/o9.png");
   background-size: cover;
   flex-flow: column;
   align-items: flex-start;
   justify-content: center;
   gap:1rem;
   background-position: top 25% right 0;
   padding: 0 80px;
}

.heading h3{
   font-size: 5rem;
   color:var(--black);
   text-transform: uppercase;
}

.heading p{
   font-size: 2.5rem;
   color:var(--light-color);
}

.heading p a{
   color:var(--purple);
}

.heading p a:hover{
   text-decoration: underline;
}


.header .header-1{
   color: var(--purple);
}

.header .header-1 .flex{
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: space-between;
   max-width: 1200px;
   margin:0 auto;
}

.header .header-2{
   background-color: var(--white);
   box-shadow: var(--box-shadow);
}

.header .header-2.active{
   position: fixed;
   top:0; left:0; right:0;
   z-index: 1000;
}

.header .header-2 .flex{
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: space-between;
   max-width: 1200px;
   margin:0 auto;
   position: relative;
}

.header .header-1 .flex .share a{
   font-size: 2.5rem;
   margin-right: 1.5rem;
   color:var(--black);
}

.header .header-1 .flex .share a:hover{
   color:var(--purple);
}

.header .header-1 .flex p{
   font-size: 2rem;
   color:var(--light-color);
}

.header .header-1 .flex p a{
   color:var(--purple);
}

.header .header-1 .flex p a:hover{
   text-decoration: underline;
}

.header .header-2 .flex .logo{
   font-size: 2.5rem;
   color:var(--purple);
}

.header .header-2 .flex .navbar a{
   margin:0 1rem;
   font-size: 2rem;
   color:var(--light-color);
}

.header .header-2 .flex .navbar a:hover{
   color:var(--purple);
   text-decoration: underline;
}

.header .header-2 .flex .icons > *{
   font-size: 2.5rem;
   color:var(--black);
   cursor: pointer;
   margin-left: 1.5rem;
}

.header .header-2 .flex .icons > *:hover{
   color:var(--purple);
}

#menu-btn{
   display: none;
}

.header .header-2 .flex .user-box{
   position: absolute;
   top:120%; right:2rem;
   background-color: var(--white);
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   padding:2rem;
   text-align: center;
   width: 30rem;
   display: none;
   animation: fadeIn .2s linear;
}

.header .header-2 .flex .user-box.active{
   display: inline-block;
}

.header .header-2 .flex .user-box p{
   font-size: 2rem;
   color:var(--light-color);
   margin-bottom: 1.5rem;
}

.header .header-2 .flex .user-box p span{
   color:var(--purple);
}

.header .header-2 .flex .user-box .delete-btn{
   margin-top: 0;
}


.display-order{
   max-width: 12px;
   margin: 0 auto;
   text-align: center;
   padding-bottom: 0;
}

.display-order p{
   background-color: var(--light-bg);
   color:var(--black);
   font-size: 2rem;
   padding:1rem 1.5rem;
   border:var(--border);
   display: inline-block;
   margin:.5rem;
}

.display-order p span{
   color:var(--red);
}

.display-order .grand-total{
   margin-top: 2rem;
   font-size: 2.5rem;
   color:var(--light-color);
}

.display-order .grand-total span{
   color:var(--red);
}


.placed-orders .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   flex-wrap: wrap;
   justify-content: space-between;
   align-items: flex-start;
   gap:1rem;
}

.placed-orders .box-container .empty{
   flex:1;
}

.placed-orders .box-container .box{
   flex: 40rem;
   border-radius: 2rem;
   padding:10rem;
   border:var(--border);
   border: 1.5px solid #cce7d0;
   background-color: var(--light-bg);
   padding:2rem 2rem;
}

.placed-orders .box-container .box p{
   padding:.5rem 0;
   font-size: 2rem;
   color:var(--light-color);
}

.placed-orders .box-container .box p span{
   color:var(--purple);
}











.footer{
   background-color: var(--light-bg);
}

.footer .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
   gap:3rem;
}

.footer .box-container .box h3{
   text-transform: uppercase;
   color:var(--black);
   font-size: 2rem;
   padding-bottom: 2rem;
}

.footer .box-container .box p,
.footer .box-container .box a{
   display: block;
   font-size: 1.7rem;
   color:var(--light-color);
   padding:1rem 0;
}

.footer .box-container .box p i,
.footer .box-container .box a i{
   color:var(--purple);
   padding-right: .5rem;
}

.footer .box-container .box a:hover{
   color:var(--purple);
   text-decoration: underline;
}

.footer .credit{
   text-align: center;
   font-size: 2rem;
   color:var(--light-color);
   border-top: var(--border);
   margin-top: 2.5rem;
   padding-top: 2.5rem;
}

.footer .credit span{
   color:var(--purple);
}


}</style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->


</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>your orders</h3>
   <p> <a href="home.php">home</a> / orders </p>
</div>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>Rs <?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
