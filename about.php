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
  background-image: url("images/aa5.png");
  display: flex;
  background-position: top 50% right 0;
  padding: 0 50px;
  flex-flow: column;
  align-items: flex-start;
  justify-content: center;
  gap:1rem;
  background-size: cover;
}

.heading h3{
  font-size: 5rem;
  color: color: #088178;
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

.reviews{
  background-color: var(--light-bg);
}

.reviews .box-container{
  max-width: 1200px;
  margin:0 auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
  align-items: center;
  gap:1.5rem;
  justify-content: center;
}

.reviews .box-container .box{
  background-color: var(--white);
  box-shadow: var(--box-shadow);
  border:var(--border);
  border-radius: .5rem;
  text-align: center;
  padding:2rem;
}

.reviews .box-container .box img{
  height: 10rem;
  width: 10rem;
  border-radius: 50%;
}

.reviews .box-container .box p{
  padding:1rem 0;
  line-height: 2;
  color:var(--light-color);
  font-size: 1.5rem;
}

.reviews .box-container .box .stars{
  background-color: var(--light-bg);
  display: inline-block;
  margin:.5rem 0;
  border-radius: .5rem;
  border:var(--border);
  padding:.5rem 1.5rem;
}

.reviews .box-container .box .stars i{
  font-size: 1.7rem;
  color:var(--orange);
  margin:.2rem;
}

.reviews .box-container .box h3{
  font-size: 2rem;
  color:var(--black);
  margin-top: 1rem;
}

.authors .box-container{
  max-width: 1200px;
  margin:0 auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
  align-items: center;
  gap:1.5rem;
  justify-content: center;
}

.authors .box-container .box{
  position: relative;
  text-align: center;
  border:var(--border);
  box-shadow: var(--box-shadow);
  overflow: hidden;
  border-radius: 1rem;
}

.authors .box-container .box img{
  border-radius: 1rem 1rem;
  width: 60%;
  height: 20rem;
  padding-top: 10px;
  object-fit: cover;
}

.authors .box-container .box .share{
  position: absolute;
  top:0; left:-10rem;
}

.authors .box-container .box:hover .share{
  left: 1rem;
}

.authors .box-container .box .share a{
  height: 4.5rem;
  width: 4.5rem;
  line-height: 4.5rem;
  font-size: 2rem;
  background-color: var(--white);
  border:var(--border);
  display: block;
  margin-top: 1rem;
  color:var(--black);
}

.authors .box-container .box .share a:hover{
  background-color: var(--black);
  color:var(--white);
}

.authors .box-container .box h3{
  font-size: 2rem;
  color:var(--black);
  padding:1.5rem;
  background-color: var(--white);
}

#about-app {
    text-align: center;
    font-size: 4rem;
}
#about-app.video {
    width: 70%;
    height: 100%;
    margin: 30px auto 0 auto;
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
</style>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->


</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>
</br>
</br>
</br>
</br>

<section class="about">

   <div class="flex">

      <div class="video">
        <video autoplay muted loop src="images/vi/v2.mp4"></video>
     </div>

      <div class="content">
         <h3 class="slide-left">why choose us?</h3>
         <p class="slide-left">If you would like to experience the best of online shopping in Book domain, you'ar in perfect place, We provide the best quality of books and meny verity of books also. Some populare categories of books are sci-fi, Fantacy, Horror, Love story, Politics, and Economics. Our online store brings you the latest products straight out from Market. You can shop online at Booklyn from the comfort of your home and get your favourites delivered right to your doorstep.
            Curated collections on Books are here.</p>
            <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <p>This novel will stir some exciting new perceptions about modern romance. With changing times.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Chandru </h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <p>This novel will stir some exciting new perceptions about modern romance. With changing times.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Prashanth</h3>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <p>This novel will stir some exciting new perceptions about modern romance. With changing times.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Raghu</h3>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <p>This novel will stir some exciting new perceptions about modern romance. With changing times.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Ranjith</h3>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <p>This novel will stir some exciting new perceptions about modern romance. With changing times.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Raghavendra</h3>
      </div>

      <div class="box">
         <img src="images/author-6.jpg" alt="">
         <p>This novel will stir some exciting new perceptions about modern romance. With changing times.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Deepak Joseph</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">greate authors</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/ii1.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Aravind Adiga</h3>
      </div>

      <div class="box">
         <img src="images/ii2.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Vikram Seth</h3>
      </div>

      <div class="box">
         <img src="images/ii3.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Jhumpa Lahiri</h3>
      </div>

      <div class="box">
         <img src="images/ii4.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Devdutt Pattanaik</h3>
      </div>

      <div class="box">
         <img src="images/ii6.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Gurcharan Das</h3>
      </div>

      <div class="box">
         <img src="images/ii7.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Kaajal Oza Vaidya</h3>
      </div>

   </div>

</section><br/><br/><br/>
<section id="about-app" class="section-p1">
           <h1>Download Our <a href="#">App</a></h1><br/>
           <div class="video">
           <video autoplay muted loop src="images/rr4.mp4"></video>
       </div>
       </section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
