<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!';
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
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
min-height: 80vh;
background-image: url("images/cc2.jpg");
background-size: cover;
display: flex;
background-position: top 25% right 0;
padding: 0 80px;
flex-flow: column;
align-items: flex-start;
justify-content: center;
gap:1rem;
}

.heading h3{
text-align: left;
font-size: 5rem;
color: #088178;
text-transform: uppercase;
}

.heading p{
text-align: left;
font-size: 2.5rem;
color:var(--light-color);
}

.heading p a{
color:var(--purple);
}

.heading p a:hover{
text-decoration: underline;
}

@keyframes fadeIn {
0%{
   transform: translateY(1rem);
   opacity: .2s;
}
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

.shopping-cart .disabled{
pointer-events: none;
opacity: .5;
user-select: none;
}
.display-order{
   max-width: 1200px;
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


.checkout form{
max-width: 700px;
padding:1.5rem;
margin:0 auto;
border:var(--border);
background-color: var(--light-bg);
border-radius: .5rem;
}

.checkout form h3{
text-align: center;
margin-bottom: 2rem;
color:var(--black);
text-transform: uppercase;
font-size: 3rem;
}

.checkout form .flex{
display: flex;
flex-wrap: wrap;
gap:.5rem;
}

.checkout form .flex .inputBox{
flex:1 1 35rem;
}

.checkout form .flex span{
font-size: 2rem;
color:var(--black);
}

.checkout form .flex select,
.checkout form .flex input{
border:var(--border);
width: 100%;
border-radius: 1rem;
width: 100%;
background-color: var(--white);
padding:1.2rem 1.4rem;
font-size: 1.7rem;
margin:1rem 0;
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

</style>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">



</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0 ){

      while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'Rs '.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>Rs <?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="text" name="number" maxlength="10" required placeholder="enter your number" >
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. Bangalore">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. karnataka">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
