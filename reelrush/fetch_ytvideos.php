<?php
require_once("db_connect.php");

$search_list = true;
$loopCounter = 0;

$new_entries = 0;

// CONFIG
$loops = 10;
$initial = true;
$keywords = "short h";
// $location = ['36.957752,-112.478531', '34.831695,-86.096753', '35.52519016321502,-97.53210794878774', "37.779467473284434,-122.43135355023469", "34.1336591380604,-118.26540822159843", "30.136485637074603,-95.15528222629625", "30.096925570863746,-90.04819957448449", "25.850840518579716,-80.20439129796404", "28.57065819725498,-81.35176030905818"];
// $location[0] => Westküste
// $location[1] => Ostküste
// $location[2] => Mitte
// $location[3] => San Francisco
// $location[4] => Los Angeles
// $location[5] => Houston
// $location[6] => New Orleans
// $location[7] => Miami
// $location[8] => Orlando
$location = ['36.2245844882136,-115.12684260717694', '33.91532529358349,-84.15952852886583', '35.471062957527295,-97.53824440920687', "37.779467473284434,-122.43135355023469", "34.1336591380604,-118.26540822159843", "30.136485637074603,-95.15528222629625", "30.096925570863746,-90.04819957448449", "25.850840518579716,-80.20439129796404"];
$location = $location[7]; // zuletzt 0 verwendet
$radius = "400km";

if ($search_list) {
   if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
      throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
   }
   require_once __DIR__ . '/vendor/autoload.php';
   
   $client = new Google_Client();
   $client->setApplicationName('Video Fetching');
   $client->setDeveloperKey('AIzaSyB5jNRClAiN3Xk-HokO0hNaqZ2btAAysms');
    
   if ($initial) {
      $nextPage = requestVideosInitial();
   } else {
      $nextPage = "CPQDEAA";  // CHANGE nextPageToken VALUE FROM DATABASE!
   }

   requestVideos($nextPage);
   echo "Added ".$new_entries." videos to the database.";
} 


// Initial API call
function requestVideosInitial() {
   global $loopCounter, $loops, $client, $conn, $new_entries, $keywords, $location, $radius;
   $service = new Google_Service_YouTube($client);
      
   $queryParams = [
      'location' => $location,
      'locationRadius' => $radius,
      'q' => $keywords,
      'regionCode' => 'us',
      'relevanceLanguage' => 'en',
      'type' => 'video',
      'videoDuration' => 'short',
      'maxResults' => 50,
      'prettyPrint' => true,
      'safeSearch' => 'strict',
      'videoEmbeddable' => 'true',
      'publishedAfter' => '2023-01-01T00:00:00Z'
   ];
   
   $response = $service->search->listSearch('snippet', $queryParams);
   $nextPage = $response->nextPageToken;
   $items = $response->items;

   $stored_response = (array) $items;
   // file_put_contents("yt-response3.php", json_encode($stored_response));
   // $videos = json_decode(file_get_contents("yt-response3.json"));
   $videos = json_decode(json_encode($stored_response));

   foreach ($videos as $video) {
      $checkQuery = $conn->prepare("SELECT COUNT(*) FROM videos2 WHERE videoId = ?");
      $checkQuery->bind_param("s", $video->id->videoId);
      $checkQuery->execute();
      $checkResult = $checkQuery->get_result();
      $existingCount = $checkResult->fetch_row()[0];

      if ($existingCount == 0) {
         $insertQuery = $conn->prepare("INSERT INTO videos2 (videoId, channelId, channelTitle, description, publishedAt, title) VALUES (?, ?, ?, ?, ?, ?)");
         $insertQuery->bind_param('ssssss', $video->id->videoId, $video->snippet->channelId, $video->snippet->channelTitle, $video->snippet->description, $video->snippet->publishedAt, $video->snippet->title);

         if ($insertQuery->execute()) {
            $new_entries++;
         } else {
            
         }

         $insertQuery->close();
      }
      $checkQuery->close();
   }
   $loopCounter++;
   echo $nextPage."<br>";
   return $nextPage;
}

// Repeating API call
function requestVideos($pageToken) {   
   global $loopCounter, $loops, $client, $conn, $new_entries, $keywords, $location, $radius;
   
   if ($loopCounter < $loops) {
      $service = new Google_Service_YouTube($client);
      
      $queryParams = [
         'location' => $location,
         'locationRadius' => $radius,
         'q' => $keywords,
         'regionCode' => 'us',
         'relevanceLanguage' => 'en',
         'type' => 'video',
         'videoDuration' => 'short',
         'maxResults' => 50,
         'prettyPrint' => true,
         'safeSearch' => 'strict',
         'pageToken' => $pageToken,
         'videoEmbeddable' => 'true',
         'publishedAfter' => '2023-01-01T00:00:00Z'
      ];
      echo $pageToken."<br>";

      $response = $service->search->listSearch('snippet', $queryParams);
      $nextPage = $response->nextPageToken;
      $items = $response->items;

      $stored_response = (array) $items;
      $videos = json_decode(json_encode($stored_response));

      foreach ($videos as $video) {
         $checkQuery = $conn->prepare("SELECT COUNT(*) FROM videos2 WHERE videoId = ?");
         $checkQuery->bind_param("s", $video->id->videoId);
         $checkQuery->execute();
         $checkResult = $checkQuery->get_result();
         $existingCount = $checkResult->fetch_row()[0];

         if ($existingCount == 0) {
            $insertQuery = $conn->prepare("INSERT INTO videos2 (videoId, channelId, channelTitle, description, publishedAt, title) VALUES (?, ?, ?, ?, ?, ?)");
            $insertQuery->bind_param('ssssss', $video->id->videoId, $video->snippet->channelId, $video->snippet->channelTitle, $video->snippet->description, $video->snippet->publishedAt, $video->snippet->title);

            if ($insertQuery->execute()) {
               $new_entries++;
            } else {
               
            }

            $insertQuery->close();
         }
         $checkQuery->close();
      }

      $loopCounter++;
      requestVideos($nextPage);
   }
}



?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">