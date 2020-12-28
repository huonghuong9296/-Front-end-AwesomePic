<?php
    include 'inc/connect_db.php';
    $query = "SELECT    a.id        order_id,
                        b.username  username
            FROM        orders  a,
                        users   b 
            WHERE       a.is_deleted = '0'
            AND         a.user_id    = b.id
            ORDER BY    order_id, username
            ";
    $query_run = mysqli_query($connection, $query);
    if ($query_run)
    {
        foreach ($query_run as $row)
        {
?>
            <option value="<?php echo $row['order_id']; ?>">
                <?php echo $row['order_id'].'. '.$row['username']; ?>
            </option>
<?php            
        }
    }
    else
    {
        echo "Error query select order id data: ".$connection->error;
    }
    $connection->close();
?>