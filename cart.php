<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity LIMIT 2' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_post['update_cart'])){
  $cart_id = $_POST['cart_id'];
  $cart_quantity = $_POST['cart_quantity'];
  mysqli_query($conn, "UPDATE `cart` SET quantity = 5000 WHERE id = '$cart_id'") or die('query failed');
  $message[] = 'limited';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>
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


.shopping-cart .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   align-items: flex-start;
   align-items: center;
   gap:1.5rem;
   justify-content: center;
}

.shopping-cart .box-container .box{
  border-radius: 0.5rem;
  background-color: var(--white);
   text-align: center;
   padding:10px 12px;
   border-radius: 20px;
   position: relative;
   border: 1px solid #cce7d0;
   cursor: pointer;
   box-shadow: 20px 20px 30px rgba(0,0,0,0.02);
   transition: 0.2s ease;

}

.shopping-cart .box-container .box .fa-times{
   position: absolute;
   top:1rem; right:1rem;
   height: 4.5rem;
   width: 4.5rem;
   line-height: 4.5rem;
   font-size: 2rem;
   background-color: var(--red);
   color:var(--white);
   border-radius: .5rem;
}

.shopping-cart .box-container .box .fa-times:hover{
   background-color: var(--black);
}

.shopping-cart .box-container .box img{
   height: 20rem;
   border-radius: 20px;
}

.shopping-cart .box-container .box .name{
   padding:10px 0;
   font-size: 2rem;
   color: #606063;
}

.shopping-cart .box-container .box .price{
   padding:1rem 0;
   font-size: 2.5rem;
   color:var(--red);
}

.shopping-cart .box-container .box input[type="number"]{
   margin:.5rem 0;
   border:var(--border);
   border-radius: .5rem;
   padding:1.2rem 1.4rem;
   font-size: 2rem;
   color:var(--black);
   width: 6rem;
}

.shopping-cart .box-container .box .sub-total{
   padding-top: 1.5rem;
   font-size: 2rem;
   color:var(--light-color);
}

.shopping-cart .box-container .box .sub-total span{
   color:var(--red);
}

.shopping-cart .cart-total{
   max-width: 620px;
   margin:0 auto;
   border:var(--border);
   padding:2rem;
   text-align: center;
   margin-top: 2rem;
   border-radius: 3rem;
}

.shopping-cart .cart-total p{
   font-size: 2.5rem;
   font-style: none;
   color:var(--light-color);
}

.shopping-cart .cart-total p span{
   color:var(--red);
}

.shopping-cart .cart-total .flex{
   display: flex;
   flex-wrap: wrap;
   column-gap:1rem;
   margin-top: 1.5rem;
   justify-content: center;
}

.shopping-cart .disabled{
   pointer-events: none;
   opacity: .5;
   user-select: none;
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

   <!-- custom css file link  -->


</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>shopping cart</h3>
   <p> <a href="home.php">home</a> / cart </p>
</div>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0 ){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){

      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
         <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_cart['name']; ?></div>
         <div class="price">Rs <?php echo $fetch_cart['price']; ?>/-</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" max="5" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>Rs <?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
     }
      }else{
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>Rs <?php echo $grand_total; ?>/-</span></p>
      <div class="flex">
         <a href="shop.php" class="option-btn">continue shopping</a>
          <a href="checkout.php" class="btn <?php echo ($grand_total < 5000 )?'':'disabled'; ?>">proceed to checkout</a>
      </div>
   </div>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
