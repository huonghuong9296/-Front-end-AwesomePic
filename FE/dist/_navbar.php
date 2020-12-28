<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/_navbar.css">
</head>
<body>
  <nav id="sidebar" class="hide-menu img">
        <div class="p-4">
          <a href="index.php" class="logo">AwesomePic</a>
          <ul class="components mb-5">
            <li id="home">
              <a href="index.php"
                ><span class="fas fa-home mr-3"></span>Home</a
              >
            </li>
            <li id="product">
              <a href="products.php"
                ><span class="fas fa-image mr-3"></span>Product</a
              >
            </li>
            <li id="pricing">
              <a href="pricing.php"
                ><span class="fa fa-donate mr-3"></span>Pricing</a
              >
            </li>
            <li id="aboutus">
              <a href="aboutUs.php"
                ><span class="fa fa-users mr-3"></span>About Us</a
              >
            </li>
            <li id="contactus">
              <a href="contact.php"
                ><span class="fa fa-envelope mr-3"></span>Contact Us</a
              >
            </li>
          </ul>

          <div class="mb-5">
            <h3 class="h6 mb-3">Receive notifications</h3>
            <form action="get" class="subscribe-form">
              <div class="form-group d-flex">
                <div class="icon"><span class="icon-paper-plane"></span></div>
                <input
                  type="email"
                  class="form-control"
                  placeholder="Enter Email Address"
                />
              </div>
            </form>
          </div>

          <div class="footer">
            <p>
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
              All rights reserved | This template is made with
              <i class="icon-heart" aria-hidden="true"></i> by
              <a href="https://awesompic.com" target="_blank">awesomepic.com</a>
            </p>
          </div>
        </div>
      </nav>

      <nav style="position: fixed" class="navbar-thao bg-light">
        <ul class="navbar-ul">
          <li>
            <i class="fas fa-bars" id="menu-button"></i>
            <a href="index.php" class="btn-thao hide-btn btn-primary my-0 left"
              ><i class="fas fa-home"></i>Home</a
            >
            <a href="products.php" class="btn-thao hide-btn btn-primary left"
              ><i class="fas fa-images"></i>Product</a
            >
            <a href="pricing.php" class="btn-thao hide-btn btn-primary left"
              ><i class="fas fa-donate"></i>Pricing</a
            >
          </li>
        </ul>
        <ul class="navbar-ul">
          <li>
            <a href="aboutUs.php" class="nav-page hide-btn">
              <i class="fas fa-users"></i>About us</a>
            <a href="contact.php" class="nav-page hide-btn">
              <i class="fas fa-envelope"></i>Contact us</a>
            <?php 
              $numberCart = 0;
              if(isset($_SESSION["cart"])) {
                foreach ($_SESSION["cart"] as $key => $value) {
                  $numberCart ++;
                }
              }
            ?>
            <a href="carts.php">
              <i class="fas fa-cart-arrow-down"></i>Cart
              <span class="item-cart" id="numberCart"
              style="color: rgb(74, 74, 74);
              background-color: rgb(253, 216, 53);
              border-radius: 2px;
              display: inline-block;
              text-align: center;
              margin-left: 9px;
              padding: 0 6px;
              font-weight: 700;
              height: 20px;
              "><?php echo $numberCart; ?></span></a>
            
			<!-- <button id="btn-profile">
				<i class="fas fa-user-circle"></i>
			Username</button> -->

			<div class="pform-popup" id="myForm">
				
				<form action="" class="pform-container">
					
					<div class="pform-item">
					  <a href="account.php" class="pform-item">Account</a>
					</div>
					<div class="pform-item">
					  <a href="purchase.php" class="pform-item">Purchase</a>
          </div> 
          <!-- <div class="pform-item">
					  <a href="update_password.php" class="pform-item">Change password</a>
					</div>           -->
				</form>
			</div>  
               
            </a>       
            <?php 
				ob_start();
				
				if(!isset($_SESSION["user_email"])){    
					// $message = "You are not logged in@@@@@@@@@@@@";
					// header("location:login.php");
				?>
					<a href="signUp.php" class="nav-page"> Sign Up</a>
					<a href="login.php" class="btn-thao btn-primary gradient right">
					Sign In</a>
				<?php
				}
				else{
					$message = "You are LOGGED in!";
				?>
					<button id="btn-profile">
						<i class="fas fa-user-circle"></i>
					<!-- Username -->
					<?php 
						print_r($_SESSION["user_firstname"]);
						echo " ";
						print_r($_SESSION["user_lastname"]);
					?>
					</button>
					<a href="logout.php" name="logOut"
					class="btn-thao btn-primary gradient right">
					Log out</a>
				<?php
				}              
        ?>    
            
      </li>
    </ul>
  </nav>
      
</body>
</html>
