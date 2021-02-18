<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.min.css" >
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <title>Edit User Admin</title>
</head>
<body>
    <?php
        if (isset($_POST['updateUser']))
        {
            $idErr = $firstnameErr = $lastnameErr = $usernameErr = $passwordErr = $emailErr = $phoneErr 
                = $addressErr = $cityErr = $countryErr = "";

            $id = $_POST['id'];
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $country = $_POST['country'];

            $msg = "";
            $errList = "";
            $queryErr = "";

            //Check data
            if (empty($id))
                $idErr = "ID is required.";
            else if (!preg_match("/^[0-9]*$/", $id))
                $idErr = "Invalid ID format!";

            if (empty($firstname))
                $firstnameErr = "First name is required.";
            else if (strlen($firstname) > 20)
                $firstnameErr = "Invalid first name! Limited to 20 characters.";

            if (empty($lastname))
                $lastnameErr = "Last name is required.";
            else if (strlen($lastname) > 32)
                $lastnameErr = "Invalid last name! Limited to 32 characters.";

            if (empty($username))
                $usernameErr = "Username is required.";
            else if (!preg_match("/^[A-Za-z0-9_\.]{6,32}$/", $username))
                $usernameErr = "Invalid username format!";
            else if (strlen($username) > 40)
                $usernameErr = "Invalid username! Limited to 40 characters.";

            if (empty($password))
                $passwordErr = "Password is required.";
            else if (strlen($password) < 4 || strlen($password) > 20)
                $passwordErr = "Invalid password! String from 4-20 characters.";

            if (empty($email))
                $emailErr = "Email is required.";
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                $emailErr = "Invalid email format!";
            else if (strlen($email) > 50)
                $emailErr = "Invalid email! Limited to 50 characters.";

            if (empty($phone))
                $phoneErr = "Phone is required.";
            else if (!preg_match("/^[0-9]*$/", $phone))
                $phoneErr = "Invalid phone format!";
            else if (strlen($phone) > 15)
                $phoneErr = "Invalid phone! Limited to 15 numbers.";

            if (empty($address))
                $addressErr = "Address is required.";
            else if (strlen($address) > 100)
                $addressErr = "Invalid address! Limited to 100 characters";

            if (empty($city))
                $cityErr = "City is required.";
            else if (strlen($city) > 32)
                $cityErr = "Invalid city! Limited to 32 characters";

            if (empty($country))
                $countryErr = "Country is required.";
            else if (strlen($country) > 32)
                $countryErr = "Invalid country! Limited to 32 characters";

            if ($idErr != "" || $firstnameErr != "" || $lastnameErr != "" || $usernameErr != "" || $passwordErr != "" || 
                $emailErr != "" || $phoneErr != "" || $addressErr != "" || $cityErr != "" ||$countryErr != "")
            {
                $msg = "User editing failed!";

                if ($idErr != "") {
                    $errList = $errList.$idErr."<br>";
                }
                if ($firstnameErr != "") {
                    $errList = $errList.$firstnameErr."<br>";
                }
                if ($lastnameErr != "") {
                    $errList = $errList.$lastnameErr."<br>";
                }
                if ($usernameErr != "") {
                    $errList = $errList.$usernameErr."<br>";
                }
                if ($passwordErr != "") {
                    $errList = $errList.$passwordErr."<br>";
                }
                if ($emailErr != "") {
                    $errList = $errList.$emailErr."<br>";
                }
                if ($phoneErr != "") {
                    $errList = $errList.$phoneErr."<br>";
                }
                if ($addressErr != "") {
                    $errList = $errList.$addressErr."<br>";
                }
                if ($cityErr != "") {
                    $errList = $errList.$cityErr."<br>";
                }
                if ($countryErr != "") {
                    $errList = $errList.$countryErr."<br>";
                }
            }
            else
            {
                include 'connect_db.php';

                $query_check =  "SELECT count(1) FROM users
                                WHERE id = '$id'
                                AND   is_deleted = '0'";
                $query_check_run = mysqli_query($connection, $query_check);
                if ($query_check_run)
                {
                    $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                    if($data_check[0] == 0) {
                        $msg = "User editing failed!";
                        $usernameErr = "User not found!";
                    }
                }
                else
                {   
                    $msg = "User editing failed!";
                    $queryErr = $queryErr."Error query check exist user: ".$connection->error."<br>";
                }

                $query_check =  "SELECT count(1) FROM users
                                WHERE username   = '$username'
                                AND   is_deleted = '0'
                                AND   id         != '$id'";
                $query_check_run = mysqli_query($connection, $query_check);
                if ($query_check_run)
                {
                    $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                    if($data_check[0] >= 1) {
                        $msg = "User editing failed!";
                        $usernameErr = "Username already exists!";
                    }
                }
                else
                {   
                    $msg = "User editing failed!";
                    $queryErr = $queryErr."Error query check exist username: ".$connection->error."<br>";
                }

                $query_check =  "SELECT count(1) FROM users
                                WHERE email      = '$email'
                                AND   is_deleted = '0'
                                AND   id         != '$id'";
                $query_check_run = mysqli_query($connection, $query_check);
                if ($query_check_run)
                {
                    $data_check = mysqli_fetch_array($query_check_run, MYSQLI_NUM);
                    if($data_check[0] >= 1) {
                        $msg = "User editing failed!";
                        $emailErr= "Email already exists!";
                    }
                }
                else
                {
                    $msg = "User editing failed!";
                    $queryErr = $queryErr."Error query check exist email: ".$connection->error."<br>";
                }

                if ($idErr != "" || $firstnameErr != "" || $lastnameErr != "" || $usernameErr != "" || $passwordErr != "" || $emailErr != "" || 
                    $phoneErr != "" || $addressErr != "" || $cityErr != "" ||$countryErr != "" || $queryErr != "")
                {
                    $msg = "User editing failed!";
                    if ($idErr != "") {
                        $errList = $errList.$idErr."<br>";
                    }
                    if ($firstnameErr != "") {
                        $errList = $errList.$firstnameErr."<br>";
                    }
                    if ($lastnameErr != "") {
                        $errList = $errList.$lastnameErr."<br>";
                    }
                    if ($usernameErr != "") {
                        $errList = $errList.$usernameErr."<br>";
                    }
                    if ($passwordErr != "") {
                        $errList = $errList.$passwordErr."<br>";
                    }
                    if ($emailErr != "") {
                        $errList = $errList.$emailErr."<br>";
                    }
                    if ($phoneErr != "") {
                        $errList = $errList.$phoneErr."<br>";
                    }
                    if ($addressErr != "") {
                        $errList = $errList.$addressErr."<br>";
                    }
                    if ($cityErr != "") {
                        $errList = $errList.$cityErr."<br>";
                    }
                    if ($countryErr != "") {
                        $errList = $errList.$countryErr."<br>";
                    }
                    if ($queryErr != "") {
                        $errList = $errList.$queryErr."<br>";
                    }
                }
                else
                {            
                    $query =    "UPDATE users SET   username    = '$username',
                                                    email       = '$email',
                                                    password    = '$password',
                                                    firstname   = '$firstname',
                                                    lastname    = '$lastname',
                                                    phone       = '$phone',
                                                    address     = '$address',
                                                    city        = '$city',
                                                    country     = '$country',
                                                    updated_date= now()
                                WHERE               id          = '$id'
                                AND                 is_deleted  = '0'
                                ";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run)
                    {
                        $msg = "User editing successfully!";
                    }
                    else
                    {   
                        $msg = "User editing failed!";
                        $errList = $errList."Error query update user: ".$connection->error."<br>";
                    }
                }
                
                $connection->close();         
            }
        }
    ?>

    <?php include 'header.php'; ?> 
    
    <!-- Content -->
    <h1 class="aboutus-title pricing-title title-admin">Users</h1>
    <div class="container">
        <h2 class="title-msg-admin"><?php echo $msg ?></h2>
        <div class="error-msg-admin"><?php echo $errList ?></div><br>
        <a href="users.php" class="btn btn-secondary btn-lg btn-block btn-back-admin" role="button" aria-pressed="true">Back</a>
    </div>
    <!-- end Content -->

    <?php include 'footer.php'; ?>
</body>
</html>
