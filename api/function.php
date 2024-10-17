<?php
    function update($sql) {
        $conn = new mysqli("localhost","root","","db_stc");
        $conn->set_charset('utf8');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            echo "Error: " . $conn->error;
            return false;
        }
    }
    
    function insertDB($table, $data) {
        $sql = "INSERT INTO $table";
        $fields = "";
        $values = "";
    
        foreach ($data as $row => $val) {
            if ($val !== null && $val !== '') {
                $fields .= "$row, ";
                $values .= "'$val', ";
            }
        }
    
        if (empty($fields) || empty($values)) {
            echo "No valid fields or values to insert.";
            return false;
        }
    
        $fields = rtrim($fields, ", ");
        $values = rtrim($values, ", ");
        $sql .= " ($fields) VALUES ($values)";
        echo $sql;
        
        return update($sql);
    }

    function updateDB($table, $data, $id) {
        try {
            $sql = "UPDATE $table SET";
            foreach ($data as $row => $val) {
                $sql .= "$row = '$val, '";
            }
            $sql = rtrim($sql, ", ");
            foreach ($id as $data_id => $val_id) {
                $sql .= " WHERE $data_id = '$val_id' ";
            }
            return update($sql);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
?>