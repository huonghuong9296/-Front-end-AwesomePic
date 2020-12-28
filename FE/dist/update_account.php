<?php
    ob_start();
    session_start();
    if(!isset($_POST['update_account'])){        
        $new_firstname = $_POST['new_firstname'];
        echo $new_firstname;
    }
    else{
        $msg = "NOTTTTTTTTTTTTTTTT";
    }
    // echo "<script type='text/javascript'>alert('$msg');</script>";
?>