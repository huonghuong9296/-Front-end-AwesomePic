<?php
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Page</title>
    <link
      rel="stylesheet"
      type="text/css"
      href="css/products/detail-style.css"
    />
    <link rel="stylesheet" type="text/css" href="css/style.min.css" />
    <link rel="stylesheet" type="text/css" href="css/products/products.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <!-- menu -->
    <?php include ('_navbar.php') ?>
    <!-- end menu -->
    <!-- Search form -->
    <?php include ('searchform.php') ?>
    <!-- end search form -->
    <!-- PHP -->
    <?php
      include ('connect.php');
      // Check get id
      if(isset($_GET["id"])) {
        $id = $_GET["id"];
        // Select from db
        $sqlDetail = "SELECT * FROM products WHERE id = ".$id;
        $resultRow = mysqli_query($connection, $sqlDetail);
        $row = mysqli_fetch_row($resultRow);
        // Check user ID
        if (isset($_SESSION['user_id'])) {
          $user = $_SESSION['user_id'];
          $curentDate = date("Y-m-d H:i:s");

          $sqlselect = "SELECT * 
          FROM ". "viewed_products 
          WHERE product_id = ". $id.
          " AND user_id =". $user;

          $resultselect = mysqli_query($connection, $sqlselect);
          $resultrow = mysqli_fetch_row($resultselect);
          $count = mysqli_num_rows($resultselect);
          if ($count == 0) {
            // Insert to viewed product when people click to view product in product page
            $sqlInsert = "INSERT INTO viewed_products(product_id, user_id, created_date) VALUES ('$id', '$user', '$curentDate')";
            mysqli_query($connection, $sqlInsert);
          } 
        }
      }
    ?>
    <!-- PHP -->
    <!-- container -->
    <div class="container">
      <!-- Detail -->
      <div id="detail-image pading-bottom-0">
        <h1 class="aboutus-title pricing-title">Detail Image</h1>
        <div class="detail-img">
          <div class="row tm-mb-90 margin-top-bot-0">
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
              <img
                src="<?php echo $row[2]; ?>"
                alt="Image"
                class="img-fluid"
              />
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
              <div class="detail-image-info">
                <p class="sub-content detail-image-txt1">
                  Please support us by making
                  <a href="pricing.html" target="_parent" rel="sponsored"
                    >a Pay donation</a
                  >. Nam ex nibh, efficitur eget libero ut, placerat aliquet
                  justo. Cras nec varius leo.
                </p>
                <div class="detail-image-txt2">
                  <div class="mr-4 mb-2">
                    <p class="sub-content detail-image-txt2">
                      <span class="tm-text-gray-dark">Dimension: </span>
                      <select name="demension" class="op-download-img">
                        <option class="select-option" value="">
                          4096×2160
                        </option>
                        <option class="select-option" value="">
                          2046×1080
                        </option>
                        <option class="select-option" value="">910×480</option>
                      </select>
                    </p>
                  </div>
                  <div class="mr-4 mb-2">
                    <p class="sub-content detail-image-txt2">
                      <span class="tm-text-gray-dark">Format: </span>
                      <select name="format" class="op-download-img">
                        <option class="select-option" value="">JPG</option>
                        <option class="select-option" value="">JPEG</option>
                        <option class="select-option" value="">PNG</option>
                      </select>
                    </p>
                  </div>
                  <div class="mr-4 mb-2">
                    <div class="sub-content detail-image-txt2 cart-quantity">
                      <span class="tm-text-gray-dark">Quantity: </span>
                      <input type="number" name="quantity" id="num" name="num" value="1" min="1">
                    </div>
                  </div>
                </div>
                <div class="joinUs btn-download-img">
                  <button class="btn-thao btn-primary gradient buy-now-button right"
                  onclick="addCart(<?php echo $_GET['id']; ?>)">Add Cart</button>
                </div>
                <hr />
                <div class="mb-4">
                  <h3 class="tm-text-gray-dark mb-3">License</h3>
                  <p>
                    Free for both personal and commercial use. No need to pay
                    anything. No need to make any attribution.
                  </p>
                </div>
                <div>
                  <h3 class="tm-text-gray-dark mb-3">Tags</h3>
                  <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                    >Cloud</a
                  >
                  <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                    >Bluesky</a
                  >
                  <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                    >Nature</a
                  >
                  <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                    >Background</a
                  >
                  <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                    >Timelapse</a
                  >
                  <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                    >Night</a
                  >
                  <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"
                    >Real Estate</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="form-popup form-container" id="notification" style="display: none;">
          <h6>Add to cart succesfully</h6>
          <button type="button" class="btn btn-warning cancel"><a href="./carts.php">Go to Cart</a></button>            
          <button type="button" class="btn btn-warning cancel" onclick="closeForm()">Cancel</button>
      </div>
      <!-- End detail -->
      <!-- Comment -->
      <?php include('comment.php') ?>
      <!-- end Comment -->
      <!-- Related Photos -->
      <?php include('related.php') ?>
      <!-- end Related Photos -->
      <!-- list trending search -->
      <?php include('trending.php') ?>
      <!--end trending search -->
    </div>
    <!-- end container -->
    <!-- footer -->
    <?php include('footer.php') ?>
    <!-- end footer -->
    <script src="JS/products/search_results/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script>
      function closeForm() {
        document.getElementById("notification").style.display = "none";
      }
    </script>
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <script>
      function addCart(id) {
        num = $("#num").val();
        $.post('./addCart.php',{'id': id, 'num': num}, function(data) {
          $("#numberCart").text(data);
          document.getElementById('notification').style.display = "block";
        })
      }
    </script>
    <script src="JS/sidebar.js"></script>
    <script src="JS/ddProfile.js"></script>
  </body>
</html>