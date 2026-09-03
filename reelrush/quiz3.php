<?php
include './assets/config.php';
include './statements/identify.php';

// if (isset($prolificid)) {
//    header('Location: ./app.php?source=pwa');
// }
// // check if called by PWA 
// if (!isset($_GET["source"])) {
//    header("location: ./index.php");
// } else {
//    if ($_GET["source"] !== "pwa") {
//       header("location: ./index.php");
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
   <meta name="apple-mobile-web-app-status-bar" content="#000000" />
   <meta name="theme-color" content="#000000" />
   <title><?=$config_title?></title>

   <link rel="stylesheet" href="quiz-style.css?v=4.13" rel=preload>
   <script src="./assets/scripts/fingerprintjs.min.js"></script>
   <script src="./assets/scripts/jquery-3.7.0.min.js"></script>
   <script src="logic.js"></script>
</head>
<main>
<body onload="uesRandom()">
   <header>
   <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
      <input type="text" class="hidden" name="gid"
         value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
      <input type="text" class="hidden" name="prolificid"
         value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
   <input type="text" class="hidden" name="startdate" value="<?php echo (isset($startdate) ? $startdate : ""); ?>">
   <input type="text" class="hidden" name="redirect_to_register" id="redirect_to_register" value="false">
   <input type="text" class="hidden" name="redirect_to_app" id="redirect_to_app" value="true">
   <h1>Bitte beantworten Sie die folgenden Fragen</h1>
   </header>
   

      <form id="survey-form" method="POST" action="statements/insert_session_data.php" id="form_initial">
            <input type="text" class="hidden" name="prolificid" id="prolificid"
               value="<?php echo (isset($prolificid) ? $prolificid : ""); ?>">
            <input type="text" class="hidden" name="groupid" id="groupid"
               value="<?php echo (isset($groupid) ? $groupid : ""); ?>">
            <input type="text" class="hidden" name="feednr" id="feednr"
               value="<?php echo (isset($feednr) ? $feednr : ""); ?>">
            <input type="text" class="hidden" name="feedid" id="feedid"
               value= "UES<?php echo (isset($feednr) ? $feednr : ""); ?>">
         <input type="text" class="hidden" name="proc" id="proc"
         value="<?php echo (isset($proc) ? $proc : ""); ?>">
         <input type="text" class="hidden" name="lab" id="lab"
         value="<?php echo (isset($lab) ? $lab : ""); ?>">
               <input type="text" class="hidden" name="feedOrSurvey" id="fos"
               value= "ues">


         <label>Die folgenden Aussagen laden Sie dazu ein, über Ihre Erfahrungen mit der Nutzung der Anwendung nachzudenken. Bitte geben Sie bei jeder Aussage anhand der Skala an, welche Aussage am ehesten auf Sie zutrifft.</label>
         <div id = "fieldset-container">

         </div>
         <button id="submit" type="submit">Weiter</button>
      </form>
</body>
</main>
</html>