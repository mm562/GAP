<?php
require_once("db_connect.php");

$updated_entries = 0;
$loopCounter = 0;

$stepsize = 50;
$offset = 20258; // NOT UPDATED VALUE
$loops = 20; // 50 videos per loop

$videos_list = true;

if ($videos_list) {
   if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
      throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
   }
   require_once __DIR__ . '/vendor/autoload.php';
   
   $client = new Google_Client();
   $client->setApplicationName('Video Fetching');
   $client->setDeveloperKey('AIzaSyB5jNRClAiN3Xk-HokO0hNaqZ2btAAysms');
    
   getVideoIDs();
   // requestVideos($nextPage);
   // echo "Added __ videos to the database.";
} 

// get fifty video ids at a time, formatted as a string for the youtube data api
function getVideoIDs() {
   global $conn, $client, $offset, $stepsize, $updated_entries, $loopCounter, $loops;

   if ($loopCounter < $loops) {
      $videoQuery = $conn->prepare("SELECT videoId FROM videos2 LIMIT $stepsize OFFSET $offset");
      $videoQuery->execute();
      $videoResult = $videoQuery->get_result();

      $videoIDs = array();
      while ($row = $videoResult->fetch_assoc()) {
         $videoIDs[] = $row["videoId"];
      }
      $combined = implode(',', $videoIDs);

      $offset = $offset + 50;

      getVideoInfo($combined);
      $videoQuery->close();

      $loopCounter++;
      getVideoIDs();
   } else {
      echo "Updated ".$updated_entries." videos";
   }
}

// 
function getVideoInfo($ids) {
   global $conn, $client, $updated_entries;

   $service = new Google_Service_YouTube($client);
   $queryParams = [
      'id' => $ids
   ];
   $response = $service->videos->listVideos('statistics, contentDetails', $queryParams);

   $items = $response->items;
   $stored_response = (array) $items;
   $videos = json_decode(json_encode($stored_response));

   foreach ($videos as $video) {
      $id = $video->id;
      $likes = $video->statistics->likeCount;
      $comments = $video->statistics->commentCount;
      $views = $video->statistics->viewCount;

      $duration = $video->contentDetails->duration;
      $interval = new DateInterval($duration);
      $totalSeconds = $interval->s + ($interval->i * 60);
      $duration = $totalSeconds;

      $updateQuery = $conn->prepare("UPDATE videos2 SET viewCount = ?, likeCount = ?, commentCount = ?, duration = ? WHERE videoId = ?");
      $updateQuery->bind_param('sssss', $views, $likes, $comments, $duration, $id);

      if ($updateQuery->execute()) {
         $updated_entries++;
      }

      $updateQuery->close();
   } 
}

?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">