<?php
// $file = 'log.txt';
// $current = file_get_contents($file);
// $current .= "session_duration:".$_POST['session_duration']."\n";
// file_put_contents($file, $current);

require_once("db_connect.php");

// [Fetch Parameters]
if (isset($_POST['session_duration']) && isset($_POST['session_videocount'])) {
   // $prolificid = decrypt($_POST['prolificid']);
   // $session_start = (new DateTime(decrypt($_POST['session_start'])))->format(DateTime::ATOM);
   // $session_end = (new DateTime(decrypt($_POST['session_end'])))->format(DateTime::ATOM);
   // $session_duration = decrypt($_POST['session_duration']);
   // $session_videocount = decrypt($_POST['session_videocount']);
   // $session_avgvideowatchtime = decrypt($_POST['session_avgvideowatchtime']);
   // $screenresolution = decrypt($_POST['screenresolution']);
   // $os = decrypt($_POST['os']);
   // $useragent = decrypt($_POST['useragent']);
   // $language = decrypt($_POST['language']);
   // $timezone = decrypt($_POST['timezone']);
   
   if (isset($_POST['session_start'])) {
      // initial data push from client
      $session_id = $_POST['session_id'];
      $prolificid = $_POST['prolificid'];
      // $intervention = $_POST['intervention'];
      // $intervention_iteration = $_POST['intervention_iteration'];
      // $intervention_startdelay = $_POST['intervention_startdelay'];
      $session_start = (new DateTime($_POST['session_start']))->format(DateTime::ATOM);
      $session_end = (new DateTime($_POST['session_end']))->format(DateTime::ATOM);
      $session_duration = $_POST['session_duration'];
      $session_videocount = $_POST['session_videocount'];
      $session_avgvideowatchtime = $_POST['session_avgvideowatchtime'];
      $screenresolution = $_POST['screenresolution'];
      $os = $_POST['os'];
      $useragent = $_POST['useragent'];
      $language = $_POST['language'];
      $timezone = $_POST['timezone'];
      $ended = 0;

      // error_log("Variables: " . $session_id . " | " . $prolificid . " | " .  $intervention . " | " . $intervention_iteration . " | " . $intervention_startdelay . " | " . $session_start . " | " . $session_end . " | " . $session_duration . " | " . $session_videocount . " | " . $session_avgvideowatchtime . " | " . $screenresolution . " | " . $os . " | " . $useragent . " | " . $language . " | " . $timezone);

      // [Prepare Statement, Execute SQL]
      $stmt = $conn->prepare("INSERT INTO sessions (session_id, prolificid, session_start, session_end, session_duration, session_videocount, session_avgvideowatchtime, screenresolution, os, useragent, language, timezone, ended) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param('ssssdidsssssi', $session_id, $prolificid, $session_start, $session_end, $session_duration, $session_videocount, $session_avgvideowatchtime, $screenresolution, $os, $useragent, $language, $timezone, $ended);
   } else {
      // repeating data push from client
      $session_id = $_POST['session_id'];
      $prolificid = $_POST['prolificid'];
      $session_end = (new DateTime($_POST['session_end']))->format(DateTime::ATOM);
      $session_duration = $_POST['session_duration'];
      $session_videocount = $_POST['session_videocount'];
      $session_avgvideowatchtime = $_POST['session_avgvideowatchtime'];

      if (isset($_POST['ended'])) {
         $ended = $_POST['ended'];
         // [Prepare Statement, Execute SQL]
         $stmt = $conn->prepare("UPDATE sessions SET prolificid = ?, session_end = ?, session_duration = ?, session_videocount = ?, session_avgvideowatchtime = ?, ended = ? WHERE session_id = ?");
         $stmt->bind_param('sssidis', $prolificid, $session_end, $session_duration, $session_videocount, $session_avgvideowatchtime, $ended, $session_id);
      } else {
         // [Prepare Statement, Execute SQL]
         $stmt = $conn->prepare("UPDATE sessions SET prolificid = ?, session_end = ?, session_duration = ?, session_videocount = ?, session_avgvideowatchtime = ? WHERE session_id = ?");
         $stmt->bind_param('sssids', $prolificid, $session_end, $session_duration, $session_videocount, $session_avgvideowatchtime, $session_id);
      }
   }

   if ($stmt->execute()) {
      // header("location: ../overview.php?source=pwa");
   } else {
      // if ($conn->errno == 1062) {
      //    // Error: value already exists in database
      //    header("location: ../error.php/?id=2&source=pwa");
      // } else {
      //    // Error: something went wrong
      //    header("location: ../error.php/?id=1&source=pwa");
      // }
   }

   $stmt->close();
}




function decrypt($string) {
   $output = false;

   $encrypt_method = "AES-256-CBC";
   $secret_key = 'yourEncryptionKey';
   $secret_iv = 'yourInitializationVector';

   // Hash the secret key
   $key = hash('sha256', $secret_key, true); // Convert to binary

   // IV - Encrypt method AES-256-CBC expects 16 bytes
   $iv = substr(hash('sha256', $secret_iv, true), 0, 16);

   // Base64 decode and then decrypt
   $decoded = base64_decode($string);

   if ($decoded === false) {
       error_log("Base64 decoding error");
       return false;
   }

   $output = openssl_decrypt($decoded, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv);

   if ($output === false) {
       error_log("Decryption error: " . openssl_error_string());
       return false;
   }

   return rtrim($output, "\0");
}

?>