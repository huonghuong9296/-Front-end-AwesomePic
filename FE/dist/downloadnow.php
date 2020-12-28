<?php
    include ('connect.php');

    session_start();
    ob_start();
    if(isset($_POST["id"])) {
        $id = $_POST["id"];
        $num = 1;
        $sqlDetail = "SELECT * FROM products WHERE id = ".$id;
        $resultRow = mysqli_query($connection, $sqlDetail);
        $row = mysqli_fetch_row($resultRow);

        $sqlproduct = "SELECT * FROM products_categories WHERE product_id = " .$id;
        $result_product = mysqli_query($connection, $sqlproduct);
        $row_product = mysqli_fetch_row($result_product);
        $cate_id = $row_product[1];

        if(!isset($_SESSION["cart"])) {
            $cart = array();
            $cart[$id] = array(
                'name' => $row[1],
                'num' => $num,
                'image' => $row[2],
                'price' => $row[5],
                'currency' => $row[6],
                'category' => $cate_id
            );
        }

        else {
            $cart = $_SESSION["cart"];
            if(array_key_exists($id, $cart)) {
                $cart[$id] = array(
                    'name' => $row[1],
                    'num' => (int)$cart[$id]['num'] + $num,
                    'image' => $row[2],
                    'price' => $row[5],
                    'currency' => $row[6],
                    'category' => $cate_id
                ); 
            }
            else {
                $cart[$id] = array(
                    'name' => $row[1],
                    'num' => $num,
                    'image' => $row[2],
                    'price' => $row[5],
                    'currency' => $row[6],
                    'category' => $cate_id
                );
            }
        }
        $_SESSION["cart"] = $cart; 
        $numCart = 0;
        foreach ($_SESSION["cart"] as $key => $value) {
            $numCart ++;
        }
        echo $numCart;
        // echo "<pre>";
        // print_r($_SESSION["cart"]);
        // die;
    }

    if(isset($_POST["id"])) {
        $id = $_POST["id"];
        $sqlDetail = "SELECT * FROM products WHERE id = ".$id;
        $resultRow = mysqli_query($connection, $sqlDetail);
        $row = mysqli_fetch_row($resultRow);
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
                $sqlInsert = "INSERT INTO viewed_products(product_id, user_id, created_date) VALUES ('$id', '$user', '$curentDate')";
                mysqli_query($connection, $sqlInsert);
            } 
        }
    }
?>