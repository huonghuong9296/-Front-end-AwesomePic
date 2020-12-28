<?php 
    ob_start();
    session_start();
    if(!isset($_SESSION['admin_id'])) {
        header('location:../../login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../css/style.min.css" />
    <!-- <link rel="stylesheet" href="../../css/bootstrap.min.css" /> -->
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>AwesomePic Admin</title>
</head>
<body>
    <div class="wrapper" id="wrapper">
        <div class="overlay hidden"></div>
        <nav id="sidebar" class="hide-menu img">
            <div class="p-4">
                <a href="dashboard.php" class="logo">Dashboard</a>
                <ul class="components mb-5">
                    <li id="admins">
                        <a href="admin.php"><span class="fas fa-home mr-3"></span>Admins</a>
                    </li>
                    <li id="products">
                        <a href="product.php"><span class="fas fa-image mr-3"></span>Products</a>
                    </li>
                    <li id="categories">
                        <a href="category.php"><span class="fas fa-sitemap mr-3 sub-content-admin"></span>Categories</a>
                    </li>
                    <li id="tags">
                        <a href="tag.php"><span class="fas fa-sitemap mr-3 sub-content-admin"></span>Tags</a>
                    </li>
                    <li id="product-categories">
                        <a href="product_category.php"><span class="fas fa-sitemap mr-3 sub-content-admin"></span>Product Categories</a>
                    </li>
                    <li id="product-tags">
                        <a href="product_tag.php"><span class="fas fa-sitemap mr-3 sub-content-admin"></span>Product Tags</a>
                    </li>
                    <li id="users">
                        <a href="user.php"><span class="fa fa-users mr-3"></span>Users</a>
                    </li>
                    <li id="employees">
                        <a href="employee.php"><span class="fa fa-user-circle-o mr-3"></span>Employees</a>
                    </li>
                    <li id="orders">
                        <a href="order.php"><span class="fa fa-list-alt mr-3"></span>Orders</a>
                    </li>
                    <li id="order-details">
                        <a href="order_detail.php"><span class="fa fas fa-sitemap mr-3 sub-content-admin"></span>Order Details</a>
                    </li>
                    <li id="carts">
                        <a href="cart.php"><span class="fa fa-shopping-cart mr-3"></span>Carts</a>
                    </li>
                    <li id="cart-details">
                        <a href="cart_detail.php"><span class="fa fas fa-sitemap mr-3 sub-content-admin"></span>Cart Details</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="content">
            <nav style="position: fixed" class="navbar-thao bg-light">
                <ul class="navbar-ul">
                    <li>
                        <i class="fas fa-bars" id="menu-button"></i>
                        <a href="../../index.php" class="btn-thao hide-btn btn-primary my-0 left">
                            <i class="fas fa-home"></i>Home
                        </a>
                        <a href="../../products.php" class="btn-thao hide-btn btn-primary left">
                            <i class="fas fa-images"></i>Product
                        </a>
                        <a href="../../pricing.php" class="btn-thao hide-btn btn-primary left">
                            <i class="fas fa-donate"></i>Pricing
                        </a>
                    </li>
                </ul>
                <ul class="navbar-ul">
                    <li>
                        <a href="../../aboutUs.php" class="nav-page hide-btn">
                            <i class="fas fa-users"></i>About us
                        </a>
                        <a href="../../contact.php" class="nav-page hide-btn">
                            <i class="fas fa-envelope"></i>Contact us
                        </a>
                        <i class="fas fa-shopping-cart"></i>
                        <a href="../../signUp.php" class="nav-page"> Sign Up</a>
                        <a href="../../logout_admin.php" class="btn-thao btn-primary gradient right">Log out</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>