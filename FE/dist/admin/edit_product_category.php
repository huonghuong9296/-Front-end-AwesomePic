<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.min.css" >
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <title>Edit Product Category Admin</title>
</head>
<body>
    <?php
        if (isset($_POST['updateProductCategory']))
        {
            $idErr = $nameErr = "";

            $id = $_POST['id'];
            $name = $_POST['name'];

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
            else if (strlen($name) > 30)
                $nameErr = "Invalid first name! Limited to 30 characters.";

            if ($idErr != "" || $nameErr != "")
            {
                $msg = "Product category editing failed!";

                if ($idErr != "") {
                    $errList = $errList.$idErr."<br>";
                }
                if ($nameErr != "") {
                    $errList = $errList.$nameErr."<br>";
                }
            }
            else
            {
                include 'connect_db.php';

                $query_check =  "SELECT count(1) FROM product_categories
                                WHERE category_id   = '$id'
                                AND   is_deleted = '0'";
                $query_check_run = mysqli_query($connection, $query_check);
                if ($query_check_run)
                {
                    $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                    if($data_check[0] == 0) {
                        $msg = "Product category editing failed!";
                        $catelogy_idErr = "Product category not exists!";
                    }
                }
                else
                {   
                    $msg = "Product category editing failed!";
                    $queryErr = $queryErr."Error query check exist product category: ".$connection->error."<br>";
                }

                if ($idErr != "" || $nameErr != "")
                {
                    $msg = "Product category editing failed!";

                    if ($idErr != "") {
                      $errList = $errList.$idErr."<br>";
                    }
                    if ($nameErr != "") {
                      $errList = $errList.$nameErr."<br>";
                    }
                    if ($queryErr != "") {
                        $errList = $errList.$queryErr."<br>";
                    }
                }
                else
                {            
                    $query =    "UPDATE product_categories
                                SET   category_name = '$name'
                                WHERE category_id   = '$id'
                                AND   is_deleted    = '0'";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run)
                    {
                        $msg = "Product category editing successfully!";
                    }
                    else
                    {   
                        $msg = "Product category editing failed!";
                        $errList = $errList."Error query update product category: ".$connection->error."<br>";
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
        <a href="product_categories.php" class="btn btn-secondary btn-lg btn-block btn-back-admin" role="button" aria-pressed="true">Back</a>
    </div>
    <!-- end Content -->

    <?php include 'footer.php'; ?>
</body>
</html>
