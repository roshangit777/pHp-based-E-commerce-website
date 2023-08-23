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

.white-btn{
  background-color: var(--purple);
  opacity: 0;

}
.btn{
   background-color: var(--purple);
   opacity:
}

.option-btn{
   background-color: var(--orange);
}

.delete-btn{
   background-color: #088178;
}

.white-btn:hover{
   background-color: var(--088178);
   color:var(--purple);
}

.heading{
   min-height: 30vh;
   display: flex;
   flex-flow: column;
   align-items: center;
   justify-content: center;
   gap:1rem;
   background: url(../images/home-bg.jpg) no-repeat;
   background-size: cover;
   background-position: center;
   text-align: center;
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

@keyframes fadeIn {
   0%{
      transform: translateY(1rem);
      opacity: .2s;
   }
}

.form-container{
   min-height: 100vh;
   background-color: var(--light-bg);
   display: flex;
   align-items: center;
   justify-content: center;
   padding:2rem;
}

.form-container form{
   padding:2rem;
   width: 50rem;
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   background-color: var(--white);
   text-align: center;
}

.form-container form h3{
   font-size: 3rem;
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

.home{
   min-height: 70vh;
   background-image: url("images/n3.webp");
   background-size: cover;
   background-position: top 25% right 0;
   padding: 0 80px;
   display: flex;
   flex-direction: column;
   align-items: flex-start;
   justify-content: center;
}

.home .bubble img{
  width: 50px;
  animation: bubblee 7s linear infinite;
}

.home .bubble{
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-around;
  position: absolute;
  bottom: -10px;
}
@keyframes bubblee {
  0%{
    transform: translatey(0);
    opacity: 0;
  }
  50%{
    opacity: 1;
  }
  70%{
    opacity: 1;
  }
  100%{
    transform: translatey(-80vh);
    opacity: 0;
  }

}

.home .bubble img:nth-child(1){
  animation-delay: 2s;
}
.home .bubble img:nth-child(2){
  animation-delay: 1s;
}
.home .bubble img:nth-child(3){
  animation-delay: 3s;
}
.home .bubble img:nth-child(4){
  animation-delay: 4.5s;
}
.home .bubble img:nth-child(5){
  animation-delay: 3s;
}
.home .bubble img:nth-child(6){
  animation-delay: 6s;
}
.home .bubble img:nth-child(7){
  animation-delay: 7s;
}

.home .content{
   text-align: center;
   width: 60rem;
}

.home .content h3{
   font-size: 5.5rem;
   color: #088178;
   text-transform: uppercase;
}

.home .content p{
   font-size: 1.5rem;
   color: #000;
   padding:1rem 0;
   line-height: 1.5;
   opacity: 0;
}

.slide-left{
  animation: slideleft 1s linear forwards;
}

@keyframes slideleft {
  0%{
    transform: translate(100px);
    opacity: 0;
  }
  100%{
    transform: translate(04px);
    opacity: 1;
  }


}

p.slide-left {
  animation-delay: 1s;
}
a.slide-left {
  animation-delay: 2s;
}

#feature {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

#feature .fe-box {
    width: 180px;
    text-align: center;
    padding: 25px 15px;
    box-shadow: 20px 20px 34px rgb(0,0,0,0.03);
    border: 1px solid #cce7d0;
    border-radius: 4px;
    margin: 15px 0;
}

#feature .fe-box:hover {
    box-shadow: 10px 10px 54px rgb(70, 62, 221, 0.1);
}

#feature .fe-box img {
    width: 100%;
    margin-bottom: 10px;
}

#feature .fe-box h3 {
    display: inline-block;
    padding: 9px 8px 6px 8px;
    line-height: 1;
    border-radius: 4px;
    color: #088178;
    background-color: #fddde4;
}

#feature .fe-box:nth-child(2) h3 {
    background-color: #cdebbc;
}

#feature .fe-box:nth-child(3) h3 {
    background-color: #d1e8f2;
}

#feature .fe-box:nth-child(4) h3 {
    background-color: #cdd4f8;
}

#feature .fe-box:nth-child(5) h3 {
    background-color: #f6dbf6;
}

#feature .fe-box:nth-child(6) h3 {
    background-color: #fff2e5;
}


.products .box-container{
   max-width: 1200px;
   margin:0 auto;
   display: flex;
   flex-wrap: wrap;
   grid-template-columns: repeat(auto-fit, 30rem);
   align-items: flex-start;
   gap:1.5rem;
   justify-content: space-between;
}

.products .box-container .box{
   border-radius: .5rem;
   max-width: 23%;
   min-width: 250px;
   margin: 15px 0;
   background-color: var(--white);
   padding: 10px 12px;
   text-align: center;
   border: 1px solid #cce7d0;
   position: relative;
   border-radius: 20px;
   cursor: pointer;
   box-shadow: 20px 20px 30px rgba(0,0,0,0.02);
   transition: 0.2s ease;
   position: relative;
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

.about .flex{
   max-width: 1200px;
   margin:0 auto;
   display: flex;
   align-items: center;
   flex-wrap: wrap;
}

.about .flex .video{
   flex:1 1 13rem;
   border-radius: 10px;
}

.about .flex .video video{
  width: 90%;
}

.about .flex .content{
   flex:1 1 40rem;
   padding:2rem;
   background-color: none;
}

.about .flex .content h3{
  text-align: center;
   font-size: 4rem;
   color: #088178;
   text-transform: uppercase;
   opacity: 0;
}

.about .flex .content p{
   padding:1rem 0;
   line-height: 2;
   font-size: 1.7rem;
   color:var(--light-color);
   opacity: 0;
}

#banner3 {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 0 80px;
}

#banner3 .banner-box {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    background-image: url("images/bb1.jpg");
    min-width: 30%;
    height: 40vh;
    background-size: cover;
    background-position: center;
    padding: 20px;
    margin-bottom: 20px;
}

#banner3 .banner-box2 {
  background-image: url("images/bb2.jpg");
}

#banner3 .banner-box3 {
    background-image: url("images/bb3.jpg");
}

#banner3 h2 {
    color: #fff;
    font-weight: 900;
    font-size: 22px;
}

#banner3 h3 {
    color: #ec544e;
    font-weight: 800;
    font-size: 15px;
}

.home-contact{
   background-color: var(--black);
}

.home-contact .content{
   max-width: 60rem;
   text-align: center;
   margin:0 auto;
}

.home-contact .content h3{
   font-size: 3rem;
   text-transform: uppercase;
   color:var(--white);
}

.home-contact .content p{
   padding:1rem 0;
   line-height: 1.5;
   color:var(--light-white);
   font-size: 1.7rem;
}


.contact form{
   margin:0 auto;
   background-color: var(--light-bg);
   border-radius: .5rem;
   border:var(--border);
   padding:2rem;
   max-width: 50rem;
   margin:0 auto;
   text-align: center;
}

.contact form h3{
   font-size: 2.5rem;
   text-transform: uppercase;
   margin-bottom: 1rem;
   color:var(--black);
}

.contact form .box{
   margin:1rem 0;
   width: 100%;
   border:var(--border);
   background-color: var(--white);
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color:var(--black);
   border-radius: .5rem;
}

.contact form textarea{
   height: 20rem;
   resize: none;
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
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">



</head>
<body>

<?php include 'header.php'; ?>

<section class="home">
<div class="bubble">
  <img src="images/b3.png">
  <img src="images/b3.png">
  <img src="images/b3.png">
  <img src="images/b3.png">
  <img src="images/b3.png">
  <img src="images/b3.png">
  <img src="images/b3.png">
</div>
 <div class="content">
   <h3 class="slide-left">Trade-in-offer</h3>
    <p class="slide-left">Super deals<br>
    On all product<br>
    Save more with coupons & up to 50% off!</p>
      <a href="about.php" class="white-btn slide-left">discover more</a>
   </div>

</section>
<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="php/img/features/f1.png.jpg" alt="">
        <h3>Free Shipping</h3>
    </div>
    <div class="fe-box">
        <img src="php/img/features/f2.png.png" alt="">
        <h3>Online Order</h3>
    </div>
    <div class="fe-box">
        <img src="php/img/features/f3.png.jpg" alt="">
        <h3>Save Money</h3>
    </div>
    <div class="fe-box">
        <img src="php/img/features/f4.png.jfif" alt="">
        <h3>Promotion</h3>
    </div>
    <div class="fe-box">
        <img src="php/img/features/f5.png.png" alt="">
        <h3>Happy Sell</h3>
    </div>
    <div class="fe-box">
        <img src="php/img/features/f6.png.png" alt="">
        <h3>F24/7 Support</h3>
    </div>
</section>


<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 8") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" max="5" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart " name="add_to_cart" class="btn">
   </form>

      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="video">
        <video autoplay muted loop src="images/vi/v5.mp4"></video>
      </div>

      <div class="content">
         <h3 class="slide-left">about us</h3>
         <p class="slide-left">If you would like to experience the best of online shopping in Book domain, you'ar in perfect place, We provide the best quality of books and meny verity of books also. Some populare categories of books are sci-fi, Fantacy, Horror, Love story, Politics, and Economics. Our online store brings you the latest products straight out from Market. You can shop online at Booklyn from the comfort of your home and get your favourites delivered right to your doorstep.
            Curated collections on Books are here.</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section><br/><br/><br/><br/>
<section id="banner3">
    <div class="banner-box">
        <h2>SEASONAL SALES</h2>
        <h3></h3>
    </div>
    <div class="banner-box banner-box2">
        <h2>Story books</h2>
        <h3>Spring/Summer 2022</h3>
    </div>
    <div class="banner-box banner-box3">
        <h2>New collections</h2>
        <h3>New Trendy Price</h3>
    </div>
</section>
<br/><br/>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>If you have any Question about our service and any other work, you can contact us or inform us in our official websit. We would love to talk and do Bussiness with you. </p>
      <a href="contact.php" class="btn">contact us</a>
   </div>

</section>






<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
