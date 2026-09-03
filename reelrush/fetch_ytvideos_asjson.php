<?php
require_once("db_connect.php");

$result = $conn->query("SELECT videoId FROM filtered_videos_100_60 ORDER BY rand()");

$videos["items"] = array();

while ($row = $result->fetch_assoc()) {
   $videos['items'][] = array(
      "contentDetails" => array(
         "videoId" => $row['videoId']
      )
  );
}

$videos['items'] = array_values($videos['items']);
print_r(json_encode($videos));
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">