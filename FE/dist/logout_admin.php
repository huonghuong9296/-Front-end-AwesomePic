 <?php 
    session_start();    
    unset($_SESSION["admin_id"]);
    unset($_SESSION["admin_email"]);
    unset($_SESSION["admin_username"]);
    header("location:login.php");
?>