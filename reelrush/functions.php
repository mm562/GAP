<?php

/*
3RD PARTY API USAGE - CHECKING FOR VIDEO TYPE = SHORT
*/
function checkByAPI() {
   $yt_response = json_decode(file_get_contents("yt-response.json"), true);
   foreach ($yt_response["items"] as &$video) {
      echo "<div class='check-output'>".$video["id"]." - ";

      $url = 'https://yt.lemnoslife.com/videos?part=short&id='.$video["id"];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      if (curl_errno($ch)) {
         echo 'Error:' . curl_error($ch);
         exit();
      } 
      curl_close($ch);      
      $response = json_decode($response, true);
      echo ($response["items"][0]["short"]["available"]) ? true : false . "</div>";
   }
}

/*
YOUTUBE SERVER PINGING - CHECKING FOR VIDEO TYPE = SHORT
*/
function checkByPing() {
   $yt_response = json_decode(file_get_contents("yt-response.json"), true);
   foreach ($yt_response["items"] as &$video) {
      echo "<div class='check-output'>".$video["id"]." - HTTP ";

      $url = 'https://www.youtube.com/shorts/'.$video["id"];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_NOBODY, true);
      curl_setopt($ch, CURLOPT_HEADER, true);
      $response = curl_exec($ch);
      if (curl_errno($ch)) {
         echo 'Error:' . curl_error($ch);
         exit();
      }
      curl_close($ch);      
      echo curl_getinfo($ch, CURLINFO_HTTP_CODE). "</div>";
   }
}


?>