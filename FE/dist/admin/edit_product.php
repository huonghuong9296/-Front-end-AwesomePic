<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.min.css" >
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <title>Edit Product Admin</title>
</head>
<body>
    <?php
        if (isset($_POST['updateProduct']))
        {
            $idErr = $nameErr = $category_idErr = $srcErr = $priceErr = $currencyErr = $descriptionErr = "";

            $id = $_POST['id'];
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $src = $_POST['src'];
            $price = $_POST['price'];
            $currency = $_POST['currency'];
            $description = $_POST['description'];

            $msg = "";
            $errList = "";
            $queryErr = "";

            //Check data
            if (empty($id))
                $idErr = "ID is required.";
            else if (!preg_match("/^[0-9]*$/", $id))
                $idErr = "Invalid ID format!";

            if (empty($name))
                $nameErr = "Name is required.";
            else if (strlen($name) > 50)
                $nameErr = "Invalid first name! Limited to 50 characters.";

            if (empty($category_id) && $category_id != "0")
                $category_idErr = "Category is required.";
            else if (strlen($category_id) > 8)
                $category_idErr = "Invalid Category Id! Limited to 8 characters.";

            if (empty($src))
                $srcErr = "Src is required.";

            if (empty($price))
                $priceErr = "Price is required.";
        
            if (empty($currency))
                $currencyErr = "Currency is required.";
            else if (strlen($currency) > 20)
                $currencyErr = "Invalid currency! Limited to 20 characters.";

            if ($idErr != "" || $nameErr != "" || $category_idErr != "" || $srcErr != "" || $priceErr != "" || $currencyErr != "" || $descriptionErr != "")
            {
                $msg = "Product editing failed!";

                if ($idErr != "") {
                    $errList = $errList.$idErr."<br>";
                }
                if ($nameErr != "") {
                    $errList = $errList.$nameErr."<br>";
                }
                if ($category_idErr != "") {
                    $errList = $errList.$category_idErr."<br>";
                }
                if ($srcErr != "") {
                    $errList = $errList.$srcErr."<br>";
                }
                if ($priceErr != "") {
                    $errList = $errList.$priceErr."<br>";
                }
                if ($currencyErr != "") {
                    $errList = $errList.$currencyErr."<br>";
                }
                if ($descriptionErr != "") {
                  $errList = $errList.$descriptionErr."<br>";
                }
            }
            else
            {
                include 'connect_db.php';

                $query_check =  "SELECT count(1) FROM products
                                WHERE id = '$id'
                                AND   is_deleted = '0'";
                $query_check_run = mysqli_query($connection, $query_check);
                if ($query_check_run)
                {
                    $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                    if($data_check[0] == 0) {
                        $msg = "Product editing failed!";
                        $idErr = "Product not found!";
                    }
                }
                else
                {   
                    $msg = "Product editing failed!";
                    $queryErr = $queryErr."Error query check exist product: ".$connection->error."<br>";
                }

                $query_check =  "SELECT count(1) FROM product_categories
                                WHERE category_id   = '$category_id'
                                AND   is_deleted = '0'";
                $query_check_run = mysqli_query($connection, $query_check);
                if ($query_check_run)
                {
                    $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                    if($data_check[0] == 0) {
                        $msg = "Product editing failed!";
                        $catelogy_idErr = "Category not exists!";
                    }
                }
                else
                {   
                    $msg = "Product editing failed!";
                    $queryErr = $queryErr."Error query check exist category: ".$connection->error."<br>";
                }

                if ($idErr != "" || $nameErr != "" || $category_idErr != "" || $srcErr != "" || $priceErr != "" || $currencyErr != "" 
                    || $descriptionErr != "" || $queryErr != "")
                {
                    $msg = "Product editing failed!";

                    if ($idErr != "") {
                      $errList = $errList.$idErr."<br>";
                    }
                    if ($nameErr != "") {
                      $errList = $errList.$nameErr."<br>";
                    }
                    if ($category_idErr != "") {
                        $errList = $errList.$category_idErr."<br>";
                    }
                    if ($srcErr != "") {
                        $errList = $errList.$srcErr."<br>";
                    }
                    if ($priceErr != "") {
                        $errList = $errList.$priceErr."<br>";
                    }
                    if ($currencyErr != "") {
                        $errList = $errList.$currencyErr."<br>";
                    }
                    if ($descriptionErr != "") {
                      $errList = $errList.$descriptionErr."<br>";
                    }
                    if ($queryErr != "") {
                        $errList = $errList.$queryErr."<br>";
                    }
                }
                else
                {            
                    $query =    "UPDATE products
                                SET   name        = '$name', 
                                      category_id  = '$category_id', 
                                      src          = '$src', 
                                      price        = '$price', 
                                      currency     = '$currency', 
                                      description  = '$description',
                                      updated_date = now() 
                                WHERE id = '$id'
                                AND   is_deleted = '0'";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run)
                    {
                        $msg = "Product editing successfully!";
                    }
                    else
                    {   
                        $msg = "Product editing failed!";
                        $errList = $errList."Error query update product: ".$connection->error."<br>";
                    }
                }
                
                $connection->close();         
            }
        }
    ?>

    <?php include 'header.php'; ?> 
    
    <!-- Content -->
    <h1 class="aboutus-title pricing-title title-admin">Products</h1>
    <div class="container">
        <h2 class="title-msg-admin"><?php echo $msg ?></h2>
        <div class="error-msg-admin"><?php echo $errList ?></div><br>
        <a href="products.php" class="btn btn-secondary btn-lg btn-block btn-back-admin" role="button" aria-pressed="true">Back</a>
    </div>
    <!-- end Content -->

    <?php include 'footer.php'; ?>
</body>
</html>
