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
    <title>Sign In to AwesomePic</title>
  </head>
  <body>
    <div class="login-wrapper animated fadeInLeft">
      <div class="signup-form">
        <form method="POST">
          <div style="text-align: center">
            <a href="index.php" class="awe" style="color: #ad24ce !important"
              >AwesomePic</a
            >
          </div>
          <h2>Sign In</h2>
          <p class="hint-text">
            Sign In with your social media account or email address
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

          <div class="form-group" >
            <input
              type="text"
              class="form-control"
              name="username_email"
              placeholder="Email or username"
              required="required"
            />
          </div>
          <div class="form-group" >
            <input
              type="password"
              class="form-control"
              name="password"
              placeholder="Password"
              required="required"
            />
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="login_role" id="login_user" value="user" checked>
            <label class="form-check-label" for="login_user">
              User
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="login_role" id="login_admin" value="admin">
            <label class="form-check-label" for="login_admin">
              Admin
            </label>
          </div>
          </br>
          <div class="form-group"> 
            <button
              type="submit" id="signIn" name="signin" id="signIn"
              class="btn btn-signup btn-success btn-lg btn-block signup-btn"
            >
              Sign In
            </button>
          </div>
          <div class="text-center">
            Create an account? <a href="signUp.php">Sign Up</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
<?php 
   
    include 'connect.php';
   
    // Initialize the session
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $username_email = $_POST["username_email"];
      $password       = $_POST["password"];
      $login_role     = $_POST["login_role"];		

      if(!isset($_POST["login_role"])) {
        echo "<script>alert('Please choose your login role!');</script>";
      }
      else if($_POST["login_role"] == "user") {
        $sql = "SELECT id, username, email, AES_DECRYPT(password, 'secret') password, 
                firstname, lastname, phone, address, created_date, updated_date, is_deleted
                FROM users WHERE   (email      = '$username_email' 
                                    AND     password    = AES_ENCRYPT('$password', 'secret')
                                    AND     is_deleted  = '0')
                                    OR      (username   = '$username_email' 
                                    AND     password    = AES_ENCRYPT('$password', 'secret')
                                    AND     is_deleted  = '0')
                                    ";
      }
      else if($_POST["login_role"] == "admin") {
        $sql = "SELECT * FROM admins WHERE   (email      = '$username_email' 
                                    AND     password    = AES_ENCRYPT('$password', 'secret')
                                    AND     is_deleted  = '0')
                                    OR      (username   = '$username_email' 
                                    AND     password    = AES_ENCRYPT('$password', 'secret')
                                    AND     is_deleted  = '0')
                                    ";
      }

      $result = mysqli_query($connection, $sql);
      if (!$result) {
        echo "<script>alert('error!');</script>";
      }
      $row    = mysqli_fetch_array($result);      
      $count  = mysqli_num_rows($result);
      echo $count;
     
      // If result matched $email and $password, table row must be 1 row
      if($count == 1) {
        if ($_POST["login_role"] == "user") {
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['user_email'] = $row['email'];  
          $_SESSION['user_password'] = $row['password'];  
          $_SESSION['user_username'] = $row['username'];
          $_SESSION['user_firstname'] = $row['firstname'];
          $_SESSION['user_lastname'] = $row['lastname'];
          $_SESSION['user_phone'] = $row['phone'];
          $_SESSION['user_address'] = $row['address'];
          $_SESSION['user_createdDate'] = $row['created_date']; 
          $_SESSION['user_updatedDate'] = $row['updated_date']; 
          $_SESSION['user_isDeleted'] = $row['is_deleted'];
          // print_r($_SESSION);
          header("location:account.php");
        }
        else if ($_POST["login_role"] == "admin") {
          $_SESSION['admin_id'] = $row['id'];
          $_SESSION['admin_email'] = $row['email'];  
          $_SESSION['admin_username'] = $row['username'];

          header("location:admin/view/dashboard.php");
        }
        // print_r($_SESSION);
      }else {
        $msg = "Your Login Email or Password is invalid!";
        echo "<script type='text/javascript'>alert('$msg');</script>";
      }
    }
?>