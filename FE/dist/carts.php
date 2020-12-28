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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Carts</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        .cart-header{
            height: 60px;
            margin-top: 70px;
            /* background-color: whitesmoke;
            border-top: 1px solid rgba(153, 99, 99, 0.1); */
            display: flex;
            /* justify-content: center; */
            align-items: center;    
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
        }
        .item{
            display: flex;
            height: 300px;
            padding: 20px;
            margin-bottom: 20px;
            border-top: 1px solid rgba(153, 99, 99, 0.3);
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
        .fa-trash{
            color: red;
            border: none;
            outline:none;
        }
        .fa-trash:hover{
            transform: scale(1.5);
        }
        .form-popup {
            display: none;
            position: fixed;
            /* border: 3px solid #f1f1f1;
            margin: auto;
            position: absolute; */
            margin: auto;
            top: 40%;
            left: calc(50% - 150px);
            box-shadow: 2px 2px 5px 0 rgba(1, 1, 1, 0.2), -2px -2px 5px 0 rgba(1, 1, 1, 0.2);
            /* border: 3px solid #f1f1f1; */
            color: white;
            /* z-index: 9; */
        }           
        .form-container {
            display: inline-block;
            width: 300px;
            padding: 30px;
            background-color: rgb(0 , 0, 0, 0.7);           
            text-align: center;
        }
        .quantity, .q-increase, .q-decrease{
            border: 1px solid #ced4da;
            width: 30px;
            background-color: transparent;
        }
        .q-decrease{
            border-right: none;            
        }
        .q-increase{
            border-left: none;
        }
        .cart-footer{
            height: 100px;
            margin: 30px 0 50px 0;
            border-top: 1px solid rgba(0,0,0,0.25);
        }
        .landing-carts{
            width: 70%;
            margin: auto;
            background-color: white;
        }
        @media only screen and (min-width: 768px) and (max-width: 1024px){
            .cart-prop{
                font-size: 16px;
            }
            .landing-carts{
                
                width: 90%;
            }
            .item{
                height: 250px;
            }
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
    <?php include ('connect.php') ?>
    <!-- menu -->
    <?php include ('_navbar.php') ?>
    <!-- end menu -->
    <div class="container-fluid" id="listCart" style="padding-top:50px !important;">
        <div class="landing-carts" id="refresh">
            <div class="cart-header">
                <div class="cart-prop">
                    <p class="col-sm-6 prop">Product</p>
                    <p class="col-sm-2 prop">Category</p>
                    <p class="col-sm-1 prop">Price</p>
                    <p class="col-sm-1 prop">Quantity</p>
                    <p class="col-sm-1 prop">Amount</p>
                    <p class="col-sm-1 prop">Delete</p>
                </div>                
            </div>
            <?php
                if(isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $key => $value) {
                        $sqlDetail = "SELECT * FROM products WHERE id = ".$key;
                        $resultRow = mysqli_query($connection, $sqlDetail);
                        $row = mysqli_fetch_row($resultRow);
            ?>
                        <div class="item">
                            <div class="col-sm-6 product">
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
                            <div class="col-sm-1 prop-wrapper">
                                <p class="prop"><?php echo $row[5]. $value['currency'];  ?></p>
                            </div>
                            <div class="col-sm-1 prop-wrapper">
                                <input class="q-decrease minus is-form" type="button" value="-" onclick="minus(<?php echo $key; ?>)">
                                <input class="prop quantity input-qty" type="text" id="quantity_<?php echo $key; ?>" min="1" max="99" onchange="updateCart(<?php echo $key; ?>)"
                                name="quantity_<?php echo $key; ?>" type="number" value="<?php echo $value['num']; ?>">
                                <input class="q-increase plus is-form" type="button" value="+" onclick="plus(<?php echo $key; ?>)">
                            </div>
                            <div class="col-sm-1 prop-wrapper">
                                <p class="prop"><?php echo $total = ($row[5] * $value['num']). $value['currency']; ?></p>
                            </div>
                            <div class="col-sm-1 prop-wrapper">
                                <button onclick="open_delete_Form(<?php echo $key ?>)" class="fas fa-trash prop"></button>
                            </div>
                        </div>
            <?php   }
                }
                else {
                    echo "Shopping cart with no products. Please do it again.";
                } ?>
            
            <div class="cart-footer">
            <?php
                if(isset($_SESSION["cart"])) {
            ?>                
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
                            <!-- print total price and currency-->
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
                    </div>
            <?php
                }        
            ?>
                <br><br><br>
                <?php
                    if (isset($_SESSION['user_id'])) {
                        $user = $_SESSION['user_id'];
                    };
                ?>
                <form action="checkout.php?id=<?php echo $user; ?>" method="post">
                    <button type="submit" name="addtoCart" class="btn-thao btn-primary gradient right btn-checkout">Go to check out</button>
                </form>

            </div>    
        </div>


        <div class="form-popup" id="deleteForm">
            <form action="" class="form-container">
                <h6>Are you sure to delete this item?</h6>

                <button type="submit" class="btn btn-danger" id="deletecart" 
                onclick="trunggian()">Continue</button>
                <button type="button" class="btn btn-warning cancel" onclick="close_delete_Form()">Cancel</button>
            </form>
        </div>

    </div>
    <!-- footer -->
    <?php include('footer.php') ?>
    <!-- end footer -->
    <script>
        function open_delete_Form(id) {
            $id = id;
            document.getElementById("deleteForm").style.display = "block";
            $("#deletecart").click(trungian($id));
        }
        
        function close_delete_Form() {
            document.getElementById("deleteForm").style.display = "none";
        }
        function trunggian(id) {
            deleteCart($id);
            $( "#listCart" ).load( "http://localhost/Assigment/FE/dist/carts.php #refresh" );
        }

        //
        function minus(id) {
            num = $("#quantity_" + id).val();
            num -= 1;
            $.post('./updateCart.php',{'id': id, 'num': num}, function(data) {
                $("#listCart").load("http://localhost/Assigment/FE/dist/carts.php #refresh");
            })
        }

        function plus(id) {
            num = parseInt($("#quantity_" + id).val());
            num++;
            $.post('./updateCart.php',{'id': id, 'num': num}, function(data) {
                $("#listCart").load("http://localhost/Assigment/FE/dist/carts.php #refresh");
            })
        }
    </script>
    <script>
        // UpdateCart
        function updateCart(id) {
            num = $("#quantity_" + id).val();
            $.post('./updateCart.php',{'id': id, 'num': num}, function(data) {
                $( "#listCart" ).load( "http://localhost/Assigment/FE/dist/carts.php #refresh" );
            })
        }
        // DeleteCart
        function deleteCart(id) {
            $.post('./updateCart.php',{'id': id, 'num': 0}, function(data) {
                $( "#listCart" ).load( "http://localhost/Assigment/FE/dist/carts.php #refresh" );
            })
        }
    </script>
    <script src="JS/ddProfile.js"></script>
    <script src="JS/scrollToTop.js"></script>
    <script src="JS/sidebar.js"></script>
</body>
</html>