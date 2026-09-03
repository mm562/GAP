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
        'maxResults' => 25,
        'playlistId' => 'PLZrwVB5bRgrCAhqX2PPfWP_cPobZJBtTX'
    ];
    
    $response = $service->playlistItems->listPlaylistItems('id,snippet,contentDetails', $queryParams);
    print_r($response);


   $response = json_encode($response);
   file_put_contents('yt-response_playlist.json', $response);
}


?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">