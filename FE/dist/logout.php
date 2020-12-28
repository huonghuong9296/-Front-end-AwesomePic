 <?php 
    session_start();    
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_email"]);
    unset($_SESSION["user_username"]);
    unset($_SESSION["user_firstname"]);
    unset($_SESSION["user_lastname"]);
    unset($_SESSION["user_phone"]);
    unset($_SESSION["user_address"]);
    unset($_SESSION["user_createdDate"]);
    unset($_SESSION["user_updatedDate"]);
    unset($_SESSION["user_isDeleted"]);
    
    header("location:login.php");
?>

