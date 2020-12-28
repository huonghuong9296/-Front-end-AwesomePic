<?php
    include 'inc/connect_db.php';
    $query = "SELECT    id,
                        username
            FROM        users 
            WHERE       is_deleted = '0'
            ORDER BY    id, username
            ";
    $query_run = mysqli_query($connection, $query);
    if ($query_run)
    {
        foreach ($query_run as $row)
        {
?>
            <option value="<?php echo $row['id']; ?>">
                <?php echo $row['id'].'. '.$row['username']; ?>
            </option>
<?php            
        }
    }
    else
    {
        echo "Error query select user id data: ".$connection->error;
    }
    $connection->close();
?>