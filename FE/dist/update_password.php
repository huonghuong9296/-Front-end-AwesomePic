<?php 
  ob_start();
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" type="text/css" href="css/style.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/_navbar.css">
    <title>Change Password</title>
    <style>
        .change-password{
        font-size: 2rem;
        /* font-weight: bold; */
        margin-left: 50px;
        margin-top: 20px;
        background: linear-gradient(to right, #5366ab 0%, rgb(236, 21, 182) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }   
      .btn-update{
        margin-right: 20px;
        display: flex;
        align-items: center;
        text-transform: uppercase;
        font-weight: bold;
        float: right;
        border-radius: 0.1rem !important;
      }
    </style>
</head>
<body>
<div class="overlay hidden"></div>
    <?php 
        include "_navbar.php"
    ?>
    <div class="container">
        <div class="account-layout">
            <div class="account-inner">
                <form method="post">

                    <p class="change-password">Change Password</p>

                    <div class="form-account-control">
                    <label class="input-label">Old password:</label>
                    <div>
                        <input type="password" required="" name="oldPassword" placeholder="Nhập mật khẩu cũ" value="">
                    </div>
                    </div>

                    <div class="form-account-control">
                    <label class="input-label">New Password:</label>
                    <div>
                        <input type="password" required="" name="newPassword" placeholder="Mật khẩu từ 6 đến 32 ký tự" value="">
                    </div>
                    </div>

                    <div class="form-account-control">
                    <label class="input-label">Confirm new password:</label>
                    <div>
                        <input type="password" required="" name="confirmPassword" placeholder="Nhập lại mật khẩu mới" value="">
                    </div>
                    </div>

                    <div class="form-account-control">
                    <label class="input-label"></label>
                    <a class="btn-thao btn-primary gradient right btn-update update_password" 
                    type="submit" href="update_password.php">Update</a>
                    </div>          

                </form>
            </div>
        </div>
    </div>
    <script src="JS/ddProfile.js"></script>
    <script src="JS/sidebar.js"></script>
</body>
</html>