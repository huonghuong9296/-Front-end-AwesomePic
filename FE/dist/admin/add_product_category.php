<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.min.css" >
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <title>Add Product Category Admin</title>
</head>
<body>
    <?php
        if (isset($_POST['insertProductCategory']))
        {
            $nameErr = "";

            $name = $_POST['name'];

            $msg = "";
            $errList = "";
            $queryErr = "";

            //Check data
            if (empty($name))
                $nameErr = "Name is required.";
            else if (strlen($name) > 30)
                $nameErr = "Invalid first name! Limited to 30 characters.";

            if ($nameErr != "")
            {
                $msg = "Product category added failed!";

                if ($nameErr != "") {
                    $errList = $errList.$nameErr."<br>";
                }
            }
            else
            {
                include 'connect_db.php';

                // $query_check =  "SELECT count(1) FROM product_categories
                //                 WHERE category_id   = '$category_id'
                //                 AND   is_deleted = '0'";
                // $query_check_run = mysqli_query($connection, $query_check);
                // if ($query_check_run)
                // {
                //     $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                //     if($data_check[0] == 0) {
                //         $msg = "Product added failed!";
                //         $catelogy_idErr = "Category not exists!";
                //     }
                // }
                // else
                // {   
                //     $msg = "Product added failed!";
                //     $queryErr = $queryErr."Error query check exist category: ".$connection->error."<br>";
                // }

                // if ($nameErr != "" || $category_idErr != "" || $srcErr != "" || $priceErr != "" || $currencyErr != "" 
                //     || $descriptionErr != "" || $queryErr != "")
                // {
                //     $msg = "Product added failed!";

                //     if ($nameErr != "") {
                //     $errList = $errList.$nameErr."<br>";
                //     }
                //     if ($category_idErr != "") {
                //         $errList = $errList.$category_idErr."<br>";
                //     }
                //     if ($srcErr != "") {
                //         $errList = $errList.$srcErr."<br>";
                //     }
                //     if ($priceErr != "") {
                //         $errList = $errList.$priceErr."<br>";
                //     }
                //     if ($currencyErr != "") {
                //         $errList = $errList.$currencyErr."<br>";
                //     }
                //     if ($descriptionErr != "") {
                //     $errList = $errList.$descriptionErr."<br>";
                //     }
                //     if ($queryErr != "") {
                //         $errList = $errList.$queryErr."<br>";
                //     }
                // }
                // else
                // {            
                $query =    "INSERT INTO product_categories 
                                        (category_id,
                                        category_name,
                                        is_deleted) 
                            VALUES      (NULL,
                                        '$name',
                                        '0')";
                $query_run = mysqli_query($connection, $query);
                if ($query_run)
                {
                    $msg = "Product category added successfully!";
                }
                else
                {   
                    $msg = "Product category added failed!";
                    $errList = $errList."Error query insert product category: ".$connection->error."<br>";
                }
                // }
                
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
        <a href="product_categories.php" class="btn btn-secondary btn-lg btn-block btn-back-admin" role="button" aria-pressed="true">Back</a>
    </div>
    <!-- end Content -->

    <?php include 'footer.php'; ?>
</body>
</html>
