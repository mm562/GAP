<?php

$externalCall = true;
$videoId = "";

if (isset($_POST['video'])) {
   $videoId = $_POST['video'];
}

if ($externalCall) {
   if (!file_exists(dirname(__DIR__, 1) . '/vendor/autoload.php')) {
      throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
   }
   require_once dirname(__DIR__, 1) . '/vendor/autoload.php';
   
   $client = new Google_Client();
   $client->setApplicationName('API code samples');
   $client->setDeveloperKey('AIzaSyB5jNRClAiN3Xk-HokO0hNaqZ2btAAysms');
   
   // Define service object for making API requests.
   $service = new Google_Service_YouTube($client);
   
   $queryParams = [
      'id' => $videoId,
      'prettyPrint' => true,
      'maxResults' => 5,
   ];
   
   $response = $service->videos->listVideos('snippet,contentDetails,statistics', $queryParams);
   
   $response_array = array("channelId" => $response->items[0]->snippet->channelId,
                           "channelTitle" => $response->items[0]->snippet->channelTitle,
                           "videoTitle" => $response->items[0]->snippet->title,
                           "likeCount" => $response->items[0]->statistics->likeCount);
   echo json_encode($response_array);

   // $response = json_encode($response);
   // file_put_contents('../yt-response_videodetails.json', $response);
}


?>