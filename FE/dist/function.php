<?php
    function addNew($table, $data) {
        include ('connect.php');
        $feild = "";
        $values = "";
        if(is_array($data)) {
            $i = 0;
            foreach ($data as $key => $val) {
                if ($key != "addNew") {
                    $i++;
                    if ($i == 1) {
                        $feild .= $key;
                        $values .= "'". $val . "'"; 
                    } else {
                        $feild .= ",". $key;
                        $values .= ",'". $val . "'";
                    }
                }
            }
            $sqlInsert = "INSERT INTO $table ($feild) VALUES ($values)";
            mysqli_query($connection, $sqlInsert) or die ('SQL error');
            $id = mysqli_insert_id($connection);
            return $id;
        }
    }

    function addtoCart($table, $data) {
        include ('connect.php');
        $feild = "";
        $values = "";
        if(is_array($data)) {
            $i = 0;
            foreach ($data as $key => $val) {
                if ($key != "addtoCart") {
                    $i++;
                    if ($i == 1) {
                        $feild .= $key;
                        $values .= "'". $val . "'"; 
                    } else {
                        $feild .= ",". $key;
                        $values .= ",'". $val . "'";
                    }
                }
            }
            $sqlInsert = "INSERT INTO $table ($feild) VALUES ($values)";
            mysqli_query($connection, $sqlInsert) or die ('SQL error');
            $id = mysqli_insert_id($connection);
            return $id;
        }
    }

?>

