<?php 
	ob_start();
	session_start();
	include 'connect.php';
	$email = $_SESSION['user_email'];
	$password = $_SESSION['user_password'];
	

	if (isset($_POST["update_account"])) {
		
		$new_lname = $_POST['new_lname'];
		$new_fname = $_POST['new_fname'];
		$new_phone = $_POST['new_phone'];
		$new_address = $_POST['new_address'];
		
		$sql = "UPDATE users SET firstname='$new_fname', lastname='$new_lname', address='$new_address' ,
				phone='$new_phone', updated_date=CURRENT_TIMESTAMP()
				WHERE email='$email'";
		$result = mysqli_query($connection, $sql);
		
		$new_sql  = "SELECT * FROM users WHERE email = '$email'";
		$info = mysqli_query($connection, $new_sql);
		if(mysqli_num_rows($info)){
			// mysqli_close($conn); // Close connection
			$row = mysqli_fetch_array($info); 
			// $msg = 'CLICKED';
			$_SESSION['user_firstname'] = $row['firstname'];
			$_SESSION['user_lastname'] = $row['lastname'];
			$_SESSION['user_phone'] = $row['phone'];
			$_SESSION['user_address'] = $row['address'];
			$_SESSION['user_updatedDate'] = $row['updated_date'];
			// print_r($_SESSION);
            header("location:account.php");             
        }
        else{
            echo "Error occur when update car's information";
		}  
	}
	if(isset($_POST['update_password'])){
		$oldPass = $_POST['old-password'];
		$newPass = $_POST['new-password'];
		$repeatPass = $_POST['repeat-new-password'];
		if($oldPass == $password){

			if($newPass != $repeatPass){
				$m = "Repeated password is not matched. Please try again!";
			}
			else{
				$sql = "UPDATE users SET password=AES_ENCRYPT('$newPass', 'secret')
						WHERE email='$email'";
				mysqli_query($connection, $sql);
				$_SESSION['user_password'] = $newPass;
				$m = "Update password successfully!";
			
			}
			echo "<script type='text/javascript'>alert('$m');</script>";
		}
		else{
			$m = "Password is wrong!";
			echo "<script type='text/javascript'>alert('$m');</script>";
		}
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/style.min.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/_navbar.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Account</title>
    <style>
		.btn-update{
			margin-right: 20px;
			display: flex;
			align-items: center;
			text-transform: uppercase;
			font-weight: bold;
			float: left;
			border-radius: 0.1rem !important;
		}		
		.account-noti{
			font-size: 1.5rem;
			margin-left: 50px;
			margin-top: 15px;
			color: grey;
		} 
		.a-items{
			margin: auto;			
		}
		.a-item{
			/* max-width: fit-content; */
			margin: auto;
			margin-top: 10px;
			color: #d77d00;
		}
		.a-item:hover{			
			font-weight: bolder;
		}
		#account-form, #password-form {
			display: none;
			position: fixed;				
			margin: auto;
			color: white:
			top: 40%;
			left: calc(50% - 350px);
			box-shadow: 2px 2px 5px 0 rgba(1, 1, 1, 0.2), -2px -2px 5px 0 rgba(1, 1, 1, 0.2);
		} 
		.f-container {
			/* display: inline-block; */
			width: 700px;
			padding: 30px;
			background-color: rgb(0 , 0, 0, 0.8);           
			text-align: center;
			color: white;
		} 
		.form-title{
			color: orange;
		}
		.new-label{
			text-align: left;
		}
		.new-value,.new-input{
			text-align: left;
			outline: none;
			border: none;
			color: white;
			background-color: transparent;			
		}
		.new-input{
			border: 1px solid #ccc;
		}
		.btn-grp{
			margin-left: 200px;
		}
		@media only screen and (min-width: 768px) and (max-width: 1024px){
			.a-left{
				padding-left: 0 !important;
				padding-right: 0 !important;
			}	
			.f-container{
				/* width: 80%; */
			}		
		}
		@media only screen and (max-width: 800px){
			.f-container{
				width: 95%;
			}	
		}
		
    </style>  
  </head>
  <body>
    <div class="container-fluid">
		<?php 
			include "_navbar.php";
		?>    
		<div class="landing-account">
			<p class="page-title">Account's Information</p>	
			<p class="account-noti">Keep your information privately to protect your account</p>
			<div class="account-inner">				
				<div class="col-sm-3 a-left">
					<img src="img/avatar.jpg" class="avatar" alt="avatar">
					<ul class="a-items">
						<li class="a-item">
							<a class="a-item" href="account.php" >
								<i class="fas fa-user-circle"></i>
							Profile</a>
						</li>
						<li class="a-item">
							<a class="a-item" href="purchase.php"> 
								<i class="fas fa-hand-holding-usd"></i>
							Purchases</a>
						</li>
						<li class="a-item">
							<!-- <a href="#" class="a-item">
								<i class="fas fa-key"></i>
							Change password</a> -->
							<button class="a-item btn-thao btn-primary buy-now-button right free-button"
							onclick="openPForm()">
							Change password</button>
						</li>	
						<li>
						<button class="a-item btn-thao btn-primary buy-now-button right free-button">Change Avatar</button>
						</li>					
					</ul>
				</div>			
				<div class="account-info col-sm-9">
					<div class="field">
						<label class="col-sm-3 label">Username:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_username"]);?>
						</div>
					</div>

					<div class="field">
						<label class="col-sm-3 label">First name:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_firstname"]);?>
						</div>
					</div>

					<div class="field">
						<label class="col-sm-3 label">Last name:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_lastname"]);?>
						</div>
					</div>

					<div class="field">
						<label class="col-sm-3 label">Phone number:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_phone"]);?>
						</div>
					</div>

					<div class="field">
						<label class="col-sm-3 label">Address:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_address"]);?>
						</div>
					</div>

					<div class="field">
						<label class="col-sm-3 label">Email:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_email"]);?>
						</div>
					</div>

					<div class="field">
						<label class="col-sm-3 label">Created Date:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_createdDate"]);?>
						</div>
					</div>

					<div class="field">
						<label class="col-sm-3 label">Last updated Date:</label>
						<div class="col-sm-9 field-value">
						<?php print_r($_SESSION["user_updatedDate"]);?>
						</div>
					</div>


					<div class="field">
						<label class="col-sm-4"></label>
						<div class="col-sm-9">
							<button class="btn-thao btn-primary gradient right btn-update"
							name="update_account" id="update_account"
							onclick="openForm()">Update</button>
						</div>
					</div>
				</div>				
		
				<div id="password-form">						
					<form method="post" class="f-container">
						<h3 class="form-title">Update password</h3>
						<div class="field">
							<label class="col-sm-4 new-label">Old password:</label>
							<input type="password" name="old-password" 
							class="col-sm-8 new-input" required="required"> 						
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">New password:</label>
							<input type="password" name="new-password" 
							class="col-sm-8 new-input" required="required">						
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">Repeat new password:</label>
							<input type="password" name="repeat-new-password" 
							required="required" class="col-sm-8 new-input">						
						</div>

						<div class="field btn-grp">
							<div>
								<button class="btn-thao btn-primary gradient right btn-update"
								onclick="closePForm()">Cancel</button>
							</div>
							<div>
								<button class="btn-thao btn-primary gradient right btn-update"
								name="update_password" type="submit"
								>Save</button>
							</div>
						</div>
				
					</form>         
				</div>
				<div id="account-form">						
					<form method="post" class="f-container">
					
						<h3 class="form-title">Update account's information</h3>
						<div class="field">
							<label class="col-sm-4 new-label">Username:</label>
							<div class="col-sm-8 new-value">
							<?php print_r($_SESSION["user_username"]);?>
							</div>						
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">First name:</label>
							<input class="col-sm-8 new-value new-input" type="text"
							required="required" name="new_fname">
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">Last name:</label>
							<input class="col-sm-8 new-value new-input"  type="text"
							required="required" name="new_lname">
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">Phone number:</label>
							<input class="col-sm-8 new-value new-input" type="text"
							required="required" name="new_phone">
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">Address:</label>
							<textarea class="col-sm-8 new-value new-input" rows="3" type="text"
							required="required" name="new_address">
							</textarea>
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">Email:</label>
							<div class="col-sm-9 new-value">
								<?php print_r($_SESSION["user_email"]);?>
							</div>
						</div>

						<div class="field">
							<label class="col-sm-4 new-label">Created Date:</label>
							<div class="col-sm-8 new-value">
								<?php print_r($_SESSION["user_createdDate"]);?>
							</div>
						</div>
							
						<div class="field">
							<label class="col-sm-4 new-label">Last updated Date:</label>
							<div class="col-sm-8 new-value">
								<?php print_r($_SESSION["user_updatedDate"]);?>
							</div>
						</div>

						<div class="field btn-grp">
							<div>
								<button class="btn-thao btn-primary gradient right btn-update"
								onclick="closeForm()">Cancel</button>
							</div>
							<div>
								<button class="btn-thao btn-primary gradient right btn-update"
								name="update_account" type="submit"
								>Save</button>
							</div>
						</div>
				
					</form>         
				</div>
			</div>
		</div>
    </div>

    <div class="powered">
      <h6>
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-snapchat-ghost"></a>
        Powered by
        <i class="awe">AwesomePic</i>
      </h6>
    </div>
    <div class="footer">
      <div class="private">
        <ul class="footer-list">
          <li>
            <a href="#"><div class="footer-head-list">Get in Touch</div></a>
          </li>
          <li><a href="aboutUs.html" class="policy">About Us</a></li>
          <li><a href="contact.html" class="policy">Contact Us</a></li>
        </ul>
        <ul class="footer-list">
          <li>
            <a href="#"><div class="footer-head-list">Policy</div></a>
          </li>
          <li><a href="#" class="policy">Term of Services</a></li>
          <li><a href="#" class="policy">Private Policy</a></li>
        </ul>
      </div>
    </div>

    <button onclick="topFunction()" id="myBtn" class="hidden" title="Go to top">
      <i class="fas fa-arrow-up"></i>
    </button>
    <script src="JS/scrollToTop.js"></script>
	<script>
        function openForm() {
            document.getElementById("account-form").style.display = "block";
        }
		function closeForm() {
            document.getElementById("account-form").style.display = "none";
        }
		function openPForm(){
			document.getElementById("password-form").style.display = "block";
		}
		function closePForm() {
            document.getElementById("password-form").style.display = "none";
        }
	</script>
    <!-- end footer -->
    <script src="JS/products/search_results/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script src="https://kit.fontawesome.com/ae09c0f9d5.js" crossorigin="anonymous"></script>
    <script src="JS/ddProfile.js"></script>
    <script src="JS/sidebar.js"></script>
</body>
</html>
