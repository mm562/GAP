<?php
include './assets/config.php';
// include './statements/identify.php';

if (isset($prolificid)) {
   header('Location: ./app?source=pwa');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="./assets/img/favicon.png">

   <link rel="manifest" href="./manifest.json" crossorigin="use-credentials">
   <meta name="apple-mobile-web-app-status-bar" content="#000000" />
   <meta name="theme-color" content="#000000" />
   <title><?=$config_title?></title>

   <link rel="stylesheet" href="style.css" rel=preload>
   <!-- <script src="./assets/scripts/fingerprintjs.min.js"></script> -->
   <script src="./assets/scripts/jquery-3.7.0.min.js"></script>
   <!-- <script src="logic.js"></script> -->
</head>

<body id="page">
   <header>
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   </header>

   <main>
      <div class="loading_animation"></div>
      <h1>The application is downloading...<br>Please open it after installation.</h1>
      <div class="collection">
         <div class="text-button">
            <p>To continue on the study, please open our app after it is installed on your device.</p>
            <h3 class="prolific-bonus"><a href="https://app.prolific.com/submissions/complete?cc=CAMN4POI"
                  target="_blank">Redirect back to Prolific for completion.</a></h3>
            <p>The installed app should look like this on your smartphone:
            </p>
            <img src="./assets/img/homescreen_preview.jpg" alt="app icon" class="homescreen-preview">
         </div>
      </div>
   </main>

   <footer>
      <a href="./imprint">Imprint</a>
      |
      <a href="./notice">Notice</a>
   </footer>
</body>

</html>