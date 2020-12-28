<?php
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="css/products/products.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/products/animate.css" /> -->
    <link rel="stylesheet" type="text/css" href="css/style.min.css" />
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
    <!-- container -->
    <div class="container">
      <!-- list gallery -->
      <div class="row mt-5" id="featured-colections">
        <?php
          // Select from categories table 
          include ('connect.php');
          $sqlcategories = "SELECT *
					FROM	". "categories
          WHERE 		is_deleted	= 0";
          $resultcategories = mysqli_query($connection, $sqlcategories);

          while($rowcategories = mysqli_fetch_row($resultcategories)) {
            // Selected category id
            $cate_id = $rowcategories[0];
            // Select product with category id from products_categories
            $sqlproduct = "SELECT * FROM products_categories WHERE category_id = " .$cate_id;
            $result_product = mysqli_query($connection, $sqlproduct);
            $product_id = array();
            while($row_product = mysqli_fetch_row($result_product)) {
              $product_id = $row_product[0];

              $sql_img = "SELECT * 
              FROM ". "products 
              WHERE 
              id = " . $product_id . "
              AND is_deleted	= 0";

              $result_img = mysqli_query($connection, $sql_img);
              $row_img = mysqli_fetch_row($result_img); 

              if (isset($row_img)) {
                if ($rowcategories[0] % 2 == 1) {         
        ?>
                  <section class="colection-overview">
                    <div class="container">
                      <div class="row">
                        <div class="wow col-md-6 col-sm-6 colection-description-left">
                          <h2 class="aboutus-title pricing-title"><?php echo $rowcategories[1]; ?></h2>
                          <p class="sub-content"><?php echo $rowcategories[2]; ?></p>
                          <form action="detail.php?id=<?php echo $row_img[0]; ?>" method="post">
                            <button type="submit" class="btn-thao btn-primary gradient right btn-product">View Details</button>
                          </form>
                          <form method="post">
                            <button type="button" class="btn-thao btn-primary gradient right btn-product" onclick="addCart(<?php echo $row_img[0]; ?>)">Add Cart</button>
                          </form>
                        </div>
                        <div
                          class="wow fadeInUpRight col-md-6 col-sm-6 colection-img-format"
                        >
                          <a href="search_results.html">
                            <img
                              src="<?php echo $row_img[2]; ?>"
                              class="img-responsive colection-img"
                              alt="Overview"
                            />
                          </a>
                        </div>
                      </div>
                    </div>
                  </section>
        <?php    
                } 
                else {
        ?>
                  <section class="colection-overview">
                    <div class="container">
                      <div class="row">
                        <div class="wow fadeInUpLeft col-md-6 col-sm-6 colection-img-format">
                          <a href="search_results.html">
                            <img
                              src="<?php echo $row_img[2]; ?>"
                              class="img-responsive colection-img"
                              alt="Overview"
                            />
                          </a>
                        </div>
                        <div class="wow col-md-6 col-sm-6 colection-description-right">
                          <h2 class="aboutus-title pricing-title"><?php echo $rowcategories[1]; ?></h2>
                          <p class="sub-content"><?php echo $rowcategories[2]; ?></p>
                          <form action="detail.php?id=<?php echo $row_img[0]; ?>" method="post">
                            <button type="submit" class="btn-thao btn-primary gradient right btn-product">View Details</button>
                          </form>
                          <form method="post">
                            <button type="button" class="btn-thao btn-primary gradient right btn-product" onclick="addCart(<?php echo $row_img[0]; ?>)">Add Cart</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </section> 
        <?php    
                } 
              }
            }
          }
        ?>        
      </div>
      <!--end list gallery -->
      <!-- list trending search -->
      <?php include('trending.php') ?>
      <!--end trending search -->
    </div>
    <!-- end container -->
    <!-- footer -->
    <?php include('footer.php') ?>

    <!-- end footer -->
    <!-- Modal -->
    <div class="form-popup form-container" id="notification" style="display: none;">
        <h6>Add to cart succesfully</h6>
        <button type="button" class="btn btn-warning cancel"><a href="./carts.php">Go to Cart</a></button>            
        <button type="button" class="btn btn-warning cancel" onclick="closeForm()">Cancel</button>
    </div>
    
    <script
      src="https://kit.fontawesome.com/ae09c0f9d5.js"
      crossorigin="anonymous"
    ></script>
    <script>
      function closeForm() {
        document.getElementById("notification").style.display = "none";
      }
    </script>
    <script>
      function addCart(id) {
        num = 1;
        $.post('./downloadnow.php',{'id': id, 'num': num}, function(data) {
          $("#numberCart").text(data);
          document.getElementById('notification').style.display = "block";
        })
      }
    </script>
    <script>
      document.getElementById("product").classList.add('active'); 
    </script>
    <script src="JS/sidebar.js"></script>
    <script src="JS/products/jquery.js"></script>
    <script src="JS/products/jquery.parallax.js"></script>
    <script src="JS/products/wow.min.js"></script>
    <script src="JS/ddProfile.js"></script>
  </body>
</html>
