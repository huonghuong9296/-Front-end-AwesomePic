<?php
    $connection = mysqli_connect("127.0.0.1", "root", "");
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $db = mysqli_select_db($connection, "AwesomePic");
?>