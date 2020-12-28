<?php
    ob_start();
    session_start();
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/OAuth.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"></script>
	<title>Check Out</title>
    <style>
		*{
			margin: 0;
			padding: 0;
		}
		.huong-landing{            
            width: 70%;
            margin: auto;
            margin-top: 80px;
            background-color: white;
        }
		@media only screen and (min-width: 768px) and (max-width: 1024px){
            .cart-prop{
                font-size: 16px;
            }
            .huong-landing{
                
                width: 100%;
            }
            .item{
                height: 250px;
            }
        }
		.page-title{
            font-size: 2.5rem;
            font-weight: bold;
            margin-left: 50px;
            background: linear-gradient(to right, #5366ab 0%, rgb(236, 21, 182) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
		.address{
            overflow: hidden;
            background-color: #1c2648d9;
			color: #ffc107;
			padding: 10px;
			
		}
		.address-title{
			margin-bottom: 0 !important;
			font-weight: 500;
			font-size: larger;
		}
		.address-detail{
			overflow: hidden;
            background-color: #1c2648d9;
			color: white;
			display: flex;
			padding: 10px;
			border-top: 1px solid #ffc107;
			border-bottom: 1px solid #ccc;
		}
		.change{
			color: #f3ecd9;
			text-align: center;
		}
		.cart-header{
            height: 60px;
            margin-top: 20px;
            display: flex;
            align-items: center;    
			border-bottom: 1px solid rgba(153, 99, 99, 0.3);
			border-top: 1px solid rgba(153, 99, 99, 0.3);
        }
        .cart-prop{
            display: flex;
            align-items: center;
            opacity: 0.8; 
            font-size: 18px;
            margin: auto;
            width: 100%;
            text-align: center;
            font-weight: bold;
        }
        .prop-wrapper{
            display: flex;
            align-items: center;    
            text-align: center;
            margin: auto;
        }
        .prop{
            margin: auto;
			text-align: center;
        }
        .item{
            display: flex;
            height: fit-content;
            padding: 20px;
            border-bottom: 1px solid rgba(153, 99, 99, 0.3);
        }
        .product{
            width: 90%; 
        }
        .img-product{
            max-width: 100%;
            max-height: 85%;
            width: auto;
            height: auto;
            display: flex;
            margin: auto;
        }
        .img-title{
            /* margin: auto; */
            text-align: center;
            margin-top: 10px;
        }
		.payment-info{
			text-align: center;
			/* padding: 50px; */
		}
		.qrcode{
			height: 250px;
			width: 250px;
			margin-bottom: 20px;
		}
		.total{            
            display: flex;               
            float: right;
            margin-top: 20px;
            margin-right: 20px;
        }
        .ptotal{
            margin: 8px 10px;
        }
        .total-price{
            color: red;
            font-size: 24px;
        }
		.btn-checkout{
			height: 30px;
            margin-right: 20px;
            display: flex;
            align-items: center;
            text-transform: uppercase;
            font-weight: bold;
            float: right;
			color: white !important;
            border-radius: 0.1rem !important;
        }
		.form-popup {
            display: none;
            position: fixed;
            /* border: 3px solid #f1f1f1;
            margin: auto;  */
            /* position: absolute; */
            margin: auto;
            top: calc(50% - 200px);
            left: calc(50% - 200px);
            box-shadow: 2px 2px 5px 0 rgba(1, 1, 1, 0.2), -2px -2px 5px 0 rgba(1, 1, 1, 0.2);
            /* border: 3px solid #f1f1f1; */
            color: white;
            z-index: 9;
        }           
        .form-container {
            display: block;
            width: 400px;
            padding: 30px;
            background-color: rgb(0 , 0, 0, 0.7);           
            text-align: center;
        }
	</style>

</head>
<body>
    
    <?php
        include ('connect.php');
        if(isset($_GET["id"])) {
            $user_id = $_GET["id"];
            $sql = "SELECT * FROM users WHERE id = ".$user_id;
            $result = mysqli_query($connection, $sql);
            $user_row = mysqli_fetch_row($result);
        }
    ?>

    <!-- menu -->
    <?php include ('_navbar.php'); ?>
    <!-- end menu -->
    <div class="container-fluid">		
		<div class="huong-landing">
			<p class="page-title">Payment</p>
			<div class="address">
				<p class="address-title">
					<i class="fas fa-map-marker-alt"></i>
				Delivery Address</p>
			</div>
			<div class="address-detail">

				<div class="col-sm-3">
                    Name:
                    <?php echo $user_row[4]. " ". $user_row[5]; ?> <br>
                    Phone: +(84) <?php echo $user_row[6]; ?> </div>
				<div class="col-sm-7">
                    Address: <?php echo $user_row[7]. ", ". $user_row[8]. ", ". $user_row[9]; ?> <br>
                    Email: <?php echo $user_row[2]; ?>
				</div>
				<a href="#" class="col-sm-2 change">
					<i class="fa fa-refresh"></i>
					Change</a>
			</div>

			<div class="info">
				
			</div>
            <?php
                if(isset($_SESSION["cart"])) {
            ?>
                    <div class="cart-header">
                        <div class="cart-prop">
                            <p class="col-sm-4 prop">Product</p>
                            <p class="col-sm-2 prop">Category</p>
                            <p class="col-sm-2 prop">Price</p>
                            <p class="col-sm-2 prop">Quantity</p>
                            <p class="col-sm-2 prop">Amount</p>                    
                        </div>                
                    </div>
            <?php
                }
            ?>
            
            <?php
                if(isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $key => $value) {
                        $sqlDetail = "SELECT * FROM products WHERE id = ".$key;
                        $resultRow = mysqli_query($connection, $sqlDetail);
                        $row = mysqli_fetch_row($resultRow);
            ?>
                        <div class="item">
                            <div class="col-sm-4 product">
                                <img src="<?php echo $value['image']; ?>"
                                    alt="Image" class=" img-product "/>
                                <p class=" img-title"><?php echo $value['name']; ?></p>
                            </div>
                            <div class="col-sm-2 prop-wrapper">
                                <p class="prop">
                                    <?php 
                                        include('connect.php');
                                        $category = $value['category'];
                                        $sqlcategories = "SELECT * FROM categories WHERE id = ".$category;
                                        $resultcategories = mysqli_query($connection, $sqlcategories);
                                        $row_cate = mysqli_fetch_row($resultcategories);
                                        echo $category = $row_cate[1];
                                    ?>
                                </p>
                            </div>
                            <div class="col-sm-2 prop-wrapper">
                                <p class="prop"><?php echo $row[5]. $value['currency'];  ?></p>
                            </div>
                            <div class="col-sm-2 prop-wrapper">
                                <p class="prop quantity"><?php echo $value['num']; ?></p>                   
                            </div>
                            <div class="col-sm-2 prop-wrapper">
                                <p class="prop"><?php echo $total = ($row[5] * $value['num']). $value['currency']; ?></p>
                            </div>                
                        </div>
            <?php   };
                };
            ?>
			<div class="payment-info">
            <?php
                if(isset($_SESSION["cart"])) {
            ?>
                    <div class="cart-footer">
                        <div class="total">                    
                            <p class="ptotal">Total Price(
                                <?php
                                $totalproduct = 0;
                                    foreach ($_SESSION["cart"] as $key => $value) {
                                        if ($value['num'] != 0) {
                                            $totalproduct += $value['num'];
                                        }
                                    }
                                    echo $totalproduct;
                                ?>
                                Products):
                            </p>
                            <p class="total-price">
                                <?php
                                $totalprice = 0;
                                foreach ($_SESSION["cart"] as $key => $value) {
                                    $sqlDetail = "SELECT * FROM products WHERE id = ".$key;
                                    $resultRow = mysqli_query($connection, $sqlDetail);
                                    $row = mysqli_fetch_row($resultRow);
                                    if ($value['num'] != 0) {
                                        $totalprice += ($value['num'] * $row[5]);
                                    }
                                }
                                echo $totalprice;
                                if ($totalprice != 0){
                                    echo $value['currency'];
                                }  
                            ?>
                            </p> 
                            <button onclick="open_checkout_Form()" class="btn-thao btn-prima/ry gradient right btn-checkout">Pay</button>
                                        
                        </div>
                        <br><br><br><br>
                        
                    </div>
            <?php
                }
            ?>
            				
			</div>
        </div>
        <!-- Insert to database to carts cart_detail -->
        <?php
            if(isset($_POST["addtoCart"])) {
                include ('function.php');
                $total_price = 0;
                $total_quantity = 0;
                $_POST["user_id"] = $_SESSION['user_id'];
                if(isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $key => $value) {
                        $sqlDetail = "SELECT * FROM products WHERE id = ".$key;
                        $resultRow = mysqli_query($connection, $sqlDetail);
                        $row = mysqli_fetch_row($resultRow);

                        $total_price += (int)$value["num"]*(int)$row[5];
                        $total_quantity += $value["num"];
                    }
                    $_POST["total_price"] = $total_price;
                    $_POST["total_quantity"] = $total_quantity;
                    $table = "carts";
                    $id = addtoCart($table, $_POST);

                    foreach ($_SESSION["cart"] as $key => $value) {
                        $quantity = $value["num"];
                        $sqlDetail = "INSERT INTO cart_detail (cart_id, product_id, quantity)";
                        $sqlDetail .= " VALUES('$id', '$key', '$quantity')";
                        mysqli_query ($connection, $sqlDetail);
                    }
                }  
            }
        ?>
        <!-- End Insert to database to carts cart_detail -->
        <!-- Insert to database to orders orderdetail -->
        <?php
            if(isset($_POST["addNew"])) {
                include ('function.php');
                $total_price = 0;
                $total_quantity = 0;
                $curentDate = date("Y-m-d H:i:s");
                $_POST["user_id"] = $_GET["id"];
                $_POST["is_paid"] = 1;
                $_POST["currency"] = $value["currency"];
                $_POST["created_date"] = $curentDate;
                foreach ($_SESSION["cart"] as $key => $value) {
                    $sqlDetail = "SELECT * FROM products WHERE id = ".$key;
                    $resultRow = mysqli_query($connection, $sqlDetail);
                    $row = mysqli_fetch_row($resultRow);

                    
                    $total_price += (int)$value["num"]*(int)$row[5];
                    $total_quantity += $value["num"];
                }
                $_POST["total_price"] = $total_price;
                $_POST["total_quantity"] = $total_quantity;
                $table = "orders";
                $id = addNew($table, $_POST);
        
                foreach ($_SESSION["cart"] as $key => $value) {
                    $sqlDetail = "SELECT * FROM products WHERE id = ".$key;
                    $resultRow = mysqli_query($connection, $sqlDetail);
                    $row = mysqli_fetch_row($resultRow);

                    $total_price = $row[5] * $value["num"];
                    $quantity = $value["num"];
                    $price = $row[5];
                    $sqlOrderDetail = "INSERT INTO order_detail (order_id, product_id, total_price, quantity, price)";
                    $sqlOrderDetail .= " VALUES('$id', '$key', '$total_price', '$quantity', $price)";
                    mysqli_query ($connection, $sqlOrderDetail);
                }
                // sent email for customer

                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail -> charSet = "UTF-8";
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.mail.yahoo.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'awesompictest@yahoo.com';                     // SMTP username
                    $mail->Password   = 'vjjslwqazpijqhuy';                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $user_email = $user_row[2];
                    $user_name = $user_row[4]. " ". $user_row[5];
                    $mail->setFrom('awesompictest@yahoo.com', 'Your Purchase');
                    $mail->addAddress($user_email, $user_name);     // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $link = $value['image'];
                    $mail->Subject = 'Detail order from AwesomPic';
                    $mail->Body    = 'This is the link to download the picture you bought from AwesomPic: ' . $link . '<br> Thank for your purchase';

                    $mail->send();
                    $message = "Link download your product has been sent. Please check your Email";
                    echo "<script type='text/javascript'>open_checkout_Form()</script>";
                    unset($_SESSION['cart']);
                    header("location:products.php");

                } catch (Exception $e) {
                    // header("location:products.php");
                    // unset($_SESSION['cart']);
                    // $message = "Link download your product has been sent. Please check your Email";
                    // echo "<script type='text/javascript'>alert('$message');</script>";
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

                }

                // close sent email for customer
            }
            // if ($mail->send()) {
            //     unset($_SESSION['cart']);
            //     header("location:products.php");
            // }
            
        ?>
         <!-- Close Insert to database order, order_detail -->
		<div class="form-popup" id="check_out_Form">
            <form action="" class="form-container" method="POST">
                <p>Please scan this code to purchase the order</p>
				<img src="img/qrcode.png" alt="Payment code"
				class="qrcode">          
                <button type="submit" name="addNew" class="btn btn-danger">Continue</button>
                <button type="button" class="btn btn-warning cancel" onclick="close_checkout_Form()">Cancel</button>
            </form>
        </div>

    </div>
    
    <!-- footer -->
    <?php include ('footer.php'); ?>
    <!-- end footer -->
    <script>
        function open_checkout_Form() {
            document.getElementById("check_out_Form").style.display = "block";
        }
        
        function close_checkout_Form() {
            document.getElementById("check_out_Form").style.display = "none";
        }
    </script>
	
    <script src="JS/scrollToTop.js"></script>
    <script src="JS/sidebar.js"></script>
    <script src="JS/ddProfile.js"></script>    
</body>
</html>