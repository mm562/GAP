<?php
require_once("db_connect.php");

$create = false;
$import = true;

function importJsonToMysql($jsonFilePath, $tableName) {
    global $conn, $create, $import;
    
    // Read the JSON file
    $jsonData = file_get_contents($jsonFilePath);
    $data = json_decode($jsonData, true);
    $data = $data['responses'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($create) {
        // Create the table with columns for each key
        $keys = array_keys($data[0]);
        $query = "CREATE TABLE $tableName (";
        foreach ($keys as $key) {
            // Escape and format the column name
            $key = str_replace(["["], "_", $key);
            $key = str_replace(["]"], "", $key);
            if ($key == "prolificid") {
                $key = "prolificid_";
            }
            $columnName = mysqli_real_escape_string($conn, $key);
            $query .= "`$columnName` VARCHAR(255), "; // You can adjust the data type and length as needed
        }
        $query = rtrim($query, ', ');
        $query .= ")";
        if (mysqli_query($conn, $query)) {
            echo "Table created successfully.";
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }
    }

    if ($import) {
        // Insert data into the table
        $keys = array_keys($data[0]);
        $query = "INSERT INTO $tableName (";

        $columnNames = implode(", ", array_map(function ($key) use ($conn) {
            $key = str_replace(["["], "_", $key);
            $key = str_replace(["]"], "", $key);
            if ($key == "prolificid") {
                $key = "prolificid_";
            }
            return mysqli_real_escape_string($conn, $key);
        }, $keys));

        $query .= "$columnNames) VALUES (";
        $valuePlaceholders = implode(", ", array_fill(0, count($keys), "?"));
        $query .= "$valuePlaceholders)";
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            foreach ($data as $row) {
                $values = array_values($row);
                mysqli_stmt_bind_param($stmt, str_repeat('s', count($values)), ...$values);
                mysqli_stmt_execute($stmt);
            }
            echo "Data inserted successfully.";
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    $conn->close();
}

// Usage example:
$jsonFilePath = "./exported_data/export3.json";
$tableName = "answers_demographic";

importJsonToMysql($jsonFilePath, $tableName);
?>