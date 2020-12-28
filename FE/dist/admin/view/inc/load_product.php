<?php
    include 'inc/connect_db.php';
    $query = "SELECT    id,
                        NAME
            FROM        products 
            WHERE       is_deleted = '0'
            ORDER BY    id, NAME
            ";
    $query_run = mysqli_query($connection, $query);
    if ($query_run)
    {
        foreach ($query_run as $row)
        {
?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['id'].'. '.$row['NAME']; ?></option>
<?php            
        }
    }
    else
    {
        echo "Error query select product id data: ".$connection->error;
    }
    $connection->close();
?>