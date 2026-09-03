<?php
require_once("../db_connect.php");

$tableName = "answers_demographic";
$viewName = "new_data";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {
   $uploadedFile = $_FILES['fileToUpload'];
   $fileName = $uploadedFile['name'];
   $fileTmpPath = $uploadedFile['tmp_name'];
   $fileSize = $uploadedFile['size'];
   $fileType = $uploadedFile['type'];

   $result_scope = $_POST["scope"];
   if ($result_scope == "only_survey") {
      $viewName = "new_data";
   } else if ($result_scope == "all_session") {
      $viewName = "new_data_total";
   }

   $jsonContent = file_get_contents($fileTmpPath);
   $jsonData = json_decode($jsonContent, true);

   createTable($jsonData);
   importData($jsonData);


   downloadData();
   $conn->close();
}

function createTable($data) {
   global $conn, $tableName;

   $data = $data['responses'];

   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   $tableExists = $conn->query("SHOW TABLES LIKE '$tableName'")->num_rows > 0;

   if ($tableExists) {
      
   } else {
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
         $query .= "`$columnName` VARCHAR(1023), "; 
      }
      $query = rtrim($query, ', ');
      $query .= ")";
      if (mysqli_query($conn, $query)) {
         // echo "Table created successfully.";
      } else {
         echo "Error creating table: " . mysqli_error($conn);
      }
   }
}
function importData($data) {
   global $conn, $tableName;

   $data = $data['responses'];

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
         $checkQuery = "SELECT * FROM $tableName WHERE sessionid = '".$row['sessionid']."'";
         $result = $conn->query($checkQuery);

         if ($result->num_rows > 0) {
            // sessionid already exists in db, do nothing
         } else {
            $values = array_values($row);
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($values)), ...$values);
            mysqli_stmt_execute($stmt);
         }
      }
      //  echo "Data inserted successfully.";
      mysqli_stmt_close($stmt);
   } else {
      echo "Error preparing statement: " . mysqli_error($conn);
   }
}
function downloadData() {
   global $conn, $viewName;

   // Query to fetch all data from the table
   $query = "SELECT * FROM $viewName";
   $result = $conn->query($query);

   // Check if the query was successful
   if ($result) {
      // Set headers for CSV file download
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $viewName . '.csv"');
      header('Pragma: no-cache');
      header('Expires: 0');

      // Open a PHP output stream for writing to the browser
      $output = fopen('php://output', 'w');

      // Output CSV column headers
      $row = $result->fetch_assoc();
      fputcsv($output, array_keys($row));

      // Output data rows
      $result->data_seek(0); // Reset result set pointer
      while ($row = $result->fetch_assoc()) {
         fputcsv($output, $row);
      }

      // Close the output stream
      fclose($output);

      // Free the result set
      $result->free_result();
   } else {
      echo "Error: " . $conn->error;
   }
}
?>