<?php
    include 'inc/connect_db.php';
    $query = "SELECT    id,
                        title
            FROM        tags 
            WHERE       1 
            ORDER BY    id, title
            ";
    $query_run = mysqli_query($connection, $query);
    if ($query_run)
    {
        foreach ($query_run as $row)
        {
?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['id'].'. '.$row['title']; ?></option>
<?php            
        }
    }
    else
    {
        echo "Error query select tag id data: ".$connection->error;
    }
    $connection->close();
?>