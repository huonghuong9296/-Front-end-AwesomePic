<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.min.css" >
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <title>Add Product Admin</title>
</head>
<body>
    <?php
        if (isset($_POST['insertProduct']))
        {
            $nameErr = $category_idErr = $srcErr = $priceErr = $currencyErr = $descriptionErr = "";

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

            if ($nameErr != "" || $category_idErr != "" || $srcErr != "" || $priceErr != "" || $currencyErr != "" || $descriptionErr != "")
            {
                $msg = "Product added failed!";

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

                $query_check =  "SELECT count(1) FROM product_categories
                                WHERE category_id   = '$category_id'
                                AND   is_deleted = '0'";
                $query_check_run = mysqli_query($connection, $query_check);
                if ($query_check_run)
                {
                    $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                    if($data_check[0] == 0) {
                        $msg = "Product added failed!";
                        $catelogy_idErr = "Category not exists!";
                    }
                }
                else
                {   
                    $msg = "Product added failed!";
                    $queryErr = $queryErr."Error query check exist category: ".$connection->error."<br>";
                }

                if ($nameErr != "" || $category_idErr != "" || $srcErr != "" || $priceErr != "" || $currencyErr != "" 
                    || $descriptionErr != "" || $queryErr != "")
                {
                    $msg = "Product added failed!";

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
                    $query =    "INSERT INTO products (
                                    id,
                                    name, 
                                    category_id, 
                                    src, 
                                    price, 
                                    currency, 
                                    description, 
                                    is_deleted, 
                                    created_date, 
                                    updated_date) 
                                VALUES (
                                    NULL, 
                                    '$name', 
                                    '$category_id', 
                                    '$src', 
                                    '$price', 
                                    '$currency', 
                                    '$description', 
                                    '0', 
                                    now(), 
                                    NULL)";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run)
                    {
                        $msg = "Product added successfully!";
                    }
                    else
                    {   
                        $msg = "Product added failed!";
                        $errList = $errList."Error query insert product: ".$connection->error."<br>";
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
