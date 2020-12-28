<?php
    include 'inc/connect_db.php';
    $query = "SELECT    a.id        cart_id,
                        b.username  username
            FROM        carts  a,
                        users   b 
            WHERE       a.user_id    = b.id
            ORDER BY    cart_id, username
            ";
    $query_run = mysqli_query($connection, $query);
    if ($query_run)
    {
        foreach ($query_run as $row)
        {
?>
            <option value="<?php echo $row['cart_id']; ?>">
                <?php echo $row['cart_id'].'. '.$row['username']; ?>
            </option>
<?php            
        }
    }
    else
    {
        echo "Error query select cart id data: ".$connection->error;
    }
    $connection->close();
?>