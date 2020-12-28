<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="stylesheet" href="css/style.min.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" type="text/css" href="css/products/animate.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Sign up to AwesomePic</title>
  </head>
  <body>
    <div class="sign-wrapper animated fadeInDown ease">
      <div class="signup-form">
        <form method="post">
          <div style="text-align: center">
            <a href="index.php" class="awe" style="color: #ad24ce !important"
              >AwesomePic</a
            >
          </div>
          <h2>Create an Account</h2>
          <p class="hint-text">
            Sign up with your social media account or email address
          </p>
          <div class="social-btn text-center">
            <a href="#" class="btn btn-signup btn-primary btn-md"
              ><i class="fa fa-facebook"></i> Facebook</a
            >
            <a href="#" class="btn btn-signup btn-info btn-md"
              ><i class="fa fa-twitter"></i> Twitter</a
            >
            <a href="#" class="btn btn-signup btn-danger btn-md"
              ><i class="fa fa-google"></i> Google</a
            >
          </div>
          <div class="or-seperator"><b>or</b></div>
          <div class="form-group">
          <input
              type="email" class="form-control" name="email"
              placeholder="Email Address" required="required"/>
          </div>
          <div class="form-group">
            <input
              type="text" class="form-control input-md" name="username"
              placeholder="Username" required="required"
            />
          </div>
          <div class="form-group" style="display:flex">
            <div class="col-sm-6" style="padding: 0 4px 0 0">
              <input
                type="text" class="form-control input-md" name="firstname"
                placeholder="First Name" required="required"
              />
            </div>
            <div class="col-sm-6" style="padding: 0 0 0 4px">
              <input
                type="text" class="form-control input-md" name="lastname"
                placeholder="Last Name" required="required"
              />
            </div>
            
          </div>
          
          <div class="form-group">
            <input
              type="password" class="form-control" name="password"
              placeholder="Password" required="required" />
          </div>
          <div class="form-group">
            <input
              type="password" class="form-control" name="confirm_password"
              placeholder="Confirm Password" required="required"
            />
          </div>
          <div class="form-group">
            <button type="submit" name="signUp"
              class="btn btn-signup btn-success btn-lg btn-block signup-btn">
              Sign Up
            </button>
          </div>
          <div class="text-center">
            Already have an account? <a href="login.php">Sign In</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
<?php
  include 'connect.php';
	
  	if(isset($_POST["signUp"])){
      $email = $_POST['email'];
      $username = $_POST['username'];
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $password = $_POST['password'];		
      $confirm_password = $_POST['confirm_password'];	
      // echo $email .$username .$firstname . $lastname . $password;
      if($password != $confirm_password){
        $m = "Confirm password is not match!";
        echo "<script type='text/javascript'>alert('$m');</script>";
      }
      else{
        $sql = "SELECT * FROM users WHERE email = '$email' ";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);      
        $count = mysqli_num_rows($result);
        $msg = $count;
        // If result matched $email and $password, table row must be 1 row
        if($count == 0) {
          $signUpSql = "INSERT INTO users(email, username, firstname, lastname, password)
                VALUES('$email', '$username', '$firstname', '$lastname', AES_ENCRYPT('$password', 'secret'))";
          $rs = mysqli_query($connection, $signUpSql);
          header("location:login.php");
          $msg = "Regist new account successfully!";
        }else {
          $msg = "This email is existing. Try again!";
        }
        // echo $count;
        echo "<script type='text/javascript'>alert('$msg');</script>";
		}
	}
?>