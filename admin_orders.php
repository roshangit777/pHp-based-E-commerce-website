<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
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

   .orders .box-container{
      display: grid;
      grid-template-columns: repeat(auto-fit, 30rem);
      justify-content: space-between;
      gap:1rem;
      max-width: 1200px;
      margin:0 auto;
      align-items: flex-start;
      flex-wrap: wrap;
   }

   .orders .box-container .box{
      background-color: var(--white);
      padding:10rem;
      border:var(--border);
      box-shadow: var(--box-shadow);
      border-radius: 2rem;
      flex: 40rem;
      padding:2rem 2rem;
   }

   .orders .box-container .box p{
      padding-bottom: 1rem;
      padding:.5rem 0;
      font-size: 2rem;
      color:var(--light-color);
   }

   .orders .box-container .box p span{
      color:var(--purple);
   }

   .orders .box-container .box form{
      text-align: center;
   }

   .orders .box-container .box form select{
      border-radius: .5rem;
      margin:.5rem 0;
      width: 100%;
      background-color: var(--light-bg);
      border:var(--border);
      padding:1.2rem 1.4rem;
      font-size: 1.8rem;
      color:var(--black);
   }

</style>


   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">



</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
         <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> total products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>Rs <?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <select name="update_payment">
               <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <input type="submit" value="update" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>










<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
