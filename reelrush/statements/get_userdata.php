<?php
require_once("../db_connect.php");

$data = array();

// [Fetch Parameters]
if (isset($_POST['fp_id'])) {
   $fp_id = $_POST['fp_id'];

   // [Prepare Statement, Execute SQL]
   $stmt = $conn->prepare("SELECT prolificid, startdate FROM users WHERE fingerprint = ?");
   $stmt->bind_param('s', $fp_id);

   if ($stmt->execute()) {
      $stmt->bind_result($id, $sd);
      while ($stmt->fetch()) {
         $data = array("prolificid" => $id,
                        "startdate" => $sd);
      }
      echo json_encode($data);
   }

   $stmt->close();
}
?>