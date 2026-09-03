<?php
include './assets/config.php';
include 'functions.php';
include './statements/identify.php';

// checkByAPI();
// checkByPing();

$session_id = uniqid();

//check if called by PWA 
// if (!isset($_GET["source"])) {
//    header("location: ./index.php");
// } else {
//    if ($_GET["source"] !== "pwa") {
//       header("location: ./index.php");
//    }
// }

//if enddate is reached
// if (isset($enddate) && isset($prolificid) && isset($session_id)) {
//    if (strtotime($enddate) <= time()) {
//       header("location: ./survey/index.php/179378?lang=en&pr=".$prolificid."&se=".$session_id);
//    }
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <link rel="icon" type="image/png" href="./assets/img/favicon.png">

   <link rel="manifest" href="./manifest.json" crossorigin="use-credentials">
   <meta name="theme-color" content="#000000" />
   <title><?=$config_title?></title>

   <link rel="stylesheet" href="style.css?v=4.15" rel=preload>

   <!-- Firebase Cloud Messaging -->
   <script src="./assets/scripts/firebase-app-compat.js"></script>
   <script src="./assets/scripts/firebase-messaging-compat.js"></script>

   <script src="./assets/scripts/fingerprintjs.min.js"></script>
   <script src="./assets/scripts/jquery-3.7.0.min.js"></script>
   <script src="./assets/scripts/crypto-js.min.js"></script>
   <script src="logic-app.js?v=4.16"></script>
</head>

<body id="app">
   <header>
      <input type="text" class="hidden" name="session_id" value="<?=$session_id?>">
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
      <input type="text" class="hidden" name="gid" value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
      <input type="text" class="hidden" name="fnr" value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">

      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="true">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="false">

      <div class="header_buttons">
         <!-- <a href="#" onclick="toggleAppNav();">
            <div class="header_element">
               <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                  <g class="nc-icon-wrapper" fill="#ffffff">
                     <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="48"
                        d="M88 152h336"></path>
                     <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="48"
                        d="M88 256h336"></path>
                     <path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-miterlimit="10" stroke-width="48"
                        d="M88 360h336"></path>
                  </g>
               </svg>
            </div>
         </a> -->
         <a href="#" class="header_search">
            <div class="header_element">
               <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                  <g class="nc-icon-wrapper" fill="#ffffff">
                     <path
                        d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0 0 34.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 0 0 327.3 362.6l94.09 94.09a25 25 0 0 0 35.3-35.3zM97.92 222.72a124.8 124.8 0 1 1 124.8 124.8 124.95 124.95 0 0 1-124.8-124.8z">
                     </path>
                  </g>
               </svg>
            </div>
         </a>
      </div>
   </header>

   <?php if (!isset($prolificid)) { ?>
   <div id="entry_overlay">
      <div class="loading_animation"></div>
      <p>Verifying Identity</p>
   </div>
   <?php } ?>

   <div id="app_nav">

      <div class="close-btn">
         <a href="#" onclick="toggleAppNav();">
            <!-- ionicons icon: close-outline -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 512 512">
               <g class="nc-icon-wrapper" fill="currentColor">
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                     stroke-width="32" d="M368 368L144 144"></path>
                  <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                     stroke-width="32" d="M368 144L144 368"></path>
               </g>
            </svg>
         </a>
      </div>

      <h2>Menu</h2>
      <div class="container">
         <ul>
            <a href="./info.php?source=pwa">
               <li>Participation info</li>
            </a>
            <a href="./imprint.php?source=pwa">
               <li>Imprint</li>
            </a>
            <a href="./notice.php?source=pwa">
               <li>Notice</li>
            </a>
            <!-- <a href="./logout?source=pwa">
               <li>Logout</li>
            </a> -->
         </ul>
      </div>
   </div>

   <!-- <div id="pause_alert">
      <div class="container">
         <h2>Time for a break?</h2>
         <p>You watched videos for <strong id="pause_alert_time">10 minutes</strong> without a pause.<br>
            Maybe you should take a break.</p>
         <button class="btn" onclick="togglePauseAlert(1);">Ignore</button>
      </div>
   </div> -->

   <div id="video_container">
   </div>


  <!-- Home (active) -->
<div class="navbar">
  <picture><img src ='./assets/img/tiktoknav.svg' style="width: 100vw;"></picture>
</div>
<div class="foryou">
  <p style="color: #c3c3c3">In&nbsp;der&nbsp;Nähe&nbsp;&nbsp;Gefolgt&nbsp;&nbsp;Shop&nbsp;&nbsp;<u style="color: #ffffff">Für&nbsp;dich</u></p>
</div>
<div class = "search">
   <picture><img src ='./assets/img/tiktoksearch.svg' style="width: auto; background:transparent;"></picture>
</div>
<div class = "live">
   <picture><img src ='./assets/img/tiktoklive.svg' style="width: auto; background:transparent;"></picture>
</div></p>

<div class="stoppop" id="stoppop" style="display:none;" >
   <p>Bitte beantworten Sie nun einige Fragen</p>
   <button onclick="collectResults()">Weiter</button>
</div>



   <footer>
      <a href="./imprint.php?source=pwa">Imprint</a>
      |
      <a href="./notice.php?source=pwa">Notice</a>
   </footer>
</body>

</html>