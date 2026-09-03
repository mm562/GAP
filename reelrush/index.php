<?php
include './assets/config.php';
include './statements/identify.php';


//  if (isset($prolificid)) {
//     header('Location: ./app.php?source=pwa');
//  }
// check if called by PWA 
// if (!isset($_GET["source"])) {
//    header("location: ./index.php");
// } else {
//    if ($_GET["source"] !== "pwa") {
//       header("location: ./index.php");
//    }
//}
?>

<head>
   <meta name="mobile-web-app-capable" content="yes"/>
   <link rel="manifest" href="./manifest.json">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
   <link rel="icon" type="image/png" href="./assets/img/favicon.png">

   <meta name="theme-color" content="#000000" />
   <title><?=$config_title?></title>

   <link rel="stylesheet" href="style.css?v=4.13" rel=preload>
   <script src="./assets/scripts/fingerprintjs.min.js"></script>
   <script src="./assets/scripts/jquery-3.7.0.min.js"></script>
   <script src="logic.js?v=4.13"></script>
</head>
<body id="page">
   <header>
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
         <input type="text" class="hidden" name="gid"
         value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
         <input type="text" class="hidden" name="fnr"
         value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
      <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
      <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
      <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   </header>

   <main>
      <h1>Welcome!</h1>
      <p>By taking part in this study, you will be supporting research into the use of apps such as TikTok, Instagram
         and YouTube.<br>Therefore, <strong>thank you</strong> in advance! 👏🏻</p>
      
         
         <!-- <div class="text-button">
            <p>You're already registered with your <span class="prolific">ProlificID</span>?</p>
            <a href="login"><button class="btn btn-primary">Login</button></a>
         </div> -->
         <div class="text-button">
            <p><br>Click the button to participate in this study</p>
            <a href="./register.php"><button class="btn btn-primary">Participate</button></a>
         </div>
      </div>
   </main>

   <footer>
      <a href="./imprint.php?source=pwa">Imprint</a>
      |
      <a href="./notice.php?source=pwa">Notice</a>
   </footer>
</body>

</html>