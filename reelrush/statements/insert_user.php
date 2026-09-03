<?php
require_once("../db_connect.php");

// [Fetch Parameters]
if (isset($_POST['prolificid'])) {
   $prolificid = str_replace(' ', '', $_POST['prolificid']);
   $startdate = new DateTime();
   $cookie = $_POST['prolificid'];
   $fingerprint = $_POST['fp_id'];
   $groupid = $_POST['dropdown'];

   $startdate = $startdate->format('Y-m-d H:i:s');

   // [Prepare Statement, Execute SQL]
   $stmt = $conn->prepare("INSERT INTO users (userid, startdate, cookie, groupid) VALUES (?, ?, ?, ?)");
   $stmt->bind_param('ssss',$prolificid, $startdate, $cookie, $groupid);

   try{$stmt->execute();
      session_start();
      $_SESSION['prolificid'] = strip_tags(trim($prolificid));
      setcookie("pid", strip_tags(trim($prolificid)), time() + 86400 * 14, "/");
      setcookie("sd", $startdate, time() + 86400 * 14, "/");
      setcookie("gid", strip_tags(trim($groupid)), time() + 86400 * 14, "/");

      // header("location: ../overview.php?source=pwa");
      header("location: ../quiz_initial.php");
   } catch(Exception){
      if ($conn->errno == 1062) {
         // Error: value already exists in database
         header("location: ../error.php");
      } else {
         // Error: something went wrong
         header("location: ../error.php");
      }
   }

   $stmt->close();
}
?>