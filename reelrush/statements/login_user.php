<?php
require_once("../db_connect.php");

// [Fetch Parameters]
if (isset($_POST['prolificid'])) {
   $prolificid = str_replace(' ', '', $_POST['prolificid']);

   // [Prepare Statement, Execute SQL]
   $stmt = $conn->prepare("SELECT startdate FROM users WHERE userid = ?");
   $stmt->bind_param('s', $prolificid);

   if ($stmt->execute()) {
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
         $stmt->bind_result($sd);

         session_start();
         $_SESSION['prolificid'] = strip_tags(trim($prolificid));
         setcookie("pid", strip_tags(trim($prolificid)), time() + 86400 * 14, "/");
         
         while ($stmt->fetch()) {
            $startdate = new DateTime($sd);
            $startdate = $startdate->format('Y-m-d H:i:s');
            setcookie("sd", $startdate, time() + 86400 * 14, "/");
         }
         header("location: ../app.php?source=pwa");
      } else {
         header("location: ../error.php/?id=3&source=pwa");
      }
   } else {
      // Error: something went wrong
      header("location: ../error.php/?id=1&source=pwa");
   }

   $stmt->close();
}
?>