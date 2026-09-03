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
   <script src="logic-install.js"></script>
   <!-- <script src="logic.js"></script> -->
</head>

<body id="page">
   <header>
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
      <input type="text" class="hidden" name="enddate" value="<?php echo (isset($enddate) ? $enddate : ""); ?>">
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   </header>

   <main>
      <h1>Welcome!</h1>
      <div class="collection">
         <div class="text-button" id="install-prompting">
            <p>To participate on the study, please install our web-app on your phone.</p>
            <button class="btn btn-primary" id="install" onclick="install();">Install</button>
         </div>
      </div>
   </main>

   <footer>
      <a href="./imprint">Imprint</a>
      |
      <a href="./notice">Notice</a>
      <script>
      var installButton = document.getElementById("install");

      var beforeInstallPrompt = null;

      window.addEventListener("beforeinstallprompt", eventHandler, errorHandler);

      function eventHandler(event) {
         beforeInstallPrompt = event;
         document.getElementById("install").removeAttribute("disabled");
      }

      function errorHandler(event) {
         console.log("error: " + event);
      }

      function install() {
         if (beforeInstallPrompt) beforeInstallPrompt.prompt().then((result) => {
            if (result.outcome === 'accepted') {
               // User accepted the installation
               window.location.replace("./after-install.php");
            } else {
               // Installation was not accepted
               // window.location.replace("./error.php");
            }
         });
      }
      </script>
   </footer>
</body>

</html>