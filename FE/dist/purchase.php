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
    
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <title>Purchases</title>
</head>
<body>
    <div class="container-fluid">
        <div class="overlay hidden"></div>
      <!-- sidebar -->
      <?php 
        include "_navbar.php"
      ?>
        
        <div class="landing-carts">
            <p class="page-title">Your Purchases</p>
            <div class="tab">
                <button class="tablinks btn-thao btn-primary gradient right btn-product"  onclick="openTab(event, 'all')">All</button>
                <button class="tablinks btn-thao btn-primary gradient right btn-product" onclick="openTab(event, 'bought')">Bought</button>
                <button class="tablinks btn-thao btn-primary gradient right btn-product" onclick="openTab(event, 'canceled')">Canceled</button>
            </div>
            <div id="all" class="tabcontent">
                <h3 class="status-title" style="text-align: center; font-size: 2rem; font-weight: bold;">All</h3>
                <div class="cart-header">
                    <div class="cart-prop">
                        <p class="col-sm-4 prop">Product</p>
                        <p class="col-sm-2 prop">Category</p>
                        <p class="col-sm-1 prop">Price</p>
                        <p class="col-sm-1 prop">Status</p>
                        <p class="col-sm-2 prop">More information</p>
                    </div>                
                </div>
                <?php 
                    if(isset($_SESSION['user_id'])) {
                        include 'connect.php';
                        $user = $_SESSION['user_id'];
                        $purchase = array();
                        $sqlselectorder = "SELECT * FROM orders WHERE user_id = ".$user;
                        $resultorder = mysqli_query($connection, $sqlselectorder);
                        while($row_order = mysqli_fetch_row($resultorder)) {
                            $order_id = $row_order[0];
                            $sqlselectorderdetail = "SELECT * FROM order_detail WHERE  order_id = ".$order_id;
                            $resultorderdetail = mysqli_query($connection, $sqlselectorderdetail);
                            while($row_orderdetail = mysqli_fetch_row($resultorderdetail)){
                                $product_id = $row_orderdetail[1];
                                array_push($purchase, $product_id);
                            }
                        };
                    }
                    if(isset($_SESSION['user_id'])) {
                        // Connect db and select infomation 
                        include 'connect.php';
                        $user = $_SESSION['user_id'];
                        $sqlelect = "SELECT * FROM viewed_products WHERE user_id = ".$user;
                        $result = mysqli_query($connection, $sqlelect);
                        // Loop in to row db selected
                        while ($row_select = mysqli_fetch_row($result)) {
                            $id = $row_select ['1'];
                            $sql = "SELECT * FROM products WHERE id = ".$id;
                            $array = mysqli_query($connection, $sql);
                            $row_product = mysqli_fetch_row($array);

                            $sqlcate = "SELECT * FROM products_categories WHERE product_id = ".$id;
                            $arraycate = mysqli_query($connection, $sqlcate);
                            $row_productcate = mysqli_fetch_row($arraycate);
                            $cate_id = $row_productcate[1];
                            $sqlcategory = "SELECT * FROM categories WHERE id = ".$cate_id;
                            $arraycategory= mysqli_query($connection, $sqlcategory);
                            $row_productcategory = mysqli_fetch_row($arraycategory);

                ?>
                            <!-- Print infomation of product out of desktop -->
                            <div class="item" style="text-align: center; padding: 20px 0 !important;">
                                <div class="col-sm-4 prop">
                                    <img src="<?php echo $row_product[2] ?>"
                                        alt="Image" class=" img-product "/>
                                    <p class=" img-title"><?php echo $row_product[1]; ?></p>
                                </div>
                                <div class="col-sm-2 prop">
                                    <p class="prop"><?php echo $row_productcategory[1]; ?></p>
                                </div>
                                <div class="col-sm-1 prop">
                                    <p class="prop"><?php echo $row_product[5]. $row_product[6]; ?></p>
                                </div>
                                <div class="col-sm-1 prop">
                                    <p class="prop status">
                                    <?php
                                        if (in_array($row_product[0], $purchase)) {
                                            echo "Bought";
                                        }
                                        else {
                                            echo "Cancled";
                                        }
                                    ?>
                                    </p>
                                </div>
                                <div class="col-sm-2 prop">
                                    <a class="btn-thao btn-primary buy-now-button right free-button" href="detail.php?id=<?php echo $row_product[0]; ?>">Reoder</a>
                                </div>
                            </div>
                            <br>
                            <!-- End Print infomation of product out of desktop -->
                        
                <?php
                        }
                    }
                ?>    
            </div>

            <div id="bought" class="tabcontent" style="display: none;">
                <h3 class="status-title" style="text-align: center; font-size: 2rem; font-weight: bold;">Bought</h3>
                <div class="cart-header">
                    <div class="cart-prop">
                        <p class="col-sm-4 prop">Product</p>
                        <p class="col-sm-2 prop">Category</p>
                        <p class="col-sm-1 prop">Price</p>
                        <p class="col-sm-1 prop">Status</p>
                        <p class="col-sm-2 prop">More information</p>
                    </div>                
                </div>
                <?php 
                    if(isset($_SESSION['user_id'])) {
                        include 'connect.php';
                        $user = $_SESSION['user_id'];
                        $sqlelect = "SELECT * FROM viewed_products WHERE user_id = ".$user;
                        $result = mysqli_query($connection, $sqlelect);

                        while ($row_select = mysqli_fetch_row($result)) {
                            $id = $row_select ['1'];
                            $sql = "SELECT * FROM products WHERE id = ".$id;
                            $array = mysqli_query($connection, $sql);
                            $row_product = mysqli_fetch_row($array);

                            $sqlcate = "SELECT * FROM products_categories WHERE product_id = ".$id;
                            $arraycate = mysqli_query($connection, $sqlcate);
                            $row_productcate = mysqli_fetch_row($arraycate);
                            $cate_id = $row_productcate[1];
                            $sqlcategory = "SELECT * FROM categories WHERE id = ".$cate_id;
                            $arraycategory= mysqli_query($connection, $sqlcategory);
                            $row_productcategory = mysqli_fetch_row($arraycategory);

                            if (in_array($row_product[0], $purchase)) {
                ?>
                                <div class="item" style="text-align: center; padding: 20px 0 !important;">
                                    <div class="col-sm-4 prop">
                                        <img src="<?php echo $row_product[2]; ?>"
                                            alt="Image" class=" img-product "/>
                                        <p class=" img-title"><?php echo $row_product[1]; ?></p>
                                    </div>
                                    <div class="col-sm-2 prop">
                                        <p class="prop"><?php echo $row_productcategory[1]; ?></p>
                                    </div>
                                    <div class="col-sm-1 prop">
                                        <p class="prop"><?php echo $row_product[5]. $row_product[6]; ?></p>
                                    </div>
                                    <div class="col-sm-1 prop">
                                        <p class="prop status">
                                            Bought
                                        </p>
                                    </div>
                                    <div class="col-sm-2 prop">
                                        <a class="btn-thao btn-primary buy-now-button right free-button" href="detail.php?id=<?php echo $row_product[0]; ?>">Reoder</a>
                                    </div>
                                </div>
                                <br>     
                <?php
                            }
                        }
                    }
                ?>    
            </div>

            
            <div id="canceled" class="tabcontent" style="display: none;">
                <h3 class="status-title" style="text-align: center; font-size: 2rem; font-weight: bold;">Canceled</h3>
                <div class="cart-header">
                    <div class="cart-prop">
                        <p class="col-sm-4 prop">Product</p>
                        <p class="col-sm-2 prop">Category</p>
                        <p class="col-sm-1 prop">Price</p>
                        <p class="col-sm-1 prop">Status</p>
                        <p class="col-sm-2 prop">More information</p>
                    </div>                
                </div>
                <?php 
                    if(isset($_SESSION['user_id'])) {
                        include 'connect.php';
                        $user = $_SESSION['user_id'];
                        $sqlelect = "SELECT * FROM viewed_products WHERE user_id = ".$user;
                        $result = mysqli_query($connection, $sqlelect);

                        while ($row_select = mysqli_fetch_row($result)) {
                            $id = $row_select ['1'];
                            $sql = "SELECT * FROM products WHERE id = ".$id;
                            $array = mysqli_query($connection, $sql);
                            $row_product = mysqli_fetch_row($array);

                            $sqlcate = "SELECT * FROM products_categories WHERE product_id = ".$id;
                            $arraycate = mysqli_query($connection, $sqlcate);
                            $row_productcate = mysqli_fetch_row($arraycate);
                            $cate_id = $row_productcate[1];
                            $sqlcategory = "SELECT * FROM categories WHERE id = ".$cate_id;
                            $arraycategory= mysqli_query($connection, $sqlcategory);
                            $row_productcategory = mysqli_fetch_row($arraycategory);


                            if (!in_array($row_product[0], $purchase)) {
                ?>
                                <div class="item" style="text-align: center; padding: 20px 0 !important;">
                                    <div class="col-sm-4 prop">
                                        <img src="<?php echo $row_product[2]; ?>"
                                            alt="Image" class=" img-product "/>
                                        <p class=" img-title"><?php echo $row_product[1]; ?></p>
                                    </div>
                                    <div class="col-sm-2 prop">
                                        <p class="prop"><?php echo $row_productcategory[1]; ?></p>
                                    </div>
                                    <div class="col-sm-1 prop">
                                        <p class="prop"><?php echo $row_product[5]. $row_product[6]; ?></p>
                                    </div>
                                    <div class="col-sm-1 prop">
                                        <p class="prop status">
                                            Canceled
                                        </p>
                                    </div>
                                    <div class="col-sm-2 prop">
                                        <a class="btn-thao btn-primary buy-now-button right free-button" href="detail.php?id=<?php echo $row_product[0]; ?>">Reoder</a>
                                    </div>
                                </div>
                                <br>    
                <?php
                            }
                        }
                    }
                ?>    
            </div>


        
    </div>
    <br><br>
    <div class="powered">
      <h6>
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-instagram"></a>
        <a href="#" class="fa fa-snapchat-ghost"></a>
        Powered by
        <a href="index.php" class="awe">AwesomePic</a>
      </h6>
    </div>
    <div class="footer">
      <div class="private">
        <ul class="footer-list">
          <li>
            <div class="footer-head-list">Get in Touch</div>
          </li>
          <li>
            <a href="aboutUs.php" class="policy">About Us</a>
          </li>
          <li>
            <a href="contact.php" class="policy">Contact Us</a>
          </li>
        </ul>
        <ul class="footer-list">
          <li>
            <div class="footer-head-list">Policy</div>
          </li>
          <li>
            <a href="#" class="policy">Term of Services</a>
          </li>
          <li>
            <a href="#" class="policy">Private Policy</a>
          </li>
        </ul>
      </div>
    </div>

    <script>
        function openTab(evt, type) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(type).style.display = "block";
          evt.currentTarget.className += " active";
        }
    </script>
    <button onclick="topFunction()" id="myBtn" class="hidden" title="Go to top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <script src="JS/ddProfile.js"></script>
    <script src="JS/scrollToTop.js"></script>
    <script src="JS/sidebar.js"></script>
</body>
</html>