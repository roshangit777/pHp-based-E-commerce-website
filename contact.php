<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
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
   max-width: 120px;
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
   min-height: 60vh;
   background-image: url("images/n1.webp");
   display: flex;
   background-position: top 30% right 0;
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
 #contact-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
#contact-details .details{
    width: 40%;
}
#contact-details .details span,
#form-details form span{
   font-size: 12px;

}
#contact-details .details h2,
#form-details form h2 {
    font-size: 26px;
    line-height: 35px;
    padding: 20px 0;
}
#contact-details .details h3 {
    font-size: 16px;
    padding-bottom: 15px;
}
#contact-details .details li {
    list-style: none;
    display: flex;
    padding: 10px 0;
}
#contact-details .details li i {
    font-size: 14px;
    padding-right: 22px;
}
#contact-details .details li p {
    margin: 0;
    font-size: 14px
}
#contact-details .map {
    width: 55%;
    height: 400px;
}
#contact-details .map iframe {
    width: 100%;
    height: 100%;
}

.contact{
  display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin: 80px;
    padding: 80px;
    border: 1px solid #e1e1e1;
  }

 .contact form .box{
   display: flex;
   margin: 40px;
   width: 60%;
   background-color: var(--white);
   font-size: 1.7rem;
   color:var(--black);
   border-radius: 1rem;
 }

 .contact form textarea{
   width: 60%;
   border: 25px;
   height: 10rem;
   resize: none;
 }

 .contact form input{
   border: 25px;
   height: 4rem;
   resize: none;
 }

 .contact .people img {
    height: 15vh;
    width: 7%;

}
.contact .people div{
    padding-bottom: 25px;
    display: flex;
    align-items: flex-start;
}
.contact .people div img {
    width: 65px;
    height: 65px;
    object-fit: cover;
    margin-right: 15px;
}
.contact .people div p{
    margin: 0;
    font-size: 13px;
    line-height: 25px;
}
.contact .people div p span {
    display: block;
    font-size: 16px;
    font-weight: 600;
    color: #000;
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
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>
</br>
</br>
</br>
<section id="contact-details" class="section-p1">
            <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Visit one of our agency location or contact us today</h2>
                <h3>Head Office</h3>
                <div>
                    <li>
                        <i class="fa-solid fa-map-location"></i>
                        <p>7th Block Jayanagara Bangalore 560062</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        <p>contact@Haha.com</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        <p>Call @ 8088163015</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-clock"></i>
                         <p>Monday to Saturday: 9.00am to 12.00pm</p>
                    </li>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6403.523798952824!2d77.5751215165017!3d12.92759684779621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15bdb2750e53%3A0x7098fbc027b4bfe!2sTHE%20NATIONAL%20COLLEGE%20JAYANAGAR!5e0!3m2!1sen!2sin!4v1656690272117!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="text" maxlength="10" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>
   <div class="people">
                <div>
                    <img src="php/img/people/p2.png" alt="">
                    <p><span>S.Chandrashekar</span>  CEO <br> Phone: +000000547 <br> Email: contact@example.com</p>
                </div>
                <div>
                    <img src="php/img/people/p1.png" alt="">
                    <p><span>Reena</span> Senear Marketing Manager <br> Phone: +000000323 <br> Email: contact@example.com</p>
                </div>
                <div>
                    <img src="php/img/people/p3.png" alt="">
                    <p><span>Choti Bacchi</span>  Useless Manager <br> Phone: +000000856 <br> Email: contact@example.com</p>
                </div>
            </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
