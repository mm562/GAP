<?php


$externalCall = false;

/**
 * Sample PHP code for youtube.videos.list
 * See instructions for running these code samples locally:
 * https://developers.google.com/explorer-help/code-samples#php
 */
if ($externalCall) {
   if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
      throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
   }
   require_once __DIR__ . '/vendor/autoload.php';
   
   $client = new Google_Client();
   $client->setApplicationName('API code samples');
   $client->setDeveloperKey('AIzaSyB5jNRClAiN3Xk-HokO0hNaqZ2btAAysms');
   
   // Define service object for making API requests.
   $service = new Google_Service_YouTube($client);
   
   $queryParams = [
      'chart' => 'mostPopular',
      'regionCode' => 'US',
      'prettyPrint' => true,
      'maxResults' => 1000,
   ];
   
   $response = $service->videos->listVideos('snippet,contentDetails,statistics', $queryParams);
   print_r($response);

   $response = json_encode($response);
   file_put_contents('yt-response_new1.json', $response);
} else {
   $data = file_get_contents("yt-response_new1.json");
   $object = json_decode($data);
   $duration = $object->items[0]->contentDetails->duration;

   foreach ($object->items as $video) {
      if(shortDuration($video->contentDetails->duration)) {
         echo $video->id." ---> true<br>";
      } else {
         echo $video->id." ---> false<br>";
      }
   }
}

function shortDuration($string) {
   preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/', $string, $matches);

   $hours = isset($matches[1]) ? (int)$matches[1] : 0;
   $minutes = isset($matches[2]) ? (int)$matches[2] : 0;
   $seconds = isset($matches[3]) ? (int)$matches[3] : 0;

   // Convert all units to seconds
   $totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;

   // Check if the total duration is under 60 seconds
   return $totalSeconds < 60;
}


?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">