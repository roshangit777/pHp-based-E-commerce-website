<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
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
   background-image: url("images/c4.jpg");
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


.products .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 30rem);
   align-items: flex-start;
   gap:1.5rem;
   justify-content: center;
}

.products .box-container .box{
   border-radius: .5rem;
   background-color: var(--white);
   box-shadow: var(--box-shadow);
   padding: 10px 12px;
   text-align: center;
   border: 1px solid #cce7d0;
   position: relative;
   border-radius: 20px;
   cursor: pointer;
   box-shadow: 20px 20px 30px rgba(0,0,0,0.02);
   transition: 0.2s ease;
}

.products .box-container .box:hover{
  box-shadow: 20px 20px 30px rgba(0,0,0,0.06);
}

.products .box-container .box .image{
   height: 20rem;
   border-radius: 20px;
}

.products .box-container .box .name{
   padding:10px 0;
   font-size: 2rem;
   color: #606063;
}

.products .box-container .box .qty{
   text-align: starts;
   width: 20%;
   padding:10px 10px;
   left: 10px;
   border-radius: 10px;
   border: var(--border);
   margin:1rem 1rem;
   font-size: 2rem;
}

.products .box-container .box .price{
   position: absolute;
   top:1rem; left:1rem;
   border-radius: .5rem;
   padding:1rem;
   font-size: 1.6rem;
   color:var(--white);
   background-color:var(--red);
}

.products .box-container .box .btnn{
    width: 90px;
    height: 40px;
    line-height: 40px;
    border-radius: 100px;
    background-color: #e8f6ea;
    font-weight: 1000;
    color: #088178;
    border: 1px solid #088178;
    position: absolute;
    bottom: 20px;
    right: 25px;

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
   <h3>our shop</h3>
   <p> <a href="home.php">home</a> / shop </p>
</div>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
